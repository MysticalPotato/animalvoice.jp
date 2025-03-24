		<footer>
			<div class="content-wrapper">
				<div class="content">
					<div id="footer-top-part" class="column-wrapper">
						<div class="column newsletter">
							<h3><?= __('global.newsletter_title');?></h3>
							
							<p><?= __('global.newsletter_description');?></p>
							
							<?php include('newsletter_form.php') ?>
						</div>
						
						<div class="column">
							<h3><?= __('nav.general') ?></h3>
							<nav>
								<a href="<?= route('/vegan') ?>"><?= __('nav.why_vegan') ?></a>
								<a href="<?= route('/about') ?>"><?= __('nav.about') ?></a>
								<a href="<?= route('/contact') ?>"><?= __('nav.contact') ?></a>
							</nav>
						</div>
						
						<div class="column">
							<h3><?= __('nav.get_involved') ?></h3>
							<nav>
								<a href="<?= route('/activism') ?>"><?= __('nav.join') ?></a>
								<a href="<?= route('/activism?scroll_to=start-a-group') ?>"><?= __('nav.new_group') ?></a>
								<a href="<?= route('/donate') ?>"><?= __('nav.donate') ?></a>
							</nav>
						</div>
						
						<div class="column">
							<h3><?= __('nav.resources') ?></h3>
							<nav>
								<a href="<?= route('/guidelines') ?>"><?= __('nav.guidelines') ?></a>
								<a href="<?= route('/training') ?>"><?= __('nav.training') ?></a>
								<a href="<?= route('/videos') ?>"><?= __('nav.videos') ?></a>
								<a href="<?= route('/handouts') ?>"><?= __('nav.handouts') ?></a>
							</nav>
						</div>
					</div>
					
					<hr class="dark">
					
					<div id="footer-bottom-part">
						<a class="insta-link" href="https://www.instagram.com/animal_voice_japan/" target="instagram">
						<picture>
							<source srcset="<?= PATH['images'] ?>icon-instagram.svg" type="image/svg+xml">
							<img src="<?php echo PATH['images'] ?>icon-instagram.png" alt="Instagram icon">
						</picture>
						</a>
						<span class="copyright"><?= __('meta.website_name') ?> &copy; <?php echo date('Y');?></span>
						<a class="privacy" href="<?= route('/privacy') ?>"><?= __('global.privacy_policy');?></a>
					</div>
				</div>
			</div>
		</footer>

		<script type="text/javascript" src="<?= PATH['javascript'] ?>forms.js"></script>

		<!-- 100% privacy-first analytics -->
		<script async
			data-hostname="<?= production() ? 'animalvoice.jp' : 'dev.animalvoice.jp' ?>"
			src="<?= production() ? 'https://scripts.simpleanalyticscdn.com/latest.js' : 'https://scripts.simpleanalyticscdn.com/latest.dev.js' ?>"
		></script>
	</body>
</html>