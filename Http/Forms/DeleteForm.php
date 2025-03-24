<?php

namespace Http\Forms;

use Core\Validator;
use Http\Forms\Form;

class DeleteForm extends Form {

    public function __construct(public array $attributes) {

        if(!Validator::string($attributes['answer']) || $attributes['answer'] !== 'DELETE') {
            $this->errors['answer'] = __('response.no_match');
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}