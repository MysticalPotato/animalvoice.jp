<?php

namespace Core;

class Localization {
    protected $messages;

    public function __construct($locale) {
        $str = file_get_contents(base_path("lang/{$locale}.json"));
        $this->messages = json_decode($str, true);
    }

    public function messages() {
        return $this->messages;
    }

    public static function hasLocale($locale) {
        return file_exists(base_path("lang/{$locale}.json")) ? true : false;
    }
}