<?php
/**
 * Template part for displaying footer contact information
 *
 * @package NDT4
 * @since 4.0.0
 */

$address = get_theme_mod( 'ndt4_address', '' );
$phone   = get_theme_mod( 'ndt4_phone', '' );
$fax	 = get_theme_mod( 'ndt4_fax', '' );
$email   = get_theme_mod( 'ndt4_email', '' );

if ( ! $address && ! $phone && ! $fax && ! $email ) {
	return;
}
?>

<div class="footer-contact" itemscope itemtype="https://schema.org/Organization">
	<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	<meta itemprop="url" content="<?php echo esc_url( home_url( '/' ) ); ?>">

	<?php if ( $address ) : ?>
		<address class="contact-address" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
			<span itemprop="streetAddress"><?php echo wp_kses_post( nl2br( $address ) ); ?></span>
		</address>
	<?php endif; ?>

	<div class="contact-details">
		<?php if ( $phone ) : ?>
			<p class="contact-phone">
				<span class="contact-label"><?php esc_html_e( 'Phone:', 'ndt4' ); ?></span>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" itemprop="telephone">
					<?php echo esc_html( $phone ); ?>
				</a>
			</p>
		<?php endif; ?>

		<?php if ( $fax ) : ?>
			<p class="contact-fax">
				<span class="contact-label"><?php esc_html_e( 'Fax:', 'ndt4' ); ?></span>
				<span itemprop="faxNumber"><?php echo esc_html( $fax ); ?></span>
			</p>
		<?php endif; ?>

		<?php if ( $email ) : ?>
			<p class="contact-email">
				<span class="contact-label"><?php esc_html_e( 'Email:', 'ndt4' ); ?></span>
				<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" itemprop="email">
					<?php echo esc_html( antispambot( $email ) ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</div>
