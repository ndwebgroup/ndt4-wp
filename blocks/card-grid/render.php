<?php
/**
 * Card Grid Block - Server-side rendering
 *
 * @package NDT4
 * @since 4.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content (rendered inner blocks).
 * @var WP_Block $block      Block instance.
 */

$columns = $attributes['columns'] ?? 2;
$allowed = [ 2, 3 ];

if ( ! in_array( $columns, $allowed, true ) ) {
	$columns = 2;
}
?>
<div class="grid grid-ml-<?php echo esc_attr( $columns ); ?>">
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Inner block content is already escaped. ?>
</div>
