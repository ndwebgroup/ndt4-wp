<?php
/**
 * Template part for displaying news archive
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<div class="news-archive">
	<?php if ( have_posts() ) : ?>
		<div class="news-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/news/news-card' );
			endwhile;
			?>
		</div>

		<?php
		the_posts_pagination( [
			'prev_text' => __( 'Previous', 'ndt4' ),
			'next_text' => __( 'Next', 'ndt4' ),
		] );
		?>
	<?php else : ?>
		<p class="no-news"><?php esc_html_e( 'No news articles found.', 'ndt4' ); ?></p>
	<?php endif; ?>
</div>
