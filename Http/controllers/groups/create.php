<?php

use Core\Session;

view('groups/create.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'groups',
	'errors' => Session::get('errors') ?? [],
]);