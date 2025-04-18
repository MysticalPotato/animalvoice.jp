<?php

/*
Resources will be displayed with either video (mediadelivery, youtube), or image (url, image).
Duration is optional and will only be displayed in the recommended section.
*/

$resources = [
	'dominion' => [
		'title' => __('vegan.dominion_title'),
		'description' => __('vegan.dominion_description'),
		'duration' => 120,
		'mediadelivery' => 'https://iframe.mediadelivery.net/embed/135301/89232d42-e290-40fc-917d-5669478ee73b?autoplay=true&loop=false&muted=false&preload=false' . (locale() === 'ja' ? '&captions=jp' : '')
	],
	'nekoyaki' => [
		'title' => __('vegan.nekoyaki_title'),
		'description' => __('vegan.nekoyaki_description'),
		'duration' => 21,
		'youtube' => 'https://www.youtube.com/embed/mHs9ColH2Z0?si=Y1BozIanCWGt81YI' . (locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '')
	],
	'ed_speech' => [
		'title' => __('vegan.ed_speech_title'),
		'description' => __('vegan.ed_speech_description'),
		'duration' => 32,
		'youtube' => 'https://www.youtube.com/embed/Z3u7hXpOm58?si=Zrda3II9hlnfHm1h' . (locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '')
	],
	'dont_watch' => [
		'title' => __('vegan.dont_watch_title'),
		'description' => __('vegan.dont_watch_description'),
		'duration' => 7,
		'mediadelivery' => 'https://iframe.mediadelivery.net/embed/187398/4f422297-30be-4b32-b342-6ddeb76de7ec?autoplay=true&loop=false&muted=false&preload=false' . (locale() === 'ja' ? '&captions=ja' : '')
	],
	'3_min_challenge' => [
		'title' => __('vegan.3_min_challenge_title'),
		'description' => __('vegan.3_min_challenge_description'),
		'duration' => 4,
		'mediadelivery' => 'https://iframe.mediadelivery.net/embed/245757/a3428333-9a5e-4105-a2e0-1e8c176fb938?autoplay=true&loop=false&muted=false&preload=false' . (locale() === 'ja' ? '&captions=jp' : '')
	],
	'vegan_elly' => [
		'title' => __('vegan.vegan_elly_title'),
		'description' => __('vegan.vegan_elly_description'),
		'duration' => 13,
		'youtube' => 'https://www.youtube.com/embed/Vd4gNV4fAl4?si=R6bvdB4MVNzKWx6y' . (locale() === 'en' ? '&cc_load_policy=1&cc_lang_pref=en' : '')
	],
	'dairy_is_scary' => [
		'title' => __('vegan.dairy_is_scary_title'),
		'description' => __('vegan.dairy_is_scary_description'),
		'duration' => 6,
		'youtube' => 'https://www.youtube.com/embed/UcN7SGGoCNI?si=jqwv2xCsHz1-OLxe' . (locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '')
	],
	'gary_speech' => [
		'title' => __('vegan.gary_speech_title'),
		'description' => __('vegan.gary_speech_description'),
		'duration' => 69,
		'youtube' => 'https://www.youtube.com/embed/U5hGQDLprA8?si=m925vJlFONcE0eE0' . (locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '')
	],
	'seaspiracy' => [
		'title' => __('vegan.seaspiracy_title'),
		'description' => __('vegan.seaspiracy_description'),
		'duration' => 0,
		'url' => 'https://www.netflix.com/title/81014008',
		'image' => PATH['images'] . 'seaspiracy.webp'
	],
	'cowspiracy' => [
		'title' => __('vegan.cowspiracy_title'),
		'description' => __('vegan.cowspiracy_description'),
		'duration' => 0,
		'url' => 'https://www.netflix.com/title/80033772',
		'image' => PATH['images'] . 'cowspiracy.webp'
	],
	'what_the_health' => [
		'title' => __('vegan.what_the_health_title'),
		'description' => __('vegan.what_the_health_description'),
		'duration' => 0,
		'url' => 'https://www.netflix.com/title/80174177',
		'image' => PATH['images'] . 'what_the_health.webp'
	],
	'okja' => [
		'title' => __('vegan.okja_title'),
		'description' => __('vegan.okja_description'),
		'duration' => 0,
		'url' => 'https://www.netflix.com/title/80091936',
		'image' => PATH['images'] . 'okja.webp'
	],
	'vegemap' => [
		'title' => __('vegan.vegemap_title'),
		'description' => __('vegan.vegemap_description'),
		'url' => 'https://vegemap.org/',
		'image' => PATH['images'] . 'vegemap.webp'
	],
	'vegewel' => [
		'title' => __('vegan.vegewel_title'),
		'description' => __('vegan.vegewel_description'),
		'url' => 'https://vegewel.com/',
		'image' => PATH['images'] . 'vegewel.webp'
	],
	'hachidory' => [
		'title' => __('vegan.hachidory_title'),
		'description' => __('vegan.hachidory_description'),
		'url' => 'https://hachidory.com/',
		'image' => PATH['images'] . 'hachidory.webp'
	],
	'vegan_guide' => [
		'title' => __('vegan.vegan_guide_title'),
		'description' => __('vegan.vegan_guide_description'),
		'url' => 'https://veganguide.vcook.jp/',
		'image' => PATH['images'] . 'vegan_guide.webp'
	],
	'happycow' => [
		'title' => __('vegan.happycow_title'),
		'description' => __('vegan.happycow_description'),
		'url' => 'https://apps.apple.com/jp/app/happycow-vegan-food-near-you/id435871950',
		'image' => PATH['images'] . 'happycow.webp'
	],
	'vegan_japan' => [
		'title' => __('vegan.vegan_japan_title'),
		'description' => __('vegan.vegan_japan_description'),
		'url' => 'https://apps.apple.com/jp/app/veganjapan/id1378015838',
		'image' => PATH['images'] . 'vegan_japan.webp'
	],
	've' => [
		'title' => __('vegan.ve_title'),
		'description' => __('vegan.ve_description'),
		'url' => 'https://apps.apple.com/jp/app/ve-ヴィー-ヴィーガン-ベジタリアンコミュニティアプリ/id1585916633',
		'image' => PATH['images'] . 've.webp'
	],
];

// show these 3 resources in the recommended section
$recommended = [
	$resources['dominion'],
	$resources['dont_watch'],
	$resources['vegan_elly'],
];

// show these 4 resources on the videos tab
$videos = [
	$resources['3_min_challenge'],
	$resources['ed_speech'],
	$resources['dairy_is_scary'],
	$resources['gary_speech'],
];

// show these 4 resources on the netflix tab
$netflix = [
	$resources['seaspiracy'],
	$resources['what_the_health'],
	$resources['cowspiracy'],
	$resources['okja'],
];

// show these 4 resources on the websites tab
$websites = [
	$resources['vegemap'],
	$resources['vegewel'],
	$resources['hachidory'],
	$resources['vegan_guide'],
];

// show these 4 resources on the apps tab
$apps = [
	$resources['happycow'],
	$resources['vegan_japan'],
	$resources['ve'],
	[]
];

view('vegan.view.php', [
	'meta_title' => __('vegan.page_title'),
	'meta_description' => __('vegan.page_description'),
	'recommended' => $recommended,
	'videos' => $videos,
	'netflix' => $netflix,
	'websites' => $websites,
	'apps' => $apps,
]);