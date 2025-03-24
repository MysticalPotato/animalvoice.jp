<?php

$dominion_order_url = 'https://up-t.jp/market/6778da7e8c8f1';

view('handouts.view.php', [
	'meta_title' => __('handouts.page_title'),
	'meta_description' => __('handouts.page_description'),
	'dominion_order_url' => $dominion_order_url,
]);