<?php require base_path('views/partials/admin_head.php') ?>

<div id="posts" class="content">
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>
	
	<form method="POST" action="<?= route('/admin/posts') ?>" enctype="multipart/form-data">
		<div class="form-section">
			<span class="input-tag"><?= __('form.insta_account') ?> <span class="required">*</span></span>
			<span class="input-hint"><?= __('form.insta_account_hint') ?></span>
			<input type="text" name="account" value="<?= old('account') ?>" maxlength="200" required>
			<?php if(array_key_exists('account', $errors)) : ?>
				<span class="input-error"><?= $errors['account'] ?></span>
			<?php endif; ?>
		</div>
		
		<div class="form-section">
			<span class="input-tag"><?= __('form.insta_post') ?> <span class="required">*</span></span>
			<span class="input-hint"><?= __('form.insta_post_hint') ?></span>
			<input type="text" name="url" value="<?= old('url') ?>" maxlength="200" required>
			<?php if(array_key_exists('url', $errors)) : ?>
				<span class="input-error"><?= $errors['url'] ?></span>
			<?php endif; ?>
		</div>
		
		<div class="form-section">
			<span class="input-tag"><?= __('form.insta_image') ?> <span class="required">*</span></span>
			<span class="input-hint"><?= __('admin.image_requirements') ?></span>
			<input type="file" name="image" accept=".jpg, .jpeg, .png" required>
			<?php if(array_key_exists('image', $errors)) : ?>
				<span class="input-error"><?= $errors['image'] ?></span>
			<?php endif; ?>
		</div>
		
		<button class="btn btn--good submit-btn" type="submit"><?= __('admin.create_post') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>