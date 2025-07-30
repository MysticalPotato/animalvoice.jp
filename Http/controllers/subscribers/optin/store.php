<?php

use Core\App;
use Core\Mail;
use Core\Database;
use Core\Response;
use Core\Validator;
use Http\Mailables\SubscriptionMailable;

// unset form start time to prevent submission on refresh
$form_start = $_SESSION['form_start'] ?? null;
unset($_SESSION['form_start']);

// honeypot and time-based check
if (!empty($_POST['website']) || !isset($form_start) || time() - $form_start < 2) {
	http_response_code(200);
	die('Form submitted!');
}

$errors = [];

// all variables that should be in POST, not what is required
if(!isset($_POST['email'])) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// clean input
$_POST = cleanInput($_POST);

$email = $_POST['email'];
$min_len = 1;
$max_len = 50;

// check if not empty
if(!Validator::string($email, $min_len, $max_len)) {
    $errors['email'] = insertVars(__('response.min_length'), $min_len);
}

// check if real email address
elseif (!Validator::email($email)) {
    $errors['email'] = __('response.email_format');
}

// abort if any errors
if(!empty($errors)) {
    echo $errors['email'];
    http_response_code(Response::BAD_REQUEST);
    die();
}

// check if already subscribed
$subscriber_count = App::resolve(Database::class)->query('SELECT COUNT(*) as count FROM subscribers WHERE email = :email', [
    'email' => $email
])->find()['count'];

if ($subscriber_count > 0) {
    echo __('response.already_subscribed');
    http_response_code(Response::CONFLICT);
    die();
}

// create hash
$token = bin2hex(random_bytes(32));

// insert or update in database
$pending_subs_count = App::resolve(Database::class)->query('SELECT COUNT(*) as count FROM pending_subscribers WHERE email = :email',[
    'email' => $email
])->find()['count'];

if($pending_subs_count) {
    App::resolve(Database::class)->query('UPDATE pending_subscribers SET token = :token WHERE email = :email', [
        'email' => $email,
        'token' => $token,
    ]);
} else {
    App::resolve(Database::class)->query('INSERT INTO pending_subscribers(email, token) VALUES(:email, :token)', [
        'email' => $email,
        'token' => $token,
    ]);
}

// send subscription confirmation
$mailable = new SubscriptionMailable([
    'email' => $email,
    'token' => $token,
]);
Mail::to($email)
	->from(email('noreply'))
	->send($mailable);

// set response code
http_response_code(Response::CREATED);