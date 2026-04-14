<?php
/**
 * The template for displaying 404 pages
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
				<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'ndt4' ); ?></h1>
			</div>
		</div>
		<?php
	},
	'page_sidebar' => $has_nav_sidebar ? 'ndt4_render_nav_sidebar' : null,
] );

get_header();
?>

<div class="error-404-content">
	<p><?php esc_html_e( 'The page you are looking for may have been removed, had its name changed, or is temporarily unavailable.', 'ndt4' ); ?></p>

	<h2><?php esc_html_e( 'Try the following', 'ndt4' ); ?></h2>
	<ul>
		<li><?php esc_html_e( 'If you typed the page address in the Address bar, make sure that it is spelled correctly.', 'ndt4' ); ?></li>
		<li>
			<?php
			printf(
				/* translators: %s: link to the homepage. */
				esc_html__( 'Go to the %s, and then look for links to the information you want.', 'ndt4' ),
				'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'homepage', 'ndt4' ) . '</a>'
			);
			?>
		</li>
		<li><?php esc_html_e( 'Click the Back button on your browser to try another link.', 'ndt4' ); ?></li>
		<li><?php esc_html_e( 'If you reached this page using a bookmark, the page you\'re looking for may have moved.', 'ndt4' ); ?></li>
	</ul>

	<?php
	$recent_posts = new WP_Query( [
		'post_type'      => 'post',
		'posts_per_page' => 5,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	] );
	if ( $recent_posts->have_posts() ) :
		?>
		<div class="widget widget-recent-posts">
			<h2 class="widget-title"><?php esc_html_e( 'Recent Posts', 'ndt4' ); ?></h2>
			<ul>
				<?php
				while ( $recent_posts->have_posts() ) :
					$recent_posts->the_post();
					?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer();
