<?php 

function avasol_cptui_register_cpts() {

	/* Post Type */

	/**
	 * Post Type: FAQs.
	 */

	 $labels = [
		"name" => __( "FAQs", "avasol" ),
		"singular_name" => __( "FAQ", "avasol" ),
	];

	$args = [
		"label" => __( "FAQs", "avasol" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_position" => 21,
		"menu_icon" => "dashicons-editor-help",
		"supports" => [ "title" ],
		"taxonomies" => [ "cat_faqs" ],
		"show_in_graphql" => false,
	];

	register_post_type( "faqs", $args );

		/**
	 * Post Type: Products.
	 */

	$labels = [
		"name" => esc_html__( "Products", "avasol" ),
		"singular_name" => esc_html__( "Product", "avasol" ),
	];

	$args = [
		"label" => esc_html__( "Products", "avasol" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_icon" => "dashicons-screenoptions",
		"supports" => [ "title" ],
		"show_in_graphql" => false,
	];

	register_post_type( "product", $args );
	
}

add_action( 'init', 'avasol_cptui_register_cpts' );

function avasol_cptui_register_cats() {

	/**
	 * Taxonomy: Category Products.
	 */

	$labels = [
		"name" => esc_html__( "Category", "avasol" ),
		"singular_name" => esc_html__( "Category", "avasol" ),
	];


	$args = [
		"label" => esc_html__( "Category", "avasol" ),
		"labels" => $labels,
		"public" => false,
		"publicly_queryable" => false,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => false,
		"show_admin_column" => false,
		"show_in_rest" => false,
		"show_tagcloud" => false,
		"rest_base" => "products_cat",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "products_cat", [ "product" ], $args );

}

add_action( 'init', 'avasol_cptui_register_cats' );