<?php
/**
 * Custom template tags for the theme
 *
 * @package NDT4
 * @since 4.0.0
 */

declare(strict_types=1);

if ( ! function_exists( 'ndt4_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function ndt4_posted_on(): void {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><span class="visually-hidden"> | Updated:<time class="updated" datetime="%3$s">%4$s</time></span>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'ndt4' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on meta-item publish-info">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'ndt4_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ndt4_posted_by(): void {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'ndt4' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="article--byline meta-item author"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'ndt4_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ndt4_entry_footer(): void {
		echo '<ul class="list--inline">';

		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'ndt4' ) );
			if ( $categories_list ) {
				printf(
					/* translators: %s: list of categories. */
					'<li class="cat-links">' . esc_html__( 'Posted in %s', 'ndt4' ) . '</li>',
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ndt4' ) );
			if ( $tags_list ) {
				printf(
					/* translators: %s: list of tags. */
					'<li class="tags-links">' . esc_html__( 'Tagged %s', 'ndt4' ) . '</li>',
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		if ( 'ndt4_news' === get_post_type() ) {
			$terms = get_the_terms( get_the_ID(), 'ndt4_news_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$term_links = [];
				foreach ( $terms as $term ) {
					$term_links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
				}
				printf(
					'<li class="cat-links">%s %s</li>',
					esc_html__( 'Filed under:', 'ndt4' ),
					implode( ', ', $term_links ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ndt4' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</li>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ndt4' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				wp_kses_post( get_the_title() )
			),
			'<li class="edit-link">',
			'</li>'
		);
	}
endif;

if ( ! function_exists( 'ndt4_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * @param string $size Image size to use.
	 */
	function ndt4_post_thumbnail( string $size = 'post-thumbnail' ): void {
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

if ( ! function_exists( 'ndt4_breadcrumbs' ) ) :
	/**
	 * Display breadcrumb navigation.
	 */
	function ndt4_breadcrumbs(): void {
		if ( is_front_page() ) {
			return;
		}

		echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumbs', 'ndt4' ) . '">';
		echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';

		// Home link.
		echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		echo '<a itemprop="item" href="' . esc_url( home_url( '/' ) ) . '">';
		echo '<span itemprop="name">' . esc_html__( 'Home', 'ndt4' ) . '</span>';
		echo '</a>';
		echo '<meta itemprop="position" content="1" />';
		echo '</li>';

		$position = 2;

		if ( is_page() ) {
			$ancestors = get_post_ancestors( get_the_ID() );
			$ancestors = array_reverse( $ancestors );

			foreach ( $ancestors as $ancestor ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				echo '<a itemprop="item" href="' . esc_url( get_permalink( $ancestor ) ) . '">';
				echo '<span itemprop="name">' . esc_html( get_the_title( $ancestor ) ) . '</span>';
				echo '</a>';
				echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				echo '</li>';
				$position++;
			}

			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="current">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';

		} elseif ( is_single() ) {
			if ( 'ndt4_news' === get_post_type() ) {
				echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
				echo '<a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'ndt4_news' ) ) . '">';
				echo '<span itemprop="name">' . esc_html__( 'News', 'ndt4' ) . '</span>';
				echo '</a>';
				echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
				echo '</li>';
				$position++;
			} elseif ( 'post' === get_post_type() ) {
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
					echo '<a itemprop="item" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">';
					echo '<span itemprop="name">' . esc_html( $categories[0]->name ) . '</span>';
					echo '</a>';
					echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
					echo '</li>';
					$position++;
				}
			}

			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="current">';
			echo '<span itemprop="name">' . esc_html( get_the_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';

		} elseif ( is_archive() ) {
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="current">';
			echo '<span itemprop="name">' . esc_html( get_the_archive_title() ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';

		} elseif ( is_search() ) {
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="current">';
			/* translators: %s: search query */
			echo '<span itemprop="name">' . esc_html( sprintf( __( 'Search: %s', 'ndt4' ), get_search_query() ) ) . '</span>';
			echo '<meta itemprop="position" content="' . esc_attr( $position ) . '" />';
			echo '</li>';
		}

		echo '</ol>';
		echo '</nav>';
	}
endif;

if ( ! function_exists( 'ndt4_social_share' ) ) :
	/**
	 * Display social sharing buttons.
	 */
	function ndt4_social_share(): void {
		$url   = rawurlencode( get_permalink() );
		$title = rawurlencode( get_the_title() );

		$networks = [
			'facebook' => [
				'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
				'label' => __( 'Share on Facebook', 'ndt4' ),
				'icon'  => 'facebook',
			],
			'twitter'  => [
				'url'   => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
				'label' => __( 'Share on X', 'ndt4' ),
				'icon'  => 'twitter',
			],
			'linkedin' => [
				'url'   => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title,
				'label' => __( 'Share on LinkedIn', 'ndt4' ),
				'icon'  => 'linkedin',
			],
			'email'	=> [
				'url'   => 'mailto:?subject=' . $title . '&body=' . $url,
				'label' => __( 'Share via Email', 'ndt4' ),
				'icon'  => 'email',
			],
		];

		echo '<div class="social-share">';
		echo '<span class="share-label">' . esc_html__( 'Share:', 'ndt4' ) . '</span>';
		echo '<ul class="share-links">';

		foreach ( $networks as $network => $data ) {
			echo '<li>';
			echo '<a href="' . esc_url( $data['url'] ) . '" class="share-link share-' . esc_attr( $network ) . '" target="_blank" rel="noopener noreferrer">';
			echo '<span class="screen-reader-text">' . esc_html( $data['label'] ) . '</span>';
			echo '<svg class="icon icon-' . esc_attr( $data['icon'] ) . '" aria-hidden="true" focusable="false">';
			echo '<use xlink:href="#icon-' . esc_attr( $data['icon'] ) . '"></use>';
			echo '</svg>';
			echo '</a>';
			echo '</li>';
		}

		echo '</ul>';
		echo '</div>';
	}
endif;

