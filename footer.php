<?php
/**
 * The footer template
 *
 * @package NDT4
 * @since 4.0.0
 */

$parent_name		= get_theme_mod( 'ndt4_parent_org', '' );
$parent_url		 = get_theme_mod( 'ndt4_parent_url', '' );
$grandparent_name   = get_theme_mod( 'ndt4_grandparent_org', '' );
$grandparent_url	= get_theme_mod( 'ndt4_grandparent_url', '' );
$address			= get_theme_mod( 'ndt4_address', '' );
$phone			  = get_theme_mod( 'ndt4_phone', '' );
$fax				= get_theme_mod( 'ndt4_fax', '' );
$email			  = get_theme_mod( 'ndt4_email', '' );

// Social media
$facebook  = get_theme_mod( 'ndt4_social_facebook', '' );
$twitter   = get_theme_mod( 'ndt4_social_twitter', '' );
$instagram = get_theme_mod( 'ndt4_social_instagram', '' );
$youtube   = get_theme_mod( 'ndt4_social_youtube', '' );
$linkedin  = get_theme_mod( 'ndt4_social_linkedin', '' );
?>
	</main><!-- .site-content -->

	<!-- Site Footer -->
	<footer id="footer" class="site-footer">
		<div class="footer-org" typeof="Organization" resource="#siteorg">
			<meta property="parentOrganization" resource="#parentorg" content="University of Notre Dame">

			<?php if ( $parent_name && $parent_url ) : ?>
				<ul class="footer-breadcrumbs list-unstyled">
					<?php if ( $grandparent_name && $grandparent_url ) : ?>
						<li><a href="<?php echo esc_url( $grandparent_url ); ?>"><?php echo esc_html( $grandparent_name ); ?></a></li>
					<?php endif; ?>
					<li><a href="<?php echo esc_url( $parent_url ); ?>"><?php echo esc_html( $parent_name ); ?></a></li>
				</ul>
			<?php endif; ?>

			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-link" property="url"><span property="name"><?php bloginfo( 'name' ); ?></span></a></p>

			<div class="footer-contacts">
				<p class="contact-info">
					<span class="address" property="address" typeof="PostalAddress">
						<?php if ( $address ) : ?>
							<span property="streetAddress"><?php echo esc_html( $address ); ?></span><br>
						<?php endif; ?>
						<span property="addressLocality">Notre Dame</span>, <span property="addressRegion">IN</span> <span property="postalCode">46556</span> <span property="addressCountry">USA</span>
					</span>
					<?php if ( $phone ) : ?>
						<span class="footer-phone" property="telephone" content="+1 <?php echo esc_attr( $phone ); ?>">Phone <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></span>
					<?php endif; ?>
					<?php if ( $fax ) : ?>
						<span class="footer-fax" property="faxNumber" content="+1 <?php echo esc_attr( $fax ); ?>">Fax <?php echo esc_html( $fax ); ?></span>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<span class="footer-email" property="email"><a rel="noopener" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></span>
					<?php endif; ?>
				</p>

				<?php if ( $facebook || $twitter || $instagram || $youtube || $linkedin ) : ?>
					<nav class="social" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> <?php esc_attr_e( 'social media navigation', 'ndt4' ); ?>" vocab="">
						<ul>
							<?php if ( $facebook ) : ?>
								<li><a class="soc-facebook" href="<?php echo esc_url( $facebook ); ?>" rel="noopener" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> on Facebook"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-facebook"></use></svg> Facebook</a></li>
							<?php endif; ?>
							<?php if ( $twitter ) : ?>
								<li><a class="soc-twitter" href="<?php echo esc_url( $twitter ); ?>" rel="noopener" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> on X/Twitter"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-twitter-x"></use></svg> X/Twitter</a></li>
							<?php endif; ?>
							<?php if ( $instagram ) : ?>
								<li><a class="soc-instagram" href="<?php echo esc_url( $instagram ); ?>" rel="noopener" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> on Instagram"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-instagram"></use></svg> Instagram</a></li>
							<?php endif; ?>
							<?php if ( $youtube ) : ?>
								<li><a class="soc-youtube" href="<?php echo esc_url( $youtube ); ?>" rel="noopener" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> on YouTube"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-youtube"></use></svg> YouTube</a></li>
							<?php endif; ?>
							<?php if ( $linkedin ) : ?>
								<li><a class="soc-linkedin" href="<?php echo esc_url( $linkedin ); ?>" rel="noopener" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> on LinkedIn"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-linkedin"></use></svg> LinkedIn</a></li>
							<?php endif; ?>
						</ul>
					</nav>
				<?php endif; ?>
			</div>
			<div property="logo" typeof="ImageObject"><meta property="url" content="https://static.nd.edu/images/webclips/default/webclip-60.png"></div>
		</div><!-- .footer-org -->

		<div class="footer-nd" property="parentOrganization" typeof="CollegeOrUniversity" resource="#parentorg">
			<meta property="name" content="University of Notre Dame">
			<a href="https://www.nd.edu/" class="mark-footer" property="url logo" typeof="ImageObject" aria-label="<?php esc_attr_e( 'University of Notre Dame', 'ndt4' ); ?>">
				<svg width="200" height="48" aria-hidden="true"><use xlink:href="#academic-mark"></use></svg>
			</a>

			<div class="footer-parent-links">
				<nav class="footer--links" aria-label="<?php esc_attr_e( 'Notre Dame network navigation', 'ndt4' ); ?>">
					<ul>
						<li><a href="https://search.nd.edu/" aria-label="<?php esc_attr_e( 'Search Notre Dame', 'ndt4' ); ?>"><?php esc_html_e( 'Search', 'ndt4' ); ?></a></li>
						<li><a href="https://news.nd.edu/" aria-label="<?php esc_attr_e( 'Notre Dame News', 'ndt4' ); ?>"><?php esc_html_e( 'News', 'ndt4' ); ?></a></li>
						<li><a href="https://events.nd.edu/" aria-label="<?php esc_attr_e( 'Notre Dame Events', 'ndt4' ); ?>"><?php esc_html_e( 'Events', 'ndt4' ); ?></a></li>
						<li><a href="https://www.nd.edu/visit/" aria-label="<?php esc_attr_e( 'Visit Notre Dame', 'ndt4' ); ?>"><?php esc_html_e( 'Visit', 'ndt4' ); ?></a></li>
						<li><a href="https://mobile.nd.edu/" aria-label="<?php esc_attr_e( 'Notre Dame Mobile App', 'ndt4' ); ?>"><?php esc_html_e( 'Mobile App', 'ndt4' ); ?></a></li>
						<li><a href="https://www.nd.edu/about/accessibility/" aria-label="<?php esc_attr_e( 'Notre Dame Accessibility Information', 'ndt4' ); ?>"><?php esc_html_e( 'Accessibility', 'ndt4' ); ?></a></li>
					</ul>
				</nav>
				<nav class="footer-social" aria-label="<?php esc_attr_e( 'Notre Dame social media navigation', 'ndt4' ); ?>" vocab="">
					<ul>
						<li><a class="soc-facebook" href="https://www.facebook.com/notredame/" rel="noopener" aria-label="<?php esc_attr_e( 'Notre Dame on Facebook', 'ndt4' ); ?>"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-facebook"></use></svg> Facebook</a></li>
						<li><a class="soc-twitter" href="https://twitter.com/NotreDame/" rel="noopener" aria-label="<?php esc_attr_e( 'Notre Dame on X/Twitter', 'ndt4' ); ?>"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-twitter-x"></use></svg> X/Twitter</a></li>
						<li><a class="soc-instagram" href="https://www.instagram.com/notredame/" rel="noopener" aria-label="<?php esc_attr_e( 'Notre Dame on Instagram', 'ndt4' ); ?>"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-instagram"></use></svg> Instagram</a></li>
						<li><a class="soc-youtube" href="https://www.youtube.com/user/NDdotEDU" rel="noopener" aria-label="<?php esc_attr_e( 'Notre Dame on YouTube', 'ndt4' ); ?>"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-youtube"></use></svg> YouTube</a></li>
						<li><a class="soc-linkedin" href="https://www.linkedin.com/school/university-of-notre-dame/" rel="noopener" aria-label="<?php esc_attr_e( 'Notre Dame on LinkedIn', 'ndt4' ); ?>"><svg class="icon" width="16" height="16" aria-hidden="true"><use xlink:href="#icon-linkedin"></use></svg> LinkedIn</a></li>
					</ul>
				</nav>
			</div>
		</div><!-- .footer-nd -->

		<div class="footer-global">
			<div class="footer-global--utils">
				<ul class="list--inline justify-center m-0">
					<li class="light-dark footer--utils-lightdark">
						<label>
							<span class="switch">
								<input type="checkbox" name="light-dark" class="light-dark-toggle">
								<span class="slider"><svg class="icon" data-icon="mode" aria-hidden="true" focusable="false"><use xlink:href="#icon-mode"></use></svg></span>
							</span>
							<span><?php esc_html_e( 'Light/Dark', 'ndt4' ); ?></span>
						</label>
					</li>
				</ul>
			</div>
			<p id="copyright" class="footer-global--copyright copyright url fn org">
				<a href="https://www.nd.edu/copyright/">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?></a>
				<a href="https://www.nd.edu/" class="url fn org"><?php esc_html_e( 'University of Notre Dame', 'ndt4' ); ?></a>
			</p>
		</div>
	</footer>
</div><!-- .wrapper -->

<?php get_template_part( 'template-parts/navigation/global-menu' ); ?>

<?php wp_footer(); ?>
</body>
</html>
