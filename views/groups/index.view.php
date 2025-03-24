<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="groups" class="content">
		<h2><?= __('nav.groups') ?></h2>
		<a href="<?= route('/admin/groups/create') ?>">Add group</a>
		<div class="list">
		<?php foreach($groups as $group) : ?>
			
			<div class="list-item">
				<span class="name<?= $group['enabled'] && $group['homepage'] ? '' : ' grey' ?>"><?= htmlspecialchars($group['name']) ?></span>
				
				<div class="btns">
					<a href="<?= route("/admin/groups/{$group['id']}") ?>"><?= __('button.open') ?></a>
					<!--<a href="<?= route("/admin/groups/{$group['id']}/edit") ?>">Edit</a>
					<a href="<?= route("/admin/groups/{$group['id']}/delete") ?>">Delete</a>-->
				</div>
			</div>
			
		<?php endforeach; ?>
		</div>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>