<?php

use Core\App;
use Core\Response;
use Core\Database;

// abort if email and token are not set
if(!isset($_GET['email'], $_GET['token'])) {
	abort(Response::NOT_FOUND);
}

$pending_sub = App::resolve(Database::class)->query('SELECT id, email, date FROM pending_subscribers WHERE email = :email AND token = :token', [
    'email' => $_GET['email'],
    'token' => $_GET['token'],
])->find();

// abort if no database entry
if(!$pending_sub) {
	abort(Response::NOT_FOUND);
}

// set the default timezone to use.
date_default_timezone_set('Asia/Tokyo');

// check if expired
if(time() - strtotime($pending_sub['date']) > 86400) {
    abort(Response::GONE);
}

// check if already subscribed (this is impossible, as this email should have already been deleted from pending_subscribers)
$subscriber_count = App::resolve(Database::class)->query('SELECT COUNT(*) as count FROM subscribers WHERE email = :email', [
    'email' => $_GET['email']
])->find()['count'];

if($subscriber_count > 0) {
    abort(Response::CONFLICT);
}

// delete pending subscription
App::resolve(Database::class)->query('DELETE FROM pending_subscribers WHERE id = :id', [
	'id' => $pending_sub['id']
]);

// post email to subscribers
App::resolve(Database::class)->query('INSERT INTO subscribers(email) VALUES(:email)', [
    'email' => $pending_sub['email']
]);

// show page if subscribed
view('subscribers/optin/confirm.view.php', [
	'meta_title' => __('meta.website_name'),
	'meta_description' => __('meta.description'),
]);