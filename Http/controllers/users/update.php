<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\UserForm;

$id = (int) $routeParams['id'];

// all variables that should be in POST, not what is required
if(!isset($_POST['username'], $_POST['email'], $_POST['password'])) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// clean input
$_POST = cleanInput($_POST);

// validate form
$form = UserForm::validate($attributes = [
    'id'			=> $id,
	'username'		=> $_POST['username'],
	'email'         => $_POST['email'],
	'password'      => $_POST['password'],
]);

// encrypt the password
$encrypted = password_hash($attributes['password'], PASSWORD_BCRYPT);

// get password if empty
if($attributes['password'] === '') {
	$encrypted = App::resolve(Database::class)->query("SELECT password FROM users WHERE id = :id", [
		'id' => $id
	])->findOrFail();
}

// insert into database
App::resolve(Database::class)->query('UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id', [
    'id'			=> $id,
	'username'		=> $attributes['username'],
	'email'         => $attributes['email'],
	'password'      => $encrypted,
]);

// redirect if everything went right
redirect(route('/admin/users/' . $id));