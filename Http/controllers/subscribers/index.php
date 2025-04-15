<?php

use Core\App;
use Core\Database;

$subscribers = App::resolve(Database::class)->query('SELECT * FROM subscribers')->get();
$subscribers = array_reverse($subscribers);

view('subscribers/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.subscribers'),
	],
	'current_tab' => 'subscribers',
	'subscribers' => $subscribers,
]);