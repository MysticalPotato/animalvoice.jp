<?php

use Core\Session;

$recipients = [
    __('form.organizers'),
    __('form.subscribers'),
];

view('mailer.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.mailer'),
	],
	'current_tab' => 'mailer',
    'recipients' => $recipients,
    'errors' => Session::get('errors') ?? [],
]);