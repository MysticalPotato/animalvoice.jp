<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="groups" class="content">
		<a href="<?= route("/admin/groups/{$group['id']}") ?>" class="back-btn"><- <?= __('nav.back') ?></a>
		
		<h2>Delete group</h2>
		
		<?php if(array_key_exists('summary', $errors)) : ?>
			<span class="form-response"><?= $errors['summary'] ?></span>
		<?php endif; ?>
		
		<form method="POST" action="<?= route("/admin/groups/{$group['id']}") ?>">
			<div class="form-section">
				<span class="input-tag">Type "DELETE" to permanently delete <?= htmlspecialchars($group['name']) ?></span>
				<input type="text" name="answer" maxlength="50" required>
				<?php if(array_key_exists('answer', $errors)) : ?>
					<span class="input-error"><?= $errors['answer'] ?></span>
				<?php endif; ?>
			</div>
			
			<input type="hidden" name="_method" value="DELETE">
			<button class="btn submit-btn" type="submit"><?= __('button.delete') ?></button>
		</form>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>