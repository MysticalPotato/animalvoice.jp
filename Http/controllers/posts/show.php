<?php

use Core\App;
use Core\Database;
use Core\Session;

$id = (int) $routeParams['id'];

$post = App::resolve(Database::class)->query("SELECT * FROM posts WHERE id = :id", [
	'id' => $id
])->findOrFail();

view('posts/show.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.posts'),
		'back_route' => route('/admin/posts'),
	],
	'current_tab' => 'posts',
	'post' => $post,
	'status' => Session::get('status') ?? '',
]);