<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\Form;

$id = (int) $routeParams['id'];

$user = App::resolve(Database::class)->query("SELECT * FROM users WHERE id = :id", [
	'id' => $id
])->findOrFail();

// create random password
$password = Form::randomPassword();

view('users/show.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.users'),
		'back_route' => route('/admin/users'),
	],
	'current_tab' => 'users',
	'user' => $user,
	'password' => $password,
	'status' => Session::get('status') ?? '',
]);