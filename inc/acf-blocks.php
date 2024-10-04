<?php
/**
 * Adds Gutenberg content blocks through Advance Custom Fields Plugin
 *
 * See the full list of parameters at: https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @package avasol
 */

/**
 * Custom block category
 */

function avasol_block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'avasol',
				'title' => __( 'avasol', 'avasol' ),
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'avasol_block_categories', 10, 2 );


function avasol_register_acf_block_types() {

	acf_register_block_type( array(
		'name'            => 'header',
		'title'           => __( 'Header', 'avasol' ),
		'description'     => __( 'Add Page header.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'header', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'cards',
		'title'           => __( 'Cards', 'avasol' ),
		'description'     => __( 'Add Cards with Icons and Text.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'card', 'avasol' ), __( 'icons', 'avasol' ), __( 'text', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'image_cards',
		'title'           => __( 'Image cards', 'avasol' ),
		'description'     => __( 'Add Cards with Background-Image and Text.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'card', 'avasol' ), __( 'image', 'avasol' ), __( 'text', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'team_cards',
		'title'           => __( 'Team cards', 'avasol' ),
		'description'     => __( 'Add Team Cards with Image and Text.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'card', 'avasol' ), __( 'image', 'avasol' ), __( 'text', 'avasol' ), __( 'team', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'crossed_boxes',
		'title'           => __( 'Crossed boxes', 'avasol' ),
		'description'     => __( 'Add Crossed boxes with Text.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'boxes', 'avasol' ), __( 'crossed', 'avasol' ), __( 'text', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'tabs',
		'title'           => __( 'Tabs', 'avasol' ),
		'description'     => __( 'Add Tabs with Image and Text.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'tab', 'avasol' ), __( 'image', 'avasol' ), __( 'text', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'big_cards',
		'title'           => __( 'Big cards', 'avasol' ),
		'description'     => __( 'Add Big cards with image, text and button.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'card', 'avasol' ), __( 'image', 'avasol' ), __( 'text', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'energybar',
		'title'           => __( 'Energy bar', 'avasol' ),
		'description'     => __( 'Add bars for energy saving.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'bar', 'avasol' ), __( 'energy', 'avasol' ), __( 'saving', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'textblock',
		'title'           => __( 'Textblock', 'avasol' ),
		'description'     => __( 'Add Textblock.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'textblock', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'call_to_action',
		'title'           => __( 'Call to action', 'avasol' ),
		'description'     => __( 'Add a call to action section.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'call to action', 'avasol' ), __( 'teaser', 'avasol' ), __( 'button', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'faqs',
		'title'           => __( 'FAQs', 'avasol' ),
		'description'     => __( 'Add FAQs.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'faqs', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );

	acf_register_block_type( array(
		'name'            => 'products',
		'title'           => __( 'Products', 'avasol' ),
		'description'     => __( 'Add Products.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'products', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
		'enqueue_assets' 	=> function(){
			wp_enqueue_script( 'block-products', get_template_directory_uri() . '/template-parts/blocks/products/render.js', array(), wp_get_theme()->get( 'Version' ), true );
		},
	) );

	acf_register_block_type( array(
		'name'            => 'wp_funnel',
		'title'           => __( 'WP-Funnel', 'avasol' ),
		'description'     => __( 'Add Funnel.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'funnel', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
		'enqueue_assets' 	=> function(){
			wp_enqueue_script( 'block-wp-funnel', plugins_url( '/' ) . 'wp-funnel/assets/js/funnel.js', array(), wp_get_theme()->get( 'Version' ), true );
		},
	) );

	acf_register_block_type( array(
		'name'            => 'call_to_action_image',
		'title'           => __( 'Call to action with Image', 'avasol' ),
		'description'     => __( 'Add a call to action section with Background-Image.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'call to action', 'avasol' ), __( 'teaser', 'avasol' ), __( 'button', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );
	
	acf_register_block_type( array(
		'name'            => 'slider_logo',
		'title'           => __( 'Slider - Logos', 'avasol' ),
		'description'     => __( 'Add Slider with Logos.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'logos', 'avasol' ), __( 'slider', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
		'enqueue_assets' 	=> function(){
			wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '8.3.2' );
			wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '8.3.2', true );
			wp_enqueue_script( 'block-slider-logo', get_template_directory_uri() . '/template-parts/blocks/slider-logo/render.js', array(), wp_get_theme()->get( 'Version' ), true );
		},
	) );

	acf_register_block_type( array(
		'name'            => 'slider_testimonials',
		'title'           => __( 'Slider - Testimonials', 'avasol' ),
		'description'     => __( 'Add Testimonials Slider.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'slider', 'avasol' ), __( 'testimonials', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
		'enqueue_assets' 	=> function(){
			wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '8.3.2' );
			wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '8.3.2', true );
			wp_enqueue_script( 'block-slider-testimonials', get_template_directory_uri() . '/template-parts/blocks/slider-testimonials/render.js', array(), wp_get_theme()->get( 'Version' ), true );
		},
	) );

	acf_register_block_type( array(
		'name'            => 'counter_facts',
		'title'           => __( 'Counter facts', 'avasol' ),
		'description'     => __( 'Add Counter facts.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => '<svg width="70" height="56" viewBox="0 0 70 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.4629 55.9981H0.674308C0.116212 55.9981 -0.199978 55.3543 0.142879 54.9143L42.5162 0.260959C42.9086 -0.245708 43.72 0.0323872 43.72 0.672387V25.7333C43.72 26.1048 44.021 26.4057 44.3924 26.4057H69.04C69.5981 26.4057 69.9124 27.0457 69.5734 27.4876L47.8362 55.7372C47.7086 55.901 47.5124 56 47.3029 56H40.4781C40.1067 56 39.8057 55.6991 39.8057 55.3276V37.0514C39.8057 36.4076 38.9905 36.1314 38.6 36.6438L23.9962 55.7372C23.8686 55.9029 23.6705 56.0019 23.4629 56.0019V55.9981Z" fill="#26D538"/></svg>	',
		'keywords'        => array( __( 'Counter', 'avasol' ), __( 'facts', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
		'enqueue_assets' 	=> function(){
			wp_enqueue_script( 'block-counter-facts', get_template_directory_uri() . '/template-parts/blocks/counter-facts/render.js', array(), '1.0.0', true );
		},
	) );

	/*
	acf_register_block_type( array(
		'name'            => 'formular',
		'title'           => __( 'Formular', 'avasol' ),
		'description'     => __( 'Formular via Shortcode einfügen.', 'avasol' ),
		'render_callback' => 'avasol_acf_block_render_callback',
		'category'        => 'avasol',
		'icon'            => 'forms',
		'keywords'        => array( __( 'Formular', 'avasol' ) ),
		'mode'			  => 'edit',
		'supports'          => array(
			'align' => false
		),
	) );
	*/
}

// Check if function exists and hook into setup.
if ( function_exists( 'acf_register_block_type' ) ) {
	add_action( 'acf/init', 'avasol_register_acf_block_types' );
}

function avasol_acf_block_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/blocks" folder
	if( file_exists( get_theme_file_path("/template-parts/blocks/{$slug}/render.php") ) ) {
		include( get_theme_file_path("/template-parts/blocks/{$slug}/render.php") );
	}
}

/**
 * Allowed Gutenberg blocks
 */
function avasol_allowed_block_types( $allowed_blocks ) {
	$block_types = acf_get_block_types();
	$blocks = array();

	foreach ( $block_types as $block_type ) {
		$blocks[] = $block_type['name'];
	}

	return $blocks;
}
add_filter( 'allowed_block_types_all', 'avasol_allowed_block_types' );