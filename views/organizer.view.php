<?php require base_path('views/partials/header.php') ?>

<div class="container" id="organizer">
    <div id="nav-push"></div>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
				<div class="section-header center">
                    <header class="sub-title center"><?= __('organizer.form_subtitle') ?></header>
                    <h1><?= __('organizer.form_title') ?></h1>
                </div>

				<p class="center" style="margin: 0;">
					<?= __('organizer.form_description') ?>
                </p>

                <div class="column-wrapper">
					<div class="column">
						<?php require base_path('views/partials/application_form.php') ?>
					</div>
				</div>
			</div>
		</div>
	</section>

    <script type="text/javascript" src="<?= PATH['javascript']?>nav-push.js"></script>
</div>

<?php require base_path('views/partials/footer.php') ?>