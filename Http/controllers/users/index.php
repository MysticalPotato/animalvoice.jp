<?php

use Core\App;
use Core\Database;

$users = App::resolve(Database::class)->query('SELECT * FROM users')->get();

view('users/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'users',
	'users' => $users,
]);