<?php

use Core\App;
use Core\Database;
use Core\Response;
use Core\Session;

$id = (int) $routeParams['id'];

$email = App::resolve(Database::class)->query("SELECT * FROM emails WHERE id = :id", [
	'id' => $id
])->findOrFail();

if(!empty($email['date_sent'])) {
	abort(Response::FORBIDDEN);
}

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

view('emails/edit.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.edit_email'),
		'back_route' => route("/admin/emails/{$email['id']}"),
	],
	'current_tab' => 'emails',
	'errors' => Session::get('errors') ?? [],
	'recipients' => $recipients,
	'email' => $email,
]);