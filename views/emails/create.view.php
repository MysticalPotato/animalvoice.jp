<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
    <?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>
	
	<form id="<?= $form_id = uniqid() ?>" method="POST" action="<?= route('/admin/emails') ?>" enctype="multipart/form-data">
		<div class="form-section">
			<span class="input-tag"><?= __('form.recipient') ?> <span class="required">*</span></span>
			<select name="recipient" required>
				<?php foreach($recipients as $key => $item) : 
					$option_name = $item['name'] . ' (' . insertVars(__('admin.x_people'), $item['count']) . ')';
					if(old('recipient') === $key) : ?>
					
						<option value="<?= $key ?>" selected><?= $option_name ?></option>
						
					<?php else: ?>
					
						<option value="<?= $key ?>"><?= $option_name ?></option>
						
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
			
			<?php // include rich text editor
				$content = old('content');
				require base_path('views/partials/rich_text_editor.php');
			?>

			<?php if(array_key_exists('content', $errors)) : ?>
				<span class="input-error"><?= $errors['content'] ?></span>
			<?php endif; ?>
		</div>

		<div class="notice-info">
			<span>⚠</span>
			<span><?= insertLinks(__('admin.editor_manual_notice'), $editor_manual) ?></span>
		</div>
		
		<div class="btns">
			<button class="btn btn--good submit-btn" type="submit"><?= __('admin.create_email') ?></button>
		</div>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>