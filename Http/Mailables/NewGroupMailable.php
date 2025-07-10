<?php

namespace Http\Mailables;

use Http\Mailables\Mailable;

class NewGroupMailable extends Mailable {
    
    public function __construct($attributes) {
        $this->subject = "アニマル・ボイス - 主催者になる";

        $name = $attributes['organizer_last_name'];
        $city = strtolower($attributes['city']);

        $file = file_get_contents(base_path('storage/new_group_email_ja.md'));
        $updated = insertVars($file, [$name, $name, $name, $city, $name]);

        $Parsedown = new \Parsedown();

        $this->body = $Parsedown->text($updated);
    }
}