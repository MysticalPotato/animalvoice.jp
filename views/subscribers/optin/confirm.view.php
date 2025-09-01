<?php require base_path('views/partials/header.php') ?>

<div class="container" id="home">
	<div id="nav-push"></div>

	<section class="fullscreen">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper">
					<div class="column center space">
					
						<?php if(http_response_code() >= 200) : ?>

						<div class="section-header">
							<header class="sub-title center"><?= __('confirm.error_subtitle') ?></header>
							<h1><?= __('confirm.error_title') ?></h1>
						</div>

						<div class="column center hide-privacy">
							<p><?= __('confirm.error_message') ?></p>
							<?php require base_path('views/partials/newsletter_form.php') ?>
						</div>

						<?php else: ?>

						<div class="section-header">
							<header class="sub-title center"><?= __('confirm.main_subtitle') ?></header>
							<h1><?= __('confirm.main_title') ?></h1>
						</div>

						<?php endif; ?>
						
						<p><?= insertLinks(__('global.return_home'), '/') ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript" src="<?= PATH['javascript']?>nav-push.js"></script>
	<script type="text/javascript" src="<?= PATH['javascript']?>viewport_height.js" ref="section.fullscreen" vh="100" always></script>
</div>
	
<?php require base_path('views/partials/footer.php') ?>