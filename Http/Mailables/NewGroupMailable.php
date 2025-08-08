<?php

namespace Http\Mailables;

use Core\App;
use Core\Database;
use Http\Mailables\Mailable;

class NewGroupMailable extends Mailable {
    
    public function __construct($attributes) {
        $this->subject = "アニマル・ボイス - 主催者になる";

        $name = $attributes['organizer_last_name'];
        $city = strtolower($attributes['city']);

        $editor_manual = App::resolve(Database::class)->query("SELECT value FROM settings WHERE name = :name", [
            'name' => 'organizer_manual'
        ])->findOrFail()['value'];

        $file = file_get_contents(base_path('storage/new_group_email_ja.md'));
        $updated = insertVars($file, [$name, $name, $name, $editor_manual, $editor_manual]);

        $Parsedown = new \Parsedown();

        $this->body = $Parsedown->text($updated);
    }
}