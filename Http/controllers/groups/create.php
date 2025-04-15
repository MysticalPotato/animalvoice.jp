<?php

use Core\Session;

view('groups/create.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('admin.create_group'),
		'back_route' => route('/admin/groups'),
	],
	'current_tab' => 'groups',
	'errors' => Session::get('errors') ?? [],
]);