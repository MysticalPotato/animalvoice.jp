<?php

namespace Http\Mailables;

use Http\Mailables\Mailable;

class NewUserMailable extends Mailable {
    
    public function __construct($attributes) {
        $this->subject = "あなたのログイン詳細";

        $username = $attributes['username'];
        $email = $attributes['email'];
        $password = $attributes['password'];

        $this->text = "{$username}様"
            . "\r\n"
            . "\r\n" . "アニマル・ボイスのログイン詳細は次のとおりです。"
            . "\r\n"
            . "\r\n" . "ユーザー名：" . $email
            . "\r\n" . "パスワード：" . $password
            . "\r\n"
            . "\r\n" . "ログインするには、次の URL にアクセスしてください："
            . "\r\n"
            . "\r\n" . "https://animalvoice.jp/admin"
        ;

        $file = file_get_contents(base_path('storage/new_user_email_ja.md'));
        $updated = insertVars($file, [$username, $email, $password]);
        $Parsedown = new \Parsedown();
        $this->html = $Parsedown->text($updated);
    }
}