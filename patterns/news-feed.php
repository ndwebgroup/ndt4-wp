<?php
/**
 * Title: News Feed
 * Slug: ndt4/news-feed
 * Categories: ndt4-news
 * Description: Display latest news articles in a grid.
 */
?>
<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center">Latest News</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"ndt4_news","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"align":"wide"} -->
	<div class="wp-block-query alignwide">
		<!-- wp:post-template -->
		<!-- wp:group {"style":{"border":{"width":"1px","color":"#e4e1d8"},"spacing":{"padding":{"top":"0","right":"0","bottom":"var:preset|spacing|30","left":"0"}}},"backgroundColor":"white"} -->
		<div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#e4e1d8;border-width:1px;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--30);padding-left:0">
			<!-- wp:post-featured-image {"isLink":true,"height":"200px"} /-->

			<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30","top":"var:preset|spacing|20"}}}} -->
			<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:post-date {"fontSize":"small"} /-->

				<!-- wp:post-title {"level":3,"isLink":true} /-->

				<!-- wp:post-excerpt {"moreText":"Read more","excerptLength":20} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center">No news articles found.</p>
		<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
		<!-- wp:button {"backgroundColor":"nd-blue"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-nd-blue-background-color has-background wp-element-button" href="/news/">View All News</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
