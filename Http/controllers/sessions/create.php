<?php

use Core\Session;

view('sessions/create.view.php',[
    'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
    'header' => [
		'title'	=> __('admin.sign_in'),
	],
    'errors' => Session::get('errors') ?? [],
]);