<?php

namespace Core\Middleware;

class Admin {
    public function handle() {
        if(!$_SESSION['user'] || !$_SESSION['user']['admin'] ?? false) {
            // dd(\Core\App::currentLocale());
            abort(403);
        }
    }
}