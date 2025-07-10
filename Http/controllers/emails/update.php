<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\EmailForm;

$id = (int) $routeParams['id'];

$email = App::resolve(Database::class)->query("SELECT date_sent FROM emails WHERE id = :id", [
	'id' => $id
])->findOrFail();

// abort if already sent
if(!empty($email['date_sent'])) {
	abort(Response::FORBIDDEN);
}

// filter allowed keys
$allowed = ['recipient', 'subject', 'content'];
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
$form = EmailForm::validate($attributes = [...$_POST]);

// insert all attributes one by one into database
foreach($attributes as $key => $value) {
	App::resolve(Database::class)->query("UPDATE emails SET $key = :{$key} WHERE id = :id", [
		'id'		=> $id,
		$key		=> $value,
	]);
}

// redirect if everything went right
redirect(route('/admin/emails/' . $id), [
	'status' => __('response.changes_saved')
]);