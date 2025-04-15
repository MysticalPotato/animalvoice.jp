<?php

use Core\Session;

view('posts/create.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.create_post'),
		'back_route' => route('/admin/posts'),
	],
	'current_tab' => 'posts',
	'errors' => Session::get('errors') ?? [],
]);