<?php

use Core\App;
use Core\Session;
use Core\Response;
use Core\Localization;

function filter($items, $key, $value) {
	$filteredItems = [];
	
	foreach($items as $item) {
		if($item[$key] === $value) {
			$filteredItems[] = $item;
		}
	}
	
	return $filteredItems;
}

function dd($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
	die();
}

function urlIs($value) {
	return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) === $value;
}

function abort($code = Response::NOT_FOUND) {
	// should check if file exists!
	http_response_code($code);
	require base_path("views/{$code}.php");
	die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
	if(!$condition) {
		abort($status);
	}
}

function base_path($path) {
	return BASE_PATH . $path;
}

function public_path($path) {
	return PUBLIC_PATH . $path;
}

function view($path, $attributes = []) {
	extract($attributes);
	require base_path('views/' . $path);
}

function redirect($path, $flashData = []) {
	foreach ($flashData as $key => $value) {
		Session::flash($key, $value);
	}
	header("location: $path");
	exit();
}

function last_route() {
	return isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) : '/';
}

function old($key, $default = '') {
	return Session::get('old')[$key] ?? $default;
}

function host() {
	return $_SERVER['HTTP_HOST'];
}

function uri() {
	return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
}

function url($route = null) {
	// return url of current route if route is not specified
	return protocol() . host() . ($route ?? uri());
}

function protocol() {
	return production() ? 'https://' : '';
}

function locale(string $uri = null) {
	if($uri) {
		$arr = explode('/', trim($uri, '/'));
		return App::hasLocale($arr[0]) ? $arr[0] : null;
	}
	return App::currentLocale();
}

function production() {
	return $_SERVER['SERVER_NAME'] === DOMAIN ? true : false;
}

function localNmbr(int $nmbr) {
	if(locale() === 'ja') {
		$jaNmbrs = ['０', '１', '２', '３', '４', '５', '６', '７', '８', '９'];
		$array = str_split($nmbr);
		foreach($array as $key => $value) {
			$array[$key] = $jaNmbrs[(int)$value];
		}
		return implode('', $array);
	}	
	return $nmbr;
}

function dateToText($date) {
	$format = locale() === 'ja' ? 'Y年m月j日' : 'F j, Y';
	$text = date($format, strtotime($date));
	return $text;
}

function displayName(string $first, string $last) {
	if(empty($last)) {
		return $first;
	}

	$str = $first . $last;
	if (strlen($str) != strlen(utf8_decode($str))) {
		// if string contains non roman characters, the name is probably Japanese
		return $last . '　' . $first;
	}

	return $last . ' ' . $first;
}

function replaceEmpty(string $replace, string $with) {
	return $replace != '' ? $replace : $with;
}

function instaPostId(string $url) {
	return substr($url, strlen('https://www.instagram.com/p/'), 11);
}

function route($uri, string|array $param = []) {
	$locale = locale();
	
	if(is_string($param) && App::hasLocale($param)) {
		$locale = $param;

		$parts = explode('/', trim($uri, '/'));
		if(strtolower($parts[0]) === App::currentLocale()) {
			$uri = '/' . substr(implode('/', $parts), 3);
		}
	}

	if(APP_LOCALE !== $locale) {
		$uri = '/' . $locale . $uri;
	}
	
	if(is_array($param) && count($param) > 0) {
		$uri = $uri . '?' . http_build_query($param);
	}
	
	return $uri;
}

function __(string $translationStr) {
	$keys = explode('.', $translationStr, 2);
	$messages = App::resolve(Localization::class)->messages();
	$val = count($keys) > 1 ? $messages[$keys[0]][$keys[1]] : $messages[$keys[0]];
	return is_string($val) ? htmlspecialchars($val) : $val;
}

function insertVars(string $text, string|array $vars) {
	// Replaces %s in a string with a variable. Returns string unchanged if provided variables don't match occurences of %s in string.
	if(gettype($vars) === 'string') {
		return str_replace('%s', $vars, $text);
	}
	
	$nmbr = substr_count($text, '%s');
	if($nmbr === count($vars)) {
		for($i = 0; $i < $nmbr; $i++) {
			$pos = strpos($text, '%s');
			$text = substr_replace($text, $vars[$i], $pos, strlen('%s'));
		}
	}
	
	return $text;
}

function insertLinks(string $text, string|array $links, bool $func = false) {
	// Replaces [*] in a string with a hyperlink element. Returns string unchanged if provided links don't match occurences of [*] in string.
	if(gettype($links) === 'string') {
		$links = (array)$links;
	}
	
	preg_match_all("/\[([^\]]*)\]/", $text, $matches);
	if(count($matches[1]) === count($links)) {
		for($i = 0; $i < count($matches[1]); $i++) {
			$elem = '<a ' . ($func ? 'onClick' : 'href') . '="' . $links[$i] . '">' . $matches[1][$i] . '</a>';
			$text = str_replace('[' . $matches[1][$i] . ']', $elem, $text);
		}
	}
	
	return $text;
}

function cleanInput($arr) {
	foreach($arr as $key => $val) {
		if(is_string($val)) {
			$arr[$key] = trim($val);
		}
	}
	return $arr;
}

function uploadFile($file, $stemName) {
	$dir = public_path('assets/uploads/');
	if (!file_exists($dir)) {
		mkdir($dir, 0777, true);
	}
	
	$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
	$path = $dir . $stemName . '.' . $ext;

	if(!file_exists($path)) {
		if(move_uploaded_file($file["tmp_name"], $path)){
			return $path;
		}
	}
	return false;
}

function deleteFile($baseName) {
	$path = public_path('assets/uploads/') . $baseName;
	if(file_exists($path)) {
		unlink($path);
	}
}

function resizeAndCrop($path, $width, $height) {
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$image = $ext === 'jpg' ? imagecreatefromjpeg($path) : imagecreatefrompng($path);
	
	//
}

function getRegion($prefecture) {
	$prefectures = [
		"hokkaido"		=> "hokkaido",
		"aomori"		=> "tohoku",
		"iwate"			=> "tohoku",
		"miyagi"		=> "tohoku",
		"akita"			=> "tohoku",
		"yamagata"		=> "tohoku",
		"fukushima"		=> "tohoku",
		"ibaraki"		=> "kanto",
		"tochigi"		=> "kanto",
		"gunma"			=> "kanto",
		"saitama"		=> "kanto",
		"chiba"			=> "kanto",
		"tokyo"			=> "kanto",
		"kanagawa"		=> "kanto",
		"niigata"		=> "chubu",
		"toyama"		=> "chubu",
		"ishikawa"		=> "chubu",
		"fukui"			=> "chubu",
		"yamanashi"		=> "chubu",
		"nagano"		=> "chubu",
		"gifu"			=> "chubu",
		"shizuoka"		=> "chubu",
		"aichi"			=> "chubu",
		"mie"			=> "kinki",
		"shiga"			=> "kinki",
		"kyoto"			=> "kinki",
		"osaka"			=> "kinki",
		"hyogo"			=> "kinki",
		"nara"			=> "kinki",
		"wakayama"		=> "kinki",
		"tottori"		=> "chugoku",
		"shimane"		=> "chugoku",
		"okayama"		=> "chugoku",
		"hiroshima"		=> "chugoku",
		"yamaguchi"		=> "chugoku",
		"tokushima"		=> "shikoku",
		"kagawa"		=> "shikoku",
		"ehime"			=> "shikoku",
		"kochi"			=> "shikoku",
		"fukuoka"		=> "kyushu-okinawa",
		"saga"			=> "kyushu-okinawa",
		"nagasaki"		=> "kyushu-okinawa",
		"kumamoto"		=> "kyushu-okinawa",
		"oita"			=> "kyushu-okinawa",
		"miyazaki"		=> "kyushu-okinawa",
		"kagoshima"		=> "kyushu-okinawa",
		"okinawa"		=> "kyushu-okinawa",
	];
	return array_key_exists($prefecture, $prefectures) ? $prefectures[$prefecture] : '';
}

function googleTranslate($str, $lang) {
	return 'hell yeah!';
}