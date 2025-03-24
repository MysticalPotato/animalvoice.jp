<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="groups" class="content">
		<a href="<?= route('/admin/groups') ?>" class="back-btn"><- <?= __('nav.back') ?></a>
		
		<h2><?= $group['name'] ?></h2>

		<?php if(!$group['enabled'] || !$group['homepage']) : ?>
			<div class="warning">
				<img src="<?= PATH['images'] ?>admin-icon-warning.png"/>
				<span>In order for the group to show on the website, the group needs to be enabled and have a homepage!</span>
			</div>
		<?php endif; ?>

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
</div>

<?php require base_path('views/partials/admin_footer.php') ?>