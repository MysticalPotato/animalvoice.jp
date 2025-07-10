<?php

namespace Http\Forms;

use Core\Validator;
use Http\Forms\Form;

class EmailForm extends Form {

    public function __construct(public array $attributes) {
        
        $min_txt_len = 1;
        $max_txt_len = 50;

        $min_body_len = 1;
        $max_body_len = 65000;

        // optional
        if(isset($attributes['recipient']) && $attributes['recipient'] !== '') {
            if(!Validator::int($attributes['recipient'], 0, 1)) {
                $this->errors['recipient'] = __('response.invalid_value');
            }
        }

        // optional
        if(isset($attributes['subject']) && $attributes['subject'] !== '') {
            if(!Validator::string($attributes['subject'], $min_txt_len, $max_txt_len)) {
                $this->errors['subject'] = insertVars(__('response.max_length'), $max_txt_len);
            }
        }

        // optional
        if(isset($attributes['content']) && $attributes['content'] !== '') {
            if(!Validator::string($attributes['content'], $min_body_len, $max_body_len)) {
                $this->errors['content'] = __('response.email_size');
            }
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}