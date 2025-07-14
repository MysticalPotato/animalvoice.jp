<?php

use Core\App;
use Core\Database;
use Core\Response;
use Http\Forms\DeleteForm;

$id = (int) $routeParams['id'];

// all variables that should be in POST, not what is required
if(!isset($_POST['answer'])) {
	http_response_code(Response::BAD_REQUEST);
	die();
}

// validate form
$form = DeleteForm::validate($attributes = [
	'answer' => $_POST['answer']
]);

// delete from database
App::resolve(Database::class)->query('DELETE FROM emails WHERE id = :id', [
	'id' => $id
]);

// delete uploads
$uploads = public_path("/assets/uploads/emails/{$id}");
if (file_exists($uploads)) {
	array_map('unlink', glob("$uploads/*"));
	rmdir($uploads);
}

redirect(route('/admin/emails'));