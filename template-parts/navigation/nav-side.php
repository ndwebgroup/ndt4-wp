<?php
/**
 * Template part for displaying side navigation
 *
 * @package NDT4
 * @since 4.0.0
 */

if ( ! has_nav_menu( 'primary' ) ) {
	return;
}

$use_home_icon = get_theme_mod( 'ndt4_use_home_icon', false );
?>

<nav id="side-navigation" class="side-navigation" aria-label="<?php esc_attr_e( 'Section navigation', 'ndt4' ); ?>">
	<?php if ( $use_home_icon ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-home-link" aria-label="<?php esc_attr_e( 'Home', 'ndt4' ); ?>">
			<svg class="icon icon-home" aria-hidden="true" focusable="false">
				<use xlink:href="#icon-home"></use>
			</svg>
			<span class="screen-reader-text"><?php esc_html_e( 'Home', 'ndt4' ); ?></span>
		</a>
	<?php endif; ?>

	<?php
	wp_nav_menu( [
		'theme_location' => 'primary',
		'menu_id'		=> 'side-menu',
		'menu_class'	 => 'side-menu',
		'container'	  => false,
		'depth'		  => 3,
		'walker'		 => new NDT4_Side_Nav_Walker(),
	] );
	?>
</nav>

<?php
/**
 * Custom walker for side navigation
 */
class NDT4_Side_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Start level output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int	  $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n{$indent}<ul class=\"sub-menu level-{$depth}\">\n";
	}

	/**
	 * Start element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int	  $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int	  $id	 Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Add current class for current page ancestors.
		if ( in_array( 'current-menu-ancestor', $classes, true ) || in_array( 'current-menu-item', $classes, true ) ) {
			$classes[] = 'is-active';
		}

		// Check if item has children.
		$has_children = in_array( 'menu-item-has-children', $classes, true );

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts		   = [];
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']	= ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		// Add aria-current for current page.
		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$atts['aria-current'] = 'page';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value	   = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
		$item_output .= '</a>';

		// Add toggle button for items with children.
		if ( $has_children ) {
			$item_output .= '<button class="submenu-toggle" aria-expanded="false" aria-controls="submenu-' . $item->ID . '">';
			$item_output .= '<span class="screen-reader-text">' . esc_html__( 'Toggle submenu', 'ndt4' ) . '</span>';
			$item_output .= '<svg class="icon icon-chevron" aria-hidden="true" focusable="false"><use xlink:href="#icon-chevron-down"></use></svg>';
			$item_output .= '</button>';
		}

		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
