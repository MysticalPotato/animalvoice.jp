<?php

namespace Core;

use Core\Localization;

class App {
    protected static $container;
    protected static $locale = APP_LOCALE;

    public static function setContainer($container) {
        static::$container = $container;
    }

    public static function container() {
        return static::$container;
    }

    public static function bind($key, $resolver) {
        static::container()->bind($key, $resolver);
    }

    public static function singleton($key, $resolver) {
        static::container()->singleton($key, $resolver);
    }

    public static function resolve($key) {
        return static::container()->resolve($key);
    }

    public static function currentLocale() {
        return self::$locale;
    }

    public static function setLocale($locale) {
        if(self::hasLocale($locale)) {
            self::$locale = $locale;
            return true;
        }
        return false;
    }

    public static function isLocale($locale) {
        return self::$locale === $locale ? true : false;
    }

    public static function hasLocale($locale) {
        return Localization::hasLocale($locale);
    }
}