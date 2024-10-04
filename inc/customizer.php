<?php
/**
 * avasol Theme Customizer
 *
 * @package avasol
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function avasol_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//Additional options for site identity panel
	$wp_customize->add_setting( 'avasol_copyright' );
	$wp_customize->add_control( 'avasol_copyright', array(
			'type'    => 'text',
			'section' => 'title_tagline',
			'label'   => __( 'Copyright Text', 'avasol' ),
			'description' => __( 'Add {year} to replace with the current year', 'avasol' ),
		)
	);

	//Section for social networks
	$wp_customize->add_section('avasol_social_networks', array(
		'title' => __( 'Social Networks', 'avasol' ),
		'description' => '',
		'priority' => 80,
	));

	//Social network links
	$wp_customize->add_setting( 'avasol_facebook' );
	$wp_customize->add_control( 'avasol_facebook', array(
		'type'    => 'url',
		'section' => 'avasol_social_networks',
		'label'   => __( 'Facebook Link', 'avasol' ),
	) );
	$wp_customize->add_setting( 'avasol_twitter' );
	$wp_customize->add_control( 'avasol_twitter', array(
			'type'    => 'url',
			'section' => 'avasol_social_networks',
			'label'   => __( 'Twitter Link', 'avasol' ),
		)
	);
	$wp_customize->add_setting( 'avasol_linkedin' );
	$wp_customize->add_control( 'avasol_linkedin', array(
			'type'    => 'url',
			'section' => 'avasol_social_networks',
			'label'   => __( 'Linkedin Link', 'avasol' ),
		)
	);
	$wp_customize->add_setting( 'avasol_youtube' );
	$wp_customize->add_control( 'avasol_youtube', array(
			'type'    => 'url',
			'section' => 'avasol_social_networks',
			'label'   => __( 'YouTube Link', 'avasol' ),
		)
	);
	$wp_customize->add_setting( 'avasol_instagram' );
	$wp_customize->add_control( 'avasol_instagram', array(
			'type'    => 'url',
			'section' => 'avasol_social_networks',
			'label'   => __( 'Instagram Link', 'avasol' ),
		)
	);

	//Section for custom code
	$wp_customize->add_section('avasol_custom_code', array(
		'title' => __( 'Custom Code', 'avasol' ),
		'description' => '',
		'priority' => 210,
	));
	//Fields for custom code
	$wp_customize->add_setting('avasol_after_opening_head');
	$wp_customize->add_control( 'avasol_after_opening_head', array(
			'type' => 'textarea',
			'section' => 'avasol_custom_code', // Required, core or custom.
			'label' => __( 'After Opening <head> Tag', 'avasol' ),
		)
	);
	$wp_customize->add_setting('avasol_before_closing_head');
	$wp_customize->add_control( 'avasol_before_closing_head', array(
			'type' => 'textarea',
			'section' => 'avasol_custom_code', // Required, core or custom.
			'label' => __( 'Before Closing </head> Tag', 'avasol' ),
		)
	);
	$wp_customize->add_setting('avasol_after_opening_body');
	$wp_customize->add_control( 'avasol_after_opening_body', array(
			'type' => 'textarea',
			'section' => 'avasol_custom_code', // Required, core or custom.
			'label' => __( 'After Opening <body> Tag', 'avasol' ),
		)
	);
	$wp_customize->add_setting('avasol_before_closing_body');
	$wp_customize->add_control( 'avasol_before_closing_body', array(
			'type' => 'textarea',
			'section' => 'avasol_custom_code', // Required, core or custom.
			'label' => __( 'Before Closing </body> Tag', 'avasol' ),
		)
	);

	//Section for extras
	$wp_customize->add_section('avasol_extras', array(
		'title' => __( 'Global Options & Utilities', 'avasol' ),
		'description' => '',
		'priority' => 190,
	));
	//Disable comments
	$wp_customize->add_setting('avasol_disable_comments');
	$wp_customize->add_control( 'avasol_disable_comments', array(
			'label' => __('Disable the WordPress comments system', 'avasol'),
			'description' => __( 'Will completely disable the entire WP comments feature.', 'avasol' ),
			'section' => 'avasol_extras', 
			'type'     => 'checkbox',
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'avasol_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'avasol_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'avasol_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function avasol_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function avasol_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function avasol_customize_preview_js() {
	wp_enqueue_script( 'avasol-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'avasol_customize_preview_js' );
