<?php

use Core\App;
use Core\Database;

$applications = App::resolve(Database::class)->query('SELECT id, first_name, last_name, date FROM applications')->get();

view('applications/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'applications',
	'applications' => $applications,
]);