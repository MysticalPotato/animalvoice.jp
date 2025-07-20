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

				<div class="business-cards grid grid--2-cols">
					<?php foreach($cards as $card) : ?>

					<div class="business-card">
						<div class="card-container">
							<div class="card">
								<div class="card__face card__face--front">
									<img src="<?= $card['img_front'] ?>" alt="<?= $card['title'] ?> card front"/>
								</div>
								
								<div class="card__face card__face--back">
									<img src="<?= $card['img_back'] ?>" alt="<?= $card['title'] ?> card back"/>
								</div>
							</div>
						</div>

						<div class="business-card-info">
							<h3><?= $card['title'] ?></h3>
							<p><span class="bold"><?= __('handouts.on_the_back') ?></span><br>
								<?= $card['description'] ?>
							</p>

							<div class="btns">
								<p>
									<?= __('handouts.download') ?>
									<?php if(isset($card['ai'])) : ?>

										<a href="<?= $card['ai'] ?>">AI</a>,

									<?php endif; ?>
									<?php if(isset($card['png'])) : ?>

										<a href="<?= $card['png'] ?>">PNG</a>,

									<?php endif; ?>
									<a href="<?= $card['pdf'] ?>">PDF</a>
								</p>
								<a class="btn cta-btn" href="<?= $card['order_url'] ?>" target="up-t"><?= __('button.order') ?></a>
							</div>
						</div>
					</div>

					<?php endforeach; ?>
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