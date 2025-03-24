<?php

$last_updated = '2025/3/8';

$file = file_get_contents(base_path('storage/privacy_' . locale() . '.md'));
$Parsedown = new Parsedown();
$privacy_md =  $Parsedown->text($file);

view('privacy.view.php', [
	'meta_title' => __('privacy.page_title'),
	'meta_description' => __('privacy.page_description'),
	'last_updated' => dateToText($last_updated),
	'privacy_md' => $privacy_md,
]);