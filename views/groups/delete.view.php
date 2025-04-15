<?php require base_path('views/partials/admin_head.php') ?>

<div id="groups" class="content">
	<div class="header">
		<a href="<?= route("/admin/groups/{$group['id']}") ?>" class="back-btn"><-</a>
		<h2><?= __('admin.delete_group') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>
	
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>
	
	<form method="POST" action="<?= route("/admin/groups/{$group['id']}") ?>">
		<div class="form-section">
			<span class="input-tag"><?= insertVars(__('admin.delete_hint'), htmlspecialchars($group['name'])) ?></span>
			<input type="text" name="answer" maxlength="50" required>
			<?php if(array_key_exists('answer', $errors)) : ?>
				<span class="input-error"><?= $errors['answer'] ?></span>
			<?php endif; ?>
		</div>
		
		<input type="hidden" name="_method" value="DELETE">
		<button class="btn btn--bad submit-btn" type="submit"><?= __('button.delete') ?></button>
	</form>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>