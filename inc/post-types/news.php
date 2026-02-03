<?php
/**
 * News Custom Post Type
 *
 * @package NDT4
 * @since 4.0.0
 */

declare(strict_types=1);

/**
 * Register News Custom Post Type
 */
function ndt4_register_news_post_type(): void {
	$labels = [
		'name'				  => _x( 'News', 'Post Type General Name', 'ndt4' ),
		'singular_name'		 => _x( 'News Article', 'Post Type Singular Name', 'ndt4' ),
		'menu_name'			 => __( 'News', 'ndt4' ),
		'name_admin_bar'		=> __( 'News Article', 'ndt4' ),
		'archives'			  => __( 'News Archives', 'ndt4' ),
		'attributes'			=> __( 'News Attributes', 'ndt4' ),
		'parent_item_colon'	 => __( 'Parent News:', 'ndt4' ),
		'all_items'			 => __( 'All News', 'ndt4' ),
		'add_new_item'		  => __( 'Add New Article', 'ndt4' ),
		'add_new'			   => __( 'Add New', 'ndt4' ),
		'new_item'			  => __( 'New Article', 'ndt4' ),
		'edit_item'			 => __( 'Edit Article', 'ndt4' ),
		'update_item'		   => __( 'Update Article', 'ndt4' ),
		'view_item'			 => __( 'View Article', 'ndt4' ),
		'view_items'			=> __( 'View News', 'ndt4' ),
		'search_items'		  => __( 'Search News', 'ndt4' ),
		'not_found'			 => __( 'Not found', 'ndt4' ),
		'not_found_in_trash'	=> __( 'Not found in Trash', 'ndt4' ),
		'featured_image'		=> __( 'Featured Image', 'ndt4' ),
		'set_featured_image'	=> __( 'Set featured image', 'ndt4' ),
		'remove_featured_image' => __( 'Remove featured image', 'ndt4' ),
		'use_featured_image'	=> __( 'Use as featured image', 'ndt4' ),
		'insert_into_item'	  => __( 'Insert into article', 'ndt4' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'ndt4' ),
		'items_list'			=> __( 'News list', 'ndt4' ),
		'items_list_navigation' => __( 'News list navigation', 'ndt4' ),
		'filter_items_list'	 => __( 'Filter news list', 'ndt4' ),
	];

	$args = [
		'label'			   => __( 'News', 'ndt4' ),
		'description'		 => __( 'News articles and announcements', 'ndt4' ),
		'labels'			  => $labels,
		'supports'			=> [
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'author',
			'revisions',
			'custom-fields',
		],
		'taxonomies'		  => [ 'ndt4_news_category' ],
		'hierarchical'		=> false,
		'public'			  => true,
		'show_ui'			 => true,
		'show_in_menu'		=> true,
		'menu_position'	   => 5,
		'menu_icon'		   => 'dashicons-megaphone',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'		  => true,
		'has_archive'		 => 'news',
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'	 => 'post',
		'show_in_rest'		=> true,
		'rewrite'			 => [
			'slug'	   => 'news',
			'with_front' => false,
		],
	];

	register_post_type( 'ndt4_news', $args );
}
add_action( 'init', 'ndt4_register_news_post_type', 0 );

/**
 * Add custom columns to News admin list
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function ndt4_news_admin_columns( array $columns ): array {
	$new_columns = [];

	foreach ( $columns as $key => $value ) {
		if ( 'title' === $key ) {
			$new_columns[ $key ]	 = $value;
			$new_columns['featured'] = __( 'Image', 'ndt4' );
		} elseif ( 'date' === $key ) {
			$new_columns['news_category'] = __( 'Category', 'ndt4' );
			$new_columns[ $key ]		  = $value;
		} else {
			$new_columns[ $key ] = $value;
		}
	}

	return $new_columns;
}
add_filter( 'manage_ndt4_news_posts_columns', 'ndt4_news_admin_columns' );

/**
 * Populate custom columns in News admin list
 *
 * @param string $column  Column name.
 * @param int	$post_id Post ID.
 */
function ndt4_news_admin_column_content( string $column, int $post_id ): void {
	switch ( $column ) {
		case 'featured':
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, [ 50, 50 ] );
			} else {
				echo '—';
			}
			break;

		case 'news_category':
			$terms = get_the_terms( $post_id, 'ndt4_news_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$term_names = wp_list_pluck( $terms, 'name' );
				echo esc_html( implode( ', ', $term_names ) );
			} else {
				echo '—';
			}
			break;
	}
}
add_action( 'manage_ndt4_news_posts_custom_column', 'ndt4_news_admin_column_content', 10, 2 );

/**
 * Make custom columns sortable
 *
 * @param array $columns Existing sortable columns.
 * @return array Modified sortable columns.
 */
function ndt4_news_sortable_columns( array $columns ): array {
	$columns['news_category'] = 'news_category';
	return $columns;
}
add_filter( 'manage_edit-ndt4_news_sortable_columns', 'ndt4_news_sortable_columns' );

/**
 * Flush rewrite rules on theme activation
 */
function ndt4_news_rewrite_flush(): void {
	ndt4_register_news_post_type();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ndt4_news_rewrite_flush' );
