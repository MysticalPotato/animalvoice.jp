<?php require base_path('views/partials/admin_head.php') ?>

<div class="content">
	<p class="page-description"><?= __('admin.emails_description') ?></p>
    <a href="<?= route('/admin/emails/create') ?>"><?= __('admin.create_email') ?></a>
	<div class="list">
	<?php foreach($emails as $email) : ?>
		
		<div class="list-item <?= implode(' ', $email['classes']) ?>">
			<div class="tags">
				<span class="tag tag--name"><?= htmlspecialchars($email['subject']) ?></span>
				<span class="tag tag--date"><?= empty($email['date_sent'])? 'Not yet sent' : htmlspecialchars('Sent - ' . $email['date_sent']) ?></span>
			</div>

			<div class="btns">
				<a href="<?= route("/admin/emails/{$email['id']}") ?>"><?= __('button.open') ?></a>
			</div>
		</div>
		
	<?php endforeach; ?>
	</div>
</div>

<?php require base_path('views/partials/admin_footer.php') ?>