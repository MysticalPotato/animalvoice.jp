<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div class="content">
		<h2><?= __('nav.users') ?></h2>
		<a href="<?= route('/admin/users/create') ?>">Add user</a>
		<div class="list">
		<?php foreach($users as $user) : ?>
			
			<div class="list-item">
				<span class="name"><?= htmlspecialchars($user['username']) ?></span>
				
				<div class="btns">
					<a href="<?= route("/admin/users/{$user['id']}") ?>"><?= __('button.open') ?></a>
				</div>
			</div>
			
		<?php endforeach; ?>
		</div>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>