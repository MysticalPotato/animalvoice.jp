<?php require base_path('views/partials/admin_head.php') ?>

<div id="posts" class="content">
	<div class="header">
		<a href="<?= route('/admin/posts') ?>" class="back-btn"><-</a>
		<h2><?= __('nav.posts') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>

	<?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>

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
		<img class="insta-picture" src="<?= PATH['uploads'] . htmlspecialchars(replaceEmpty($post['image'], '-')) ?>"/>
	</div>
	
	<div>
		<a href="<?= route("/admin/posts/{$post['id']}/edit") ?>" style="margin-right: 1em;"><?= __('button.edit') ?></a>
		<a href="<?= route("/admin/posts/{$post['id']}/delete") ?>"><?= __('button.delete') ?></a>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>