<?php

namespace Core;

class MailException extends \Exception {

    public readonly array $errors;

    public static function throw($errors) {
        $instance = new static('The email failed to sent.');

        $instance->errors = $errors;

        throw $instance;
    }
}