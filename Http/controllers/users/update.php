<?php

use Core\App;
use Core\Mail;
use Core\Database;
use Core\Response;
use Http\Forms\UserForm;
use Http\Mailables\NewUserMailable;

$id = (int) $routeParams['id'];

// get current user id
$current_user_id = $_SESSION['user']['id'];

// abort if not current user and not admin
if($id !== $current_user_id) {
	$user = App::resolve(Database::class)->query("SELECT * FROM users WHERE id = :id", [
		'id' => $current_user_id
	])->findOrFail();

	if(!$user['admin']) {
		abort(Response::FORBIDDEN);
	}
}

// filter allowed keys
$allowed = ['username', 'email', 'password', 'password_confirm'];
$_POST = array_intersect_key($_POST, array_flip($allowed));

// filter empty values
$_POST = array_filter($_POST);

// stop here if no allowed keys
if(!$_POST) {
	abort(Response::BAD_REQUEST);
}

// clean input
$_POST = cleanInput($_POST);

// validate form
$form = UserForm::validate($attributes = [...$_POST, 'id' => $id,]);

// unset password confirm
unset($attributes['password_confirm']);

// insert all attributes one by one into database
foreach($attributes as $key => $value) {
	if($key === 'password') {

		// send new password to user if different user than current
		if($id !== $current_user_id) {
			$user = App::resolve(Database::class)->query("SELECT * FROM users WHERE id = :id", [
				'id' => $id
			])->findOrFail();

			// override password with new password
			$user['password'] = $value;

			$mailable = new NewUserMailable($user);
			Mail::to($user['email'])
				->from(email('noreply'))
				->send($mailable);
		}

		// encrypt password for database
		$value = password_hash($value, PASSWORD_BCRYPT);
	}

	// insert into database
	App::resolve(Database::class)->query("UPDATE users SET $key = :{$key} WHERE id = :id", [
		'id'		=> $id,
		$key		=> $value,
	]);
}

// set redirect route to account if current user
$route = $id !== $current_user_id ? route('/admin/users/' . $id) : route('/admin/account');

// redirect if everything went right
redirect($route, [
	'status' => __('response.changes_saved')
]);