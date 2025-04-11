<?php

namespace Core;

class Validator {

	public static function string($value, $min = 0, $max = INF) {
		return is_string($value) && strlen($value) >= $min && strlen($value) <= $max;
	}

	public static function int($value, $min = 0, $max = INF) {
		$length = strlen((string)abs((int)$value));
		return (is_int($value) || (is_string($value) && ctype_digit($value))) && $length >= $min && $length <= $max;
	}
	
	public static function url($value) {
		return filter_var($value, FILTER_VALIDATE_URL);
	}
	
	public static function instaUrl($value) {
		return filter_var($value, FILTER_VALIDATE_URL) && str_starts_with($value, 'https://www.instagram.com/p/');
	}
	
	public static function email($value) {
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}
	
	public static function name($assoc_arr, $name) {
		foreach($assoc_arr as $item) {
			if(strtolower($item['name']) === strtolower($name)) {
				return false;
			}
		}
		return true;
	}
	
	public static function imgSize($file, $width, $height) {
		$dim = getimagesize($file["tmp_name"]);
		return $width === $dim[0] && $height === $dim[1];
	}
	
	public static function fileType($file, $approved_extensions) {
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		foreach($approved_extensions as $a_ext) {
			if(strtolower($ext) === strtolower($a_ext)) {
				return true;
			}
		}
		return false;
	}
	
	public static function fileSize($file, $max_kb) {
		return $file['size']/1024 <= $max_kb;
	}
}