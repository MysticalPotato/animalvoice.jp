<?php

use Core\App;
use Core\Database;
use Core\Session;

$id = (int) $routeParams['id'];

$group = App::resolve(Database::class)->query("SELECT * FROM groups WHERE id = :id", [
	'id' => $id
])->findOrFail();

view('groups/show.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'groups',
	'group' => $group,
	'status' => Session::get('status') ?? '',
]);