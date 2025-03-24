<?php

namespace Http\Mailables;

class Mailable {
    // A mailable needs to have a subject and a body.

    public string $subject = '';
    public string $text = '';       // plaintext body
    public string $html = '';       // html body
}