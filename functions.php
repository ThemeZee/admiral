<?php
/**
 * Admiral functions and definitions
 *
 * @package Admiral
 */

/**
 * Admiral only works in WordPress 4.2 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) :
	require get_template_directory() . '/inc/back-compat.php';
endif;


if ( ! function_exists( 'admiral_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function admiral_setup() {

	// Make theme available for translation. Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'admiral', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	
	// Set detfault Post Thumbnail size
	set_post_thumbnail_size( 820, 460, true );

	// Register Navigation Menu
	register_nav_menu( 'primary', esc_html__( 'Main Navigation', 'admiral' ) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'admiral_custom_background_args', array( 'default-color' => 'e5e5e5' ) ) );
	
	// Set up the WordPress core custom logo feature
	add_theme_support( 'custom-logo', apply_filters( 'admiral_custom_logo_args', array(
		'height' => 60,
		'width' => 300,
		'flex-height' => true,
		'flex-width' => true,
	) ) );
	
	// Add Theme Support for wooCommerce
	add_theme_support( 'woocommerce' );
	
	// Add extra theme styling to the visual editor
	add_editor_style( array( 'css/editor-style.css', admiral_google_fonts_url() ) );
	
}
endif; // admiral_setup
add_action( 'after_setup_theme', 'admiral_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function admiral_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'admiral_content_width', 800 );
}
add_action( 'after_setup_theme', 'admiral_content_width', 0 );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function admiral_widgets_init() {
	
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'admiral' ),
		'id' => 'sidebar',
		'description' => esc_html__( 'Appears on posts and pages.', 'admiral' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Small Sidebar', 'admiral' ),
		'id' => 'sidebar-small',
		'description' => esc_html__( 'Appears on posts and pages except the full width template.', 'admiral' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Header', 'admiral' ),
		'id' => 'header',
		'description' => esc_html__( 'Appears on header area. You can use a search or ad widget here.', 'admiral' ),
		'before_widget' => '<aside id="%1$s" class="header-widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="header-widget-title">',
		'after_title' => '</h4>',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Magazine Homepage', 'admiral' ),
		'id' => 'magazine-homepage',
		'description' => esc_html__( 'Appears on Magazine Homepage template only. You can use the Magazine Posts widgets here.', 'admiral' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
	
} // admiral_widgets_init
add_action( 'widgets_init', 'admiral_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function admiral_scripts() {
	global $wp_scripts;
	
	// Register and Enqueue Stylesheet
	wp_enqueue_style( 'admiral-stylesheet', get_stylesheet_uri() );
	
	// Register Genericons
	wp_enqueue_style( 'admiral-genericons', get_template_directory_uri() . '/css/genericons/genericons.css' );
	
	// Register and Enqueue HTML5shiv to support HTML5 elements in older IE versions
	wp_enqueue_script( 'admiral-html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.2', false );
	$wp_scripts->add_data( 'admiral-html5shiv', 'conditional', 'lt IE 9' );

	// Register and enqueue navigation.js
	wp_enqueue_script( 'admiral-jquery-navigation', get_template_directory_uri() .'/js/navigation.js', array('jquery') );
	
	// Passing Parameters to navigation.js
	wp_localize_script( 'admiral-jquery-navigation', 'admiral_menu_title', esc_html__( 'Navigation', 'admiral' ) );
	
	// Register and enqueue sidebar.js
	wp_enqueue_script( 'admiral-jquery-sidebar', get_template_directory_uri() .'/js/sidebar.js', array('jquery') );
	
	// Register and Enqueue Google Fonts
	wp_enqueue_style( 'admiral-default-fonts', admiral_google_fonts_url(), array(), null );

	// Register Comment Reply Script for Threaded Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
} // admiral_scripts
add_action( 'wp_enqueue_scripts', 'admiral_scripts' );


/**
 * Retrieve Font URL to register default Google Fonts
 */
function admiral_google_fonts_url() {
    
	// Set default Fonts
	$font_families = array( 'Open Sans:400,400italic,700,700italic', 'Raleway:400,400italic,700,700italic' );

	// Build Fonts URL
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return apply_filters( 'admiral_google_fonts_url', $fonts_url );
}


/**
 * Add custom sizes for featured images
 */
function admiral_add_image_sizes() {
	
	// Add different thumbnail sizes for Magazine Posts widgets
	add_image_size( 'admiral-thumbnail-small', 120, 80, true );
	add_image_size( 'admiral-thumbnail-medium', 280, 160, true );
	add_image_size( 'admiral-thumbnail-large', 560, 320, true );
	
}
add_action( 'after_setup_theme', 'admiral_add_image_sizes' );


/**
 * Include Files
 */
 
// include Theme Info page
require get_template_directory() . '/inc/theme-info.php';

// include Theme Customizer Options
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include Extra Functions
require get_template_directory() . '/inc/extras.php';

// include Template Functions
require get_template_directory() . '/inc/template-tags.php';

// Include support functions for Theme Addons
require get_template_directory() . '/inc/addons.php';

// Include Post Slider Setup
require get_template_directory() . '/inc/slider.php';

// include Widget Files
require get_template_directory() . '/inc/widgets/widget-magazine-posts-boxed.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-columns.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-grid.php';