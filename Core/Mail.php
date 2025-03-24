<?php

namespace Core;

use Core\MailException;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

Class Mail {
    protected $method = 'default';
    protected $sender = EMAIL['notify_sender'];
    protected $reply_to = null;

    protected $errors = [];

    public function __construct(protected array $recipients) {
        // to create an instance call Mail::to()
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

    public function with(string $method) {
        // see send() for accepted methods
        $this->method = $method;
        return $this;
    }

    public function send($mailable) {
        switch ($this->method) {

            case 'default':
                $this->sendDefault($mailable);
                break;

            case 'AWS':
                $this->sendAWS($mailable);
                break;

            default:
               return false;
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

    protected function sendDefault($mailable) {
        try {
            $mail = new PHPMailer(true);

            // allow smtp for gmail
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            // $mail->isSMTP();                                            //Send using SMTP
            // $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            // $mail->Username   = '****@gmail.com';                       //SMTP username
            // $mail->Password   = '**** **** **** ****';                  //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
            // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->isHTML();
            $mail->setFrom($this->sender, __('meta.website_name'));

            foreach($this->recipients as $r) {
                $mail->addAddress($r);
            }

            if($this->reply_to) {
                $mail->addReplyTo($this->reply_to);
            }

            $mail->Subject = $mailable->subject;
            $mail->Body = $mailable->html;
            $mail->AltBody = $mailable->text;
            $mail->CharSet = 'utf-8';
            
            $mail->send();
            // echo 'Message has been sent';

        } catch (Exception $e) {
            $this->errors['summary'] = __('response.technical_error');
            $this->errors['raw'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

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

        try {
            $result = $SesClient->sendEmail([
                'Destination' => [
                    'ToAddresses' => $recipient_emails,
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
            ]);
            $messageId = $result['MessageId'];
            // echo("Email sent! Message ID: $messageId"."\n");

        } catch (AwsException $e) {
            $this->errors['summary'] = __('response.technical_error');
            $this->errors['raw'] = $e->getMessage() . "\r\n" . "The email was not sent. Error message: " . $e->getAwsErrorMessage();
        }
    }
}