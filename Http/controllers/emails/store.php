<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\EmailForm;

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

// insert into database
$id = App::resolve(Database::class)->query('INSERT INTO emails(recipient, subject, content)
	VALUES(:recipient, :subject, :content)', $attributes)->id();

// redirect if everything went right
redirect(route('/admin/emails'), [
	'new_item_id' => $id
]);