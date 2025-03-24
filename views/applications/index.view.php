<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div id="applications" class="content">
		<h2><?= __('nav.applications') ?></h2>
		<div class="list">
		<?php foreach($applications as $application) : ?>
			
			<div class="list-item">
				<div class="tags">
					<span class="name"><?= displayName(htmlspecialchars($application['first_name']), htmlspecialchars($application['last_name'])) ?></span>
					<span class="name"><?= htmlspecialchars(dateToText($application['date'])) ?></span>
				</div>
				
				<div class="btns">
					<a href="<?= route("/admin/applications/{$application['id']}") ?>"><?= __('button.open') ?></a>
				</div>
			</div>
			
		<?php endforeach; ?>
		</div>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>