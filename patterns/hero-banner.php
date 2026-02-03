<?php
/**
 * Title: Hero Banner
 * Slug: ndt4/hero-banner
 * Categories: ndt4-heroes
 * Description: Full-width hero banner with background image and overlay text.
 */
?>
<!-- wp:cover {"url":"https://conductor.nd.edu/images/themes/ndt/4.0/headers/dome.jpg","dimRatio":50,"overlayColor":"nd-blue","minHeight":400,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:400px">
	<span aria-hidden="true" class="wp-block-cover__background has-nd-blue-background-color has-background-dim"></span>
	<img class="wp-block-cover__image-background" alt="" src="https://conductor.nd.edu/images/themes/ndt/4.0/headers/dome.jpg" data-object-fit="cover"/>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
			<h1 class="wp-block-heading has-text-align-center has-white-color has-text-color">Welcome to Our Site</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","textColor":"white","fontSize":"large"} -->
			<p class="has-text-align-center has-white-color has-text-color has-large-font-size">Discover what makes us unique and explore our programs.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"nd-gold","textColor":"nd-blue"} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-nd-blue-color has-nd-gold-background-color has-text-color has-background wp-element-button">Learn More</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
