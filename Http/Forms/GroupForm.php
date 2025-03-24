<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\Form;

class GroupForm extends Form {

    public function __construct(public array $attributes) {
        
        $min_txt_len = 1;
        $max_txt_len = 50;

        $min_url_len = 1;
        $max_url_len = 200;

        // make sure name doesn't exist yet
        $result = App::resolve(Database::class)->query('SELECT * FROM groups WHERE name = :name AND id<>:id', [
            'name' => $attributes['name'],
            'id' => $attributes['id'] ?? 0
        ])->find();

        if($result) {
            $this->errors['name'] = __('response.name_exists');
        }

        elseif(!Validator::string($attributes['name'], $min_txt_len, $max_txt_len)) {
            $this->errors['name'] = insertVars(__('response.max_length'), $max_txt_len);
        }

        if(!Validator::string($attributes['prefecture'])) {
            $this->errors['name'] = insertVars(__('response.max_length'), $max_txt_len);
        }

        if(!Validator::string($attributes['prefecture']) || !getRegion($attributes['prefecture'])) {
            $this->errors['prefecture'] = __('response.invalid_prefecture');
        }

        if(!Validator::string($attributes['city'], $min_txt_len, $max_txt_len)) {
            $this->errors['city'] = insertVars(__('response.max_length'), $max_txt_len);
        }

        // optional
        if($attributes['homepage'] !== '') {
            if(!Validator::string($attributes['homepage'], $min_url_len, $max_url_len)) {
                $this->errors['homepage'] = insertVars(__('response.max_length'), $max_url_len);
            }

            elseif(!Validator::url($attributes['homepage'])) {
                $this->errors['homepage'] = __('response.valid_url');
            }
        }

        // optional
        if($attributes['organizer_first_name'] !== '') {
            if(!Validator::string($attributes['organizer_first_name'], $min_txt_len, $max_txt_len)) {
                $this->errors['organizer_first_name'] = insertVars(__('response.max_length'), $max_txt_len);
            }
        }

        // optional
        if($attributes['organizer_last_name'] !== '') {
            if(!Validator::string($attributes['organizer_last_name'], $min_txt_len, $max_txt_len)) {
                $this->errors['organizer_last_name'] = insertVars(__('response.max_length'), $max_txt_len);
            }
        }

        // optional
        if($attributes['organizer_email'] !== '') {
            if(!Validator::string($attributes['organizer_email'], $min_txt_len, $max_txt_len)) {
                $this->errors['organizer_email'] = insertVars(__('response.max_length'), $max_txt_len);
            }
            
            elseif(!Validator::email($attributes['organizer_email'])) {
                $this->errors['organizer_email'] = __('response.email_format');
            }
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}