<?php require base_path('views/partials/header.php') ?>

<div class="container" id="privacy">
    <div id="nav-push"></div>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
                <div class="section-header">
                    <header class="sub-title"><?= __('privacy.main_subtitle') ?></header>
                    <h1><?= __('privacy.main_title') ?></h1>
                </div>

                <p style="margin: 0;">
                    <?= insertVars(__('privacy.last_updated'), $last_updated) ?>
                </p>

                <div class="markdown">
                    <?= $privacy_md ?>
                </div>
			</div>
		</div>
	</section>

    <script type="text/javascript" src="<?= PATH['javascript']?>nav-push.js"></script>
</div>

<?php require base_path('views/partials/footer.php') ?>