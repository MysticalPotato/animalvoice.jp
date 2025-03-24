<?php

namespace Core;

use Core\Session;

class Authenticator {
    public function attempt($email, $password) {
        $user = App::resolve(Database::class)->query("SELECT * FROM users WHERE email = :email", [
            'email' => $email,
        ])->find();

        if($user) {
            if(password_verify($_POST['password'], $user['password'])) {
                self::login($user);
                return true;
            }
        }

        return false;
    }

    public static function login($user) {
        $_SESSION['user'] = $user;
        session_regenerate_id(true);
    }
    
    public static function logout() {
        Session::destroy();
    }
}