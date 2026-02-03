<?php
/**
 * The template for displaying 404 pages
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
		<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'ndt4' ); ?></h1>
	</div>
</div>

<div class="<?php echo esc_attr( $alpha_classes ); ?>">
	<div class="error-404-content">
	<p>The page you are looking for may have been removed, had its name changed, or is temporarily unavailable.</p>

	<h2>Try the following</h2>
	<ul>
		<li>If you typed the page address in the Address bar, make sure that it is spelled correctly.</li>
		<li>Go to the <a href="/">homepage</a>, and then look for links to the information you want.</li>
		<li>Click the Back button on your browser to try another link.</li>
		<li>If you reached this page using a bookmark, the page you're looking for may have moved.</li>
	</ul>

		<?#php get_search_form(); ?>

		<?php if ( ndt4_get_latest_news( 5 )->have_posts() ) : ?>
			<div class="widget widget-recent-news">
				<h2 class="widget-title"><?php esc_html_e( 'Recent News', 'ndt4' ); ?></h2>
				<ul>
					<?php
					$recent_news = ndt4_get_latest_news( 5 );
					while ( $recent_news->have_posts() ) :
						$recent_news->the_post();
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php if ( $has_sidebar ) : ?>
	<div class="<?php echo esc_attr( $beta_classes ); ?>">
		<?php get_template_part( 'template-parts/navigation/nav-site' ); ?>
	</div>
<?php endif; ?>

<?php
get_footer();
