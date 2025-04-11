<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Response;
use Http\Forms\SettingsForm;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	// all variables that should be in POST, not what is required
	if(!isset(
		$_POST['contact_email'],
	)) {
		http_response_code(Response::BAD_REQUEST);
		die();
	}

	// clean input
	$_POST = cleanInput($_POST);

	// validate form
	$form = SettingsForm::validate($attributes = [
		'contact_email'	=> $_POST['contact_email'],
	]);

	// insert into database
	App::resolve(Database::class)->query('UPDATE settings SET value = :value WHERE name = :name', [
		'name' => 'contact_email',
		'value' => $attributes['contact_email'],
	]);

	// USE FOR UPDATING MULTIPLE SETTINGS!
	// App::resolve(Database::class)->query("UPDATE settings SET value = CASE
	// 	WHEN name = 'contact_email'	THEN :contact_email
	// 	WHEN name = 'notify_user'	THEN :notify_user
	// END
	// 	WHERE name IN ('contact_email', 'notify_user')",
	// [
	// 	'contact_email'	=> $attributes['contact_email'],
	// 	'notify_user'	=> $attributes['notify_user'],
	// ]);

	// redirect if everything went right
	redirect($_SERVER['HTTP_REFERER'], [
		'status' => __('response.settings_saved')
	]);
}

$result = App::resolve(Database::class)->query("SELECT * FROM settings")->getOrFail();
$settings = [];

foreach($result as $setting) {
	$settings[$setting['name']] = $setting['value'];
}

view('settings.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'settings',
	'errors' => Session::get('errors') ?? [],
	'status' => Session::get('status') ?? '',
	'settings' => $settings,
]);