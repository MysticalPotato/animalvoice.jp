<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Response;
use Http\Forms\SettingsForm;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	// filter allowed keys
	$allowed = ['contact_email', 'amazon_ses_enabled'];
	$_POST = array_intersect_key($_POST, array_flip($allowed));

	// filter empty values
	$_POST = array_filter($_POST, function($value) {
		return $value !== false && !is_null($value) && ($value !== '' || $value === '0');
	});

	// stop here if no allowed keys
	if(!$_POST) {
		abort(Response::BAD_REQUEST);
	}

	// clean input
	$_POST = cleanInput($_POST);

	// validate form
	$form = SettingsForm::validate($attributes = $_POST);

	// insert all attributes one by one into database
	foreach($attributes as $key => $value) {
		App::resolve(Database::class)->query("UPDATE settings SET value = :value WHERE name = :name", [
			'name'	=> $key,
			'value'	=> $value,
		]);
	}

	// redirect if everything went right
	redirect($_SERVER['HTTP_REFERER'], [
		'status' => __('response.changes_saved')
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
	'header' => [
		'title'	=> __('nav.settings'),
	],
	'current_tab' => 'settings',
	'errors' => Session::get('errors') ?? [],
	'status' => Session::get('status') ?? '',
	'settings' => $settings,
]);