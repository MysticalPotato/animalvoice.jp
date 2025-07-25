<?php

$cards = [
	[
		'title'			=> __('handouts.main_title'),
		'description'	=> __('handouts.main_description'),
		'img_front'		=> PATH['images'] . 'card-main-front.webp',
		'img_back'		=> PATH['images'] . 'card-main-back.webp',
		'ai'			=> PATH['files'] . 'animalvoice_card_ai.zip',
		'pdf'			=> PATH['files'] . 'animalvoice_card_pdf.zip',
		'png'			=> PATH['files'] . 'animalvoice_card_png.zip',
		'order_url'		=> 'https://up-t.jp/market/680976937c7d4',
	],
	[
		'title'			=> __('handouts.dominion_title'),
		'description'	=> __('handouts.dominion_description'),
		'img_front'		=> PATH['images'] . 'card-dominion-front.webp',
		'img_back'		=> PATH['images'] . 'card-dominion-back.webp',
		'pdf'			=> PATH['files'] . 'dominion_card_pdf.zip',
		'order_url'		=> 'https://up-t.jp/market/6778da7e8c8f1',
	],
];

$flyer = [
	'title'			=> __('handouts.flyer_main_title'),
	'description'	=> __('handouts.flyer_main_description'),
	'img_front'		=> PATH['images'] . 'flyer-main-front.webp',
	'img_back'		=> PATH['images'] . 'flyer-main-back.webp',
	'ai'			=> PATH['files'] . 'animalvoice_flyer_ai.zip',
	'pdf'			=> PATH['files'] . 'animalvoice_flyer_pdf.zip',
	'png'			=> PATH['files'] . 'animalvoice_flyer_png.zip',
	// 'order_url'		=> 'https://up-t.jp/market/680976937c7d4',
];

view('handouts.view.php', [
	'meta_title' => __('handouts.page_title'),
	'meta_description' => __('handouts.page_description'),
	'cards' => $cards,
	'flyer' => $flyer,
]);