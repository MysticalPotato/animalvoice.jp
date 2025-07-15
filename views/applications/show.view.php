<?php require base_path('views/partials/admin_head.php') ?>

<div id="applications" class="content">
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
			<form method="POST" action="<?= route('/admin/groups') ?>">
				<input type="hidden" name="_method" value="POST">
				<input type="hidden" name="name" value="アニマル・ボイス　<?= $application['city'] ?>">
				<input type="hidden" name="prefecture" value="<?= $application['prefecture'] ?>">
				<input type="hidden" name="city" value="<?= $application['city'] ?>">
				<input type="hidden" name="homepage" value="">
				<input type="hidden" name="organizer_first_name" value="<?= $application['first_name'] ?>">
				<input type="hidden" name="organizer_last_name" value="<?= $application['last_name'] ?>">
				<input type="hidden" name="organizer_email" value="<?= $application['email'] ?>">
				<input type="hidden" name="send_welcome_email" value="1">
				<input type="hidden" name="application_id" value="<?= $application['id'] ?>">
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