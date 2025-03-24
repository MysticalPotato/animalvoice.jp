<html>
	<head>
		<title><?= $meta_title ?></title>
		
		<!--meta website description-->
		<meta name="description" content="<?= $meta_description ?>">

		<!--meta-->
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="language" content="<?= locale() ?>"/>
		<meta name="robots" content="noindex, nofollow" />
		
		<!--Fonts-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans+JP:wght@100..900&family=Rubik:wght@300..900&family=Source+Code+Pro:wght@200..900&display=swap" rel="stylesheet">

		<!--Locales-->
		<link rel="alternate" hreflang="ja" href="<?= route(uri(), 'ja') ?>" />
		<link rel="alternate" hreflang="en" href="<?= route(uri(), 'en') ?>" />
		
		<!--CSS-->
		<link href="<?= PATH['css'] ?>admin.css?v=<?= time() ?>" rel="stylesheet" type="text/css" media="screen">
	</head>
	
	<body>