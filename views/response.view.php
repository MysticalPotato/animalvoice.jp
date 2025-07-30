<?php require base_path('views/partials/header.php') ?>

<div class="container" id="home">
	<div id="nav-push"></div>

	<section class="fullscreen">
		<div class="content-wrapper">
			<div class="content">
				<div class="column-wrapper">
					<div class="column center space">
						<div class="section-header">
							<header class="sub-title center">REPONSE CODE <?= $code ?></header>
							<h1><?= $response_name ?></h1>
						</div>
						
						<p>Return to <a href="<?= route('/') ?>">home</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript" src="<?= PATH['javascript']?>nav-push.js"></script>
	<script type="text/javascript" src="<?= PATH['javascript']?>viewport_height.js" ref="section.fullscreen" vh="100" always></script>
</div>
	
<?php require base_path('views/partials/footer.php') ?>