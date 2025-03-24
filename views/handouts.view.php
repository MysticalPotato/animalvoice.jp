<?php require(base_path('views/partials/header.php')) ?>

<div class="container" id="handouts">
	<section id="handouts-top-header" class="header">
		<div class="header-img"></div>
		<div class="header-wrapper light center">
			<h1><?= __('nav.handouts') ?></h1>
			<p><?= __('handouts.header_description') ?></p>
		</div>
	</section>

	<section class="">
		<div class="content-wrapper tight">
			<div class="content">
				<div class="section-header center">
					<div class="center-header">
						<hr><h3><?= __('handouts.information_cards') ?></h3><hr>
					</div>
				</div>

				<div class="business-cards column-wrapper">
					<div class="column row">
						<div class="card-container">
							<div class="card business-card">
								<div class="card__face card__face--front">
									<img src="<?= PATH['images'] ?>card-dominion-front.webp" alt="Dominion card front"/>
								</div>
								
								<div class="card__face card__face--back">
									<img src="<?= PATH['images'] ?>card-dominion-back.webp" alt="Dominion card back"/>
								</div>
							</div>
						</div>

						<div class="business-card-info">
							<h3><?= __('handouts.dominion_title') ?></h3>
							<p><span class="bold"><?= __('handouts.on_the_back') ?></span><br>
								<?= __('handouts.dominion_description') ?>
							</p>

							<div class="btns">
								<p><?= __('handouts.download') ?> <a href="<?= PATH['files'] ?>business-card-dominion.zip">PDF</a></p>
								<a class="btn cta-btn" href="<?= $dominion_order_url ?>" target="up-t"><?= __('button.order') ?></a>
							</div>
						</div>
					</div>

					<div class="column"></div>
					<div class="column"></div>
				</div>
			</div>
		</div>
	</section>

	<!-- <section class="alt">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper">
				</div>
			</div>
		</div>
	</section> -->

    <script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>
</div>

<?php require(base_path('views/partials/footer.php')) ?>