<?php require base_path('views/partials/admin_head.php') ?>

<div id="groups" class="content">
	<div class="header">
		<a href="<?= route('/admin/groups') ?>" class="back-btn"><-</a>
		<h2><?= __('nav.groups') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>

	<?php if(!$group['enabled'] || !$group['homepage']) : ?>
		<div class="warning">
			<img src="<?= PATH['images'] ?>admin-icon-warning.png"/>
			<span><?= __('warning.group_disabled') ?></span>
		</div>
	<?php endif; ?>

	<div>
		<div class="field-tag"><?= __('form.name') ?></div>
		<div><?= $group['name'] ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.enabled') ?></div>
		<div><?= $group['enabled'] ? 'Yes' : 'No' ?></div>
	</div>
	
	<div>
		<div class="field-tag"><?= __('form.prefecture') ?></div>
		<div><?= __('prefecture.' . $group['prefecture']) ?></div>
	</div>
	
	<div>
		<div class="field-tag"><?= __('form.city') ?></div>
		<div><?= htmlspecialchars(replaceEmpty($group['city'], '-')) ?></div>
	</div>
	
	<div>
		<div class="field-tag"><?= __('form.homepage') ?></div>
		<div><a href="<?= $group['homepage'] ?>" target="homepage"><?= htmlspecialchars(replaceEmpty($group['homepage'], '-')) ?></a></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.organizer_first_name') ?></div>
		<div><?= htmlspecialchars(replaceEmpty($group['organizer_first_name'], '-')) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.organizer_last_name') ?></div>
		<div><?= htmlspecialchars(replaceEmpty($group['organizer_last_name'], '-')) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.organizer_email') ?></div>
		<div><?= htmlspecialchars(replaceEmpty($group['organizer_email'], '-')) ?></div>
	</div>
	
	<div>
		<a href="<?= route("/admin/groups/{$group['id']}/edit") ?>" style="margin-right: 1em;"><?= __('button.edit') ?></a>
		<a href="<?= route("/admin/groups/{$group['id']}/delete") ?>"><?= __('button.delete') ?></a>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>