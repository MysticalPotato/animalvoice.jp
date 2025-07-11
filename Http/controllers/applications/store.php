<?php

use Core\App;
use Core\Mail;
use Core\Database;
use Core\Response;
use Http\Forms\ApplicationForm;
use Http\Mailables\ApplicationMailable;

// unset form start time to prevent submission on refresh
$form_start = $_SESSION['form_start'] ?? null;
unset($_SESSION['form_start']);

// honeypot and time-based check
if (!empty($_POST['website']) || !isset($form_start) || time() - $form_start < 2) {
	http_response_code(200);
	die('Form submitted!');
}

// all variables that should be in POST, not what is required
if(!isset(
	$_POST['first_name'],
	$_POST['last_name'],
	$_POST['email'],
	$_POST['prefecture'],
	$_POST['city'],
	$_POST['question_1'],
	$_POST['question_2'],
	$_POST['question_3']
)) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// clean input
$_POST = cleanInput($_POST);

// validate form
$form = ApplicationForm::validate($attributes = [
	'first_name'	=> $_POST['first_name'],
	'last_name'		=> $_POST['last_name'],
	'email'			=> $_POST['email'],
	'prefecture'	=> $_POST['prefecture'],
	'city'			=> $_POST['city'],
	'question_1'	=> $_POST['question_1'],
	'question_2'	=> $_POST['question_2'],
	'question_3'	=> $_POST['question_3'],
]);

// insert into database
App::resolve(Database::class)->query('INSERT INTO applications(
	first_name,
	last_name,
	email,
	prefecture,
	city,
	question_1,
	question_2,
	question_3
) VALUES(
	:first_name,
	:last_name,
	:email,
	:prefecture,
	:city,
	:question_1,
	:question_2,
	:question_3
)', [
	'first_name'	=> $attributes['first_name'],
	'last_name'		=> $attributes['last_name'],
	'email'			=> $attributes['email'],
	'prefecture'	=> $attributes['prefecture'],
	'city'			=> $attributes['city'],
	'question_1'	=> $attributes['question_1'],
	'question_2'	=> $attributes['question_2'],
	'question_3'	=> $attributes['question_3'],
]);

// create mailable
$mailable = new ApplicationMailable($attributes);

// get recipients
$users = App::resolve(Database::class)->query("SELECT email FROM users")->getOrFail();
$recipients = [];
foreach ($users as $user) {
	$recipients[] = $user['email'];
}
	
// send email
Mail::to($recipients)
	->from(email('webform'))
	->replyTo($attributes['email'])
	->send($mailable);

// redirect if everything went right
redirect($_SERVER['HTTP_REFERER'], [
	'status' => __('response.form_submitted')
]);