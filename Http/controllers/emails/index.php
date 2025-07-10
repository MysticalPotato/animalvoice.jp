<?php

use Core\App;
use Core\Database;
use Core\Session;

$emails = App::resolve(Database::class)->query('SELECT * FROM emails')->get();
$emails = array_reverse($emails);

// get id for newly created email if present
$new_item_id = Session::get('new_item_id') ?? null;

// prepare classes for each email
foreach($emails as &$email) {
	$email['classes'] = [];

	if($new_item_id && $new_item_id == $email['id']) {
		$email['classes'][] = 'new-item';
	}
}

view('emails/index.view.php', [
	'meta_title' => __('admin.page_title'),
	'meta_description' => __('admin.page_description'),
	'header' => [
		'title'	=> __('nav.emails'),
	],
	'current_tab' => 'emails',
	'emails' => $emails,
]);