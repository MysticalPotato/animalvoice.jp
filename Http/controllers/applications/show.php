<?php

use Core\App;
use Core\Database;

$id = (int) $routeParams['id'];

$application = App::resolve(Database::class)->query("SELECT * FROM applications WHERE id = :id", [
	'id' => $id
])->findOrFail();

$result = App::resolve(Database::class)->query("SELECT * FROM groups WHERE city = :city", [
	'city' => $application['city']
])->find();

$approved = $result ? true : false;

view('applications/show.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'applications',
	'application' => $application,
	'approved' => $approved,
]);