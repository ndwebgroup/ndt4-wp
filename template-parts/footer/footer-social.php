<?php
/**
 * Template part for displaying footer social links
 *
 * @package NDT4
 * @since 4.0.0
 */

$social_networks = [
	'facebook'  => [
		'label' => __( 'Facebook', 'ndt4' ),
		'icon'  => 'facebook',
	],
	'twitter'   => [
		'label' => __( 'X (Twitter)', 'ndt4' ),
		'icon'  => 'twitter',
	],
	'instagram' => [
		'label' => __( 'Instagram', 'ndt4' ),
		'icon'  => 'instagram',
	],
	'youtube'   => [
		'label' => __( 'YouTube', 'ndt4' ),
		'icon'  => 'youtube',
	],
	'linkedin'  => [
		'label' => __( 'LinkedIn', 'ndt4' ),
		'icon'  => 'linkedin',
	],
];

$has_social = false;
foreach ( $social_networks as $network => $data ) {
	if ( get_theme_mod( 'ndt4_social_' . $network, '' ) ) {
		$has_social = true;
		break;
	}
}

if ( ! $has_social ) {
	return;
}
?>

<div class="footer-social">
	<h2 class="social-title screen-reader-text"><?php esc_html_e( 'Follow Us', 'ndt4' ); ?></h2>
	<ul class="social-links">
		<?php foreach ( $social_networks as $network => $data ) : ?>
			<?php $url = get_theme_mod( 'ndt4_social_' . $network, '' ); ?>
			<?php if ( $url ) : ?>
				<li>
					<a href="<?php echo esc_url( $url ); ?>" class="social-link social-<?php echo esc_attr( $network ); ?>" target="_blank" rel="noopener noreferrer">
						<span class="screen-reader-text"><?php echo esc_html( $data['label'] ); ?></span>
						<svg class="icon icon-<?php echo esc_attr( $data['icon'] ); ?>" aria-hidden="true" focusable="false">
							<use xlink:href="#icon-<?php echo esc_attr( $data['icon'] ); ?>"></use>
						</svg>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</div>
