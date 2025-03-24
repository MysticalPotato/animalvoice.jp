<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="posts" class="content">
		<a href="<?= route("/admin/posts/{$post['id']}") ?>" class="back-btn"><- <?= __('nav.back') ?></a>
		
		<h2>Edit post</h2>
		
		<?php if(array_key_exists('summary', $errors)) : ?>
			<span class="form-response"><?= $errors['summary'] ?></span>
		<?php endif; ?>
		
		<form method="POST" action="<?= route("/admin/posts/{$post['id']}") ?>" enctype="multipart/form-data">
			<div class="form-section">
				<span class="input-tag"><?= __('form.enabled') ?></span>
				<input type="hidden" name="enabled" value="0">
				<input type="checkbox" name="enabled" value="1" <?= old('enabled', htmlspecialchars($post['enabled'])) === '1' ? 'checked' : '' ?>>
			</div>

			<div class="form-section">
				<span class="input-tag"><?= __('form.insta_account') ?> <span class="required">*</span></span>
				<input type="text" name="account" value="<?= old('account', htmlspecialchars($post['account'])) ?>" maxlength="200" required>
				<?php if(array_key_exists('account', $errors)) : ?>
					<span class="input-error"><?= $errors['account'] ?></span>
				<?php endif; ?>
			</div>
			
			<div class="form-section">
				<span class="input-tag"><?= __('form.insta_post') ?> <span class="required">*</span></span>
				<input type="text" name="url" value="<?= old('url', htmlspecialchars($post['url'])) ?>" maxlength="200" required>
				<?php if(array_key_exists('url', $errors)) : ?>
					<span class="input-error"><?= $errors['url'] ?></span>
				<?php endif; ?>
			</div>
			
			<div class="form-section">
				<span class="input-tag"><?= __('form.insta_image') ?></span>
				<input type="file" name="image" accept=".jpg, .png">
				<?php if(array_key_exists('image', $errors)) : ?>
					<span class="input-error"><?= $errors['image'] ?></span>
				<?php endif; ?>
			</div>
			
			<input type="hidden" name="_method" value="PATCH">
			<button class="btn submit-btn" type="submit"><?= __('button.update') ?></button>
		</form>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>