<?php

use Core\App;
use Core\Database;

$groups = App::resolve(Database::class)->query("SELECT * FROM groups WHERE enabled = 1 AND homepage<>''")->get();

view('about.view.php', [
	'meta_title' => __('about.page_title'),
	'meta_description' => __('about.page_description'),
	'groups' => $groups,
]);