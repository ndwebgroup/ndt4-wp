<?php
/**
 * Template part for displaying the full site header
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style	   = ndt4_get_navigation_style();
$show_global_nav = get_theme_mod( 'ndt4_global_nav', true );
$animate_header  = get_theme_mod( 'ndt4_animate', false );
?>

<?php if ( $show_global_nav ) : ?>
	<?php get_template_part( 'template-parts/navigation/nav-global-menu' ); ?>
<?php endif; ?>

<header id="masthead" class="site-header <?php echo $animate_header ? ' has-animation' : ''; ?>">
	<div class="site-header-inner">
		<?php get_template_part( 'template-parts/header/site-branding' ); ?>

		<?php if ( 'top' === $nav_style ) : ?>
			<?php get_template_part( 'template-parts/header/navigation-top' ); ?>
		<?php endif; ?>

		<div class="header-actions">
			<button class="search-toggle" aria-expanded="false" aria-controls="site-search">
				<span class="screen-reader-text"><?php esc_html_e( 'Search', 'ndt4' ); ?></span>
				<svg class="icon icon-search" aria-hidden="true" focusable="false" width="24" height="24" viewBox="0 0 24 24">
					<path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
				</svg>
			</button>

			<button class="nav-toggle" aria-expanded="false" aria-controls="mobile-navigation">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'ndt4' ); ?></span>
				<span class="nav-toggle-bars">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</span>
			</button>
		</div>
	</div>

	<div id="site-search" class="site-search" hidden>
		<?php get_search_form(); ?>
	</div>
</header>
