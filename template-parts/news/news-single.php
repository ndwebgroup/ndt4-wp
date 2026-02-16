<?php
/**
 * Template part for displaying single news article
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-single' ); ?>>
	<header class="entry-header">
		<?php ndt4_breadcrumbs(); ?>

		<div class="meta entry-meta">
			<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>

			<?php
			$terms = get_the_terms( get_the_ID(), 'ndt4_news_category' );
			if ( $terms && ! is_wp_error( $terms ) ) :
				?>
				<span class="entry-categories">
					<?php
					$term_links = [];
					foreach ( $terms as $term ) {
						$term_links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
					}
					echo implode( ', ', $term_links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</span>
			<?php endif; ?>
		</div>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( get_the_author_meta( 'display_name' ) ) : ?>
			<p class="entry-author">
				<?php
				printf(
					/* translators: %s: author name */
					esc_html__( 'By %s', 'ndt4' ),
					'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
				);
				?>
			</p>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumbnail">
			<?php the_post_thumbnail( 'large' ); ?>
			<?php
			$caption = get_the_post_thumbnail_caption();
			if ( $caption ) :
				?>
				<figcaption><?php echo esc_html( $caption ); ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

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
</article>

<?php
// Related news.
$related_terms = get_the_terms( get_the_ID(), 'ndt4_news_category' );
if ( $related_terms && ! is_wp_error( $related_terms ) ) :
	$term_ids	 = wp_list_pluck( $related_terms, 'term_id' );
	$related_news = new WP_Query( [
		'post_type'	  => 'ndt4_news',
		'posts_per_page' => 3,
		'post__not_in'   => [ get_the_ID() ],
		'tax_query'	  => [
			[
				'taxonomy' => 'ndt4_news_category',
				'field'	=> 'term_id',
				'terms'	=> $term_ids,
			],
		],
	] );

	if ( $related_news->have_posts() ) :
		?>
		<aside class="related-news">
			<h2><?php esc_html_e( 'Related News', 'ndt4' ); ?></h2>
			<div class="news-grid">
				<?php
				while ( $related_news->have_posts() ) :
					$related_news->the_post();
					get_template_part( 'template-parts/news/news-card' );
				endwhile;
				?>
			</div>
		</aside>
		<?php
		wp_reset_postdata();
	endif;
endif;
