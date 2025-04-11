<?php require base_path('views/partials/admin_head.php') ?>

<div id="settings" class="content">
	<div class="header">
		<h2><?= __('nav.settings') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>

	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>

	<?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>
	
	<form method="POST" action="<?= route("/admin/settings") ?>" enctype="multipart/form-data">
		<div class="form-section">
			<span class="input-tag">Contact recipient</span>
			<input type="email" name="contact_email" value="<?= htmlspecialchars($settings['contact_email']) ?>" maxlength="50">
			<?php if(array_key_exists('contact_email', $errors)) : ?>
				<span class="input-error"><?= $errors['contact_email'] ?></span>
			<?php endif; ?>
		</div>
		
		<button class="btn btn--good submit-btn" type="submit"><?= __('button.update') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>