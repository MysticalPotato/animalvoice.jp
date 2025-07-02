<?php require base_path('views/partials/header.php') ?>

<div class="container" id="unsubscribe">
    <div id="nav-push"></div>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
                <div class="column-wrapper start">
					<div class="column space">
                        <div class="section-header">
                            <header class="sub-title"><?= __('unsubscribe.form_subtitle') ?></header>
                            <h1><?= __('unsubscribe.form_title') ?></h1>
                        </div>

                        <p style="margin: 0;">
                            <?= __('unsubscribe.form_description') ?>
                        </p>

						<form id="unsubscribe-form" class="regular-form" onsubmit="submitForm('unsubscribe-form');" method="POST">
							<?php if(array_key_exists('summary', $errors)) : ?>
								<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
							<?php endif; ?>

							<?php if(!empty($status)) : ?>
								<span class="form-response form-response--ok"><?= $status ?></span>
							<?php endif; ?>
							
							<div class="form-content">
								<div class="form-section">
									<input type="email" name="email" value="<?= old('email') ?>" maxlength="50" required>
									<?php if(array_key_exists('email', $errors)) : ?>
										<span class="input-error"><?= $errors['email'] ?></span>
									<?php endif; ?>
								</div>
								
								<div class="form-section">
									<button id="new-group-submit" class="btn cta-btn" type="submit">
										<span class="btn-value"><?= __('button.unsubscribe') ?></span>
										<span class="btn-spinner"><i class="fa fa-refresh fa-spin"></i></span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

    <script type="text/javascript" src="<?= PATH['javascript']?>nav-push.js"></script>
</div>

<?php require base_path('views/partials/footer.php') ?>