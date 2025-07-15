<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\PostForm;

$id = (int) $routeParams['id'];

// all variables that should be in POST, not what is required
if(!isset($_POST['enabled'], $_POST['account'], $_POST['url'])) {
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

// get group from database
$post = App::resolve(Database::class)->query("SELECT image FROM posts WHERE id = :id", [
	'id' => $id
])->findOrFail();

// upload image if posted
$imageName = $post['image'];
if($attributes['image']['size'] > 0) {
	$rel_file_path = uploadFile($_FILES['image'], uniqid(), 'posts');
	$file_path = public_path($rel_file_path);

	$dim = getimagesize($file_path);
	$squareWidth = 320;

	if($dim[0] !== $squareWidth || $dim[1] !== $squareWidth) {
		resizeImage($file_path, $squareWidth, $squareWidth, true);
	}
	
	// delete old image
	if($imageName !== '') {
		deleteFile('posts/' . $imageName);
	}

	$imageName = basename($file_path);
}

// insert into database
App::resolve(Database::class)->query('UPDATE posts SET account = :account, url = :url, image = :image, enabled = :enabled WHERE id = :id', [
	'id'			=> $id,
	'account'       => $attributes['account'],
	'url'           => $attributes['url'],
	'image'         => $imageName,
	'enabled'		=> (int) $_POST['enabled'],
]);

// redirect if everything went right
redirect(route('/admin/posts/' . $id), [
	'status' => __('response.changes_saved')
]);