<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<div class="header">
		<a href="<?= route('/admin/users') ?>" class="back-btn"><-</a>
		<h2><?= __('nav.users') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>
	
	<div>
		<div class="field-tag"><?= __('form.username') ?></div>
		<div><?= htmlspecialchars($user['username']) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.email') ?></div>
		<div><?= htmlspecialchars($user['email']) ?></div>
	</div>
	
	<div>
		<a href="<?= route("/admin/users/{$user['id']}/edit") ?>" style="margin-right: 1em;"><?= __('button.edit') ?></a>
		<a href="<?= route("/admin/users/{$user['id']}/delete") ?>"><?= __('button.delete') ?></a>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>