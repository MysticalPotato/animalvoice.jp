<?php

use Core\App;
use Core\Database;
use Core\Session;

$groups = App::resolve(Database::class)->query('SELECT id, name, enabled, homepage, viewed FROM groups')->get();
$groups = array_reverse($groups);

// get id for newly created group if present
$new_group_id = Session::get('new_item_id') ?? null;

foreach($groups as &$group) {
	$group['classes'] = [];

	if($new_group_id && $new_group_id == $group['id']) {
		$group['classes'][] = 'new-item';
	}

	if(!$group['enabled'] || !$group['homepage']) {
		$group['classes'][] = 'disabled';
	}
}

view('groups/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'current_tab' => 'groups',
	'groups' => $groups,
]);