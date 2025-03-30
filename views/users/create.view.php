<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<div class="header">
		<a href="<?= route('/admin/users') ?>" class="back-btn"><-</a>
		<h2><?= __('admin.create_user') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>
	
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response"><?= $errors['summary'] ?></span>
	<?php endif; ?>
	
	<form method="POST" action="<?= route('/admin/users') ?>">
		<div class="form-section">
			<span class="input-tag"><?= __('form.username') ?></span>
			<input type="text" name="username" value="<?= old('username') ?>" maxlength="50" required>
			<?php if(array_key_exists('username', $errors)) : ?>
				<span class="input-error"><?= $errors['username'] ?></span>
			<?php endif; ?>
		</div>
		
		<div class="form-section">
			<span class="input-tag"><?= __('form.email') ?></span>
			<input type="email" name="email" value="<?= old('email') ?>" maxlength="50" required>
			<?php if(array_key_exists('email', $errors)) : ?>
				<span class="input-error"><?= $errors['email'] ?></span>
			<?php endif; ?>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('global.placeholder_password') ?></span>
			<input type="text" name="password" value="<?= old('password', $password) ?>" maxlength="50" required>
			<?php if(array_key_exists('password', $errors)) : ?>
				<span class="input-error"><?= $errors['password'] ?></span>
			<?php endif; ?>
		</div>
		
		<button class="btn btn--good submit-btn" type="submit">Add user</button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>