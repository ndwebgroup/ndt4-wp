<?php
/**
 * Template part for displaying site navigation
 *
 * Accepts args:
 *   'nav_class' - CSS classes for the <nav> element (default: 'nav-site nav-full')
 *   'nav_id'    - ID for the <nav> element (default: 'nav')
 *   'menu_id'   - ID for the menu <ul> (default: 'nav-site-menu')
 *   'item_ids'  - Whether menu items get id="menu-item-N" (default: true);
 *                 disable on a second copy of the menu to avoid duplicate IDs
 *
 * @package NDT4
 * @since 4.0.0
 */

if ( ! has_nav_menu( 'primary' ) ) {
	return;
}

$nav_class  = $args['nav_class'] ?? 'nav-site nav-full';
$nav_id     = $args['nav_id'] ?? 'nav';
$menu_id    = $args['menu_id'] ?? 'nav-site-menu';
$item_ids   = $args['item_ids'] ?? true;
?>

<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>" aria-label="<?php esc_attr_e( 'Primary', 'ndt4' ); ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => 'primary',
		'menu_id'		=> $menu_id,
		'item_ids'	   => $item_ids,
		'container'	  => false,
		'depth'		  => 3,
		'walker'		 => new NDT4_Side_Nav_Walker(),
	] );
	?>
</nav>
