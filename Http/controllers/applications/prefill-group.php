<?php

use Core\App;
use Core\Database;

$id = (int) $routeParams['id'];

// post request to /admin/applications/{id} means application approved -> redirect to /admin/groups/create
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application = App::resolve(Database::class)->query("SELECT * FROM applications WHERE id = :id", [
        'id' => $id
    ])->findOrFail();

	redirect(route('/admin/groups/create'), [
		'old' => [
			'name'					=> "アニマル・ボイス　{$application['city']}",
			'prefecture'			=> $application['prefecture'],
			'city'					=> $application['city'],
			'homepage'				=> '',
			'organizer_first_name'	=> $application['first_name'],
			'organizer_last_name'	=> $application['last_name'],
			'organizer_email'		=> $application['email'],
			'send_welcome_email'	=> '1',
			'application_id'		=> $id,
		]
	]);
}