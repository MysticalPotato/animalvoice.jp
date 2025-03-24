<?php

use Core\Session;

view('sessions/create.view.php',[
    'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
    'errors' => Session::get('errors') ?? [],
]);