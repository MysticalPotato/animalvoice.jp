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