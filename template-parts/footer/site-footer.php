<?php
/**
 * Template part for displaying the full site footer
 *
 * @package NDT4
 * @since 4.0.0
 */

$parent_name	  = get_theme_mod( 'ndt4_parent_org', '' );
$parent_url	   = get_theme_mod( 'ndt4_parent_url', '' );
$grandparent_name = get_theme_mod( 'ndt4_grandparent_org', '' );
$grandparent_url  = get_theme_mod( 'ndt4_grandparent_url', '' );
$show_back_to_top = get_theme_mod( 'ndt4_back_to_top', true );
?>

<footer id="colophon" class="site-footer">
	<div class="site-footer-inner">
		<?php if ( $parent_name || $grandparent_name ) : ?>
			<nav class="site-breadcrumb" aria-label="<?php esc_attr_e( 'Site hierarchy', 'ndt4' ); ?>">
				<ul>
					<?php if ( $grandparent_name ) : ?>
						<li>
							<?php if ( $grandparent_url ) : ?>
								<a href="<?php echo esc_url( $grandparent_url ); ?>"><?php echo esc_html( $grandparent_name ); ?></a>
							<?php else : ?>
								<?php echo esc_html( $grandparent_name ); ?>
							<?php endif; ?>
						</li>
					<?php endif; ?>
					<?php if ( $parent_name ) : ?>
						<li>
							<?php if ( $parent_url ) : ?>
								<a href="<?php echo esc_url( $parent_url ); ?>"><?php echo esc_html( $parent_name ); ?></a>
							<?php else : ?>
								<?php echo esc_html( $parent_name ); ?>
							<?php endif; ?>
						</li>
					<?php endif; ?>
					<li class="current">
						<span><?php bloginfo( 'name' ); ?></span>
					</li>
				</ul>
			</nav>
		<?php endif; ?>

		<div class="footer-content">
			<?php get_template_part( 'template-parts/footer/footer-contact' ); ?>
			<?php get_template_part( 'template-parts/footer/footer-social' ); ?>
		</div>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer navigation', 'ndt4' ); ?>">
				<?php
				wp_nav_menu( [
					'theme_location' => 'footer',
					'menu_class'	 => 'footer-menu',
					'depth'		  => 1,
				] );
				?>
			</nav>
		<?php endif; ?>
	</div>

	<div class="university-footer">
		<div class="university-footer-inner">
			<a href="https://www.nd.edu" class="nd-monogram">
				<img src="https://conductor.nd.edu/images/themes/ndt/4.0/monogram.svg" alt="<?php esc_attr_e( 'University of Notre Dame', 'ndt4' ); ?>" width="100" height="100">
			</a>
			<div class="university-links">
				<ul class="utility-links">
					<li><a href="https://www.nd.edu/about/"><?php esc_html_e( 'About Notre Dame', 'ndt4' ); ?></a></li>
					<li><a href="https://www.nd.edu/academics/"><?php esc_html_e( 'Academics', 'ndt4' ); ?></a></li>
					<li><a href="https://www.nd.edu/research/"><?php esc_html_e( 'Research', 'ndt4' ); ?></a></li>
					<li><a href="https://www.nd.edu/community/"><?php esc_html_e( 'Community', 'ndt4' ); ?></a></li>
				</ul>
				<p class="copyright">
					<?php
					printf(
						/* translators: %s: current year */
						esc_html__( 'Copyright %s University of Notre Dame', 'ndt4' ),
						esc_html( gmdate( 'Y' ) )
					);
					?>
				</p>
			</div>
		</div>
	</div>

	<?php if ( $show_back_to_top ) : ?>
		<a href="#page" class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'ndt4' ); ?>">
			<span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'ndt4' ); ?></span>
			<svg class="icon icon-arrow-up" aria-hidden="true" focusable="false" width="24" height="24" viewBox="0 0 24 24">
				<path fill="currentColor" d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
			</svg>
		</a>
	<?php endif; ?>
</footer>
