<?php
/**
 * The template for displaying search results
 *
 * @package NDT4
 * @since 4.0.0
 */

get_header();

$nav_style	 = ndt4_get_navigation_style();
$topnav		= ( 'top' === $nav_style );
$mark_right	= ( 'right' === get_theme_mod( 'ndt4_mark_position', 'left' ) );
$has_sidebar   = ! $topnav && has_nav_menu( 'primary' );

// Determine column classes based on layout
if ( $topnav ) {
	$alpha_classes = 'page-primary';
	$beta_classes  = '';
} else {
	$alpha_classes = 'page-primary';
	$beta_classes  = 'page-sidebar';
}
?>

<div class="page-header">
	<div class="page-title-wrapper">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Search Results for: %s', 'ndt4' ),
				'<span>' . get_search_query() . '</span>'
			);
			?>
		</h1>
	</div>
</div>

<div class="<?php echo esc_attr( $alpha_classes ); ?>">
	<?php if ( have_posts() ) : ?>

		<div class="search-results">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
					<header class="entry-header">
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<div class="entry-meta">
							<?php ndt4_posted_on(); ?>
						</div>
					</header>

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>
				</article>
				<?php
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

		<div class="no-results">
			<h2><?php esc_html_e( 'Nothing Found', 'ndt4' ); ?></h2>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ndt4' ); ?></p>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>
</div>

<?php if ( $has_sidebar ) : ?>
	<div class="<?php echo esc_attr( $beta_classes ); ?>">
		<?php get_template_part( 'template-parts/navigation/nav-site' ); ?>
		<?php dynamic_sidebar( 'sidebar-nav' ); ?>
	</div>
<?php endif; ?>

<?php
get_footer();
