<?php

use Core\Session;
use Http\Forms\Form;

// create random password
$password = Form::randomPassword();

view('users/create.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.create_user'),
		'back_route' => route('/admin/users'),
	],
	'current_tab' => 'users',
	'errors' => Session::get('errors') ?? [],
	'password' => $password,
]);