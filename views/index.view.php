<?php require base_path('views/partials/header.php') ?>

<div class="container" id="home">
	<section id="home-top-header" class="header parallax-container">
		<!--<img class="parallax-bg" src="<?= PATH['images']?>outreach_8.jpg"/>-->
		<div class="header-img parallax-img"></div>
		<div class="header-wrapper light">
			<div class="content">
				<h1><?= __('home.banner') ?></h1>
				<div class="buttons">
					<a class="btn cta-btn" href="<?= route('/activism') ?>"><?= __('button.join_long') ?></a>
					<a class="btn empty-btn" href="<?= route('/vegan') ?>"><?= __('nav.why_vegan') ?></a>
				</div>
			</div>
		</div>
	</section>
	
	<section class="#after #hide-after-on-phone">
		<div class="content-wrapper">
			<div class="content space">
				<div class="section-header center">
					<header class="sub-title"><?= __('home.activity_subtitle') ?></header>
					<div class="center-header">
						<hr><h1><?= __('home.activity_title') ?></h1><hr>
					</div>
				</div>
				
				<div class="column-wrapper">
					<div class="column stretch reverse">
						<div class="text-container">
							<!--<h2><span class="big-number">1</span> <?= __('home.expose_title') ?></h2>-->
							<h2 class="flash-icon"><?= __('home.expose_title') ?></h2>
							<p><?= __('home.expose_description') ?></p>
						</div>
						<img class="stretch" src="<?= PATH['images']?>home-expose.webp" alt="Masked person holding TV screen"/>
					</div>
					
					<div class="column stretch">
						<div class="text-container">
							<!--<h2><span class="big-number">2</span> <?= __('home.advocate_title') ?></h2>-->
							<h2 class="flash-icon"><?= __('home.advocate_title') ?></h2>
							<p><?= __('home.advocate_description') ?></p>
						</div>
						<img class="stretch" src="<?= PATH['images']?>home-advocate.webp" alt="Person doing outreach"/>
					</div>
				</div>
				
				<!-- <span class="center"><?= insertLinks('Learn more about who we are [here]', '/about') ?></span> -->
				 <div class="center">
					<a class="btn empty-btn dark-empty-btn" href="<?= route('/about') ?>"><?= __('home.learn_about_us') ?></a>
				</div>
			</div>
		</div>
	</section>
	
	<section class="alt bg">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper reverse">
					<div class="column space push-down">
						<div class="section-header">
							<header class="sub-title"><?= __('home.find_group_subtitle') ?></header>
							<h1><?= __('home.find_group_title') ?></h1>
						</div>
						
						<p><?= __('home.find_group_description') ?></p>
						
						<a class="btn cta-btn" href="<?= route('/activism') ?>"><?= __('button.get_involved') ?></a>
					</div>
					
					<div class="column">
						<img class="stretch" src="<?= PATH['images']?>home-join.webp" alt="Person holding TV screen with hidden face and arrow pointing at the face saying &quot;you?&quot;"/>
						<!-- <img class="stretch" src="<?= PATH['images']?>activism_map.png" alt="Stylized map of Japan"/> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="dark">
		<div class="content-wrapper">
			<div class="content">
				<div class="section-header center">
					<h1><?= __('global.newsletter_title') ?></h1>
				</div>
				
				<div class="column-wrapper">
					<div class="column center">
						<p><?= __('global.newsletter_description') ?></p>
						
						<?php include('partials/newsletter_form.php') ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="#after #hide-after-on-phone">
		<div class="content-wrapper">
			<div class="content space">
				<div class="section-header center">
					<header class="sub-title"><?= __('home.social_subtitle') ?></header>
					<div class="center-header">
						<hr><h1><?= __('home.social_title') ?></h1><hr>
					</div>
				</div>
				
				<div class="column-wrapper social-previews">
					<?php foreach($posts as $post) : ?>
						
						<a class="card-container" href="<?= htmlspecialchars($post['url']) ?>" target="social">
							<div class="card insta-card">
								<div class="card__face card__face--front">
									
									<img src="<?= PATH['uploads'] . htmlspecialchars($post['image']) ?>" alt="Instagram photo"/>
								</div>
								
								<div class="card__face card__face--back">
									<picture>
										<source srcset="<?= PATH['images'] ?>icon-instagram.svg" type="image/svg+xml">
										<img src="<?php echo PATH['images'] ?>icon-instagram.png" alt="Instagram icon">
									</picture>
									<span>@<?= htmlspecialchars($post['account']) ?></span>
								</div>
							</div>
						</a>
						
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	
	<section class="alt cta-section">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper">
					<div class="column center space">
						<div class="section-header">
							<header class="sub-title center"><?= __('home.join_subtitle') ?></header>
							<h1><?= __('home.join_title') ?></h1>
						</div>
						
						<p><?= __('home.join_description') ?></p>
						
						<a class="btn cta-btn" href="<?= route('/activism') ?>"><?= __('button.join_long') ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript" src="<?php echo PATH['javascript']?>viewport_height.js" ref="section.header" vh="100"></script>
</div>
	
<?php require base_path('views/partials/footer.php') ?>