<?php
/**
 * Title: Contact Block
 * Slug: ndt4/contact-block
 * Categories: ndt4-content
 * Description: Contact information block with address, phone, and email.
 */
?>
<!-- wp:group {"style":{"border":{"width":"1px","color":"#e4e1d8"},"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#e4e1d8;border-width:1px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
	<!-- wp:heading {"className":"h3"} -->
	<h2 class="wp-block-heading h3">Contact Us</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group">
		<!-- wp:group -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":3,"className":"h4","style":{"spacing":{"margin":{"top":"0"}}},"fontSize":"small"} -->
			<h3 class="wp-block-heading h4 has-small-font-size" style="margin-top:0">Address</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>123 Main Street<br>Notre Dame, IN 46556</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":3,"className":"h4","style":{"spacing":{"margin":{"top":"0"}}},"fontSize":"small"} -->
			<h3 class="wp-block-heading h4 has-small-font-size" style="margin-top:0">Phone</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><a href="tel:+15746315000">(574) 631-5000</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":3,"className":"h4","style":{"spacing":{"margin":{"top":"0"}}},"fontSize":"small"} -->
			<h3 class="wp-block-heading h4 has-small-font-size" style="margin-top:0">Email</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><a href="mailto:contact@nd.edu">contact@nd.edu</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
