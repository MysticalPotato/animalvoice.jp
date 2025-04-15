<?php

use Core\App;
use Core\Database;
use Core\Session;

$id = (int) $routeParams['id'];

$post = App::resolve(Database::class)->query("SELECT * FROM posts WHERE id = :id", [
	'id' => $id
])->findOrFail();

view('posts/delete.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.delete_post'),
		'back_route' => route("/admin/posts/{$post['id']}"),
	],
	'current_tab' => 'posts',
	'errors' => Session::get('errors') ?? [],
	'post' => $post,
]);