
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

// get group from database
$post = App::resolve(Database::class)->query("SELECT * FROM posts WHERE id = :id", [
	'id' => $id
])->findOrFail();

// delete image if associated with group
if($post['image'] !== '') {
	deleteFile('posts/' . $post['image']);
}

// delete from database
App::resolve(Database::class)->query('DELETE FROM posts WHERE id = :id', [
	'id' => $id
]);

redirect(route('/admin/posts'));