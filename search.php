<?php
/**
 * The template for displaying search results
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style       = ndt4_get_navigation_style();
$topnav          = ( 'top' === $nav_style );
$has_nav_sidebar = ! $topnav && has_nav_menu( 'primary' );

ndt4_register_layout( [
	'page_header' => static function (): void {
		?>
		<div class="page-header">
			<div class="page-title-wrapper">
				<h1 class="page-title">
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( 'Search Results for: %s', 'ndt4' ),
						'<span>' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>
			</div>
		</div>
		<?php
	},
	'page_sidebar' => $has_nav_sidebar ? 'ndt4_render_nav_sidebar' : null,
] );

get_header();
?>

<?php if ( have_posts() ) : ?>

	<div class="search-results">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title search-result-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<div class="meta entry-meta search-result-meta">
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

<?php
get_footer();
