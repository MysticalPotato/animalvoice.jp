<?php require base_path('views/partials/admin_head.php') ?>
<?php require base_path('views/partials/admin_nav.php') ?>

<div class="main">
	<div class="content">
		<h2><?= __('nav.subscribers') ?></h2>
		<a href="#">Download list</a>
		<div class="list">
		<?php foreach($subscribers as $subscriber) : ?>
			
			<div class="list-item">
				<div class="tags">
					<span class="name"><?= htmlspecialchars($subscriber['email']) ?></span>
					<span class="name"><?= htmlspecialchars(dateToText($subscriber['date'])) ?></span>
				</div>
			</div>
			
		<?php endforeach; ?>
		</div>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>