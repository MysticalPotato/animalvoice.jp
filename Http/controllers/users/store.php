<?php

use Core\App;
use Core\Mail;
use Core\Database;
use Core\Response;
use Http\Forms\UserForm;
use Http\Mailables\NewUserMailable;

// all variables that should be in POST, not what is required
if(!isset($_POST['username'], $_POST['email'], $_POST['password']) && $_POST['password'] === '') {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// clean input
$_POST = cleanInput($_POST);

// validate form
$form = UserForm::validate($attributes = [
	'username'		=> $_POST['username'],
	'email'         => $_POST['email'],
	'password'		=> $_POST['password'],
]);

// encrypt the password
$encrypted = password_hash($attributes['password'], PASSWORD_BCRYPT);

// insert into database
App::resolve(Database::class)->query('INSERT INTO users(username, email, password) VALUES(:username, :email, :password)', [
	'username'		=> $attributes['username'],
	'email'         => $attributes['email'],
	'password'		=> $encrypted,
]);

// create mailable
$mailable = new NewUserMailable($attributes);

// mail the new user his login details
Mail::to($attributes['email'])->send($mailable);

// redirect if everything went right
redirect(route('/admin/users'));