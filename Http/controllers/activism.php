<?php

use Core\App;
use Core\Database;
use Core\Session;

$groups = App::resolve(Database::class)->query("SELECT name, region, prefecture, city, homepage FROM groups WHERE enabled = 1 AND homepage<>''")->getOrFail();

$regions = [
	[
		'hokkaido',
		'tohoku',
		'kanto',
		'chubu',
	],
	[
		'kinki',
		'chugoku',
		'shikoku',
		'kyushu-okinawa',
	],
];

// $filtered_groups = array_filter($groups, function($group){
	// return $group['region'] === 'kanto';
// });

view('activism.view.php', [
	'meta_title' => __('activism.page_title'),
	'meta_description' => __('activism.page_description'),
	'groups' => $groups,
	'regions' => $regions
]);