<?php require(base_path('views/partials/header.php')) ?>

<div class="container" id="guidelines">
	<section id="guidelines-top-header" class="header">
		<div class="header-img"></div>
		<div class="header-wrapper light center">
			<h1><?= __('nav.guidelines') ?></h1>
            <p><?= __('activism.guidelines_description') ?></p>
		</div>
	</section>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper">
					<div class="column end">
						<h3 class="disclaimer"><?= __('guidelines.disclaimer_title') ?></h3>
					</div>

					<div class="column">
						<?= __('guidelines.disclaimer_content') ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="alt">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper reverse">
					<div class="column space">
						<h2><?= __('guidelines.rules_title') ?></h2>
						<p style="display: none;">
							<?= __('guidelines.rules_content_1') ?>
							<br><br>
							<?= __('guidelines.rules_content_2') ?>
							<br><br>
							<?= __('guidelines.rules_content_3') ?>
						</p>

						<ol class="rules-list">
							<?php $i = 1; foreach(__('guidelines.rules_list') as $item) : ?>
							<li>
								<span><?= $i . '.' ?></span>
								<span><?= $item ?></span>
							</li>
							<?php $i++; endforeach; ?>
						</ol>

						<span class="local-rules"><?= __('guidelines.rules_disclaimer') ?></span>
					</div>

					<div class="column center-content">
						<img class="stretch" src="<?= PATH['images']?>guidelines-roc.webp" alt="Two people looking at masked person holding TV screen"/>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
				<h2><?= __('guidelines.equipment_title') ?></h2>

				<div class="equipment grid grid--2-cols">
					<div class="grid-item">
						<picture>
							<source srcset="<?= PATH['images'] ?>equipment-icon-shirt.svg" type="image/svg+xml">
							<img src="<?= PATH['images'] ?>equipment-icon-shirt.png" class="equipment-icon equipment-icon--shirt" alt="Shirt icon"/>
						</picture>
						<p><?= __('guidelines.equipment_content_1') ?></p>
					</div>

					<div class="grid-item">
						<picture>
							<source srcset="<?= PATH['images'] ?>equipment-icon-mask.svg" type="image/svg+xml">
							<img src="<?= PATH['images'] ?>equipment-icon-mask.png" class="equipment-icon equipment-icon--mask" alt="Mask icon"/>
						</picture>
						<p><?= insertLinks(__('guidelines.equipment_content_2'), "https://www.amazon.co.jp/s?k=anonymous+mask") ?></p>
					</div>

					<div class="grid-item">
						<picture>
							<source srcset="<?= PATH['images'] ?>equipment-icon-cards.svg" type="image/svg+xml">
							<img src="<?= PATH['images'] ?>equipment-icon-cards.png" class="equipment-icon equipment-icon--cards" alt="Cards icon"/>
						</picture>
						<p><?= insertLinks(__('guidelines.equipment_content_3'), route('/handouts')) ?></p>
					</div>

					<div class="grid-item">
						<picture>
							<source srcset="<?= PATH['images'] ?>equipment-icon-tv.svg" type="image/svg+xml">
							<img src="<?= PATH['images'] ?>equipment-icon-tv.png" class="equipment-icon equipment-icon--tv" alt="TV icon"/>
						</picture>
						<p><?= __('guidelines.equipment_content_4') ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="content-wrapper" style="padding-top: 0;">
			<div class="content" style="max-width: 1620px;">
				<div class="next-page-btn">
					<span><?= __('button.page_next') ?></span>
					<a href="<?= route('/training') ?>">
						<span><?= __('nav.training') ?></span>
						<picture>
							<source srcset="<?= PATH['images'] ?>arrow-right.svg" type="image/svg+xml" />
							<img src="<?= PATH['images'] ?>arrow-right.png" alt="Right arrow icon"/>
						</picture>
					</a>
				</div>
			</div>
		</div>
	</section>

    <script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>
</div>

<?php require(base_path('views/partials/footer.php')) ?>