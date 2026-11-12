<?php
/**
 * Deprecated functions
 *
 * The theme no longer calls these. They are kept for one release so child
 * themes that still call them get a deprecation notice instead of a fatal
 * error. Delete this file, and its require in functions.php, in the first
 * release after 1.0.6.
 *
 * @package NDT4
 */

declare(strict_types=1);

if ( ! function_exists( 'ndt4_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 *
	 * @deprecated 1.0.6
	 */
	function ndt4_posted_by(): void {
		_deprecated_function( __FUNCTION__, '1.0.6' );

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'ndt4' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="article--byline meta-item author"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'ndt4_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * @deprecated 1.0.6 Use the_post_thumbnail().
	 *
	 * @param string $size Image size to use.
	 */
	function ndt4_post_thumbnail( string $size = 'post-thumbnail' ): void {
		_deprecated_function( __FUNCTION__, '1.0.6', 'the_post_thumbnail()' );

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( $size ); ?>
			</div>
			<?php
		else :
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					$size,
					[
						'alt' => the_title_attribute( [ 'echo' => false ] ),
					]
				);
				?>
			</a>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'ndt4_has_parent' ) ) :
	/**
	 * Check if the page has a parent.
	 *
	 * @deprecated 1.0.6
	 *
	 * @return bool
	 */
	function ndt4_has_parent(): bool {
		_deprecated_function( __FUNCTION__, '1.0.6' );

		global $post;
		return $post && $post->post_parent > 0;
	}
endif;

if ( ! function_exists( 'ndt4_get_child_pages' ) ) :
	/**
	 * Get child pages of current page or parent.
	 *
	 * @deprecated 1.0.6 Use get_pages().
	 *
	 * @return array Array of page objects.
	 */
	function ndt4_get_child_pages(): array {
		_deprecated_function( __FUNCTION__, '1.0.6', 'get_pages()' );

		global $post;

		if ( ! $post ) {
			return [];
		}

		$parent_id = $post->post_parent > 0 ? $post->post_parent : $post->ID;

		$children = get_pages( [
			'parent'	  => $parent_id,
			'sort_column' => 'menu_order, post_title',
		] );

		return $children ?: [];
	}
endif;

if ( ! function_exists( 'ndt4_sanitize_header_bg' ) ) :
	/**
	 * Sanitize header background
	 *
	 * @deprecated 1.0.6
	 *
	 * @param mixed $input Header background input.
	 * @return string
	 */
	function ndt4_sanitize_header_bg( $input ): string {
		_deprecated_function( __FUNCTION__, '1.0.6' );

		$valid = [ 'campus', 'clover', 'dome', 'vine-wall', 'custom' ];
		return in_array( $input, $valid, true ) ? $input : 'dome';
	}
endif;

if ( ! function_exists( 'ndt4_sanitize_mark_position' ) ) :
	/**
	 * Sanitize mark position
	 *
	 * @deprecated 1.0.6
	 *
	 * @param mixed $input Mark position input.
	 * @return string
	 */
	function ndt4_sanitize_mark_position( $input ): string {
		_deprecated_function( __FUNCTION__, '1.0.6' );

		$valid = [ 'left', 'right' ];
		return in_array( $input, $valid, true ) ? $input : 'left';
	}
endif;
