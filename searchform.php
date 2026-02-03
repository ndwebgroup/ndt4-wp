<?php
/**
 * Custom search form template
 *
 * @package NDT4
 * @since 4.0.0
 */

$unique_id = wp_unique_id( 'search-form-' );
?>

<form role="search" method="get" class="search-form" aria-label="Site search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="visually-hidden" for="<?php echo esc_attr( $unique_id ); ?>"><?php esc_html_e( 'Search for:', 'ndt4' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-input" placeholder="<?php esc_attr_e( 'Search&hellip;', 'ndt4' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-button btn--action" aria-label="Search"><svg class="icon" width="16" height="16" data-icon="search"><use xlink:href="#icon-search"></use></svg></button>
</form>
