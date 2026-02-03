<?php
/**
 * Template part for displaying site branding
 *
 * @package NDT4
 * @since 4.0.0
 */

$mark_position	 = get_theme_mod( 'ndt4_mark_position', 'left' );
$show_tagline	  = get_theme_mod( 'ndt4_show_tagline', true );
$tagline_position  = get_theme_mod( 'ndt4_tagline_position', 'below' );
?>

<div class="site-branding mark-<?php echo esc_attr( $mark_position ); ?>">
	<?php if ( 'left' === $mark_position ) : ?>
		<a href="https://www.nd.edu" class="nd-mark" aria-label="<?php esc_attr_e( 'University of Notre Dame', 'ndt4' ); ?>">
			<img src="https://conductor.nd.edu/images/themes/ndt/4.0/mark.svg" alt="" width="60" height="60">
		</a>
	<?php endif; ?>

	<div class="site-identity">
		<?php if ( $show_tagline && 'above' === $tagline_position && get_bloginfo( 'description' ) ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>

		<?php if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
		<?php else : ?>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</p>
		<?php endif; ?>

		<?php if ( $show_tagline && 'below' === $tagline_position && get_bloginfo( 'description' ) ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( 'right' === $mark_position ) : ?>
		<a href="https://www.nd.edu" class="nd-mark" aria-label="<?php esc_attr_e( 'University of Notre Dame', 'ndt4' ); ?>">
			<img src="https://conductor.nd.edu/images/themes/ndt/4.0/mark.svg" alt="" width="60" height="60">
		</a>
	<?php endif; ?>
</div>
