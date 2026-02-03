<?php
/**
 * Template part for displaying page content
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php ndt4_breadcrumbs(); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php ndt4_post_thumbnail( 'large' ); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ndt4' ),
			'after'  => '</div>',
		] );
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'ndt4' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>
</article>
