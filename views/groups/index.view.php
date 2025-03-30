<?php require base_path('views/partials/admin_head.php') ?>

<div id="groups" class="content">
	<div class="header">
		<h2><?= __('nav.groups') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>
	
	<a href="<?= route('/admin/groups/create') ?>"><?= __('admin.create_group') ?></a>
	<div class="list">
	<?php foreach($groups as $group) : ?>
		
		<div class="list-item <?= implode(' ', $group['classes']) ?>">
			<div class="tags">
				<span class="tag tag--name"><?= htmlspecialchars($group['name']) ?></span>
			</div>
			
			<div class="btns">
				<a href="<?= route("/admin/groups/{$group['id']}") ?>"><?= __('button.open') ?></a>
				<!--<a href="<?= route("/admin/groups/{$group['id']}/edit") ?>">Edit</a>
				<a href="<?= route("/admin/groups/{$group['id']}/delete") ?>">Delete</a>-->
			</div>
		</div>
		
	<?php endforeach; ?>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>