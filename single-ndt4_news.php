<?php
/**
 * The template for displaying single News articles
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style       = ndt4_get_navigation_style();
$topnav          = ( 'top' === $nav_style );
$has_nav_sidebar = ! $topnav && has_nav_menu( 'primary' );

ndt4_register_layout( [
	'page_sidebar' => $has_nav_sidebar ? 'ndt4_render_nav_sidebar' : null,
] );

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/news/news-single' );
endwhile;

get_footer();
