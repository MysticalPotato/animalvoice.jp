<?php

namespace Core;

use Core\App;
use Core\Database;
use Core\MailException;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

Class Mail {
    protected $sender = null;
    protected $reply_to = null;

    protected $errors = [];

    public function __construct(protected array $recipients) {
        // to create an instance call Mail::to()
        // set default sender
        $this->sender = email();
    }

    public static function to(array|string $recipients) {
        // this function must be called first to create an instance
        return new Mail(is_array($recipients) ? $recipients : [$recipients]);
    }

    public function from(string $sender) {
        $this->sender = $sender;
        return $this;
    }

    public function replyTo(string $reply_to) {
        // $this->headers .= "Reply-To: {$reply_to}" . "\r\n";
        $this->reply_to = $reply_to;
        return $this;
    }

    public function send($mailable) {
        // switch ($this->method) {

        //     case 'default':
        //         $this->sendDefault($mailable);
        //         break;

        //     case 'AWS':
        //         $this->sendAWS($mailable);
        //         break;

        //     default:
        //        return false;
        // }

        // Check database for sending method
        $result = App::resolve(Database::class)->query("SELECT value FROM settings WHERE name = :name", [
            'name' => 'amazon_ses_enabled'
        ])->find();
        
        $method = $result && $result['value'] === '1' ? 'amazon' : 'default';

        // Make directory if it doesn't exist
        $dir = base_path('storage/temp');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        // Save subject and content to a temp file
        $job_id = uniqid('email_', true);
        file_put_contents("{$dir}/{$job_id}.json", json_encode([
            'method'        => $method,
            'template'      => $mailable->template,
            'subject'       => $mailable->subject,
            'preheader'     => $mailable->preheader,
            'body'          => $mailable->body,
            'sender'        => $this->sender,
            'reply_to'      => $this->reply_to,
            'recipients'    => $this->recipients
        ]));

        // Start job and throw exception if job doesn't exist
        if(!startJob('send_email', [$job_id])) {
            $this->errors['summary'] = __('response.technical_error');
        }

        if($this->failed()) {
            MailException::throw($this->errors());
        }
    }

    public function failed() {
        return count($this->errors);
    }

    public function errors() {
        return $this->errors;
    }


    // OUT OF USE --> Switched to SMTP!
    
    public function sendAWS($mailable) {
        // Create an SesClient. Change the value of the region parameter if you're 
        // using an AWS Region other than US West (Oregon). Change the value of the
        // profile parameter if you want to use a profile in your credentials file
        // other than the default.
        $config = require base_path('config.php');
        $SesClient = new SesClient([
            // 'profile' => 'default',
            'region'  => 'ap-northeast-1',
            'credentials' => [
                'key' => $config['aws']['access_key_id'],
                'secret' => $config['aws']['secret_access_key'],
            ],
        ]);

        // Replace sender@example.com with your "From" address.
        // This address must be verified with Amazon SES.
        $sender_email = $this->sender;

        // Replace these sample addresses with the addresses of your recipients. If
        // your account is still in the sandbox, these addresses must be verified.
        $recipient_emails = $this->recipients;

        // Specify a configuration set. If you do not want to use a configuration
        // set, comment the following variable, and the
        // 'ConfigurationSetName' => $configuration_set argument below.
        // $configuration_set = 'ConfigSet';

        $subject = $mailable->subject;
        $plaintext_body = $mailable->text;
        $html_body =  $mailable->html;
        $char_set = 'UTF-8';

        foreach ($this->recipients as $recipient_email) {
            $unsubscribe_url = 'https://animalvoice.jp/unsubscribe?email=' . urlencode($recipient_email);

            $requestParam = [
                'Destination' => [
                    'ToAddresses' => [$recipient_email],
                ],
                'ReplyToAddresses' => [$this->reply_to ?? $sender_email],
                'Source' => $sender_email,
                'Message' => [
                    'Body' => [
                        'Html' => [
                            'Charset' => $char_set,
                            'Data' => $html_body,
                        ],
                        'Text' => [
                            'Charset' => $char_set,
                            'Data' => $plaintext_body,
                        ],
                    ],
                    'Subject' => [
                        'Charset' => $char_set,
                        'Data' => $subject,
                    ],
                ],
                // If you aren't using a configuration set, comment or delete the
                // following line
                // 'ConfigurationSetName' => $configuration_set,
            ];

            if(true) {
                $requestParam['Headers'] = [
                    [
                        'Name' => 'List-Unsubscribe',
                        'Value' => '<' . $unsubscribe_url . '>',
                    ],
                    [
                        'Name' => 'List-Unsubscribe-Post',
                        'Value' => 'List-Unsubscribe=One-Click',
                    ],
                ];
            }

            try {
                $result = $SesClient->sendEmail($requestParam);
                // $messageId = $result['MessageId'];
                // echo("Email sent! Message ID: $messageId"."\n");

            } catch (AwsException $e) {
                $this->errors['summary'] = __('response.technical_error');
                $this->errors['raw'] = $e->getMessage() . "\r\n" . "The email was not sent. Error message: " . $e->getAwsErrorMessage();
            }
        }
    }
}