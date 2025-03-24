<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="posts" class="content">
		<h2><?= __('nav.posts') ?></h2>
        <a href="<?= route('/admin/posts/create') ?>">Add post</a>
		<div class="list">
		<?php foreach($posts as $post) : ?>
			
			<div class="list-item">
				<div class="tags">
					<span class="name<?= $post['enabled'] ? '' : ' grey' ?>"><?= htmlspecialchars(instaPostId($post['url'])) ?></span>
				</div>
				
				<div class="btns">
					<a href="<?= route("/admin/posts/{$post['id']}") ?>"><?= __('button.open') ?></a>
				</div>
			</div>
			
		<?php endforeach; ?>
		</div>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>