<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div class="content">
		<a href="<?= route('/admin/users') ?>" class="back-btn"><- <?= __('nav.back') ?></a>
		
		<h2><?= htmlspecialchars($user['username']) ?></h2>
		
		<div>
			<div class="field-tag"><?= __('form.email') ?></div>
			<div><?= htmlspecialchars($user['email']) ?></div>
		</div>
		
		<div>
			<a href="<?= route("/admin/users/{$user['id']}/edit") ?>" style="margin-right: 1em;"><?= __('button.edit') ?></a>
			<a href="<?= route("/admin/users/{$user['id']}/delete") ?>"><?= __('button.delete') ?></a>
		</div>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>