<?php

use Core\App;
use Core\Localization;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind('Core\Database', function() {
    $config = require base_path('config.php');
    return new Database(
        $config['db_dsn'],
        $config['db_login']['username'],
        $config['db_login']['password']
    );
});

$container->singleton('Core\Localization', function() {
    $locale = App::currentLocale();
    return new Localization($locale);
});

App::setContainer($container);