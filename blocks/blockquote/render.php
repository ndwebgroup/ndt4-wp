<?php
/**
 * Blockquote Block - Server-side rendering
 *
 * @package NDT4
 * @since 4.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$quote        = $attributes['quote'] ?? '';
$author_name  = $attributes['authorName'] ?? '';
$author_title = $attributes['authorTitle'] ?? '';
$image_id     = $attributes['imageId'] ?? 0;
$image_url    = $attributes['imageUrl'] ?? '';
$variant      = $attributes['variant'] ?? 'inline';
$reversed     = $attributes['reversed'] ?? false;

if ( ! $quote ) {
	return;
}

// Build blockquote classes.
$classes = 'blockquote blockquote--left';
if ( 'stacked' === $variant ) {
	$classes .= ' blockquote--stacked';
}
if ( $reversed ) {
	$classes .= ' blockquote--reversed';
}

// Get image HTML if we have an image.
$image_html = '';
if ( $image_id ) {
	$image_html = wp_get_attachment_image( $image_id, array( 600, 600 ), false, array( 'alt' => esc_attr( $author_name ) ) );
} elseif ( $image_url ) {
	$image_html = sprintf(
		'<img src="%s" alt="%s">',
		esc_url( $image_url ),
		esc_attr( $author_name )
	);
}

// Avatar classes depend on variant.
$avatar_class = 'stacked' === $variant ? 'avatar avatar--sm avatar--quote' : 'avatar avatar--md avatar--quote mi-auto';
?>

<?php if ( 'stacked' === $variant ) : ?>
	<blockquote class="<?php echo esc_attr( $classes ); ?>">
		<p><?php echo wp_kses_post( $quote ); ?></p>
		<?php if ( $author_name || $author_title || $image_html ) : ?>
			<div class="byline">
				<?php if ( $image_html ) : ?>
					<figure class="<?php echo esc_attr( $avatar_class ); ?>">
						<?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</figure>
				<?php endif; ?>
				<div class="byline-body">
					<?php if ( $author_name ) : ?>
						<p class="byline-title person-name"><?php echo esc_html( $author_name ); ?></p>
					<?php endif; ?>
					<?php if ( $author_title ) : ?>
						<p class="person-title"><?php echo esc_html( $author_title ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</blockquote>
<?php else : ?>
	<blockquote class="<?php echo esc_attr( $classes ); ?>">
		<div class="flex-md align-start">
			<?php if ( $image_html ) : ?>
				<figure class="<?php echo esc_attr( $avatar_class ); ?>">
					<?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</figure>
			<?php endif; ?>
			<p><?php echo wp_kses_post( $quote ); ?></p>
		</div>
		<?php if ( $author_name || $author_title ) : ?>
			<div class="byline">
				<div class="byline-body">
					<?php if ( $author_name ) : ?>
						<p class="byline-title person-name"><?php echo esc_html( $author_name ); ?></p>
					<?php endif; ?>
					<?php if ( $author_title ) : ?>
						<p class="person-title"><?php echo esc_html( $author_title ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</blockquote>
<?php endif; ?>
