<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
    <?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>
	
	<form method="POST" action="<?= route('/admin/groups') ?>" enctype="multipart/form-data">
		<div class="form-section">
			<span class="input-tag"><?= __('form.recipient') ?> <span class="required">*</span></span>
			<select name="recipient" required>
				<?php foreach($recipients as $key => $item) : ?>
					<?php if(old('recipient') === $key) : ?>
					
						<option value="<?= $key ?>" selected><?= $item ?></option>
						
					<?php else: ?>
					
						<option value="<?= $key ?>"><?= $item ?></option>
						
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>

        <div class="form-section">
			<span class="input-tag"><?= __('form.subject') ?> <span class="required">*</span></span>
			<input type="text" name="subject" value="<?= old('subject') ?>" maxlength="50" required>
			<?php if(array_key_exists('subject', $errors)) : ?>
				<span class="input-error"><?= $errors['subject'] ?></span>
			<?php endif; ?>
		</div>

        <div class="form-section">
			<span class="input-tag"><?= __('form.message') ?> <span class="required">*</span></span>
            <textarea name="message" maxlength="500" required><?= old('message') ?></textarea>
			<?php if(array_key_exists('message', $errors)) : ?>
				<span class="input-error"><?= $errors['message'] ?></span>
			<?php endif; ?>
		</div>
		
		<button class="btn btn--good submit-btn" type="submit"><?= __('button.send') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>