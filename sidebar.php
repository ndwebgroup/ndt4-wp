<?php
/**
 * The sidebar template
 *
 * @package NDT4
 * @since 4.0.0
 */

if ( ! is_active_sidebar( 'sidebar-content' ) ) {
	return;
}
?>

<aside id="sidebar" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-content' ); ?>
</aside>
