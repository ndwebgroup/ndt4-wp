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

$current_id  = get_the_ID();
$section_id  = ndt4_get_top_parent_id();

if ( ! $section_id ) {
	return;
}

// Only show if there are child pages in this section
if ( ! ndt4_page_has_children( $section_id ) ) {
	return;
}

$section_title = get_the_title( $section_id );
$section_url   = get_permalink( $section_id );
?>

<?php
$root_classes = [ 'li-has-children' ];
if ( $current_id === $section_id ) {
	$root_classes[] = 'active';
} elseif ( in_array( $section_id, get_post_ancestors( $current_id ), true ) ) {
	$root_classes[] = 'active';
}
$root_aria = ( $current_id === $section_id ) ? ' aria-current="page"' : '';
?>
<nav id="nav" class="nav-site nav-section mbe-3" aria-label="<?php echo esc_attr( $section_title ); ?> <?php esc_attr_e( 'section navigation', 'ndt4' ); ?>">
	<ul class="menu">
		<li class="<?php echo esc_attr( implode( ' ', $root_classes ) ); ?>">
			<?php
			wp_list_pages( [
				'child_of'    => $section_id,
				'title_li'    => '',
				'sort_column' => 'menu_order, post_title',
				'depth'       => 3,
				'walker'      => new NDT4_Subnav_Walker(),
			] );
			?>
		</li>
	</ul>
</nav>
