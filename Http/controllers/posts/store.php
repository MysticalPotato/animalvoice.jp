<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\PostForm;

// all variables that should be in POST, not what is required
if(!isset($_POST['account'], $_POST['url'], $_FILES['image']) && $_FILES['image']['size'] == 0) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// clean input
$_POST = cleanInput($_POST);

// validate form
$form = PostForm::validate($attributes = [
	'account'       => $_POST['account'],
	'url'           => $_POST['url'],
	'image'         => $_FILES['image'],
]);

// upload image if posted
$imageName = '';
if($attributes['image']['size'] > 0) {
	$rel_file_path = uploadFile($_FILES['image'], uniqid(), 'posts');
	$file_path = public_path($rel_file_path);

	$dim = getimagesize($file_path);
	$squareWidth = 320;

	if($dim[0] !== $squareWidth || $dim[1] !== $squareWidth) {
		resizeImage($file_path, $squareWidth, $squareWidth, true);
	}

	$imageName = basename($file_path);
}

// insert into database
$id =App::resolve(Database::class)->query('INSERT INTO posts(account, url, image) VALUES(:account, :url, :image)', [
	'account'       => $attributes['account'],
	'url'           => $attributes['url'],
	'image'         => $imageName,
])->id();

// redirect if everything went right
redirect(route('/admin/posts'), [
	'new_item_id' => $id
]);