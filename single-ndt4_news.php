<?php
/**
 * The template for displaying single News articles
 *
 * @package NDT4
 * @since 4.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/news/news-single' );
	endwhile;
	?>
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
