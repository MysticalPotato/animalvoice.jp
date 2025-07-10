<?php
	$unique_id = uniqid();
?>

<form id="<?= $unique_id ?>" class="newsletter" onsubmit="return submitEmail('<?= $unique_id ?>');">
	<div class="form-content">
		<span class="error-message"></span>
		<div class="field-btn-wrapper">
			<input id="newsletter-email" type="email" name="email" size="50" placeholder="<?= __('global.placeholder_email') ?>" required>

			<?php require base_path('views/partials/robot_blocker.php') ?>
			
			<button id="newsletter-submit" class="btn cta-btn" type="submit">
				<span class="btn-value"><?= __('button.send') ?></span>
				<span class="btn-spinner"><i class="fa fa-refresh fa-spin"></i></span>
			</button>
		</div>
		<div class="privacy-disclaimer"><?= insertLinks(__('global.newsletter_privacy'), route('/privacy')) ?></div>
	</div>
	
	<h3 class="success-message"><?= __('response.thank_you') ?></h3>
</form>