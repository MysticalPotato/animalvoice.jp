<?php

use Core\Session;

view('organizer.view.php', [
	'meta_title' => __('organizer.page_title'),
	'meta_description' => __('organizer.page_description'),
	'errors' => Session::get('errors') ?? [],
	'status' => Session::get('status') ?? '',
	'show_raw_errors' => !production(),
]);