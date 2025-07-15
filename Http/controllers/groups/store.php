<?php

use Core\App;
use Core\Mail;
use Core\Database;
use Core\Response;
use Http\Forms\GroupForm;
use Http\Mailables\NewGroupMailable;

// all variables that should be in POST, not what is required
if(!isset(
	$_POST['name'],
	$_POST['prefecture'],
	$_POST['city'],
	$_POST['homepage'],
	$_POST['organizer_first_name'],
	$_POST['organizer_last_name'],
	$_POST['organizer_email']
)) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// clean input
$_POST = cleanInput($_POST);

// validate form
$form = GroupForm::validate($attributes = [
	'name'					=> $_POST['name'],
	'prefecture'			=> $_POST['prefecture'],
	'city'					=> $_POST['city'],
	'homepage'				=> $_POST['homepage'],
	'organizer_first_name'	=> $_POST['organizer_first_name'],
	'organizer_last_name'	=> $_POST['organizer_last_name'],
	'organizer_email'		=> $_POST['organizer_email'],
]);

// insert into database
$id = App::resolve(Database::class)->query('INSERT INTO groups(
	name,
	region,
	prefecture,
	city,
	homepage,
	organizer_first_name,
	organizer_last_name,
	organizer_email
) VALUES(
	:name,
	:region,
	:prefecture,
	:city,
	:homepage,
	:organizer_first_name,
	:organizer_last_name,
	:organizer_email
)', [
	'name'					=> $attributes['name'],
	'region'				=> getRegion($attributes['prefecture']),
	'prefecture'			=> $attributes['prefecture'],
	'city'					=> $attributes['city'],
	'homepage'				=> $attributes['homepage'],
	'organizer_first_name'	=> $attributes['organizer_first_name'],
	'organizer_last_name'	=> $attributes['organizer_last_name'],
	'organizer_email'		=> $attributes['organizer_email'],
])->id();

// update group_id for application
if(isset($_POST['application_id']) && is_numeric($_POST['application_id'])) {
	App::resolve(Database::class)->query('UPDATE applications SET group_id = :group_id WHERE id = :id', [
		'id'		=> (int) $_POST['application_id'],
		'group_id'	=> $id,
	]);
}

// send welcome email
if(isset($_POST['send_welcome_email']) && (int) $_POST['send_welcome_email'] === 1) {
	$mailable = new NewGroupMailable($attributes);
	Mail::to($attributes['organizer_email'])
		->from(email('general'))
		->send($mailable);
}

// redirect if everything went right
redirect(route('/admin/groups'), [
	'new_item_id' => $id
]);