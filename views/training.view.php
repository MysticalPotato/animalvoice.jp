<?php require(base_path('views/partials/header.php')) ?>

<div class="container" id="training">
	<section id="training-top-header" class="header">
		<div class="header-img"></div>
		<div class="header-wrapper light center">
			<h1><?= __('nav.training') ?></h1>
			<p><?= __('activism.training_description') ?></p>
		</div>
	</section>

	<section id="conversation" class="">
		<div class="content-wrapper">
			<div class="content small-space">
				<div class="section-header center small">
					<picture>
						<source srcset="<?= PATH['images'] ?>icon-comment.svg" type="image/svg+xml">
						<img src="<?= PATH['images'] ?>icon-comment.png" alt="Text box icon"/>
					</picture>
					<div class="center-header">
						<hr><h2><?= __('training.how_to_start') ?></h2><hr>
					</div>
				</div>

				<div class="column-wrapper">
					<?php for($i = 0 ; $i < count($conversation_columns); $i ++) : ?>

						<div class="column no-gap">
							<?php foreach($conversation_columns[$i] as $key => $value) : ?>

								<div class="conversation-item">
									<div class="conversation-number">
										<h3 class="number"><?= $key + 1 + count($conversation_columns[0]) * $i ?></h3>
										<div class="dotted-line"></div>
									</div>

									<div class="qa-container">
										<span class="question"><?= $value['question'] ?></span>
										<!-- <span class="answer">"<?= $value['answer'] ?>"</span> -->
									</div>
								</div>

							<?php endforeach; ?>
						</div>

					<?php endfor; ?>
				</div>
			</div>
		</div>
	</section>

	<section id="excuses" class="alt">
		<div class="content-wrapper">
			<div class="content small-space">
				<div class="section-header center small">
					<picture>
						<source srcset="<?= PATH['images'] ?>icon-glasses.svg" type="image/svg+xml">
						<img src="<?= PATH['images'] ?>icon-glasses.png" alt="Glasses icon"/>
					</picture>
					<div class="center-header">
						<hr><h2><?= __('training.common_excuses') ?></h2><hr>
					</div>
				</div>

				<div class="column-wrapper">
					<?php for($i = 0 ; $i < count($excuses_columns); $i ++) : ?>
					
						<div class="column small-gap">
							<?php foreach($excuses_columns[$i] as $excuse) : ?>
								
								<div class="accordion-container qa">
									<button class="accordion">
										<span class="accordion-content"><?= $excuse['question'] ?></span>
										<span class="accordion-toggle-bar accordion-toggle-bar--top"></span>
										<span class="accordion-toggle-bar accordion-toggle-bar--bottom"></span>
									</button>
									
									<div class="panel">
										<span class="panel-content"><?= $excuse['answer'] ?></span>
									</div>
								</div>
								
							<?php endforeach; ?>
						</div>
						
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="alt">
		<div class="content-wrapper" style="padding-top: 0;">
			<div class="content" style="max-width: 1620px;">
				<div class="next-page-btn">
					<span><?= __('button.page_next') ?></span>
					<a href="<?= route('/videos') ?>">
						<span><?= __('nav.videos') ?></span>
						<picture>
							<source srcset="<?= PATH['images'] ?>arrow-right.svg" type="image/svg+xml" />
							<img src="<?= PATH['images'] ?>arrow-right.png" alt="Right arrow icon"/>
						</picture>
					</a>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript" src="<?= PATH['javascript'] ?>accordion.js"></script>
    <script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>
</div>

<?php require(base_path('views/partials/footer.php')) ?>