<?php require base_path('views/partials/admin_head.php') ?>

<div id="posts" class="content">
	<a href="<?= route('/admin/posts/create') ?>"><?= __('admin.create_post') ?></a>
	<div class="list">
	<?php foreach($posts as $post) : ?>
		
		<div class="list-item <?= implode(' ', $post['classes']) ?>">
			<div class="tags">
				<img class="tag tag--preview" src="<?= PATH['uploads'] . htmlspecialchars(replaceEmpty($post['image'], '-')) ?>" />
				<span class="tag tag--name<?= $post['enabled'] ? '' : ' disabled' ?>"><?= htmlspecialchars(instaPostId($post['url'])) ?></span>
			</div>
			
			<div class="btns">
				<a href="<?= route("/admin/posts/{$post['id']}") ?>"><?= __('button.open') ?></a>
			</div>
		</div>
		
	<?php endforeach; ?>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>