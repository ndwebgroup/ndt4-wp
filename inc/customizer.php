<?php
/**
 * NDT4 Theme Customizer
 *
 * @package NDT4
 * @since 4.0.0
 */

declare(strict_types=1);

/**
 * Add Customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ndt4_customize_register( WP_Customize_Manager $wp_customize ): void {

	// Change some default settings.
	$wp_customize->get_setting( 'blogname' )->transport		= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Selective refresh for site title and description.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			[
				'selector'		=> '.site-title a',
				'render_callback' => function() {
					bloginfo( 'name' );
				},
			]
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			[
				'selector'		=> '.site-description',
				'render_callback' => function() {
					bloginfo( 'description' );
				},
			]
		);
	}

	/*
	 * Navigation Section
	 */
	$wp_customize->add_section(
		'ndt4_navigation',
		[
			'title'	=> __( 'Navigation', 'ndt4' ),
			'priority' => 30,
		]
	);

	// Navigation Style.
	$wp_customize->add_setting(
		'ndt4_nav_style',
		[
			'default'		   => 'side',
			'sanitize_callback' => 'ndt4_sanitize_nav_style',
			'transport'		 => 'refresh',
		]
	);

	$wp_customize->add_control(
		'ndt4_nav_style',
		[
			'label'	=> __( 'Navigation Style', 'ndt4' ),
			'section'  => 'ndt4_navigation',
			'type'	 => 'radio',
			'choices'  => [
				'side' => __( 'Side Navigation (Default)', 'ndt4' ),
				'top'  => __( 'Top Navigation', 'ndt4' ),
			],
		]
	);

	// Global Nav Toggle.
	$wp_customize->add_setting(
		'ndt4_global_nav',
		[
			'default'		   => true,
			'sanitize_callback' => 'ndt4_sanitize_checkbox',
			'transport'		 => 'refresh',
		]
	);

	// $wp_customize->add_control(
	// 	'ndt4_global_nav',
	// 	[
	// 		'label'   => __( 'Show Global Navigation', 'ndt4' ),
	// 		'section' => 'ndt4_navigation',
	// 		'type'	=> 'checkbox',
	// 	]
	// );

	// Use Home Icon.
	$wp_customize->add_setting(
		'ndt4_use_home_icon',
		[
			'default'		   => false,
			'sanitize_callback' => 'ndt4_sanitize_checkbox',
			'transport'		 => 'refresh',
		]
	);

	$wp_customize->add_control(
		'ndt4_use_home_icon',
		[
			'label'   => __( 'Use Home Icon in Navigation', 'ndt4' ),
			'section' => 'ndt4_navigation',
			'type'	=> 'checkbox',
			'default' => true,
		]
	);

	/*
	 * Header Section
	 */
	$wp_customize->add_section(
		'ndt4_header',
		[
			'title'	=> __( 'Header', 'ndt4' ),
			'priority' => 35,
		]
	);

	// Mark Position.
	// $wp_customize->add_setting(
	// 	'ndt4_mark_position',
	// 	[
	// 		'default'		   => 'left',
	// 		'sanitize_callback' => 'ndt4_sanitize_mark_position',
	// 		'transport'		 => 'refresh',
	// 	]
	// );

	// $wp_customize->add_control(
	// 	'ndt4_mark_position',
	// 	[
	// 		'label'   => __( 'ND Mark Position', 'ndt4' ),
	// 		'section' => 'ndt4_header',
	// 		'type'	=> 'radio',
	// 		'choices' => [
	// 			'left'  => __( 'Left', 'ndt4' ),
	// 			'right' => __( 'Right', 'ndt4' ),
	// 		],
	// 	]
	// );

	// Animate Header.
	// $wp_customize->add_setting(
	// 	'ndt4_animate',
	// 	[
	// 		'default'		   => false,
	// 		'sanitize_callback' => 'ndt4_sanitize_checkbox',
	// 		'transport'		 => 'refresh',
	// 	]
	// );

	// $wp_customize->add_control(
	// 	'ndt4_animate',
	// 	[
	// 		'label'   => __( 'Animate Header', 'ndt4' ),
	// 		'section' => 'ndt4_header',
	// 		'type'	=> 'checkbox',
	// 	]
	// );

	// Show Tagline.
	$wp_customize->add_setting(
		'ndt4_show_tagline',
		[
			'default'		   => true,
			'sanitize_callback' => 'ndt4_sanitize_checkbox',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_show_tagline',
		[
			'label'   => __( 'Show Site Tagline', 'ndt4' ),
			'section' => 'title_tagline',
			'type'	=> 'checkbox',
		]
	);

	/*
	 * Footer Section
	 */
	$wp_customize->add_section(
		'ndt4_footer',
		[
			'title'	=> __( 'Footer', 'ndt4' ),
			'priority' => 90,
		]
	);

	// Parent Organization.
	$wp_customize->add_setting(
		'ndt4_parent_org',
		[
			'default'		   => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_parent_org',
		[
			'label'   => __( 'Parent Organization Name', 'ndt4' ),
			'section' => 'ndt4_footer',
			'type'	=> 'text',
		]
	);

	// Parent URL.
	$wp_customize->add_setting(
		'ndt4_parent_url',
		[
			'default'		   => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_parent_url',
		[
			'label'   => __( 'Parent Organization URL', 'ndt4' ),
			'section' => 'ndt4_footer',
			'type'	=> 'url',
		]
	);

	// Grandparent Organization.
	$wp_customize->add_setting(
		'ndt4_grandparent_org',
		[
			'default'		   => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_grandparent_org',
		[
			'label'   => __( 'Grandparent Organization Name', 'ndt4' ),
			'section' => 'ndt4_footer',
			'type'	=> 'text',
		]
	);

	// Grandparent URL.
	$wp_customize->add_setting(
		'ndt4_grandparent_url',
		[
			'default'		   => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_grandparent_url',
		[
			'label'   => __( 'Grandparent Organization URL', 'ndt4' ),
			'section' => 'ndt4_footer',
			'type'	=> 'url',
		]
	);

	/*
	 * Contact Information Section
	 */
	$wp_customize->add_section(
		'ndt4_contact',
		[
			'title'	=> __( 'Contact Information', 'ndt4' ),
			'priority' => 91,
		]
	);

	// Address.
	$wp_customize->add_setting(
		'ndt4_address',
		[
			'default'		   => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_address',
		[
			'label'   => __( 'Address', 'ndt4' ),
			'section' => 'ndt4_contact',
			'type'	=> 'textarea',
		]
	);

	// Phone.
	$wp_customize->add_setting(
		'ndt4_phone',
		[
			'default'		   => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_phone',
		[
			'label'   => __( 'Phone', 'ndt4' ),
			'section' => 'ndt4_contact',
			'type'	=> 'tel',
		]
	);

	// Fax.
	$wp_customize->add_setting(
		'ndt4_fax',
		[
			'default'		   => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_fax',
		[
			'label'   => __( 'Fax', 'ndt4' ),
			'section' => 'ndt4_contact',
			'type'	=> 'tel',
		]
	);

	// Email.
	$wp_customize->add_setting(
		'ndt4_email',
		[
			'default'		   => '',
			'sanitize_callback' => 'sanitize_email',
			'transport'		 => 'postMessage',
		]
	);

	$wp_customize->add_control(
		'ndt4_email',
		[
			'label'   => __( 'Email', 'ndt4' ),
			'section' => 'ndt4_contact',
			'type'	=> 'email',
		]
	);

	/*
	 * Social Media Section
	 */
	$wp_customize->add_section(
		'ndt4_social',
		[
			'title'	=> __( 'Social Media', 'ndt4' ),
			'priority' => 92,
		]
	);

	$social_networks = [
		'facebook'  => __( 'Facebook URL', 'ndt4' ),
		'twitter'   => __( 'X (Twitter) URL', 'ndt4' ),
		'instagram' => __( 'Instagram URL', 'ndt4' ),
		'youtube'   => __( 'YouTube URL', 'ndt4' ),
		'linkedin'  => __( 'LinkedIn URL', 'ndt4' ),
	];

	foreach ( $social_networks as $network => $label ) {
		$wp_customize->add_setting(
			'ndt4_social_' . $network,
			[
				'default'		   => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'		 => 'postMessage',
			]
		);

		$wp_customize->add_control(
			'ndt4_social_' . $network,
			[
				'label'   => $label,
				'section' => 'ndt4_social',
				'type'	=> 'url',
			]
		);
	}

	/*
	 * Content Section
	 */
	$wp_customize->add_section(
		'ndt4_content',
		[
			'title'	=> __( 'Content Options', 'ndt4' ),
			'priority' => 93,
		]
	);

	// Show News Images.
	$wp_customize->add_setting(
		'ndt4_news_images',
		[
			'default'		   => true,
			'sanitize_callback' => 'ndt4_sanitize_checkbox',
			'transport'		 => 'refresh',
		]
	);

	$wp_customize->add_control(
		'ndt4_news_images',
		[
			'label'   => __( 'Show Images in News Lists', 'ndt4' ),
			'section' => 'ndt4_content',
			'type'	=> 'checkbox',
		]
	);

	// Back to Top Button.
	$wp_customize->add_setting(
		'ndt4_back_to_top',
		[
			'default'		   => true,
			'sanitize_callback' => 'ndt4_sanitize_checkbox',
			'transport'		 => 'refresh',
		]
	);

	$wp_customize->add_control(
		'ndt4_back_to_top',
		[
			'label'   => __( 'Show Back to Top Button', 'ndt4' ),
			'section' => 'ndt4_content',
			'type'	=> 'checkbox',
		]
	);

	// Default OG Image.
	$wp_customize->add_setting(
		'ndt4_og_image',
		[
			'default'		   => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'		 => 'refresh',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'ndt4_og_image',
			[
				'label'	   => __( 'Default Social Share Image', 'ndt4' ),
				'description' => __( 'Used when a page/post does not have a featured image. Recommended size: 1200x630 pixels.', 'ndt4' ),
				'section'	 => 'ndt4_content',
			]
		)
	);
}
add_action( 'customize_register', 'ndt4_customize_register' );

/**
 * Sanitize checkbox values
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool
 */
function ndt4_sanitize_checkbox( $checked ): bool {
	return (bool) $checked;
}

/**
 * Sanitize navigation style
 *
 * @param string $input Navigation style input.
 * @return string
 */
function ndt4_sanitize_nav_style( string $input ): string {
	$valid = [ 'side', 'top' ];
	return in_array( $input, $valid, true ) ? $input : 'side';
}

/**
 * Sanitize header background
 *
 * @param string $input Header background input.
 * @return string
 */
function ndt4_sanitize_header_bg( string $input ): string {
	$valid = [ 'campus', 'clover', 'dome', 'vine-wall', 'custom' ];
	return in_array( $input, $valid, true ) ? $input : 'dome';
}

/**
 * Sanitize mark position
 *
 * @param string $input Mark position input.
 * @return string
 */
function ndt4_sanitize_mark_position( string $input ): string {
	$valid = [ 'left', 'right' ];
	return in_array( $input, $valid, true ) ? $input : 'left';
}

/**
 * Enqueue Customizer preview scripts
 */
function ndt4_customize_preview_js(): void {
	wp_enqueue_script(
		'ndt4-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		[ 'customize-preview' ],
		NDT4_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'ndt4_customize_preview_js' );

/**
 * Enqueue Customizer panel styles
 */
function ndt4_customize_controls_enqueue_scripts(): void {
	wp_enqueue_style(
		'ndt4-customizer-controls',
		get_template_directory_uri() . '/assets/css/customizer.css',
		[],
		NDT4_VERSION
	);
}
add_action( 'customize_controls_enqueue_scripts', 'ndt4_customize_controls_enqueue_scripts' );
