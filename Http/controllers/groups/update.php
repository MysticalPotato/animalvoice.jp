<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\GroupForm;

$id = (int) $routeParams['id'];

// all variables that should be in POST, not what is required
if(!isset(
	$_POST['enabled'],
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
	'id'					=> $id,
	'name'					=> $_POST['name'],
	'prefecture'			=> $_POST['prefecture'],
	'city'					=> $_POST['city'],
	'homepage'				=> $_POST['homepage'],
	'organizer_first_name'	=> $_POST['organizer_first_name'],
	'organizer_last_name'	=> $_POST['organizer_last_name'],
	'organizer_email'		=> $_POST['organizer_email'],
]);

// insert into database
App::resolve(Database::class)->query('UPDATE groups SET
	name					= :name,
	region					= :region,
	prefecture				= :prefecture,
	city					= :city,
	homepage				= :homepage,
	organizer_first_name	= :organizer_first_name,
	organizer_last_name		= :organizer_last_name,
	organizer_email			= :organizer_email,
	enabled					= :enabled
WHERE
	id						= :id',
[
	'id'					=> $id,
	'name'					=> $attributes['name'],
	'region'				=> getRegion($attributes['prefecture']),
	'prefecture'			=> $attributes['prefecture'],
	'city'					=> $attributes['city'],
	'homepage'				=> $attributes['homepage'],
	'organizer_first_name'	=> $attributes['organizer_first_name'],
	'organizer_last_name'	=> $attributes['organizer_last_name'],
	'organizer_email'		=> $attributes['organizer_email'],
	'enabled'				=> (int) $_POST['enabled'],
]);

// redirect if everything went right
redirect(route('/admin/groups/' . $id));