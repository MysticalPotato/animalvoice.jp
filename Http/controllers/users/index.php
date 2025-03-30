<?php

use Core\App;
use Core\Database;
use Core\Session;

$users = App::resolve(Database::class)->query('SELECT * FROM users')->get();
$users = array_reverse($users);

// get id for newly created user if present
$new_user_id = Session::get('new_item_id') ?? null;

foreach($users as &$user) {
	$user['classes'] = [];

	if($new_user_id && $new_user_id == $user['id']) {
		$user['classes'][] = 'new-item';
	}
}

view('users/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'users',
	'users' => $users,
]);