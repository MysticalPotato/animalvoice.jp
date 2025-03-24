<?php require(base_path('views/partials/header.php')) ?>

<div class="container" id="videos">
	<section id="videos-top-header" class="header">
		<div class="header-img"></div>
		<div class="header-wrapper light center">
			<h1><?= __('nav.videos') ?></h1>
            <p><?= __('activism.videos_description') ?></p>
		</div>
	</section>

	<section class="">
		<div class="content-wrapper">
			<div class="content">
				<div class="section-header center">
					<div class="center-header">
						<hr><h3><?= __('videos.outreach_japan') ?></h3><hr>
					</div>
				</div>

				<div class="outreach-videos grid grid--4-cols">
					<?php foreach($yt_videos as $yt_video) : ?>

						<div class="grid-item">
							<div class="yt-container">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $yt_video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

    <section>
		<div class="content-wrapper" style="padding-top: 0;">
			<div class="content" style="max-width: 1620px;">
				<div class="next-page-btn">
					<span><?= __('button.page_next') ?></span>
					<a href="<?= route('/handouts') ?>">
						<span><?= __('nav.handouts') ?></span>
						<picture>
							<source srcset="<?= PATH['images'] ?>arrow-right.svg" type="image/svg+xml" />
							<img src="<?= PATH['images'] ?>arrow-right.png" alt="Right arrow icon"/>
						</picture>
					</a>
				</div>
			</div>
		</div>
	</section>
    
    <script async src="//www.instagram.com/embed.js"></script>
    <script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>
</div>

<?php require(base_path('views/partials/footer.php')) ?>