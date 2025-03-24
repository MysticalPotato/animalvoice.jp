<?php

namespace Http\Mailables;

use Http\Mailables\Mailable;

class ContactMailable extends Mailable {
    
    public function __construct($attributes) {
        $this->subject = $attributes['subject'];

        $message = $attributes['message'];
        $from_fname = $attributes['first_name'];
        $from_lname = $attributes['last_name'];
        $from_email = $attributes['email'];

        $this->text = $message
            . "\r\n\r\n"
            . "From: " . displayName($from_fname, $from_lname) . "\r\n"
            . "Email: $from_email"
        ;

        $this->html = $this->text;
        ob_start();
        ?>

        <p>
            <?= $message ?>
        </p>
        <p>
            From: <?= displayName($from_fname, $from_lname) ?>
            <br>
            Email: <?= $from_email ?>
        </p>

        <?php
        $this->html = ob_get_contents();
        ob_end_clean();
    }
}