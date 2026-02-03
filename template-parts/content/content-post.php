<?php
/**
 * Template part for displaying posts
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			ndt4_breadcrumbs();
			the_title( '<h1 class="entry-title article-title card-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title article-title card-title"><a class="card-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				ndt4_posted_on();
				ndt4_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( is_singular() ) : ?>
		<?php ndt4_post_thumbnail( 'large' ); ?>
	<?php else : ?>
		<?php ndt4_post_thumbnail( 'ndt4-card' ); ?>
	<?php endif; ?>

	<?php if ( is_singular() ) : ?>
		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ndt4' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages( [
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ndt4' ),
				'after'  => '</div>',
			] );
			?>
		</div>

		<?php ndt4_social_share(); ?>

		<footer class="entry-footer">
			<?php ndt4_entry_footer(); ?>
		</footer>
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php endif; ?>
</article>
