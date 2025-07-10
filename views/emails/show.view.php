<?php require base_path('views/partials/admin_head.php') ?>

<div id="emails" class="content">
	<?php if(array_key_exists('summary', $errors)) : ?>
		<span class="form-response form-response--bad"><?= $errors['summary'] ?></span>
	<?php endif; ?>

	<?php if(!empty($status)) : ?>
        <span class="form-response form-response--ok"><?= $status ?></span>
    <?php endif; ?>

	<?php if($_SESSION['user']['admin']) : ?>

		<div class="confirmation-box">
			<span><?= __('admin.send_test_email') ?></span>

			<form method="POST" action="<?= route("/admin/emails/{$email['id']}") ?>">
				<div class="form-section">
					<input type="hidden" name="enabled" value="1">
					<input type="email" name="email" maxlength="50" required>
				</div>

				<button class="btn submit-btn" type="submit"><?= __('button.send') ?></button>
			</form>

			<?php if(array_key_exists('email', $errors)) : ?>
				<span class="input-error"><?= $errors['email'] ?></span>
			<?php endif; ?>
		</div>

	<?php endif; if(empty($email['date_sent'])) : ?>

		<div class="confirmation-box">
			<span><?= insertVars(__('admin.confirmation_notice'), '<strong>' . strtolower($recipients[$email['recipient']]) . '</strong>') ?></span>

			<form method="POST" action="<?= route("/admin/emails/{$email['id']}") ?>">
				<div class="form-section">
					<input type="hidden" name="enabled" value="0">
					<input id="cb-confirmation" type="checkbox" name="enabled" value="1">
					<span><?= __('admin.confirmation_label') ?></span>
				</div>

				<button id="send-email-btn" class="btn btn--good submit-btn" type="submit" disabled><?= __('button.send') ?></button>
			</form>
		</div>

	<?php else: ?>

		<div>
			<div class="field-tag"><?= __('admin.date_sent') ?></div>
			<div><?= dateToText($email['date_sent']) ?></div>
		</div>

	<?php endif; ?>

    <div>
		<div class="field-tag"><?= __('form.recipient') ?></div>
		<div><?= $recipients[$email['recipient']] ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.subject') ?></div>
		<div><?= $email['subject'] ?></div>
	</div>

	<div>
		<div class="field-tag"><?= __('form.message') ?></div>
		<div class="email-body"><?= $email['content'] ?></div>
	</div>
	
	<div>
		<?php if(empty($email['date_sent'])) : ?>
			<a href="<?= route("/admin/emails/{$email['id']}/edit") ?>" style="margin-right: 1em;"><?= __('button.edit') ?></a>
			<a href="<?= route("/admin/emails/{$email['id']}/preview") ?>" style="margin-right: 1em;" target="_blank"><?= __('button.preview') ?></a>
		<?php endif; ?>

		<a href="<?= route("/admin/emails/{$email['id']}/delete") ?>"><?= __('button.delete') ?></a>
	</div>
</div>

<script>
	const btn = document.getElementById("send-email-btn");
	document.getElementById("cb-confirmation").addEventListener('change', function() {
		if (this.checked) {
			btn.removeAttribute('disabled');
		} else {
			btn.setAttribute('disabled', 'disabled');
		}
	});
</script>

<?php require base_path('views/partials/admin_footer.php') ?>