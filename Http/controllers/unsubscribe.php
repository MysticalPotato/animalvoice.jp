<?php

use Core\App;
use Core\Session;
use Core\Database;
use Core\Response;
use Http\Forms\UnsubscribeForm;

function delete_subscriber($email) {
	App::resolve(Database::class)->query('DELETE FROM subscribers WHERE email = :email', [
        'email' => $email
    ]);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// all variables that should be in POST, not what is required
	if(!isset($_POST['email'])) {
		http_response_code(Response::BAD_REQUEST);
		die();
	}

	// clean input
	$_POST = cleanInput($_POST);

	// validate form
	$form = UnsubscribeForm::validate($attributes = [
		'email' => $_POST['email'],
	]);

	// delete subscriber
	delete_subscriber($attributes['email']);

	// reload page if everything went right
	redirect($_SERVER['HTTP_REFERER'], [
		'status' => __('response.unsubscribed')
	]);
}

if(isset($_GET['email'])) {
	// Clean input
    $_GET = cleanInput($_GET);

	// validate email
	if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
		abort(Response::BAD_REQUEST);
	}

	// delete subscriber
	delete_subscriber($_GET['email']);

	// reload page if everything went right
	redirect(uri(), [
		'status' => __('response.unsubscribed')
	]);
}

view('unsubscribe.view.php', [
	'meta_title' => __('unsubscribe.page_title'),
	'meta_description' => __('unsubscribe.page_description'),
	'errors' => Session::get('errors') ?? [],
	'status' => Session::get('status') ?? '',
]);