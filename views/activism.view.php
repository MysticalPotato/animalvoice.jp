<?php require(base_path('views/partials/header.php')) ?>

<div class="container" id="activism">
	<section id="activism-top-header" class="header">
		<!--<img class="parallax-bg" src="<?php echo PATH['images']?>outreach_8.jpg"/>-->
		<div class="header-img"></div>
		<div class="header-wrapper light center">
			<h1><?= __('activism.header_title') ?></h1>
			<!--<img src="<?= PATH['images'] ?>scroll_down.png"/>-->
		</div>
	</section>
	
	<section class="after">
		<div class="content-wrapper">
			<div class="content">
				<div class="section-header center">
					<header class="sub-title"><?= insertVars(__('activism.step'), localNmbr(1)) ?></header>
					<div class="center-header">
						<hr><h1><?= __('global.newsletter_title') ?></h1><hr>
					</div>
				</div>
				
				<div class="column-wrapper">
					<div class="column center hide-privacy">
						<p><?= __('global.newsletter_description') ?></p>
						
						<?php include('partials/newsletter_form.php') ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="find-a-group" class="alt after">
		<div class="content-wrapper">
			<div class="content small-space">
				<div class="section-header center">
					<header class="sub-title"><?= insertVars(__('activism.step'), localNmbr(2)) ?></header>
					<div class="center-header">
						<hr><h1><?= __('activism.find_group_title') ?></h1><hr>
					</div>
				</div>
				
				<div class="column-wrapper">
					<?php foreach($regions as $column) : ?>
					
						<div class="column">
							<?php foreach($column as $region) : ?>
							
								<div class="accordion-container item-list">
									<button class="accordion">
										<span class="accordion-content"><?= __('region.' . $region) ?></span>
										<span class="accordion-toggle-bar accordion-toggle-bar--top"></span>
										<span class="accordion-toggle-bar accordion-toggle-bar--bottom"></span>
									</button>
									
									<div class="panel">
										<?php $selection = filter($groups, 'region', $region); ?>
										<?php foreach($selection as $group) : ?>
										
											<div class="panel-item">
												<span><?= htmlspecialchars($group['name']) ?></span>
												<a href="<?= htmlspecialchars($group['homepage']) ?>" target="<?= htmlspecialchars($group['name']) ?>"><?= __('button.join_short') ?></a>
											</div>
										
										<?php endforeach; if(count($selection) === 0) : ?>
										
											<div class="panel-item">
												<span><?= __('activism.no_groups') ?></span>
												<a onClick="scroll_to('start-a-group');"><?= __('activism.start_group_title') ?></a>
											</div>
										
										<?php endif; ?>
									</div>
									
									<hr>
								</div>
							
							<?php endforeach; ?>
						</div>
						
					<?php endforeach; ?>
				</div>
				
				<span class="center"><?= insertLinks(__('activism.start_group_here'), "scroll_to('start-a-group');", true) ?></span>
			</div>
		</div>
	</section>
	
	<section>
		<div class="content-wrapper">
			<div class="content small-space">
				<div class="section-header center">
					<header class="sub-title"><?= insertVars(__('activism.step'), localNmbr(3)) ?></header>
					<div class="center-header">
						<hr><h1><?= __('activism.resources_title') ?></h1><hr>
					</div>
				</div>
				
				<div class="column-wrapper small-gap">
					<div class="column alt center card">
						<picture>
							<source srcset="<?= PATH['images'] ?>resources-icon-guidelines.svg" type="image/svg+xml">
							<img src="<?php echo PATH['images'] ?>resources-icon-guidelines.png" class="line-img" alt="Guidelines icon"/>
						</picture>

						<h3><?= __('nav.guidelines') ?></h3>
						<p><?= __('activism.guidelines_description') ?></p>
						<a class="btn cta-btn" href="<?= route('/guidelines') ?>"><?= __('button.show_me') ?></a>
					</div>
					
					<div class="column alt center card">
						<picture>
							<source srcset="<?= PATH['images'] ?>resources-icon-training.svg" type="image/svg+xml">
							<img src="<?php echo PATH['images'] ?>resources-icon-training.png" class="line-img" alt="Training icon"/>
						</picture>

						<h3><?= __('nav.training') ?></h3>
						<p><?= __('activism.training_description') ?></p>
						<a class="btn cta-btn" href="<?= route('/training') ?>"><?= __('button.show_me') ?></a>
					</div>
					
					<div class="column alt center card">
						<picture>
							<source srcset="<?= PATH['images'] ?>resources-icon-videos.svg" type="image/svg+xml">
							<img src="<?php echo PATH['images'] ?>resources-icon-videos.png" class="line-img" alt="Videos icon"/>
						</picture>

						<h3><?= __('nav.videos') ?></h3>
						<p><?= __('activism.videos_description') ?></p>
						<a class="btn cta-btn" href="<?= route('/videos') ?>"><?= __('button.show_me') ?></a>
					</div>

					<div class="column alt center card">
						<picture>
							<source srcset="<?= PATH['images'] ?>resources-icon-handouts.svg" type="image/svg+xml">
							<img src="<?php echo PATH['images'] ?>resources-icon-handouts.png" class="line-img" alt="Handouts icon"/>
						</picture>
						
						<h3><?= __('nav.handouts') ?></h3>
						<p><?= __('activism.handouts_description') ?></p>
						<a class="btn cta-btn" href="<?= route('/handouts') ?>"><?= __('button.show_me') ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="header">
		<div class="header-img" style="background-image: linear-gradient(270deg, rgba(42, 62, 102, 0.3) 100%, rgba(37,42,52,0) 100%), url('<?php echo PATH['images']?>hero-activism-2.webp');"></div>
		<div class="header-wrapper light">
			<!-- <span class="big-number">“</span>
			<h3>Vegan - Because the strong always protect the weak.</h3> -->
		</div>
	</section>
	
	<section id="start-a-group">
		<div class="content-wrapper">
			<div class="content space">
				<div class="section-header center">
					<header class="sub-title"><?= __('activism.start_group_subtitle') ?></header>
					<div class="center-header">
						<hr><h1><?= __('activism.start_group_title') ?></h1><hr>
					</div>
				</div>
				
				<div class="column-wrapper">
					<div class="column">
						<img class="stretch" src="<?= PATH['images']?>activism-new.webp" alt="Group photo"/>
					</div>

					<div class="column">
						<div class="text-container">
							<h2><?= __('activism.how_to_start_title') ?></h2>
							<p>
								<?= __('activism.how_to_start_content_1') ?>
								<br><br>
								<?= insertLinks(__('activism.how_to_start_content_2'), '/guidelines') ?> 
							</p>
						</div>
						<a class="btn cta-btn special-char--arrow" href="<?= route('/organizer') ?>"><?= __('button.apply') ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript" src="<?= PATH['javascript'] ?>accordion.js"></script>
	<script type="text/javascript" src="<?= PATH['javascript'] ?>scroll_to.js"></script>
	<script type="text/javascript" src="<?= PATH['javascript'] ?>viewport_height.js" ref=".header" vh="60"></script>

	<?php if(isset($_GET['scroll_to'])) : ?>
		
		<script type="text/javascript">
			scroll_to('<?= $_GET['scroll_to'] ?>');
		</script>

	<?php endif; ?>
</div>

<?php require(base_path('views/partials/footer.php')) ?>