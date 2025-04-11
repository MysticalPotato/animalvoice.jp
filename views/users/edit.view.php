<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<div class="header">
		<a href="<?= route("/admin/users/{$user['id']}") ?>" class="back-btn"><-</a>
		<h2><?= __('admin.edit_user') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>
	
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>
	
	<form method="POST" action="<?= route("/admin/users/{$user['id']}") ?>">
		<div class="form-section">
			<span class="input-tag"><?= __('form.username') ?></span>
			<input type="text" name="username" value="<?= old('username', htmlspecialchars($user['username'])) ?>" maxlength="50" required>
			<?php if(array_key_exists('username', $errors)) : ?>
				<span class="input-error"><?= $errors['username'] ?></span>
			<?php endif; ?>
		</div>
		
		<div class="form-section">
			<span class="input-tag"><?= __('form.email') ?></span>
			<input type="email" name="email" value="<?= old('email', htmlspecialchars($user['email'])) ?>" maxlength="50" required>
			<?php if(array_key_exists('email', $errors)) : ?>
				<span class="input-error"><?= $errors['email'] ?></span>
			<?php endif; ?>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('global.placeholder_password') ?> <span class="optional">(optional)</span></span>
			<input type="text" name="password" value="<?= old('password') ?>" maxlength="50">
			<?php if(array_key_exists('password', $errors)) : ?>
				<span class="input-error"><?= $errors['password'] ?></span>
			<?php endif; ?>
		</div>
		
		<input type="hidden" name="_method" value="PATCH">
		<button class="btn btn--good submit-btn" type="submit"><?= __('button.update') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>