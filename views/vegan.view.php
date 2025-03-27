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

	<section class="recommended-videos">
		<div class="content-wrapper">
			<div class="content">
				<div class="section-header center">
					<div class="center-header">
						<hr><h2><?= __('vegan.recommended_videos') ?></h2><hr>
					</div>
				</div>

				<div class="column-wrapper">
					<div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://iframe.mediadelivery.net/embed/135301/89232d42-e290-40fc-917d-5669478ee73b?autoplay=true&loop=false&muted=false&preload=false<?= locale() === 'ja' ? '&captions=jp' : '' ?>" frameborder="0" allow="autoplay; picture-in-picture" allowfullscreen></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<img class="thumb" src="<?= PATH['images'] ?>icon-thumb.png"/>
								<h3><?= __('vegan.dominion_title') ?></h3>
								<div class="duration-display row">
									<picture>
										<source srcset="<?= PATH['images'] ?>icon-clock.svg" type="image/svg+xml">
										<img src="<?= PATH['images'] ?>icon-clock.png" alt="Clock icon"/>
									</picture>
									<span><?= insertVars(__('vegan.video_duration'), 120) ?></span>
								</div>
							</div>
							<p><?= __('vegan.dominion_description') ?></p>
						</div>
					</div>
					
					<!-- <div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/mHs9ColH2Z0?si=Y1BozIanCWGt81YI<?= locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '' ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<img class="thumb" src="<?= PATH['images'] ?>icon-thumb.png"/>
								<h3><?= __('vegan.nekoyaki_title') ?></h3>
								<div class="duration-display row">
									<picture>
										<source srcset="<?= PATH['images'] ?>icon-clock.svg" type="image/svg+xml">
										<img src="<?= PATH['images'] ?>icon-clock.png" alt="Clock icon"/>
									</picture>
									<span><?= insertVars(__('vegan.video_duration'), 21) ?></span>
								</div>
							</div>
							<p><?= __('vegan.nekoyaki_description') ?></p>
						</div>
					</div> -->

					<div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://iframe.mediadelivery.net/embed/187398/4f422297-30be-4b32-b342-6ddeb76de7ec?autoplay=true&loop=false&muted=false&preload=false<?= locale() === 'ja' ? '&captions=ja' : '' ?>" frameborder="0" allow="autoplay; picture-in-picture" allowfullscreen=""></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<img class="thumb" src="<?= PATH['images'] ?>icon-thumb.png"/>
								<h3><?= __('vegan.dont_watch_title') ?></h3>
								<div class="duration-display row">
									<picture>
										<source srcset="<?= PATH['images'] ?>icon-clock.svg" type="image/svg+xml">
										<img src="<?= PATH['images'] ?>icon-clock.png" alt="Clock icon"/>
									</picture>
									<span><?= insertVars(__('vegan.video_duration'), 7) ?></span>
								</div>
							</div>
							<p><?= __('vegan.dont_watch_description') ?></p>
						</div>
					</div>
					
					<div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/Z3u7hXpOm58?si=Zrda3II9hlnfHm1h<?= locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '' ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<img class="thumb" src="<?= PATH['images'] ?>icon-thumb.png"/>
								<h3><?= __('vegan.ed_speech_title') ?></h3>
								<div class="duration-display row">
									<picture>
										<source srcset="<?= PATH['images'] ?>icon-clock.svg" type="image/svg+xml">
										<img src="<?= PATH['images'] ?>icon-clock.png" alt="Clock icon"/>
									</picture>
									<span><?= insertVars(__('vegan.video_duration'), 32) ?></span>
								</div>
							</div>
							<p><?= __('vegan.ed_speech_description') ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="recommended-videos alt">
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
					<div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://iframe.mediadelivery.net/embed/245757/a3428333-9a5e-4105-a2e0-1e8c176fb938?autoplay=true&loop=false&muted=false&preload=false<?= locale() === 'ja' ? '&captions=jp' : '' ?>" frameborder="0" allow="autoplay; picture-in-picture" allowfullscreen=""></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.3_min_challenge_title') ?></h3>
							</div>
							<p><?= __('vegan.3_min_challenge_description') ?></p>
						</div>
					</div>
					
					<!-- <div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://iframe.mediadelivery.net/embed/187398/4f422297-30be-4b32-b342-6ddeb76de7ec?autoplay=true&loop=false&muted=false&preload=false<?= locale() === 'ja' ? '&captions=ja' : '' ?>" frameborder="0" allow="autoplay; picture-in-picture" allowfullscreen=""></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.dont_watch_title') ?></h3>
							</div>
							<p><?= __('vegan.dont_watch_description') ?></p>
						</div>
					</div> -->

					<div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/Vd4gNV4fAl4?si=R6bvdB4MVNzKWx6y<?= locale() === 'en' ? '&cc_load_policy=1&cc_lang_pref=en' : '' ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.vegan_elly_title') ?></h3>
							</div>
							<p><?= __('vegan.vegan_elly_description') ?></p>
						</div>
					</div>
					
					<div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/UcN7SGGoCNI?si=jqwv2xCsHz1-OLxe<?= locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '' ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.dairy_is_scary_title') ?></h3>
							</div>
							<p><?= __('vegan.dairy_is_scary_description') ?></p>
						</div>
					</div>

					<div class="column">
						<div class="iframe-container">
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/U5hGQDLprA8?si=m925vJlFONcE0eE0<?= locale() === 'ja' ? '&cc_load_policy=1&cc_lang_pref=ja' : '' ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
						</div>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.gary_speech_title') ?></h3> <!--ゲイリー・ヨーロフスキーのスピーチ-->
							</div>
							<p><?= __('vegan.gary_speech_description') ?></p> <!--アニマルライツ活動家であるゲイリー・ユロフスキーのお話しを聞いた後、何百万もの人々がヴィーガンへ移行する決意をしています。-->
						</div>
					</div>
				</div>

				<div id="tab-netflix" class="tab-content column-wrapper">
					<div class="column">
						<a href="https://www.netflix.com/title/81014008" target="seaspiracy">
							<img class="stretch" src="<?= PATH['images'] ?>seaspiracy.webp" alt="Seaspiracy"/>
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.seaspiracy_title') ?></h3>
							</div>
							<p><?= __('vegan.seaspiracy_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://www.netflix.com/title/80174177" target="whatthehealth">
							<img class="stretch" src="<?= PATH['images'] ?>what_the_health.webp" alt="What The Health"/>
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.what_the_health_title') ?></h3>
							</div>
							<p><?= __('vegan.what_the_health_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://www.netflix.com/title/80033772" target="cowspiracy">
							<img class="stretch" src="<?= PATH['images'] ?>cowspiracy.webp" alt="Cowspiracy"/>
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.cowspiracy_title') ?></h3>
							</div>
							<p><?= __('vegan.cowspiracy_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://www.netflix.com/title/80091936" target="okja">
							<img class="stretch" src="<?= PATH['images'] ?>okja.webp" alt="Okja"/>
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.okja_title') ?></h3>
							</div>
							<p><?= __('vegan.okja_description') ?></p>
						</div>
					</div>
				</div>

				<div id="tab-websites" class="tab-content column-wrapper">
					<div class="column">
						<a href="https://vegemap.org/" target="vegemap">
							<img class="stretch" src="<?= PATH['images'] ?>vegemap.webp" alt="VegeMap">
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.vegemap_title') ?></h3>
							</div>
							<p><?= __('vegan.vegemap_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://vegewel.com/" target="vegewel">
							<img class="stretch" src="<?= PATH['images'] ?>vegewel.webp" alt="Vegewel">
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.vegewel_title') ?></h3>
							</div>
							<p><?= __('vegan.vegewel_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://hachidory.com/" target="hachidory">
							<img class="stretch" src="<?= PATH['images'] ?>hachidory.webp" alt="Hachidory">
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.hachidory_title') ?></h3>
							</div>
							<p><?= __('vegan.hachidory_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://veganguide.vcook.jp/" target="veganguide">
							<img class="stretch" src="<?= PATH['images'] ?>vegan_guide.webp" alt="Vegan Guide">
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.vegan_guide_title') ?></h3>
							</div>
							<p><?= __('vegan.vegan_guide_description') ?></p>
						</div>
					</div>
				</div>

				<div id="tab-apps" class="tab-content column-wrapper">
					<div class="column">
						<a href="https://apps.apple.com/jp/app/happycow-vegan-food-near-you/id435871950" target="happycow">
							<img class="stretch" src="<?= PATH['images'] ?>happycow.webp" alt="HappyCow">
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.happycow_title') ?></h3>
							</div>
							<p><?= __('vegan.happycow_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://apps.apple.com/jp/app/veganjapan/id1378015838" target="veganjapan">
							<img class="stretch" src="<?= PATH['images'] ?>vegan_japan.webp" alt="Vegan Japan">
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.vegan_japan_title') ?></h3>
							</div>
							<p><?= __('vegan.vegan_japan_description') ?></p>
						</div>
					</div>

					<div class="column">
						<a href="https://apps.apple.com/jp/app/ve-ヴィー-ヴィーガン-ベジタリアンコミュニティアプリ/id1585916633" target="ve">
							<img class="stretch" src="<?= PATH['images'] ?>ve.webp" alt="Ve">
						</a>
						
						<div class="text-container">
							<div class="row">
								<h3><?= __('vegan.ve_title') ?></h3>
							</div>
							<p><?= __('vegan.ve_description') ?></p>
						</div>
					</div>

					<div class="column">
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript" src="<?= PATH['javascript'] ?>useful_links.js"></script>
	<script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>
</div>

<?php require base_path('views/partials/footer.php') ?>