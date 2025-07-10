<?php

use Core\App;
use Core\Database;
use Core\Response;
use Core\Validator;

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

$min_len = 1;
$max_len = 50;

// check if not empty
if(!Validator::string($_POST['email'], $min_len, $max_len)) {
    $errors['email'] = insertVars(__('response.min_length'), $min_len);
}

// check if real email address
elseif (!Validator::email($_POST['email'])) {
    $errors['email'] = __('response.email_format');
}

// abort if any errors
if(!empty($errors)) {
    echo $errors['email'];
    http_response_code(Response::BAD_REQUEST);
    die();
}

// check if already subscribed
$exists = App::resolve(Database::class)->query('SELECT COUNT(*) as count FROM subscribers WHERE email = :email', [
    'email' => $_POST['email']
])->statement->fetch()['count'];

if ($exists > 0) {
    echo __('response.already_subscribed');
    http_response_code(Response::CONFLICT);
    die();
}

// insert into databse
App::resolve(Database::class)->query('INSERT INTO subscribers(email) VALUES(:email)', [
    'email' => $_POST['email'],
]);

// set response code
http_response_code(Response::CREATED);