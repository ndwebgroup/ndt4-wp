<?php
/**
 * Template part for displaying a news card
 *
 * @package NDT4
 * @since 4.0.0
 */

$show_images = get_theme_mod( 'ndt4_news_images', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-card' ); ?>>
	<?php if ( $show_images && has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="news-card-image" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'ndt4-news-thumb' ); ?>
		</a>
	<?php endif; ?>

	<div class="news-card-content">
		<header class="news-card-header">
			<time class="news-card-date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>

			<?php the_title( '<h3 class="news-card-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
		</header>

		<?php if ( has_excerpt() ) : ?>
			<div class="news-card-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

		<?php
		$terms = get_the_terms( get_the_ID(), 'ndt4_news_category' );
		if ( $terms && ! is_wp_error( $terms ) ) :
			?>
			<footer class="news-card-footer">
				<ul class="news-card-categories">
					<?php foreach ( $terms as $term ) : ?>
						<li>
							<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</footer>
		<?php endif; ?>
	</div>
</article>
