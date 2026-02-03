<?php
/**
 * The template for displaying News archives
 *
 * @package NDT4
 * @since 4.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'News', 'ndt4' ); ?></h1>

		<?php
		// Display category description if on a news category archive.
		if ( is_tax( 'ndt4_news_category' ) ) :
			the_archive_description( '<div class="archive-description">', '</div>' );
		endif;
		?>
	</header>

	<?php
	// News category filter.
	$news_categories = get_terms( [
		'taxonomy'   => 'ndt4_news_category',
		'hide_empty' => true,
	] );

	if ( ! empty( $news_categories ) && ! is_wp_error( $news_categories ) ) :
		?>
		<nav class="news-filter" aria-label="<?php esc_attr_e( 'Filter news by category', 'ndt4' ); ?>">
			<ul>
				<li>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'ndt4_news' ) ); ?>"<?php echo ! is_tax( 'ndt4_news_category' ) ? ' aria-current="page"' : ''; ?>>
						<?php esc_html_e( 'All', 'ndt4' ); ?>
					</a>
				</li>
				<?php foreach ( $news_categories as $category ) : ?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $category ) ); ?>"<?php echo is_tax( 'ndt4_news_category', $category->term_id ) ? ' aria-current="page"' : ''; ?>>
							<?php echo esc_html( $category->name ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/news/news-archive' ); ?>
</main>

<?php
if ( 'side' === ndt4_get_navigation_style() && has_nav_menu( 'primary' ) ) :
?>
	<div class="page-sidebar">
		<?php get_template_part( 'template-parts/navigation/nav-site' ); ?>
		<?php dynamic_sidebar( 'sidebar-nav' ); ?>
	</div>
<?php
endif;
get_footer();
