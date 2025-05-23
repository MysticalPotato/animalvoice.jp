<?php

use Core\App;
use Core\Database;
use Core\Session;

$id = (int) $routeParams['id'];

$user = App::resolve(Database::class)->query("SELECT * FROM users WHERE id = :id", [
	'id' => $id
])->findOrFail();

view('users/edit.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.edit_user'),
		'back_route' => route("/admin/users/{$user['id']}"),
	],
	'current_tab' => 'users',
	'errors' => Session::get('errors') ?? [],
	'user' => $user,
]);