<?php

const BASE_PATH = __DIR__ . '/../../';

require BASE_PATH . 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Soundasleep\Html2Text;

// set the default timezone to use.
date_default_timezone_set('Asia/Tokyo');


// === CONFIGURATION === //
define('CHUNK_SIZE', 10);
define('DELAY_BETWEEN_CHUNKS', 2); // seconds
define('MAX_RETRIES', 3);
define('RETRY_DELAY_SECONDS', 1);


// === HELPERS === //
function base_path($path) {
    return BASE_PATH . $path;
}

function writeLog($message) {
    $dir = base_path('storage/logs');
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    $logFile = $dir . DIRECTORY_SEPARATOR . 'log_' . date("Y-m-d") . '.txt';
    $log = '[' . date("T Y-m-d H:i:s") . '] Message: ' . $message . PHP_EOL;
    file_put_contents($logFile, $log, FILE_APPEND);
}

function renderTemplate(string $template_file, array $vars): string {
    extract($vars);
    ob_start();
    include $template_file;
    return ob_get_clean();
}

function get_credentials($method, $sender) {
    $config = require base_path('config.php');

    // amazon
    if($method === 'amazon') {
        return $config['smtp']['amazon'];
    }

    // default
    if($sender === 'hello@animalvoice.jp') {
        return $config['smtp']['general'];
    }

    if($sender === 'webform@animalvoice.jp') {
        return $config['smtp']['webform'];
    }

    if($sender === 'noreply@animalvoice.jp') {
        return $config['smtp']['noreply'];
    }

    if($sender === 'sandbox@animalvoice.jp') {
        return $config['smtp']['sandbox'];
    }

    return null;
}

function load_data($job_id) {
    $path = base_path("storage/temp/{$job_id}.json");
    return file_exists($path) ? json_decode(file_get_contents($path), true) : null;
}

function unlink_temp_file($job_id) {
    $path = base_path("storage/temp/{$job_id}.json");
    if (file_exists($path)) {
        unlink($path);
    }
}


// === LOAD DATA === //
$job_id = $argv[1] ?? null;
if (!$job_id) {
    writeLog("Error: Missing job ID");
    exit(1);
}

$data = load_data($job_id);
if (!$data) {
    writeLog("Error: Failed to load newsletter_data.json");
    exit(1);
}

$method         = $data['method'] ?? 'default'; // OPTIONAL
$template       = $data['template'] ?? 'plain'; // OPTIONAL
$subject        = $data['subject'];             // REQUIRED
$preheader      = $data['preheader'] ?? null;   // OPTIONAL
$body           = $data['body'];                // REQUIRED
$sender         = $data['sender'];              // REQUIRED
$reply_to       = $data['reply_to'] ?? null;    // OPTIONAL
$recipients     = $data['recipients'];          // REQUIRED


// === LOAD CREDENTIALS === //
$credentials = get_credentials($method, $sender);
if(!$credentials) {
    writeLog("Error: Failed to load credentials");
    exit(1);
}

// === EMAIL SENDING LOOP === //
$chunks = array_chunk($recipients, CHUNK_SIZE);

foreach ($chunks as $chunkIndex => $chunk) {

    foreach ($chunk as $recipient) {
        $unsubscribe_url = 'https://animalvoice.jp/unsubscribe?email=' . urlencode($recipient);

        // Apply template
        $template_file = base_path("views/partials/email_template_{$template}.php");

        $html_body = $body;
        if ($template_file && file_exists($template_file)) {
            $html_body = renderTemplate($template_file, [
                'subject'   => $subject,
                'preheader' => $preheader,
                'content'   => $body,
                'recipient' => $recipient,
            ]);
        }

        // Generate a plaintext email
        $plaintext_body = Html2Text::convert($html_body);

        // Retry loop
        $attempts = 0;
        $sent = false;

        while ($attempts < MAX_RETRIES && !$sent) {
            $attempts++;

            try {
                $mail = new PHPMailer(true);

                // SMTP settings
                $mail->isSMTP();
                $mail->Host       = $credentials['host'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $credentials['username'];
                $mail->Password   = $credentials['password'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
                $mail->Port       = 587;

                // Enable debug for testing
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                // Optional unsubscribe headers for newsletters
                if(!empty($template) && $template === 'newsletter') {
                    $mail->addCustomHeader('List-Unsubscribe', "<{$unsubscribe_url}>");
                    $mail->addCustomHeader('List-Unsubscribe-Post', 'List-Unsubscribe=One-Click');
                }

                // Sender and recipient
                $mail->setFrom($sender, 'アニマル・ボイス');
                $mail->addAddress($recipient);

                // Set reply to if present
                if($reply_to) {
                    $mail->addReplyTo($reply_to);
                }

                // Email content
                $mail->isHTML(true); // Sets default headers for html (Content-Type, MIME-Version)
                $mail->Subject = $subject;
                $mail->Body    = $html_body;
                $mail->AltBody = $plaintext_body;
                $mail->CharSet = 'utf-8';

                // Send newsletter
                $mail->send();
                $sent = true;
                writeLog("Email sent to {$recipient} (Attempt {$attempts})");

            } catch (Exception $e) {
                writeLog("Send failure to {$recipient} on attempt {$attempts}: {$e->getMessage()} | PHPMailer Error: {$mail->ErrorInfo}");
                if ($attempts < MAX_RETRIES) {
                    sleep(RETRY_DELAY_SECONDS);
                }
            }
        }

        if (!$sent) {
            writeLog("Final failure: Email could not be sent to {$recipient} after {$attempts} attempts.");
        }
    }

    // Throttle between chunks
    if ($chunkIndex < count($chunks) - 1) {
        sleep(DELAY_BETWEEN_CHUNKS);
    }
}

// Write log for success
writeLog("Newsletter job complete. Subject: \"{$subject}\"");

// Delete temporarily JSON file
unlink_temp_file($job_id);