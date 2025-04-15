<?php

use Core\App;
use Core\Database;
use Core\Session;

$user = App::resolve(Database::class)->query("SELECT * FROM users WHERE id = :id", [
	'id' => $_SESSION['user']['id']
])->findOrFail();

view('account.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.account'),
	],
	'current_tab' => 'account',
    'user' => $user,
	'errors' => Session::get('errors') ?? [],
	'status' => Session::get('status') ?? '',
]);