<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\Form;

class SettingsForm extends Form {

    public function __construct(public array $attributes) {
        
        $min_txt_len = 1;
        $max_txt_len = 50;

        if(!Validator::string($attributes['contact_email'], $min_txt_len, $max_txt_len)) {
            $this->errors['contact_email'] = insertVars(__('response.max_length'), $max_txt_len);
        }
        
        elseif(!Validator::email($attributes['contact_email'])) {
            $this->errors['contact_email'] = __('response.email_format');
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}