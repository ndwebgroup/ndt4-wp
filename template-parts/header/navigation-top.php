<?php
/**
 * Template part for displaying top navigation
 *
 * @package NDT4
 * @since 4.0.0
 */

if ( ! has_nav_menu( 'primary' ) ) {
	return;
}

$use_home_icon = get_theme_mod( 'ndt4_use_home_icon', false );
?>

<nav id="site-navigation" class="main-navigation top-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'ndt4' ); ?>">
	<?php
	wp_nav_menu( [
		'theme_location'  => 'primary',
		'menu_id'		 => 'primary-menu',
		'menu_class'	  => 'top-menu',
		'container'	   => false,
		'depth'		   => 2,
		'items_wrap'	  => '<ul id="%1$s" class="%2$s">' . ( $use_home_icon ? '<li class="menu-item menu-item-home"><a href="' . esc_url( home_url( '/' ) ) . '" aria-label="' . esc_attr__( 'Home', 'ndt4' ) . '"><svg class="icon icon-home" aria-hidden="true" focusable="false"><use xlink:href="#icon-home"></use></svg></a></li>' : '' ) . '%3$s</ul>',
	] );
	?>
</nav>
