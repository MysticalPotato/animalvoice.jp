<?php

use Core\App;
use Core\Database;
use Core\Response;
use Core\Session;
use Core\Mail;
use Http\Forms\RecoverForm;
use Http\Mailables\Mailable;

const ORGANIZERS = 0;
const SUBSCRIBERS = 1;

$id = (int) $routeParams['id'];

$email = App::resolve(Database::class)->query("SELECT * FROM emails WHERE id = :id", [
	'id' => $id
])->findOrFail();

$recipients = [
	__('form.organizers'),
	__('form.subscribers'),
];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// if email is set, it's a test email
	$test_email = !empty($_POST['email']) ? $_POST['email'] : null;

	// cast recipient to int
	$recipient = (int)$email['recipient'];

	// get recipients
	$recipients = [];
	
	if($test_email) {
		// clean input
		$test_email = cleanInput($test_email);

		// validate form (for now use RecoverForm, as it only validates email)
		$form = RecoverForm::validate($attributes = [
			'email' => $test_email
		]);

		// add email to recipients
		$recipients[] = $attributes['email'];
	}

	else {
		// if for organizers
		if($recipient === ORGANIZERS) {
			$result = App::resolve(Database::class)->query('SELECT DISTINCT organizer_email FROM groups WHERE organizer_email IS NOT NULL AND organizer_email != ""')->getOrFail();
			$recipients = array_column($result, 'organizer_email');
		}

		// if for subscribers
		elseif($recipient === SUBSCRIBERS) {
			$result = App::resolve(Database::class)->query('SELECT email FROM subscribers')->getOrFail();
			$recipients = array_column($result, 'email');
		}

		// abort if no match
		else {
			abort(Response::BAD_REQUEST);
		}
	}

	// create mailable
	$mailable = new Mailable();
	$mailable->template = $recipient === SUBSCRIBERS ? 'newsletter' : 'plain';
	$mailable->subject = $email['subject'];
	$mailable->body = $email['content'];

	// send email
	Mail::to($recipients)
		->from(email('general'))
		->send($mailable);

	// set date_sent to current in database if not a test email
	if(!$test_email) {
		App::resolve(Database::class)->query("UPDATE emails SET date_sent = :date_sent WHERE id = :id", [
			'id'		=> $id,
			'date_sent'	=> date('Y-m-d'),
		]);
	}

	// reload page if everything went right
	redirect($_SERVER['HTTP_REFERER'], [
		'status' => __('response.email_sent')
	]);
}

view('emails/show.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.emails'),
		'back_route' => route('/admin/emails'),
	],
	'current_tab' => 'emails',
	'errors' => Session::get('errors') ?? [],
	'status' => Session::get('status') ?? '',
	'recipients' => $recipients,
	'email' => $email,
]);