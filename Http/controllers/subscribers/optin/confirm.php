<?php

use Core\App;
use Core\Response;
use Core\Database;

function view_page($response_code) {
    http_response_code($response_code);

    view('subscribers/optin/confirm.view.php', [
        'meta_title' => __('meta.website_name'),
        'meta_description' => __('meta.description'),
    ]);

    die();
}

// abort if email and token are not set
if(!isset($_GET['email'], $_GET['token'])) {
	abort(Response::BAD_REQUEST);
}

$pending_sub = App::resolve(Database::class)->query('SELECT id, email, date FROM pending_subscribers WHERE email = :email AND token = :token', [
    'email' => $_GET['email'],
    'token' => $_GET['token'],
])->find();

// check if pending subscriber exists
if(!$pending_sub) {
	view_page(Response::NOT_FOUND);
}

// check if expired
if(time() - strtotime($pending_sub['date']) > 86400) {
    view_page(Response::GONE);
}

// check if already subscribed (this is impossible, as this email should have already been deleted from pending_subscribers)
$subscriber_count = App::resolve(Database::class)->query('SELECT COUNT(*) as count FROM subscribers WHERE email = :email', [
    'email' => $_GET['email']
])->find()['count'];

if($subscriber_count > 0) {
    view_page(Response::CONFLICT);
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
view_page(Response::CREATED);