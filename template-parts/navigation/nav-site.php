<?php
/**
 * Template part for displaying site navigation
 *
 * Accepts args:
 *   'nav_class' - CSS classes for the <nav> element (default: 'nav-site nav-full')
 *   'nav_id'    - ID for the <nav> element (default: 'nav')
 *
 * @package NDT4
 * @since 4.0.0
 */

if ( ! has_nav_menu( 'primary' ) ) {
	return;
}

$nav_class  = $args['nav_class'] ?? 'nav-site nav-full';
$nav_id     = $args['nav_id'] ?? 'nav';
$mark_right = ( 'right' === get_theme_mod( 'ndt4_mark_position', 'left' ) );
$topnav     = ( 'top' === ndt4_get_navigation_style() );
?>

<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>" aria-label="<?php esc_attr_e( 'Primary', 'ndt4' ); ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => 'primary',
		'menu_id'		=> 'nav-site-menu',
		'container'	  => false,
		'depth'		  => 3,
		'walker'		 => new NDT4_Side_Nav_Walker(),
	] );
	?>
</nav>

<?php if ( $mark_right && ! $topnav ) : ?>
	<form method="get" action="<?php echo esc_url( home_url( '/search/' ) ); ?>" class="search-form" role="search" aria-label="<?php esc_attr_e( 'Site search', 'ndt4' ); ?>">
		<input type="search" name="s" class="search-input" placeholder="<?php esc_attr_e( 'Search this site', 'ndt4' ); ?>" title="<?php esc_attr_e( 'type your search term', 'ndt4' ); ?>" aria-label="<?php esc_attr_e( 'Site Search input', 'ndt4' ); ?>">
		<button type="submit" class="btn search-button btn--action" aria-label="<?php esc_attr_e( 'Search', 'ndt4' ); ?>">
			<svg class="icon" width="16" height="16" data-icon="search"><use xlink:href="#icon-search"></use></svg>
		</button>
	</form>
<?php endif; ?>
