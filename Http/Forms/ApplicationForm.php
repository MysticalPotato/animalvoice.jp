<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\Form;

class ApplicationForm extends Form {

    public function __construct(public array $attributes) {

        $min_txt_len = 1;
        $max_txt_len = 50;

        $min_ltxt_len = 1;
        $max_ltxt_len = 500;

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

        if(!Validator::string($attributes['prefecture']) || !getRegion($attributes['prefecture'])) {
            $this->errors['prefecture'] = __('response.invalid_prefecture');
        }

        if(!Validator::string($attributes['city'], $min_txt_len, $max_txt_len)) {
            $this->errors['city'] = insertVars(__('response.max_length'), $max_txt_len);
        }

        // optional
        if($attributes['question_1'] !== '') {
            if(!Validator::string($attributes['question_1'], $min_ltxt_len, $max_ltxt_len)) {
                $this->errors['question_1'] = insertVars(__('response.max_length'), $max_ltxt_len);
            }
        }

        if(!Validator::string($attributes['question_2'], $min_ltxt_len, $max_ltxt_len)) {
            $this->errors['question_2'] = insertVars(__('response.max_length'), $max_ltxt_len);
        }

        if(!Validator::string($attributes['question_3'], $min_ltxt_len, $max_ltxt_len)) {
            $this->errors['question_3'] = insertVars(__('response.max_length'), $max_ltxt_len);
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}