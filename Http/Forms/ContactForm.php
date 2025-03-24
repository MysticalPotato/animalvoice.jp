<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\Form;

class ContactForm extends Form {

    public function __construct(public array $attributes) {

        $min_txt_len = 1;
        $max_txt_len = 50;

        $min_ltxt_len = 1;
        $max_ltxt_len = 1000;

        if(!Validator::string($attributes['first_name'], $min_txt_len, $max_txt_len)) {
            $this->errors['first_name'] = insertVars(__('response.max_length'), $max_txt_len);
        }

        if(!Validator::string($attributes['last_name'], $min_txt_len, $max_txt_len)) {
            $this->errors['last_name'] = insertVars(__('response.max_length'), $max_txt_len);
        }

        if(!Validator::string($attributes['email'], $min_txt_len, $max_txt_len)) {
            $this->errors['email'] = insertVars(__('response.max_length'), $max_txt_len);
        }
        
        elseif(!Validator::email($attributes['email'])) {
            $this->errors['email'] = __('response.email_format');
        }

        if(!Validator::string($attributes['subject'], $min_txt_len, $max_txt_len)) {
            $this->errors['subject'] = insertVars(__('response.max_length'), $max_txt_len);
        }
        
        if(!Validator::string($attributes['message'], $min_ltxt_len, $max_ltxt_len)) {
            $this->errors['message'] = insertVars(__('response.max_length'), $max_ltxt_len);
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}