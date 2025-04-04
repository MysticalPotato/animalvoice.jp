<?php

use Core\App;
use Core\Database;

$id = (int) $routeParams['id'];

$user = App::resolve(Database::class)->query("SELECT * FROM users WHERE id = :id", [
	'id' => $id
])->findOrFail();

view('users/show.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'users',
	'user' => $user,
]);