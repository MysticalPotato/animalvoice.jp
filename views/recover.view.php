<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>

    <?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>

	<form method="POST" action="<?= route('/admin/recover') ?>">
		<p class="grey"><?= __('form.recover_password_hint') ?></p>

		<div class="form-section">
			<span class="input-tag"><?= __('form.email') ?></span>
			<input type="text" name="email" value="<?= old('email') ?>" placeholder="email@example.com" maxlength="50" required>
			<?php if(array_key_exists('email', $errors)) : ?>
				<span class="input-error"><?= $errors['email'] ?></span>
			<?php endif; ?>
		</div>
		
		<button class="btn btn--good submit-btn" type="submit"><?= __('button.send') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>