<?php

use Core\App;
use Core\Mail;
use Core\Session;
use Core\Database;
use Core\Response;
use Http\Forms\ContactForm;
use Http\Mailables\ContactMailable;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// all variables that should be in POST, not what is required
	if(!isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
		http_response_code(Response::BAD_REQUEST);
		die();
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
	Mail::to($recipient)->replyTo($attributes['email'])->send($mailable);

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