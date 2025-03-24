<?php

namespace Http\Forms;

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\Form;

class PostForm extends Form {

    public function __construct(public array $attributes) {
        
        $min_txt_len = 1;
        $max_txt_len = 50;

        $min_url_len = 1;
        $max_url_len = 200;

        $max_size_in_kb = 2000;
        $max_size_in_mb = 2;

        $img_width = 320;
        $img_height = 320;
        
        if(!Validator::string($attributes['account'], $min_txt_len, $max_txt_len)) {
            $this->errors['account'] = insertVars(__('response.max_length'), $max_txt_len);
        }

        if(!Validator::string($attributes['url'], $min_url_len, $max_url_len)) {
            $this->errors['url'] = insertVars(__('response.max_length'), $max_url_len);
        }
        
        elseif(!Validator::instaUrl($attributes['url'])) {
            $this->errors['url'] = __('response.valid_url');
        }

        // optional
        if(isset($attributes['image']) && $attributes['image']['size'] > 0) {
            if(!Validator::fileType($attributes['image'], ['jpg', 'jpeg', 'png'])) {
                $this->errors['image'] = insertVars(__('response.file_type_2'), ['.jpg', '.png']);
            }
            
            elseif(!Validator::fileSize($attributes['image'], $max_size_in_kb)) {
                $this->errors['image'] = insertVars(__('response.file_size'), $max_size_in_mb . ' MB');
            }
            
            elseif(!Validator::imgSize($attributes['image'], $img_width, $img_height)) {
                $this->errors['image'] = insertVars(__('response.image_size'), [$img_width, $img_height]);
            }
        }

        if(!empty($this->errors)) {
            $this->errors['summary'] = __('response.fix_issues');
        }
    }
}