<?php
/**
 * Template part for displaying results in search pages
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result' ); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() || 'ndt4_news' === get_post_type() ) : ?>
			<div class="meta entry-meta">
				<?php
				ndt4_posted_on();
				ndt4_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<span class="post-type-label">
			<?php
			$post_type_obj = get_post_type_object( get_post_type() );
			echo esc_html( $post_type_obj->labels->singular_name );
			?>
		</span>
	</footer>
</article>
