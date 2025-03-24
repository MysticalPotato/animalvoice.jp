<?php

use Core\App;
use Core\Database;

$posts = App::resolve(Database::class)->query('SELECT * FROM posts')->get();

view('posts/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'posts',
	'posts' => $posts,
]);