<?php

namespace Http\Mailables;

use Http\Mailables\Mailable;

class SubscriptionMailable extends Mailable {
    
    public function __construct($attributes) {
        $this->subject = "アニマル・ボイス - ニュースレターのご登録確認";

        $email = $attributes['email'];
        $token = $attributes['token'];

        $confirmation_url = url("/confirm-subscription?email={$email}&token={$token}");

        $file = file_get_contents(base_path('storage/sub_confirmation_email.md'));
        $updated = insertVars($file, [$confirmation_url, $confirmation_url]);

        $Parsedown = new \Parsedown();

        $this->body = $Parsedown->text($updated);
    }
}