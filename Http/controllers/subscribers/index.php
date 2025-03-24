<?php

use Core\App;
use Core\Database;

$subscribers = App::resolve(Database::class)->query('SELECT * FROM subscribers')->get();

view('subscribers/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'subscribers',
	'subscribers' => $subscribers,
]);