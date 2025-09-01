<?php

/*

Delete pending subscribers after 24 hours
Job should run every hour

*/

const BASE_PATH = __DIR__ . '/../../';
const APP_LOCALE	= "ja";

function base_path($path) {
	$path = ltrim($path, '/');
	return BASE_PATH . $path;
}

require base_path('vendor/autoload.php');
require base_path('bootstrap.php');

use Core\App;
use Core\Database;

// set the default timezone to use.
date_default_timezone_set('Asia/Tokyo');

// Delete pending subscriptions older than 24 hours (86400 seconds).
App::resolve(Database::class)->query("DELETE FROM pending_subscribers WHERE date < (NOW() - INTERVAL 1 DAY)");