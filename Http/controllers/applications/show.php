<?php

use Core\App;
use Core\Database;

$id = (int) $routeParams['id'];

$application = App::resolve(Database::class)->query("SELECT * FROM applications WHERE id = :id", [
	'id' => $id
])->findOrFail();

// find group for group_id
$result = App::resolve(Database::class)->query("SELECT * FROM groups WHERE id = :id", [
	'id' => $application['group_id']
])->find();

 // assume it has been approved if group with city exists
$approved = $result ? true : false;

// set viewed to true if opened for first time
if(!$application['viewed']) {
	App::resolve(Database::class)->query('UPDATE applications SET viewed = :viewed WHERE id = :id', [
		'id'			=> $id,
		'viewed'		=> 1,
	]);
}

view('applications/show.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.applications'),
		'back_route' => route('/admin/applications'),
	],
	'current_tab' => 'applications',
	'application' => $application,
	'approved' => $approved,
]);