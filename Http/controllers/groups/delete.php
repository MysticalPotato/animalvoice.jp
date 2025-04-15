<?php

use Core\App;
use Core\Database;
use Core\Session;

$id = (int) $routeParams['id'];

$group = App::resolve(Database::class)->query("SELECT * FROM groups WHERE id = :id", [
	'id' => $id
])->findOrFail();

view('groups/delete.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.delete_group'),
		'back_route' => route("/admin/groups/{$group['id']}"),
	],
	'current_tab' => 'groups',
	'errors' => Session::get('errors') ?? [],
	'group' => $group,
]);