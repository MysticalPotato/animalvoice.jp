<?php

use Core\App;
use Core\Mail;
use Core\Session;
use Core\Database;
use Core\Response;
use Http\Forms\RecoverForm;
use Http\Mailables\NewUserMailable;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // filter allowed keys
    $allowed = ['email'];
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
    $form = RecoverForm::validate($attributes = [...$_POST, 'id' => $id,]);

    $user = App::resolve(Database::class)->query("SELECT * FROM users WHERE email = :email", [
        'email' => $attributes['email']
    ])->find();

    if($user) {

        // create random password
        $password = RecoverForm::randomPassword();
        $user['password'] = $password;

        // Send email with new password
        $mailable = new NewUserMailable($user);
		Mail::to($attributes['email'])
            ->from(email('noreply'))
            ->send($mailable);

        // encrypt password for database
		$encrypted = password_hash($password, PASSWORD_BCRYPT);

        // insert into database
        App::resolve(Database::class)->query("UPDATE users SET password = :password WHERE email = :email", [
            'email'		=> $attributes['email'],
            'password'	=> $encrypted,
        ]);
    }

    // redirect if everything went right
	redirect($_SERVER['HTTP_REFERER'], [
		'status' => __('response.form_submitted')
	]);
}

view('recover.view.php',[
    'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
    'header' => [
		'title' => __('admin.recover_account'),
		'back_route' => route('/login'),
	],
    'errors' => Session::get('errors') ?? [],
    'status' => Session::get('status') ?? '',
]);