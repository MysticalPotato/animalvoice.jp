<?php require base_path('views/partials/admin_head.php') ?>

<div id="settings" class="content">
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>

	<?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>
	
	<form method="POST" action="<?= route("/admin/settings") ?>" enctype="multipart/form-data">
		<div class="form-section">
			<span class="input-tag"><?= __('form.contact_recipient') ?></span>
			<input type="email" name="contact_email" value="<?= htmlspecialchars($settings['contact_email']) ?>" maxlength="50">
			<?php if(array_key_exists('contact_email', $errors)) : ?>
				<span class="input-error"><?= $errors['contact_email'] ?></span>
			<?php endif; ?>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('form.enable_aws') ?></span>
			<span class="input-hint"><?= __('form.enable_aws_hint') ?></span>
			<input type="hidden" name="amazon_ses_enabled" value="0">
			<input type="checkbox" name="amazon_ses_enabled" value="1" <?= old('amazon_ses_enabled', htmlspecialchars($settings['amazon_ses_enabled'])) === '1' ? 'checked' : '' ?>>
		</div>
		
		<button class="btn btn--good submit-btn" type="submit"><?= __('button.update') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>