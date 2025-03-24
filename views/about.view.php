<?php require(base_path('views/partials/header.php')) ?>

<div class="container" id="about">
	<section id="about-top-header" class="header">
		<div class="header-img"></div>
		<div class="header-wrapper light center">
			<h1><?= __('about.header_title') ?></h1>
			<!-- <img src="<?= PATH['images'] ?>scroll_down.png"/> -->
		</div>
	</section>

	<section class="alt">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper">
					<div class="column">
						<!-- <img class="stretch" src="<?= PATH['images']?>group_1.jpg"/> -->
						<span class="bold"><?= __('about.description_short') ?></span>
					</div>
					
					<div class="column">
						<?= __('about.description') ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
				<div class="homepages grid">
					<?php foreach($groups as $group) : ?>

						<div class="grid-item">
							<span class="bold"><?= $group['name'] ?></span>
							<br>
							<a href="<?= $group['homepage'] ?>"><?= __('about.homepage') ?></a>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>
</div>

<?php require(base_path('views/partials/footer.php')) ?>