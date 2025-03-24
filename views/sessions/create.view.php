<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div class="content">
		<h2>Sign in to your account</h2>

		<?php if(array_key_exists('summary', $errors)) : ?>
			<span class="form-response"><?= $errors['summary'] ?></span>
		<?php endif; ?>

		<form method="POST" action="sessions">
			<div class="form-section">
				<input type="text" name="email" value="<?= old('email') ?>" placeholder="<?= __('global.placeholder_email') ?>" maxlength="50" required>
				<?php if(array_key_exists('email', $errors)) : ?>
					<span class="input-error"><?= $errors['email'] ?></span>
				<?php endif; ?>
			</div>

			<div class="form-section">
				<input type="password" name="password" placeholder="<?= __('global.placeholder_password') ?>" maxlength="50" required>
				<?php if(array_key_exists('password', $errors)) : ?>
					<span class="input-error"><?= $errors['password'] ?></span>
				<?php endif; ?>
			</div>

			<button class="btn submit-btn" type="submit">Sign in</button>
		</form>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>