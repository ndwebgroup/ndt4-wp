<?php
/**
 * Template part for displaying page sub-navigation
 *
 * Shows the current section's page hierarchy when top navigation is active.
 *
 * @package NDT4
 * @since 4.0.0
 */

if ( ! is_page() ) {
	return;
}

$section_id = ndt4_get_top_parent_id();

if ( ! $section_id ) {
	return;
}

// Only show if there are child pages in this section
if ( ! ndt4_page_has_children( $section_id ) ) {
	return;
}

$section_title = get_the_title( $section_id );
?>

<nav id="nav" class="nav-site nav-section mbe-3" aria-label="<?php echo esc_attr( $section_title ); ?> <?php esc_attr_e( 'section navigation', 'ndt4' ); ?>">
	<ul class="menu">
		<?php
		wp_list_pages( [
			'child_of'    => $section_id,
			'title_li'    => '',
			'sort_column' => 'menu_order, post_title',
			'depth'       => 3,
			'walker'      => new NDT4_Subnav_Walker(),
		] );
		?>
	</ul>
</nav>
