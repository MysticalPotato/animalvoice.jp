<?php

namespace Core\Middleware;

class Auth {
    public function handle() {
        if(!$_SESSION['user'] ?? false) {
            // dd(\Core\App::currentLocale());
            redirect(route('/login'));
        }
    }
}