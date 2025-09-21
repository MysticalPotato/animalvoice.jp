<?php require base_path('views/partials/admin_head.php') ?>

<div id="applications" class="content">
	<?php if($approved) : ?>
		<div class="warning">
			<img src="<?= PATH['images'] ?>admin-icon-warning.png"/>
			<span><?= $approver ? insertVars(__('warning.application_approved_by'), $approver) : __('warning.application_approved') ?></span>
		</div>
	<?php endif; ?>

	<div>
		<div class="field-tag"><?= __('form.first_name') ?></div>
		<div><?= htmlspecialchars($application['first_name']) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.last_name') ?></div>
		<div><?= htmlspecialchars($application['last_name']) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.email') ?></div>
		<div><?= htmlspecialchars($application['email']) ?></div>
	</div>
	
	<div>
		<div class="field-tag"><?= __('form.prefecture') ?></div>
		<div><?= __('prefecture.' . $application['prefecture']) ?></div>
	</div>
	
	<div>
		<div class="field-tag"><?= __('form.city') ?></div>
		<div><?= htmlspecialchars($application['city']) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.how_find_website') ?></div>
		<div><?= htmlspecialchars(replaceEmpty($application['question_1'], '-')) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.introduce_yourself') ?></div>
		<div><?= htmlspecialchars(replaceEmpty($application['question_2'], '-')) ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.outreach_experience') ?></div>
		<div><?= htmlspecialchars(replaceEmpty($application['question_3'], '-')) ?></div>
	</div>
	
	<div class="btns">
		<?php if(!$approved) : ?>
			<form method="POST" action="<?= route("/admin/applications/{$application['id']}/prefill-group") ?>">
				<button class="btn btn--good"><?= __('button.approve') ?></button>
			</form>
		<?php endif; ?>

		<form method="POST" action="<?= route("/admin/applications/{$application['id']}") ?>">
			<input type="hidden" name="_method" value="DELETE">
			<?php if($approved) : ?>
				<button class="btn"><?= __('button.delete') ?></button>
			<?php else: ?>
				<button class="btn btn--bad"><?= __('button.reject') ?></button>
			<?php endif; ?>
		</form>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>