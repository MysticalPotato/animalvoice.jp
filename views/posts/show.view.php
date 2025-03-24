<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="posts" class="content">
		<a href="<?= route('/admin/posts') ?>" class="back-btn"><- <?= __('nav.back') ?></a>
		
		<h2><?= instaPostId($post['url']) ?></h2>

		<div>
			<div class="field-tag"><?= __('form.enabled') ?></div>
			<div><?= $post['enabled'] ? 'Yes' : 'No' ?></div>
		</div>
		
		<div>
			<div class="field-tag"><?= __('form.insta_account') ?></div>
			<div><a href="https://www.instagram.com/<?= $post['account'] ?>" target="insta-account"><?= htmlspecialchars($post['account']) ?></a></div>
		</div>
		
		<div>
			<div class="field-tag"><?= __('form.insta_post') ?></div>
			<div><a href="<?= $post['url'] ?>" target="insta-post"><?= htmlspecialchars($post['url']) ?></a></div>
		</div>
		
		<div>
            <div class="field-tag"><?= __('form.insta_image') ?></div>
            <img src="<?= PATH['uploads'] . htmlspecialchars(replaceEmpty($post['image'], '-')) ?>" style="width: 320px; height: 320px;"/>
        </div>
		
		<div>
			<a href="<?= route("/admin/posts/{$post['id']}/edit") ?>" style="margin-right: 1em;"><?= __('button.edit') ?></a>
			<a href="<?= route("/admin/posts/{$post['id']}/delete") ?>"><?= __('button.delete') ?></a>
		</div>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>