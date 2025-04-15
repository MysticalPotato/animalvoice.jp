<?php

use Core\App;
use Core\Database;

// check for new applications
$result = App::resolve(Database::class)->query("SELECT * FROM applications WHERE viewed = :viewed", [
	'viewed' => 0
])->get();

$new_applications = count($result);

?>

<!DOCTYPE html>
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
	
	<body class="<?= isset($_GET['nav']) && $_GET['nav'] === 'close' ? 'show-nav' : '' ?>">
		<div class="sidebar">
			<div class="sidebar-top">
				<div class="sidebar-header">
					<span>Admin</span>
				</div>
				
				<?php if(isset($_SESSION['user'])) : ?>

					<div class="nav-btn-container">
						<a id="groups-btn" class="nav-btn <?= $current_tab === 'groups' ? 'active' : '' ?>" href="<?= route('/admin/groups') ?>" attr="groups">
							<img src="<?= PATH['images'] ?>admin-icon-location.png"/>
							<span><?= __('nav.groups') ?></span>
						</a>
						
						<?php if($_SESSION['user']['admin']) : ?>
							<a id="users-btn" class="nav-btn <?= $current_tab === 'users' ? 'active' : '' ?>" href="<?= route('/admin/users') ?>" attr="users">
								<img src="<?= PATH['images'] ?>admin-icon-user.png"/>
								<span><?= __('nav.users') ?></span>
							</a>
						<?php endif; ?>

						<a id="applications-btn" class="nav-btn <?= $current_tab === 'applications' ? 'active' : '' ?>" href="<?= route('/admin/applications') ?>" attr="applications">
							<img src="<?= PATH['images'] ?>admin-icon-spark.png"/>
							<span><?= __('nav.applications') ?></span>
							<?php if($new_applications > 0) : ?>

							<span class="counter"><?= $new_applications ?></span>

							<?php endif; ?>
						</a>

						<a id="posts-btn" class="nav-btn <?= $current_tab === 'posts' ? 'active' : '' ?>" href="<?= route('/admin/posts') ?>" attr="posts">
							<img src="<?= PATH['images'] ?>admin-icon-instagram.png"/>
							<span><?= __('nav.posts') ?></span>
						</a>
						
						<a id="newsletter-btn" class="nav-btn <?= $current_tab === 'subscribers' ? 'active' : '' ?>" href="<?= route('/admin/subscribers') ?>" attr="newsletter">
							<img src="<?= PATH['images'] ?>admin-icon-envelope.png"/>
							<span><?= __('nav.subscribers') ?></span>
						</a>

						<a id="settings-btn" class="nav-btn <?= $current_tab === 'settings' ? 'active' : '' ?>" href="<?= route('/admin/settings') ?>" attr="settings">
							<img src="<?= PATH['images'] ?>admin-icon-gear.png"/>
							<span><?= __('nav.settings') ?></span>
						</a>
					</div>

				<?php endif; ?>
			</div>

			<div class="sidebar-bottom">
				<?php if(isset($_SESSION['user'])) : ?>

				<div class="nav-btn-container">
					<a class="nav-btn account-btn" href="<?= route('/admin/account') ?>">
						<img src="<?= PATH['images'] ?>admin-icon-user.png"/>
						<span><?= __('nav.account') ?></span>
					</a>

					<form method="POST" action="<?= route('/sessions') ?>">
						<input type="hidden" name="_method" value="DELETE">
						<button class="nav-btn logout-btn">
							<img src="<?= PATH['images'] ?>admin-icon-power.png"/>
						</button>
					</form>
				</div>
				
				<?php endif; ?>
			</div>
		</div>

		<div class="main">