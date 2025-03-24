<?php

use Core\Response;
use Core\Authenticator;
use Http\Forms\LoginForm;

if(!isset($_POST['email'], $_POST['password'])) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);

$signedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);

if(!$signedIn) {
    $form->error('summary', __('response.bad_credentials'))->throw();
}

redirect(route('/admin'));