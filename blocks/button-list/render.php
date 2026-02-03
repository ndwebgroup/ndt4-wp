<?php
/**
 * Button List Block - Server-side rendering
 *
 * @package NDT4
 * @since 4.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

if ( empty( $block->inner_blocks ) ) {
	return;
}
?>
<ul class="no-bullets btn-list">
	<?php foreach ( $block->inner_blocks as $inner_block ) : ?>
		<li><?php echo $inner_block->render(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
	<?php endforeach; ?>
</ul>
