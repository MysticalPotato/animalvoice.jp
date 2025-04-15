<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<div class="header">
		<a href="<?= route('/admin/users') ?>" class="back-btn"><-</a>
		<h2><?= __('nav.users') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>

	<?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>
	
	<div>
		<div class="field-tag"><?= __('form.username') ?></div>
		<div><?= htmlspecialchars($user['username']) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.email') ?></div>
		<div><?= htmlspecialchars($user['email']) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('global.placeholder_password') ?></div>
		<form method="POST" action="<?= route("/admin/users/{$user['id']}") ?>">
			<input type="hidden" name="password" value="<?= $password ?>">
			<input type="hidden" name="_method" value="PATCH">
			<button type="submit">Send new password</button>
		</form>
	</div>
	
	<div>
		<a href="<?= route("/admin/users/{$user['id']}/edit") ?>" style="margin-right: 1em;"><?= __('button.edit') ?></a>
		<a href="<?= route("/admin/users/{$user['id']}/delete") ?>"><?= __('button.delete') ?></a>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>