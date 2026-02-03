<?php
/**
 * Template part for displaying mobile navigation
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<div id="mobile-navigation" class="mobile-navigation" hidden>
	<div class="mobile-navigation-inner">
		<div class="mobile-nav-header">
			<button class="mobile-nav-close" aria-label="<?php esc_attr_e( 'Close menu', 'ndt4' ); ?>">
				<svg class="icon icon-close" aria-hidden="true" focusable="false">
					<use xlink:href="#icon-close"></use>
				</svg>
			</button>
		</div>

		<div class="mobile-nav-search">
			<?php get_search_form(); ?>
		</div>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav class="mobile-nav-primary" aria-label="<?php esc_attr_e( 'Primary navigation', 'ndt4' ); ?>">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'menu_id'		=> 'mobile-primary-menu',
					'menu_class'	 => 'mobile-menu',
					'container'	  => false,
					'depth'		  => 3,
				] );
				?>
			</nav>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<nav class="mobile-nav-secondary" aria-label="<?php esc_attr_e( 'Secondary navigation', 'ndt4' ); ?>">
				<?php
				wp_nav_menu( [
					'theme_location' => 'secondary',
					'menu_id'		=> 'mobile-secondary-menu',
					'menu_class'	 => 'mobile-menu mobile-menu-secondary',
					'container'	  => false,
					'depth'		  => 1,
				] );
				?>
			</nav>
		<?php endif; ?>

		<div class="mobile-nav-footer">
			<a href="https://www.nd.edu" class="nd-link">
				<img src="https://conductor.nd.edu/images/themes/ndt/4.0/wordmark.svg" alt="<?php esc_attr_e( 'University of Notre Dame', 'ndt4' ); ?>" width="200">
			</a>
		</div>
	</div>
</div>

<div class="mobile-nav-overlay" hidden></div>
