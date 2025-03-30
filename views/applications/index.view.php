<?php require base_path('views/partials/admin_head.php') ?>

<div id="applications" class="content">
	<div class="header">
		<h2><?= __('nav.applications') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>

	<div class="list">
	<?php foreach($applications as $application) : ?>
		
		<div class="list-item">
			<div class="tags">
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