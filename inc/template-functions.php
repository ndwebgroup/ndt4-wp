<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package NDT4
 * @since 4.0.0
 */

declare(strict_types=1);

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ndt4_pingback_header(): void {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ndt4_pingback_header' );

/**
 * Add custom image sizes.
 */
function ndt4_add_image_sizes(): void {
	add_image_size( 'ndt4-hero', 1340, 600, true );
	add_image_size( 'ndt4-card', 400, 300, true );
	add_image_size( 'ndt4-news-thumb', 300, 200, true );
}
add_action( 'after_setup_theme', 'ndt4_add_image_sizes' );

/**
 * Add custom image size names to media library.
 *
 * @param array $sizes Existing image sizes.
 * @return array Modified image sizes.
 */
function ndt4_custom_image_sizes( array $sizes ): array {
	return array_merge(
		$sizes,
		[
			'ndt4-hero'	   => __( 'Hero Image', 'ndt4' ),
			'ndt4-card'	   => __( 'Card Image', 'ndt4' ),
			'ndt4-news-thumb' => __( 'News Thumbnail', 'ndt4' ),
		]
	);
}
add_filter( 'image_size_names_choose', 'ndt4_custom_image_sizes' );

/**
 * Add Open Graph meta tags.
 */
function ndt4_open_graph_meta(): void {
	if ( is_singular() ) {
		global $post;

		$og_title	   = get_the_title();
		$og_description = has_excerpt() ? get_the_excerpt() : wp_trim_words( $post->post_content, 30 );
		$og_url		 = get_permalink();
		$og_type		= 'article';
		$og_image	   = '';

		if ( has_post_thumbnail() ) {
			$og_image = get_the_post_thumbnail_url( null, 'large' );
		} elseif ( get_theme_mod( 'ndt4_og_image' ) ) {
			$og_image = get_theme_mod( 'ndt4_og_image' );
		}

		echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $og_description ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $og_url ) . '">' . "\n";
		echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";

		if ( $og_image ) {
			echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
		}

		// Twitter Card.
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $og_title ) . '">' . "\n";
		echo '<meta name="twitter:description" content="' . esc_attr( $og_description ) . '">' . "\n";

		if ( $og_image ) {
			echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'ndt4_open_graph_meta', 5 );

/**
 * Modify the archive title.
 *
 * @param string $title Archive title.
 * @return string Modified archive title.
 */
function ndt4_archive_title( string $title ): string {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_year() ) {
		/* translators: %s: year */
		$title = sprintf( __( 'Year: %s', 'ndt4' ), get_the_date( 'Y' ) );
	} elseif ( is_month() ) {
		/* translators: %s: month and year */
		$title = sprintf( __( 'Month: %s', 'ndt4' ), get_the_date( 'F Y' ) );
	} elseif ( is_day() ) {
		/* translators: %s: date */
		$title = sprintf( __( 'Day: %s', 'ndt4' ), get_the_date() );
	} elseif ( is_post_type_archive( 'ndt4_news' ) ) {
		$title = __( 'News', 'ndt4' );
	} elseif ( is_tax( 'ndt4_news_category' ) ) {
		$title = single_term_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'ndt4_archive_title' );

/**
 * Filter the excerpt length.
 *
 * @param int $length Default excerpt length.
 * @return int Modified excerpt length.
 */
function ndt4_excerpt_length( int $length ): int {
	return 30;
}
add_filter( 'excerpt_length', 'ndt4_excerpt_length' );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string Modified "read more" string.
 */
function ndt4_excerpt_more( string $more ): string {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'ndt4_excerpt_more' );

/**
 * Add 'btn' class to block editor button links.
 *
 * @param string $block_content The block content.
 * @return string Modified block content.
 */
function ndt4_button_block_class( string $block_content ): string {
	$block_content = str_replace(
		'wp-block-button__link',
		'wp-block-button__link btn',
		$block_content
	);
	return $block_content;
}
add_filter( 'render_block_core/button', 'ndt4_button_block_class' );

/**
 * Add schema.org markup for organization in footer.
 */
function ndt4_schema_org_footer(): void {
	$address = get_theme_mod( 'ndt4_address', '' );
	$phone   = get_theme_mod( 'ndt4_phone', '' );
	$email   = get_theme_mod( 'ndt4_email', '' );

	if ( ! $address && ! $phone && ! $email ) {
		return;
	}

	$schema = [
		'@context' => 'https://schema.org',
		'@type'	=> 'Organization',
		'name'	 => get_bloginfo( 'name' ),
		'url'	  => home_url( '/' ),
	];

	if ( $address ) {
		$schema['address'] = [
			'@type'		   => 'PostalAddress',
			'streetAddress'   => wp_strip_all_tags( $address ),
		];
	}

	if ( $phone ) {
		$schema['telephone'] = $phone;
	}

	if ( $email ) {
		$schema['email'] = $email;
	}

	// Social profiles.
	$social_urls = [];
	$networks	= [ 'facebook', 'twitter', 'instagram', 'youtube', 'linkedin' ];
	foreach ( $networks as $network ) {
		$url = get_theme_mod( 'ndt4_social_' . $network, '' );
		if ( $url ) {
			$social_urls[] = $url;
		}
	}

	if ( ! empty( $social_urls ) ) {
		$schema['sameAs'] = $social_urls;
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_footer', 'ndt4_schema_org_footer' );

/**
 * Check if the page has a parent.
 *
 * @return bool
 */
function ndt4_has_parent(): bool {
	global $post;
	return $post && $post->post_parent > 0;
}

/**
 * Get top-level parent page ID.
 *
 * @return int|false Parent ID or false.
 */
function ndt4_get_top_parent_id() {
	global $post;

	if ( ! $post ) {
		return false;
	}

	$ancestors = get_post_ancestors( $post );

	if ( empty( $ancestors ) ) {
		return $post->ID;
	}

	return end( $ancestors );
}

/**
 * Get child pages of current page or parent.
 *
 * @return array Array of page objects.
 */
function ndt4_get_child_pages(): array {
	global $post;

	if ( ! $post ) {
		return [];
	}

	$parent_id = ndt4_has_parent() ? $post->post_parent : $post->ID;

	$children = get_pages( [
		'parent'	  => $parent_id,
		'sort_column' => 'menu_order, post_title',
	] );

	return $children ?: [];
}

/**
 * Check if a page has children.
 *
 * @param int $page_id Page ID.
 * @return bool
 */
function ndt4_page_has_children( int $page_id ): bool {
	$children = get_pages( [
		'parent'	  => $page_id,
		'number'	  => 1,
		'post_status' => 'publish',
	] );

	return ! empty( $children );
}

/**
 * Custom walker for top navigation (removes submenus, adds home icon)
 */
class NDT4_Top_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Whether to use home icon
	 *
	 * @var bool
	 */
	private $use_home_icon;

	/**
	 * Constructor
	 *
	 * @param bool $use_home_icon Whether to use home icon.
	 */
	public function __construct( bool $use_home_icon = true ) {
		$this->use_home_icon = $use_home_icon;
	}

	/**
	 * Start element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int	  $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int	  $id	 Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Add 'active' for current page or ancestor/parent.
		$active_classes = [
			'current-menu-item',
			'current_page_item',
			'current-page-ancestor',
			'current-menu-ancestor',
			'current-menu-parent',
			'current-page-parent',
			'current_page_parent',
			'current_page_ancestor',
		];
		if ( array_intersect( $active_classes, $classes ) ) {
			$classes[] = 'active';
		}

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= '<li' . $class_names . '>';

		$atts		   = [];
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']	= ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		// Add aria-current for current page.
		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$atts['aria-current'] = 'page';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value	   = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		// Check if this is the Home item
		$is_home = ( 'Home' === $title || 'home' === strtolower( $title ) );

		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes;

		if ( $is_home && $this->use_home_icon ) {
			$item_output .= ' aria-label="Home">';
			$item_output .= '<svg class="icon" data-icon="home" width="16" height="16"><use xlink:href="#icon-home"></use></svg>';
		} else {
			$item_output .= '>';
			$item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
		}

		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Custom walker for side navigation
 */
class NDT4_Side_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Start level output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int	  $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n{$indent}<ul class=\"sub-menu\">\n";
	}

	/**
	 * Start element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int	  $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int	  $id	 Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Add 'active' for current page or ancestor.
		$active_classes = [ 'current-menu-item', 'current-menu-ancestor', 'current_page_item', 'current_page_ancestor' ];
		if ( array_intersect( $active_classes, $classes ) ) {
			$classes[] = 'active';
		}

		// Add 'li-has-children' for items with submenus.
		if ( in_array( 'menu-item-has-children', $classes, true ) ) {
			$classes[] = 'li-has-children';
		}

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id_attr = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id_attr = $id_attr ? ' id="' . esc_attr( $id_attr ) . '"' : '';

		$output .= $indent . '<li' . $id_attr . $class_names . '>';

		$atts		   = [];
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']	= ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		// Add aria-current for current page.
		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$atts['aria-current'] = 'page';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value	   = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Custom walker for subnav (page hierarchy)
 *
 * Adds 'active' class to current page and ancestors.
 * Adds 'li-has-children' class to items with child pages.
 */
class NDT4_Subnav_Walker extends Walker_Page {
	/**
	 * Start element output.
	 *
	 * @param string  $output		Used to append additional content (passed by reference).
	 * @param WP_Post $page			Page data object.
	 * @param int	  $depth		Depth of page.
	 * @param array   $args			An array of arguments.
	 * @param int	  $current_page	Current page ID.
	 */
	public function start_el( &$output, $page, $depth = 0, $args = [], $current_page = 0 ) {
		$indent = str_repeat( "\t", $depth );

		$classes = [];

		// Active state: current page or ancestor of current page.
		if ( $current_page ) {
			if ( $page->ID === $current_page ) {
				$classes[] = 'active';
			} elseif ( in_array( $page->ID, get_post_ancestors( $current_page ), true ) ) {
				$classes[] = 'active';
			}
		}

		// Check if page has children.
		if ( ndt4_page_has_children( $page->ID ) ) {
			$classes[] = 'li-has-children';
		}

		$class_attr = ! empty( $classes ) ? ' class="' . esc_attr( implode( ' ', $classes ) ) . '"' : '';

		$output .= $indent . '<li' . $class_attr . '>';

		$aria = ( $page->ID === $current_page ) ? ' aria-current="page"' : '';

		$output .= '<a href="' . esc_url( get_permalink( $page->ID ) ) . '"' . $aria . '>';
		$output .= esc_html( apply_filters( 'the_title', $page->post_title, $page->ID ) );
		$output .= '</a>';
	}
}
