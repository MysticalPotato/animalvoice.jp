<?php

use Core\Session;
use Core\ValidationException;
use Core\MailException;

// Default timezone
date_default_timezone_set('Asia/Tokyo');

// Start session
session_start();

const PUBLIC_PATH	= __DIR__ . '/';
const BASE_PATH		= __DIR__ . '/../';
const APP_LOCALE	= "ja";
const DOMAIN		= 'animalvoice.jp';

// Helper functions
require_once BASE_PATH . 'Core/functions.php';

// Paths	
const PATH = array(
	"css"			=> "/assets/css/",
	"favicon"		=> "/assets/favicon/",
	"fonts"			=> "/assets/fonts/",
	"images"		=> "/assets/images/",
	"uploads"		=> "/assets/uploads/",
	"legal"			=> "/assets/legal/",
	"javascript"	=> "/assets/javascript/",
	"files"			=> "/assets/files/",
);

// Email (all verified on Amazon SES)
define('EMAIL', array(
	'general'			=> 'hello@animalvoice.jp',
	'webform'			=> 'webform@animalvoice.jp',
	'noreply'			=> 'noreply@animalvoice.jp',
	'sandbox'			=> 'sandbox@animalvoice.jp',
));

// Autoloader
// spl_autoload_register(function($class) {
// 	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
// 	require base_path("{$class}.php");
// });
require BASE_PATH . '/vendor/autoload.php';

// Bootstrap
require base_path('bootstrap.php');

// Router
$router = new \Core\Router();
require base_path('routes.php');

// Current route
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
}
catch(ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);
    
    return redirect($router->previousUrl());
}
catch(MailException $exception) {
	Session::flash('errors', $exception->errors);
	
	return redirect($router->previousUrl());
}

// Empty flash
Session::unflash();