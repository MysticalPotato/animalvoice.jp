<?php
$alt_locale = locale() === 'en' ? 'ja' : 'en';
?>

<!DOCTYPE html>
<html lang="<?= locale() ?>">
	<head>
		<title><?= $meta_title ?></title>

		<link rel="canonical" href="<?= url(route(uri(), 'ja')) ?>">
		<link rel="alternate" hreflang="ja" href="<?= url(route(uri(), 'ja')) ?>" />
		<link rel="alternate" hreflang="en" href="<?= url(route(uri(), 'en')) ?>" />
		<link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">
		
		<meta name="description" content="<?= $meta_description ?>">
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="language" content="<?= locale() ?>"/>
		<meta name="keywords" content="Japan, 日本, Animal Rights, Activism, Anonymous For The Voiceless, We The Free, Vegan, ヴィーガン, ビーガン">
		<meta name="author" content="Mark Walters">
		<meta name="web_author" content="Mark Walters">

		<!--Favicon-->
		<link rel="apple-touch-icon" sizes="180x180" href="<?= PATH['favicon'] ?>apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= PATH['favicon'] ?>favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= PATH['favicon'] ?>favicon-16x16.png">
		<link rel="manifest" href="<?= PATH['favicon'] ?>site.webmanifest">

		<!--Open Graph-->
		<meta property="og:site_name" content="<?= __('meta.website_name') ?>">
		<meta property="og:title" content="<?= $meta_title ?>">
		<meta property="og:description" content="<?= $meta_description ?>">
		<meta property="og:url" content="<?= url() ?>">
		<meta property="og:type" content="website">
		<meta property="og:locale" content="<?= locale() ?>">
		<meta property="og:image" content="<?= url(PATH['images'] . "og-image.png") ?>">
		<meta property="og:image:width" content="1200">
		<meta property="og:image:height" content="630">

		<!--CSS-->
		<link href="<?= PATH['css']?>stylesheet.css?v=<?= time() ?>" rel="stylesheet" type="text/css" media="screen">
		<link href="<?= PATH['css']?>mobile.css?v=<?= time() ?>" rel="stylesheet" type="text/css" media="screen">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

		<!--Fonts-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Rubik:wght@300..900&family=Source+Code+Pro:wght@200..900&display=swap" rel="stylesheet">
	</head>
	
	<body>
		<div id="nav">
			<div id="top-nav">
				<div class="nav-section">
					<a class="branding" href="<?= route('/') ?>">
						<picture>
							<source srcset="<?= PATH['images'] ?>animal-voice-logo.svg" type="image/svg+xml"/>
							<img class="branding-logo" src="<?= PATH['images'] ?>animal-voice-logo.png" height="46px" alt="Animal Voice Logo"/>
						</picture>
						<span class="branding-title"><?= __('meta.website_name') ?></span>
					</a>
				</div>
				
				<div class="nav-section">
				</div>
				
				<div class="nav-section">
					<nav class="desktop">
						<a class="nav-link" href="<?= route('/vegan') ?>"><?= __('nav.why_vegan') ?></a>
						<div class="dropdown">
							<a class="nav-link" href="<?= route('/guidelines') ?>"><?= __('nav.resources') ?><span class="arrow"></span></a>
							<div class="dropdown-content">
								<a class="nav-link" href="<?= route('/guidelines') ?>"><?= __('nav.guidelines') ?></a>
								<a class="nav-link" href="<?= route('/training') ?>"><?= __('nav.training') ?></a>
								<a class="nav-link" href="<?= route('/videos') ?>"><?= __('nav.videos') ?></a>
								<a class="nav-link" href="<?= route('/handouts') ?>"><?= __('nav.handouts') ?></a>
							</div>
						</div>
						<a class="nav-link" href="<?= route('/about') ?>"><?= __('nav.about') ?></a>
					</nav>
					
					<a class="cta-btn desktop" href="<?= route('/activism') ?>"><?= __('button.join_long') ?></a>
					<a class="lang-btn" href="<?= route(uri(), $alt_locale) ?>" hreflang="<?= $alt_locale ?>"><?= strtoupper($alt_locale) ?></a>
					
					<!-- Hamburger menu -->
					<a id="menu-toggle" class="menu-toggle mobile">
						<span class="menu-toggle-bar menu-toggle-bar--top"></span>
						<span class="menu-toggle-bar menu-toggle-bar--middle"></span>
						<span class="menu-toggle-bar menu-toggle-bar--bottom"></span>
					</a>
				</div>
			</div>
			
			<!-- Mobile menu -->
			
			<div id="mobile-menu" class="mobile">
				<div class="nav-folder active" data-folder="default">
					<div class="nav-folder-content">
						<div class="nav-folder-content-item">
							<a class="nav-link" href="<?= route('/vegan') ?>"><?= __('nav.why_vegan') ?></a>
						</div>
						
						<div class="nav-folder-content-item">
							<a href="#" class="nav-link" onclick="openFolder(event, 'resources');">
								<span><?= __('nav.resources') ?></span>
								<span class="chevron chevron-right"></span>
							</a>
						</div>
						
						<div class="nav-folder-content-item">
							<a class="nav-link" href="<?= route('/about') ?>"><?= __('nav.about') ?></a>
						</div>
					</div>
					<a class="cta-btn" href="<?= route('/activism') ?>"><?= __('button.join_long') ?></a>
				</div>
				
				<div class="nav-folder" data-folder="resources">
					<div class="nav-folder-content">
						<div class="nav-folder-content-item nav-folder-controls">
							<a href="#" class="nav-link" onclick="openFolder(event, 'default');">
								<span class="chevron chevron-left"></span>
								<span><?= __('nav.back') ?></span>
							</a>
						</div>
						
						<div class="nav-folder-content-item">
							<a class="nav-link" href="<?= route('/guidelines') ?>"><?= __('nav.guidelines') ?></a>
						</div>
						
						<div class="nav-folder-content-item">
							<a class="nav-link" href="<?= route('/training') ?>"><?= __('nav.training') ?></a>
						</div>

						<div class="nav-folder-content-item">
							<a class="nav-link" href="<?= route('/videos') ?>"><?= __('nav.videos') ?></a>
						</div>
						
						<div class="nav-folder-content-item">
							<a class="nav-link" href="<?= route('/handouts') ?>"><?= __('nav.handouts') ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="<?= PATH['javascript'] ?>nav.js" lang="<?= locale() ?>"></script>