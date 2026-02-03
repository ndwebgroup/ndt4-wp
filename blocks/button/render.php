<?php
/**
 * Button Block - Server-side rendering
 *
 * @package NDT4
 * @since 4.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$text  = $attributes['text'] ?? '';
$link  = $attributes['link'] ?? '#';
$style = $attributes['style'] ?? 'base';
$color = $attributes['color'] ?? 'primary';

if ( ! $text ) {
	return;
}

// Build classes.
$classes = 'btn';

if ( 'cta' === $style ) {
	$classes .= ' btn--cta';
} elseif ( 'more' === $style ) {
	$classes .= ' btn--more';
}

if ( 'secondary' === $color ) {
	$classes .= ' btn--secondary';
} elseif ( 'tertiary' === $color ) {
	$classes .= ' btn--tertiary';
} elseif ( 'neutral' === $color ) {
	$classes .= ' btn--neutral';
}
?>
<a href="<?php echo esc_url( $link ); ?>" class="<?php echo esc_attr( $classes ); ?>"><?php echo esc_html( $text ); ?></a>
