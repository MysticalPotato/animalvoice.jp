<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="posts" class="content">
		<a href="<?= route('/admin/posts') ?>" class="back-btn"><- <?= __('nav.back') ?></a>
		
		<h2>Create post</h2>
		
		<?php if(array_key_exists('summary', $errors)) : ?>
			<span class="form-response"><?= $errors['summary'] ?></span>
		<?php endif; ?>
		
		<form method="POST" action="<?= route('/admin/posts') ?>" enctype="multipart/form-data">
			<div class="form-section">
				<span class="input-tag"><?= __('form.insta_account') ?> <span class="required">*</span></span>
				<input type="text" name="account" value="<?= old('account') ?>" maxlength="200" required>
				<?php if(array_key_exists('account', $errors)) : ?>
					<span class="input-error"><?= $errors['account'] ?></span>
				<?php endif; ?>
			</div>
			
			<div class="form-section">
				<span class="input-tag"><?= __('form.insta_post') ?> <span class="required">*</span></span>
				<input type="text" name="url" value="<?= old('url') ?>" maxlength="200" required>
				<?php if(array_key_exists('url', $errors)) : ?>
					<span class="input-error"><?= $errors['url'] ?></span>
				<?php endif; ?>
			</div>
			
			<div class="form-section">
				<span class="input-tag"><?= __('form.insta_image') ?> <span class="required">*</span></span>
				<input type="file" name="image" accept=".jpg, .png" required>
				<?php if(array_key_exists('image', $errors)) : ?>
					<span class="input-error"><?= $errors['image'] ?></span>
				<?php endif; ?>
			</div>
			
			<button class="btn submit-btn" type="submit">Add post</button>
		</form>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>