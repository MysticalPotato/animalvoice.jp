<?php

use Core\App;
use Core\Database;
use Core\Session;

$organizers_count = App::resolve(Database::class)->query(
	"SELECT COUNT(DISTINCT organizer_email) FROM groups WHERE organizer_email IS NOT NULL AND organizer_email != ''"
)->find();
$organizers_count = $organizers_count[array_key_first($organizers_count)];

$subscribers_count = App::resolve(Database::class)->query(
	"SELECT COUNT(*) FROM subscribers"
)->find();
$subscribers_count = $subscribers_count[array_key_first($subscribers_count)];

$recipients = [
	[
		'name' => __('form.organizers'),
		'count' => $organizers_count,
	],
	[
		'name' => __('form.subscribers'),
		'count' => $subscribers_count,
	],
];

$editor_manual = 'https://docs.google.com/document/d/1tdx8GDxw_MSc4pkU8YmDzZavIICiOwwfORYcQiJX3jg/edit?usp=sharing';

view('emails/create.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.emails'),
        'back_route' => route('/admin/emails'),
	],
	'current_tab' => 'emails',
    'recipients' => $recipients,
    'errors' => Session::get('errors') ?? [],
	'editor_manual' => $editor_manual,
]);