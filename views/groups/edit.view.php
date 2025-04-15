<?php require base_path('views/partials/admin_head.php') ?>

<div id="groups" class="content">
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>
	
	<form method="POST" action="<?= route("/admin/groups/{$group['id']}") ?>" enctype="multipart/form-data">
		<div class="form-section">
			<span class="input-tag"><?= __('form.enabled') ?></span>
			<input type="hidden" name="enabled" value="0">
			<input type="checkbox" name="enabled" value="1" <?= old('enabled', htmlspecialchars($group['enabled'])) === '1' ? 'checked' : '' ?>>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('form.group_name') ?> <span class="required">*</span></span>
			<input type="text" name="name" value="<?= old('name', htmlspecialchars($group['name'])) ?>" maxlength="50" required>
			<?php if(array_key_exists('name', $errors)) : ?>
				<span class="input-error"><?= $errors['name'] ?></span>
			<?php endif; ?>
		</div>
		
		<div class="form-section">
			<span class="input-tag"><?= __('form.prefecture') ?> <span class="required">*</span></span>
			<select name="prefecture" required>
				<option disabled selected value><?= __('form.select_prefecture') ?></option>
				<?php foreach(__('prefecture') as $key => $item) : ?>
					<?php if(old('prefecture', $group['prefecture']) === $key) : ?>
					
						<option value="<?= $key ?>" selected><?= $item ?></option>
						
					<?php else: ?>
					
						<option value="<?= $key ?>"><?= $item ?></option>
						
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div class="form-section">
			<span class="input-tag"><?= __('form.city') ?> <span class="required">*</span></span>
			<input type="text" name="city" value="<?= old('city', htmlspecialchars($group['city'])) ?>" maxlength="50" required>
			<?php if(array_key_exists('city', $errors)) : ?>
				<span class="input-error"><?= $errors['city'] ?></span>
			<?php endif; ?>
		</div>
		
		<div class="form-section">
			<span class="input-tag"><?= __('form.homepage') ?></span>
			<input type="text" name="homepage" value="<?= old('homepage', htmlspecialchars($group['homepage'])) ?>" maxlength="200">
			<?php if(array_key_exists('homepage', $errors)) : ?>
				<span class="input-error"><?= $errors['homepage'] ?></span>
			<?php endif; ?>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('form.organizer_first_name') ?></span>
			<input type="text" name="organizer_first_name" value="<?= old('organizer_first_name', htmlspecialchars($group['organizer_first_name'])) ?>" maxlength="50">
			<?php if(array_key_exists('organizer_first_name', $errors)) : ?>
				<span class="input-error"><?= $errors['organizer_first_name'] ?></span>
			<?php endif; ?>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('form.organizer_last_name') ?></span>
			<input type="text" name="organizer_last_name" value="<?= old('organizer_last_name', htmlspecialchars($group['organizer_last_name'])) ?>" maxlength="50">
			<?php if(array_key_exists('organizer_last_name', $errors)) : ?>
				<span class="input-error"><?= $errors['organizer_last_name'] ?></span>
			<?php endif; ?>
		</div>

		<div class="form-section">
			<span class="input-tag"><?= __('form.organizer_email') ?></span>
			<input type="email" name="organizer_email" value="<?= old('organizer_email', htmlspecialchars($group['organizer_email'])) ?>" maxlength="50">
			<?php if(array_key_exists('organizer_email', $errors)) : ?>
				<span class="input-error"><?= $errors['organizer_email'] ?></span>
			<?php endif; ?>
		</div>
		
		<input type="hidden" name="_method" value="PATCH">
		<button class="btn btn--good submit-btn" type="submit"><?= __('button.update') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>