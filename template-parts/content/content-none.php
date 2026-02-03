<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'ndt4' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<?php
			printf(
				'<p>' . wp_kses(
					/* translators: %s: link to new post */
					__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'ndt4' ),
					[
						'a' => [
							'href' => [],
						],
					]
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
			?>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ndt4' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ndt4' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
