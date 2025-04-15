<?php require base_path('views/partials/admin_head.php') ?>

<div id="posts" class="content">
	<?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>

	<?php if(!$post['enabled']) : ?>
		<div class="warning">
			<img src="<?= PATH['images'] ?>admin-icon-warning.png"/>
			<span><?= __('warning.post_disabled') ?></span>
		</div>
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