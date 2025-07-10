<?php require base_path('views/partials/header.php') ?>

<div class="container" id="contact">
    <div id="nav-push"></div>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
                <div class="section-header center">
                    <header class="sub-title center"><?= __('contact.form_subtitle') ?></header>
                    <h1><?= __('contact.form_title') ?></h1>
                </div>

                <p class="center" style="margin: 0;">
                    <?= __('contact.form_description') ?>
                </p>

                <div class="column-wrapper">
					<div class="column">
						<form id="contact-form" class="regular-form" onsubmit="submitForm('contact-form');" method="POST">
							<?php if(array_key_exists('summary', $errors)) : ?>
								<span class="form-response form-response--bad"><?= $show_raw_errors && array_key_exists('raw', $errors) ? $errors['raw'] : $errors['summary'] ?></span>
							<?php endif; ?>

							<?php if(!empty($status)) : ?>
								<span class="form-response form-response--ok"><?= $status ?></span>
							<?php endif; ?>
							
							<div class="form-content">
								<div class="form-row">
									<div class="form-section">
										<span class="input-tag"><?= __('form.first_name') ?> <span class="highlight">*</span></span>
										<input type="text" name="first_name" value="<?= old('first_name') ?>" maxlength="50" required>
										<?php if(array_key_exists('first_name', $errors)) : ?>
											<span class="input-error"><?= $errors['first_name'] ?></span>
										<?php endif; ?>
									</div>

									<div class="form-section">
										<span class="input-tag"><?= __('form.last_name') ?> <span class="highlight">*</span></span>
										<input type="text" name="last_name" value="<?= old('last_name') ?>" maxlength="50" required>
										<?php if(array_key_exists('last_name', $errors)) : ?>
											<span class="input-error"><?= $errors['last_name'] ?></span>
										<?php endif; ?>
									</div>
								</div>

								<div class="form-section">
									<span class="input-tag"><?= __('form.email') ?> <span class="highlight">*</span></span>
									<input type="email" name="email" value="<?= old('email') ?>" maxlength="50" required>
									<?php if(array_key_exists('email', $errors)) : ?>
										<span class="input-error"><?= $errors['email'] ?></span>
									<?php endif; ?>
								</div>

								<div class="form-section">
									<span class="input-tag"><?= __('form.subject') ?> <span class="highlight">*</span></span>
									<input type="text" name="subject" value="<?= old('subject') ?>" maxlength="50" required>
									<?php if(array_key_exists('subject', $errors)) : ?>
										<span class="input-error"><?= $errors['subject'] ?></span>
									<?php endif; ?>
								</div>

								<div class="form-section">
									<span class="input-tag"><?= __('form.message') ?> <span class="highlight">*</span></span>
									<textarea name="message" maxlength="1000" required><?= old('message') ?></textarea>
									<?php if(array_key_exists('message', $errors)) : ?>
										<span class="input-error"><?= $errors['message'] ?></span>
									<?php endif; ?>
								</div>

								<?php require base_path('views/partials/robot_blocker.php') ?>
								
								<div class="form-section">
									<button id="new-group-submit" class="btn cta-btn" type="submit">
										<span class="btn-value"><?= __('button.send') ?></span>
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