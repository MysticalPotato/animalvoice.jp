<?php

namespace Http\Mailables;

class Mailable {
    // A mailable needs to have a subject and a body.

    public string $template     = '';       // newsletter or plain
    public string $subject      = '';
    public string $preheader    = '';
    public string $body         = '';       // html body
}