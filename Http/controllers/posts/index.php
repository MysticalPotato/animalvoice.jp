<?php

use Core\App;
use Core\Database;
use Core\Session;

$posts = App::resolve(Database::class)->query('SELECT * FROM posts')->get();
$posts = array_reverse($posts);

// get id for newly created post if present
$new_post_id = Session::get('new_item_id') ?? null;

// prepare classes for each post
foreach($posts as &$post) {
	$post['classes'] = [];

	if($new_post_id && $new_post_id == $post['id']) {
		$post['classes'][] = 'new-item';
	}

	if(!$post['enabled'] || !$post['url']) {
		$post['classes'][] = 'disabled';
	}
}

view('posts/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.posts'),
	],
	'current_tab' => 'posts',
	'posts' => $posts,
]);