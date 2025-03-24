<?php require base_path('views/partials/header.php') ?>

<div class="container" id="donate">
	<div id="nav-push"></div>

	<section class="fullscreen">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper">
					<div class="column center space">
						<div class="section-header">
							<header class="sub-title center"><?= __('donate.main_subtitle') ?></header>
							<h1><?= __('donate.main_title') ?></h1>
						</div>
						
						<p><?= insertLinks(__('donate.main_description'), '/contact') ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript" src="<?= PATH['javascript']?>nav-push.js"></script>
	<script type="text/javascript" src="<?= PATH['javascript']?>viewport_height.js" ref="section.fullscreen" vh="100" always></script>
</div>
	
<?php require base_path('views/partials/footer.php') ?>