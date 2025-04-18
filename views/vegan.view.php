<?php require base_path('views/partials/header.php') ?>

<div class="container" id="vegan">
	<section id="vegan-top-header" class="header">
		<div class="header-img"></div>
		<div class="header-wrapper light center">
			<h1><?= __('vegan.header_title') ?></h1>
			<p>
				<?= __('vegan.header_description') ?>
			</p>
			<!-- <img src="<?= PATH['images'] ?>scroll_down.png"/> -->
		</div>
	</section>

	<section id="challenge21" class="alt">
		<div class="content-wrapper">
			<div class="content">
				<img src="<?= PATH['images'] ?>arc_chicken.png"/>
				<span class="center"><?= insertLinks(__('vegan.vegan_21'), 'https://arcj.org/vegan21/') ?></span>
			</div>
		</div>
	</section>

	<section class="vegan-resources recommended-videos">
		<div class="content-wrapper">
			<div class="content">
				<div class="section-header center">
					<div class="center-header">
						<hr><h2><?= __('vegan.recommended_videos') ?></h2><hr>
					</div>
				</div>

				<div class="column-wrapper">
					<?php foreach($recommended as $res) {
						require base_path('views/partials/vegan_resource.php');
					} ?>
				</div>
			</div>
		</div>
	</section>

	<section class="vegan-resources alt">
		<div class="content-wrapper">
			<div class="content">
				<div id="tab-btns" style="
					display: flex;
					justify-content: center;
					gap: 1em;
				">
					<button class="btn tab-btn dark" attr="tab-videos"><?= __('vegan.tab_videos') ?></button>
					<button class="btn tab-btn" attr="tab-netflix"><?= __('vegan.tab_netflix') ?></button>
					<button class="btn tab-btn" attr="tab-websites"><?= __('vegan.tab_websites') ?></button>
					<button class="btn tab-btn" attr="tab-apps"><?= __('vegan.tab_apps') ?></button>
				</div>

				<div id="tab-videos" class="tab-content column-wrapper">
					<?php foreach($videos as $res) {
						require base_path('views/partials/vegan_resource.php');
					} ?>
				</div>

				<div id="tab-netflix" class="tab-content column-wrapper">
					<?php foreach($netflix as $res) {
						require base_path('views/partials/vegan_resource.php');
					} ?>
				</div>

				<div id="tab-websites" class="tab-content column-wrapper">
					<?php foreach($websites as $res) {
						require base_path('views/partials/vegan_resource.php');
					} ?>
				</div>

				<div id="tab-apps" class="tab-content column-wrapper">
					<?php foreach($apps as $res) {
						require base_path('views/partials/vegan_resource.php');
					} ?>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript" src="<?= PATH['javascript'] ?>useful_links.js"></script>
	<script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>
</div>

<?php require base_path('views/partials/footer.php') ?>