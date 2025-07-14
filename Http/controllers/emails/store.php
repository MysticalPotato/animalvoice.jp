<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\EmailForm;

// all variables that should be in POST, not what is required
if(!isset($_POST['recipient'], $_POST['subject'], $_POST['content'], $_POST['new_images'])) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// clean input
$_POST = cleanInput($_POST);

// validate form
$form = EmailForm::validate($attributes = [
	'recipient'	=> $_POST['recipient'],
	'subject'	=> $_POST['subject'],
	'content'	=> $_POST['content'],
]);

// insert into database
$id = App::resolve(Database::class)->query('INSERT INTO emails(recipient, subject) VALUES(:recipient, :subject)', [
	'recipient'	=> $attributes['recipient'],
	'subject'	=> $attributes['subject'],
])->id();

$content = $attributes['content'];

// move new images and update content
if(!empty($_POST['new_images']) && is_array($_POST['new_images']) && count($_POST['new_images']) > 0) {
	$images = $_POST['new_images'];

	$rel_dir = "/assets/uploads/emails/{$id}/";
	$new_dir = public_path($rel_dir);

	foreach($images as $url) {
		$old_uri = uri($url);
		$current = public_path($old_uri);
		if(!file_exists($current)) {
			continue;
		}

		$basename = basename($url);
		$new_uri = $rel_dir . $basename;
		$new_url = url($new_uri);

		// look for url in content and replace with new url
		$content = str_replace($url, $new_url, $content);

		// make new dir if doesn't exist
		if (!file_exists($new_dir)) {
			mkdir($new_dir, 0777, true);
		}

		// move to new directory
		rename($current, $new_dir . $basename);
	}
}

// update database
App::resolve(Database::class)->query('UPDATE emails SET content = :content WHERE id = :id', [
	'id'		=> $id,
	'content'	=> $content,
]);

// redirect if everything went right
redirect(route('/admin/emails'), [
	'new_item_id' => $id
]);