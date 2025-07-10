<?php

use Core\App;
use Core\Database;

const ORGANIZERS = 0;
const SUBSCRIBERS = 1;

function renderTemplate(string $template_file, array $vars): string {
    extract($vars);
    ob_start();
    include $template_file;
    return ob_get_clean();
}

$id = (int) $routeParams['id'];

$email = App::resolve(Database::class)->query("SELECT * FROM emails WHERE id = :id", [
	'id' => $id
])->findOrFail();

$template = $email['recipient'] === SUBSCRIBERS ? 'newsletter' : 'plain';
$template_file = base_path("views/partials/email_template_{$template}.php");

$preview_content = renderTemplate($template_file, [
    'subject'   => $email['subject'],
    'preheader' => $email['preheader'],
    'content'   => $email['content'],
    'recipient' => 'example@email.com',
]);

echo $preview_content;