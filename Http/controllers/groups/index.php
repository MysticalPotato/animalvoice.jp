<?php

use Core\App;
use Core\Database;

$groups = App::resolve(Database::class)->query('SELECT id, name, enabled, homepage FROM groups')->get();

view('groups/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'groups',
	'groups' => $groups,
]);