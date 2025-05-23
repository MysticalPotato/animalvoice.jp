<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\Form;

class UserForm extends Form {

    public function __construct(public array $attributes) {
        $min_txt_len = 1;
        $max_txt_len = 50;

        // optional
        if(isset($attributes['email']) && $attributes['email'] !== '') {
            
            // make sure name doesn't exist yet
            $result = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email AND id<>:id', [
                'email' => $attributes['email'],
                'id' => $attributes['id'] ?? 0
            ])->find();
    
            if($result) {
                $this->errors['email'] = __('response.email_exists');
            }

            if(!Validator::string($attributes['email'], $min_txt_len, $max_txt_len)) {
                $this->errors['email'] = insertVars(__('response.max_length'), $max_txt_len);
            }
    
            elseif(!Validator::email($attributes['email'])) {
                $this->errors['email'] = __('response.email_format');
            }
        }

        // optional
        if(isset($attributes['username']) && $attributes['username'] !== '') {
            if(!Validator::string($attributes['username'], $min_txt_len, $max_txt_len)) {
                $this->errors['username'] = insertVars(__('response.max_length'), $max_txt_len);
            }
        }

        // optional
        if(isset($attributes['password']) && $attributes['password'] !== '') {
            if(!Validator::string($attributes['password'], $min_txt_len, $max_txt_len)) {
                $this->errors['password'] = insertVars(__('response.max_length'), $max_txt_len);
            }

            // optional
            if(isset($attributes['password_confirm']) && $attributes['password_confirm'] !== '') {
                if(!Validator::string($attributes['password_confirm'], $min_txt_len, $max_txt_len)) {
                    $this->errors['password_confirm'] = insertVars(__('response.max_length'), $max_txt_len);
                }

                if($attributes['password'] !== $attributes['password_confirm']) {
                    $this->errors['password_confirm'] = __('response.password_no_match');
                }
            }
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}