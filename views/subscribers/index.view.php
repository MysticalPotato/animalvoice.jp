<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<div class="header">
		<h2><?= __('nav.subscribers') ?></h2>
		<?php require base_path('views/partials/admin_menu_btn.php') ?>
	</div>
	
	<a href="#">Download list</a>
	<div class="list">
	<?php foreach($subscribers as $subscriber) : ?>
		
		<div class="list-item">
			<div class="tags">
				<span class="tag tag--name"><?= htmlspecialchars($subscriber['email']) ?></span>
				<span class="tag tag--date"><?= htmlspecialchars(dateToText($subscriber['date'])) ?></span>
			</div>
		</div>
		
	<?php endforeach; ?>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>