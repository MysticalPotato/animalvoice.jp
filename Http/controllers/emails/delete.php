<?php

use Core\App;
use Core\Database;
use Core\Session;

$id = (int) $routeParams['id'];

$email = App::resolve(Database::class)->query("SELECT * FROM emails WHERE id = :id", [
	'id' => $id
])->findOrFail();

view('emails/delete.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.delete_email'),
		'back_route' => route("/admin/emails/{$email['id']}"),
	],
	'current_tab' => 'emails',
	'errors' => Session::get('errors') ?? [],
	'email' => $email,
]);