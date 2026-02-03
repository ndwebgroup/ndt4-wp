<?php
/**
 * News Category Taxonomy
 *
 * @package NDT4
 * @since 4.0.0
 */

declare(strict_types=1);

/**
 * Register News Category Taxonomy
 */
function ndt4_register_news_category_taxonomy(): void {
	$labels = [
		'name'					   => _x( 'News Categories', 'Taxonomy General Name', 'ndt4' ),
		'singular_name'			  => _x( 'News Category', 'Taxonomy Singular Name', 'ndt4' ),
		'menu_name'				  => __( 'Categories', 'ndt4' ),
		'all_items'				  => __( 'All Categories', 'ndt4' ),
		'parent_item'				=> __( 'Parent Category', 'ndt4' ),
		'parent_item_colon'		  => __( 'Parent Category:', 'ndt4' ),
		'new_item_name'			  => __( 'New Category Name', 'ndt4' ),
		'add_new_item'			   => __( 'Add New Category', 'ndt4' ),
		'edit_item'				  => __( 'Edit Category', 'ndt4' ),
		'update_item'				=> __( 'Update Category', 'ndt4' ),
		'view_item'				  => __( 'View Category', 'ndt4' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'ndt4' ),
		'add_or_remove_items'		=> __( 'Add or remove categories', 'ndt4' ),
		'choose_from_most_used'	  => __( 'Choose from the most used', 'ndt4' ),
		'popular_items'			  => __( 'Popular Categories', 'ndt4' ),
		'search_items'			   => __( 'Search Categories', 'ndt4' ),
		'not_found'				  => __( 'Not Found', 'ndt4' ),
		'no_terms'				   => __( 'No categories', 'ndt4' ),
		'items_list'				 => __( 'Categories list', 'ndt4' ),
		'items_list_navigation'	  => __( 'Categories list navigation', 'ndt4' ),
	];

	$args = [
		'labels'			 => $labels,
		'hierarchical'	   => true,
		'public'			 => true,
		'show_ui'			=> true,
		'show_admin_column'  => true,
		'show_in_nav_menus'  => true,
		'show_tagcloud'	  => true,
		'show_in_rest'	   => true,
		'rewrite'			=> [
			'slug'		 => 'news/category',
			'with_front'   => false,
			'hierarchical' => true,
		],
	];

	register_taxonomy( 'ndt4_news_category', [ 'ndt4_news' ], $args );
}
add_action( 'init', 'ndt4_register_news_category_taxonomy', 0 );
