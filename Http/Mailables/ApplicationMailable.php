<?php

namespace Http\Mailables;

use Http\Mailables\Mailable;

class ApplicationMailable extends Mailable {
    
    public function __construct($attributes) {
        $this->subject = "アニマル・ボイス - 主催者アプリケーション";

        $from_first_name = $attributes['first_name'];
        $from_last_name = $attributes['last_name'];
        $from_email = $attributes['email'];
        $prefecture = $attributes['prefecture'];
        $city = $attributes['city'];
        $question_1 = $attributes['question_1'];
        $question_2 = $attributes['question_2'];
        $question_3 = $attributes['question_3'];

        ob_start();
        ?>

        <div>
            <em>応募者に連絡するには、このメールに返信してください。</em>
            <br>
            <br><strong><?= __('form.first_name') ?></strong>
            <br><span><?= $from_first_name ?></span>
            <br>
            <br><strong><?= __('form.last_name') ?></strong>
            <br><span><?= $from_last_name ?></span>
            <br>
            <br><strong><?= __('form.email') ?></strong>
            <br><span><?= $from_email ?></span>
            <br>
            <br><strong><?= __('form.prefecture') ?></strong>
            <br><span><?= $prefecture ?></span>
            <br>
            <br><strong><?= __('form.city') ?></strong>
            <br><span><?= $city ?></span>
            <br>
            <br><strong><?= __('form.how_find_website') ?></strong>
            <br><span><?= $question_1 ?></span>
            <br>
            <br><strong><?= __('form.introduce_yourself') ?></strong>
            <br><span><?= $question_2 ?></span>
            <br>
            <br><strong><?= __('form.outreach_experience') ?></strong>
            <br><span><?= $question_3 ?></span>
        </div>

        <?php
        // NOT BEING USED
        $this->body = ob_get_contents();
        ob_end_clean();

        // UPDATED METHOD
        $file = file_get_contents(base_path('storage/application_notice_email_ja.md'));
        $Parsedown = new \Parsedown();
        $this->body = $Parsedown->text($file);
    }
}