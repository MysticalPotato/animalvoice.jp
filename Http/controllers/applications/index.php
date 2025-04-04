<?php

use Core\App;
use Core\Session;
use Core\Database;

$applications = App::resolve(Database::class)->query('SELECT id, first_name, last_name, date, viewed FROM applications')->get();
$applications = array_reverse($applications);

// prepare classes for each application
foreach($applications as &$application) {
	$application['classes'] = [];

	if(!$application['viewed']) {
		$application['classes'][] = 'new-item';
	}
}

view('applications/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'applications',
	'applications' => $applications,
]);