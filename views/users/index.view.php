<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<div class="header">
		<h2><?= __('nav.users') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>
	
	<a href="<?= route('/admin/users/create') ?>"><?= __('admin.create_user') ?></a>
	<div class="list">
	<?php foreach($users as $user) : ?>
		
		<div class="list-item <?= implode(' ', $user['classes']) ?>">
			<div class="tags">
				<span class="tag tag--name"><?= htmlspecialchars($user['username']) ?></span>
			</div>
			
			<div class="btns">
				<a href="<?= route("/admin/users/{$user['id']}") ?>"><?= __('button.open') ?></a>
			</div>
		</div>
		
	<?php endforeach; ?>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>