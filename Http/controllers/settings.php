<?php

use Core\App;
use Core\Database;

// $settings = App::resolve(Database::class)->query("SELECT * FROM settings")->get();

view('settings.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'settings',
]);