<?php
/**
 * Card Block - Server-side rendering
 *
 * @package NDT4
 * @since 4.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$variant    = $attributes['variant'] ?? 'default';
$show_image = $attributes['showImage'] ?? true;
$image_id   = $attributes['imageId'] ?? 0;
$label      = $attributes['label'] ?? '';
$heading_tag = $attributes['headingTag'] ?? 'h2';
$title      = $attributes['title'] ?? '';
$summary    = $attributes['summary'] ?? '';
$link       = $attributes['link'] ?? '';
$bg_color   = $attributes['backgroundColor'] ?? 'none';
$is_featured = ( 'featured' === $variant );

// Build card classes.
$card_classes = 'card';

switch ( $variant ) {
	case 'horizontal':
		$card_classes .= ' card--horizontal';
		break;
	case 'stacked':
		$card_classes .= ' card--stacked';
		break;
	case 'featured':
		$card_classes .= ' card--featured';
		break;
}

if ( 'none' !== $bg_color && $bg_color ) {
	$card_classes .= ' bg--' . $bg_color;
}

// Validate heading tag.
$allowed_tags = [ 'h2', 'h3', 'h4', 'h5', 'h6' ];
if ( ! in_array( $heading_tag, $allowed_tags, true ) ) {
	$heading_tag = 'h2';
}
?>
<div class="card-container">
	<div class="<?php echo esc_attr( $card_classes ); ?>">
		<?php if ( $show_image && $image_id ) : ?>
			<figure class="card-image">
				<?php echo wp_get_attachment_image( $image_id, 'large', false, [ 'loading' => 'lazy' ] ); ?>
			</figure>
		<?php endif; ?>
		<div class="card-body">
			<?php if ( $label ) : ?>
				<p class="card-label"><?php if ( $is_featured ) : ?><span><?php echo esc_html( $label ); ?></span><?php else : ?><?php echo esc_html( $label ); ?><?php endif; ?></p>
			<?php endif; ?>
			<<?php echo esc_attr( $heading_tag ); ?> class="card-title">
				<?php if ( $link ) : ?>
					<a class="card-link" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php else : ?>
					<?php echo esc_html( $title ); ?>
				<?php endif; ?>
			</<?php echo esc_attr( $heading_tag ); ?>>
			<?php if ( ! $is_featured && $summary ) : ?>
				<p class="card-summary"><?php echo esc_html( $summary ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
