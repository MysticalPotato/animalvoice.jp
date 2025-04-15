<?php require base_path('views/partials/admin_head.php') ?>

<div id="applications" class="content">
	<div class="list">
	<?php foreach($applications as $application) : ?>
		
		<div class="list-item <?= implode(' ', $application['classes']) ?>">
			<div class="tags">
				<?php if(!$application['viewed']) : ?>

				<img class="tag tag--new" src="<?= PATH['images'] ?>admin-icon-exclamation.png" />

				<?php endif; ?>
				<span class="tag tag--name"><?= displayName(htmlspecialchars($application['first_name']), htmlspecialchars($application['last_name'])) ?></span>
				<span class="tag tag--date"><?= htmlspecialchars(dateToText($application['date'])) ?></span>
			</div>
			
			<div class="btns">
				<a href="<?= route("/admin/applications/{$application['id']}") ?>"><?= __('button.open') ?></a>
			</div>
		</div>
		
	<?php endforeach; ?>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>