<?php
/**
 * Title: Contact Block
 * Slug: ndt4/contact-block
 * Categories: ndt4-content
 * Description: Contact information block with address, phone, and email.
 */
?>
<!-- wp:group {"style":{"border":{"width":"1px","color":"#e4e1d8"},"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#e4e1d8;border-width:1px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
	<!-- wp:heading {"level":3} -->
	<h3 class="wp-block-heading">Contact Us</h3>
	<!-- /wp:heading -->

	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group">
		<!-- wp:group -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":4,"fontSize":"small"} -->
			<h4 class="wp-block-heading has-small-font-size">Address</h4>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>123 Main Street<br>Notre Dame, IN 46556</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":4,"fontSize":"small"} -->
			<h4 class="wp-block-heading has-small-font-size">Phone</h4>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><a href="tel:+15746315000">(574) 631-5000</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":4,"fontSize":"small"} -->
			<h4 class="wp-block-heading has-small-font-size">Email</h4>
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
