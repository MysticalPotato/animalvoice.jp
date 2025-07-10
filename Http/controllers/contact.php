<?php

use Core\App;
use Core\Mail;
use Core\Session;
use Core\Database;
use Core\Response;
use Http\Forms\ContactForm;
use Http\Mailables\ContactMailable;

// CONFIGURATION
// $enable_captcha = true;
// $min_time_seconds = 3;

// // Honeypot check
// if (!empty($_POST['website'])) {
//     die("Bot detected (honeypot).");
// }

// // Time-based check
// if (!isset($_SESSION['form_start']) || time() - $_SESSION['form_start'] < $min_time_seconds) {
//     die("You submitted too quickly. Are you a bot?");
// }

// // CAPTCHA check (if enabled)
// if ($enable_captcha) {
//     if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha']) {
//         die("Incorrect CAPTCHA.");
//     }
// }

// Toggle CAPTCHA on/off
// $enable_captcha = true;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

	// unset form start time to prevent submission on refresh
	$form_start = $_SESSION['form_start'] ?? null;
	unset($_SESSION['form_start']);

	// honeypot and time-based check
	if (!empty($_POST['website']) || !isset($form_start) || time() - $form_start < 2) {
		http_response_code(200);
		die('Form submitted!');
	}

	// all variables that should be in POST, not what is required
	if(!isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
		abort(Response::BAD_REQUEST);
	}

	// clean input
	$_POST = cleanInput($_POST);

	// validate form
	$form = ContactForm::validate($attributes = [
		'first_name'		=> $_POST['first_name'],
		'last_name'			=> $_POST['last_name'],
		'email'				=> $_POST['email'],
		'subject'			=> $_POST['subject'],
		'message'			=> $_POST['message'],
	]);

	// create mailable
	$mailable = new ContactMailable($attributes);

	//get contact email
	$result = App::resolve(Database::class)->query("SELECT value FROM settings WHERE name = :name", [
		'name' => 'contact_email',
	])->findOrFail();
	
	// send email
	$recipient = $result['value'];
	Mail::to($recipient)
		->from(email('webform'))
		->replyTo($attributes['email'])
		->send($mailable);

	// reload page if everything went right
	redirect($_SERVER['HTTP_REFERER'], [
		'status' => __('response.form_submitted')
	]);
}

view('contact.view.php', [
	'meta_title' => __('contact.page_title'),
	'meta_description' => __('contact.page_description'),
	'errors' => Session::get('errors') ?? [],
	'status' => Session::get('status') ?? '',
	'show_raw_errors' => !production(),
]);