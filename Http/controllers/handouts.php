<?php

$cards = [
	[
		'title'			=> __('handouts.main_title'),
		'description'	=> __('handouts.main_description'),
		'img_front'		=> PATH['images'] . 'card-main-front.webp',
		'img_back'		=> PATH['images'] . 'card-main-back.webp',
		'ai'			=> PATH['files'] . 'business-card-main.ai',
		'pdf'			=> PATH['files'] . 'business-card-main-pdf.zip',
		'order_url'		=> 'https://up-t.jp/market/67e90613955d2',
	],
	[
		'title'			=> __('handouts.dominion_title'),
		'description'	=> __('handouts.dominion_description'),
		'img_front'		=> PATH['images'] . 'card-dominion-front.webp',
		'img_back'		=> PATH['images'] . 'card-dominion-back.webp',
		'pdf'			=> PATH['files'] . 'business-card-dominion.zip',
		'order_url'		=> 'https://up-t.jp/market/6778da7e8c8f1',
	],
];

view('handouts.view.php', [
	'meta_title' => __('handouts.page_title'),
	'meta_description' => __('handouts.page_description'),
	'cards' => $cards,
]);