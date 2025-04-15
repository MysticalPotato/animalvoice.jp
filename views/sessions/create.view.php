<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>

	<form method="POST" action="sessions">
		<div class="form-section">
			<span class="input-tag"><?= __('form.email') ?></span>
			<input type="text" name="email" value="<?= old('email') ?>" placeholder="email@example.com" maxlength="50" required>
			<?php if(array_key_exists('email', $errors)) : ?>
				<span class="input-error"><?= $errors['email'] ?></span>
			<?php endif; ?>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('form.password') ?></span>
			<input type="password" name="password" placeholder="<?= __('global.placeholder_password') ?>" maxlength="50" required>
			<?php if(array_key_exists('password', $errors)) : ?>
				<span class="input-error"><?= $errors['password'] ?></span>
			<?php endif; ?>
		</div>
		
		<button class="btn btn--good submit-btn" type="submit"><?= __('button.sign_in') ?></button>
	</form>

	<a href="<?= route('/admin/recover') ?>"><?= __('form.forgot_password') ?></a>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>