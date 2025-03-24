<?php

use Core\App;
use Core\Database;
use Core\Response;
use Core\Validator;

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

if(!empty($errors)) {
    echo $errors['email'];
    http_response_code(Response::BAD_REQUEST);
    die();
}

App::resolve(Database::class)->query('INSERT INTO subscribers(email) VALUES(:email)', [
    'email' => $_POST['email'],
]);

// set response code
http_response_code(Response::CREATED);

// write logs
// function write($log, $message){
//     $content = $message . PHP_EOL;
//     file_put_contents($log, $content, FILE_APPEND);
// }
// $log = base_path('logs/newsletter_signups.log');
// write($log, date("Y-m-d H:i:s") . " " . $email);