<?php

$conversation = __('conversation');
$rows = round(count($conversation) / 2);
$conversation_columns = array_chunk($conversation, $rows, false);

$excuses = __('excuses');
$rows = round(count($excuses) / 2);
$excuses_columns = array_chunk($excuses, $rows, false);

view('training.view.php', [
	'meta_title' => __('training.page_title'),
	'meta_description' => __('training.page_description'),
	'conversation_columns' => $conversation_columns,
	'excuses_columns' => $excuses_columns
]);