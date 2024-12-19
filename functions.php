<?php
/**
 * avasol functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package avasol
 */

if ( ! function_exists( 'avasol_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function avasol_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on avasol, use a find and replace
		 * to change 'avasol' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'avasol', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Gutenberg
		 *
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
		 */
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		//add_theme_support( 'dark-editor-style' );
		//add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'avasol' ),
			'menu-2' => esc_html__( 'Footer', 'avasol' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		/*
		add_theme_support( 'custom-background', apply_filters( 'avasol_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		*/

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'avasol_setup' );

/* Thumbnails */
//add_image_size('500x500', 500, 500, array('center', 'center'));

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function avasol_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'avasol_content_width', 1920 );
}
add_action( 'after_setup_theme', 'avasol_content_width', 0 );

add_filter( 'wp_check_filetype_and_ext', 'avasol_svgs_disable_real_mime_check', 10, 4 );

function avasol_svgs_disable_real_mime_check( $data, $file, $filename, $mimes ) {
    $wp_filetype = wp_check_filetype( $filename, $mimes );	
    $ext = $wp_filetype['ext'];
    $type = $wp_filetype['type'];
    $proper_filename = $data['proper_filename'];
    return compact( 'ext', 'type', 'proper_filename' );
}

/**
 * 
 * Upload Additional File Types
 *
*/
add_filter( 'upload_mimes', 'avasol_myme_types', 1, 1 );
function avasol_myme_types( $mime_types ) {
  $mime_types['svg'] = 'image/svg+xml';     // Adding .svg extension
  return $mime_types;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function avasol_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'avasol' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'avasol' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'avasol_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function avasol_scripts() {
	wp_enqueue_style( 'avasol-style', get_template_directory_uri() . '/assets/css/style.css', array(), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_style( 'aos-style', get_template_directory_uri() . '/assets/css/aos.css', null, '0' );
	
	wp_enqueue_script( 'avasol-lazy-of', get_template_directory_uri() . '/assets/js/plugins/object-fit/ls.object-fit.min.js', array(), null, false );

	/**
	 * Lazysizes unveil hooks
	 * Uncomment to use lazy loading background images by adding a class of "lazyload" and data-bg="/path/to/image.jpg"
	 * Be sure to add 'avasol-lazy-uh' to the dependencies for 'avasol-lazy'
	 */
	//wp_enqueue_script( 'avasol-lazy-uh', get_template_directory_uri() . '/assets/js/plugins/unveilhooks/ls.unveilhooks.min.js', array(), null, false );

	wp_enqueue_script( 'avasol-lazy', get_template_directory_uri() . '/assets/js/lazysizes.min.js', array('avasol-lazy-of'), null, false );

	wp_enqueue_script( 'avasol-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), null, true );

	//wp_enqueue_script( 'lax-js', get_template_directory_uri() . '/assets/js/lax.min.js', array(), null, false );

	wp_enqueue_script( 'aos-js', get_template_directory_uri() . '/assets/js/aos.js', array(), null, false );

	wp_enqueue_script( 'avasol-script', get_template_directory_uri() . '/assets/js/site.js', array('jquery','avasol-bootstrap'), wp_get_theme()->get( 'Version' ), true );

	wp_enqueue_script( 'avasol-focus-visible-pollyfill', get_template_directory_uri() . '/assets/js/focus-visible.js', array(), wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'avasol_scripts' );

/**
 * Remove Gutenberg CSS/JS
 */

function avasol_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
	wp_deregister_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'avasol_remove_wp_block_library_css', 100 );

/**
 * Editor stylesheet
 */
function avasol_load_editor_style() {
	add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'avasol_load_editor_style' );

/** 
 * Workaround Editor stylesheets
*/
function avasol_load_admin_editor_style() {
	if ( is_user_logged_in() ) {
		wp_enqueue_style( 'admin-editor-styles', get_template_directory_uri() . '/assets/css/editor-style.css' );
		wp_enqueue_script( 'admin-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), null, true );
	}
}
add_action( 'admin_enqueue_scripts', 'avasol_load_admin_editor_style' );

/**
 * Gutenberg script
 */
function avasol_gutenberg_enqueue() {
	//wp_enqueue_script( 'avasol-gutenberg', get_template_directory_uri() . '/js/gutenberg.js' );
}
add_action( 'enqueue_block_editor_assets', 'avasol_gutenberg_enqueue' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Bootstrap navwalker.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Simple navwalker.
 */
require get_template_directory() . '/inc/wp_simple_navwalker.php';

/**
 * Bootstrap commentwalker.
 */
require get_template_directory() . '/inc/wp_bootstrap_comments.php';

/**
 * ACF JSON-Files.
 */
require get_template_directory() . '/inc/acf-json.php';

/**
 * ACF Settings.
 */
require get_template_directory() . '/inc/acf-settings.php';

/**
 * ACF Gutenberg blocks
 */
if ( function_exists('acf_register_block_type') ) {
	require get_template_directory() . '/inc/acf-blocks.php';
}

/**
 * Custom Post Types.
 */
 require get_template_directory() . '/inc/cpt.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * OPTIONAL: Disable Comments.
 */
if ( get_theme_mod( 'avasol_disable_comments' ) ) {
	require get_template_directory() . '/inc/disable-comments.php';
}

//OPTIONAL: BACK TO TOP
//require_once get_template_directory() . '/inc/back-to-top.php';

/**
 * Load Mobile Detect Library.
 */
require get_template_directory() . '/inc/mobile_detect.php';
 
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * SMTP Mail settings for dev environment
 */
if (defined('WORDPRESS_SMTP_PORT')) {
	add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);
	add_action('phpmailer_init', function ($phpmailer) {

			$phpmailer->isSMTP();
			// host details
			$phpmailer->SMTPAuth = WORDPRESS_SMTP_AUTH;
			$phpmailer->SMTPSecure = WORDPRESS_SMTP_SECURE;
			$phpmailer->SMTPAutoTLS = false;
			$phpmailer->Host = WORDPRESS_SMTP_HOST;
			$phpmailer->Port = WORDPRESS_SMTP_PORT;
			// from details
			$phpmailer->From = WORDPRESS_SMTP_FROM;
			$phpmailer->FromName = WORDPRESS_SMTP_FROM_NAME;
			// login details
			$phpmailer->Username = WORDPRESS_SMTP_USERNAME;
			$phpmailer->Password = WORDPRESS_SMTP_PASSWORD;

	});
}

/* call render.php - echo _s_generate_image_size($IMAGE_ID, '800', '200', true, 'img-fluid mb-5'); */
function avasol_generate_image_size($image_id, $width, $height, $crop, $classes, $srcset_enable=true, $loading_eager=false) {
    // Temporarily create an image size
    $size_id = 'generate_image_' . $width . 'x' .$height . '_' . ((string) $crop);
	if ($crop == 'center') {
		$crop = "array('center', 'center')";
	}
    add_image_size($size_id, $width, $height, $crop);

    // Get the attachment data
    $meta = wp_get_attachment_metadata($image_id);

    // If the size does not exist
    if(!isset($meta['sizes'][$size_id])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $file = get_attached_file($image_id);
        $new_meta = wp_generate_attachment_metadata($image_id, $file);

        // Merge the sizes so we don't lose already generated sizes
        $new_meta['sizes'] = array_merge($meta['sizes'], $new_meta['sizes']);

        // Update the meta data
        wp_update_attachment_metadata($image_id, $new_meta);
    }

	if ( $loading_eager ) {
		$loading = 'eager';
	} else {
		$loading = 'lazy';
	}

	if ( $srcset_enable ) :
		$srcset = wp_get_attachment_image_srcset( $image_id, array( $size_id ) );
		$array_image = array(
			"class" => $classes,
			"srcset" => $srcset,
			"loading" => $loading,
		);
	else :
		$array_image = array(
			"class" => $classes,
			"loading" => $loading,
		);
	endif;
	

	// Fetch the sized image
	$sized = wp_get_attachment_image( $image_id, $size_id, '', $array_image );

    // Remove the image size so new images won't be created in this size automatically
    remove_image_size($size_id);
    return $sized;
}

function filter_products() {
	$termID = $_POST['term_id'];

	if ( $termID ) :
		$products_cat = array(
			array(
				'taxonomy' => 'products_cat',
				'terms' => $termID,
			),
		);
	endif;

	$ajaxposts = new WP_Query([
		'post_type' => 'product',
		'posts_per_page' => -1,
		'orderby' => 'title', 
		'order' => 'ASC',
		'post_status' => 'publish',
		'tax_query' => $products_cat,
	]);
	$response = '';

	if($ajaxposts->have_posts()) {
		while($ajaxposts->have_posts()) : $ajaxposts->the_post();
		$response .= get_template_part('template-parts/blocks/products/loop');
		endwhile;
	} else {
		$response = '<div class="col">No products found.</div>';
	}

	echo $response;
	exit;
}
add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');

function register_author_post_type() {
    $labels = array(
        'name'               => 'Authors',
        'singular_name'      => 'Author',
        'menu_name'          => 'Authors',
        'name_admin_bar'     => 'Author',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Author',
        'new_item'           => 'New Author',
        'edit_item'          => 'Edit Author',
        'view_item'          => 'View Author',
        'all_items'          => 'All Authors',
        'search_items'       => 'Search Authors',
        'not_found'          => 'No authors found.',
        'not_found_in_trash' => 'No authors found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'show_in_menu'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite'            => array('slug' => 'authors'),
    );

    register_post_type('author', $args);
}
add_action('init', 'register_author_post_type');

function add_author_meta_box() {
    add_meta_box(
        'post_author_meta_box',
        'Select Author',
        'render_author_meta_box',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_author_meta_box');

function render_author_meta_box($post) {
    $selected_author = get_post_meta($post->ID, '_post_author_id', true);

    $authors = get_posts(array(
        'post_type' => 'author',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));

    echo '<select name="post_author_id" id="post_author_id">';
    echo '<option value="">Select an Author</option>';

    foreach ($authors as $author) {
        echo '<option value="' . esc_attr($author->ID) . '"' . selected($selected_author, $author->ID, false) . '>';
        echo esc_html($author->post_title);
        echo '</option>';
    }

    echo '</select>';
}

function save_post_author_meta($post_id) {
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['post_author_id'])) {
        return;
    }

    $author_id = sanitize_text_field($_POST['post_author_id']);
    if ($author_id) {
        update_post_meta($post_id, '_post_author_id', $author_id);
    } else {
        delete_post_meta($post_id, '_post_author_id');
    }
}
add_action('save_post', 'save_post_author_meta');



function my_theme_unrestrict_blocks( $allowed_blocks, $post ) {
    return true;
}
add_filter( 'allowed_block_types_all', 'my_theme_unrestrict_blocks', 10, 2 );
