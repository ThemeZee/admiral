<?php
/**
 * Admiral functions and definitions
 *
 * @package Admiral
 */

/**
 * Admiral only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


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

		// Set detfault Post Thumbnail size.
		set_post_thumbnail_size( 820, 510, true );

		// Register Navigation Menu.
		register_nav_menu( 'primary', esc_html__( 'Main Navigation', 'admiral' ) );

		// Register Navigation Menus.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Main Navigation', 'admiral' ),
			'secondary' => esc_html__( 'Sidebar Navigation', 'admiral' ),
			'social'    => esc_html__( 'Social Icons', 'admiral' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'admiral_custom_background_args', array( 'default-color' => 'f5f5f5' ) ) );

		// Set up the WordPress core custom logo feature.
		add_theme_support( 'custom-logo', apply_filters( 'admiral_custom_logo_args', array(
			'height'      => 60,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		) ) );

		// Add Theme Support for wooCommerce.
		add_theme_support( 'woocommerce' );

		// Add extra theme styling to the visual editor.
		add_editor_style( array( 'assets/css/editor-style.css', get_template_directory_uri() . '/assets/css/custom-fonts.css' ) );

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add custom color palette for Gutenberg.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html_x( 'Primary', 'Gutenberg Color Palette', 'admiral' ),
				'slug'  => 'primary',
				'color' => apply_filters( 'admiral_primary_color', '#ee4444' ),
			),
			array(
				'name'  => esc_html_x( 'White', 'Gutenberg Color Palette', 'admiral' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html_x( 'Light Gray', 'Gutenberg Color Palette', 'admiral' ),
				'slug'  => 'light-gray',
				'color' => '#f0f0f0',
			),
			array(
				'name'  => esc_html_x( 'Dark Gray', 'Gutenberg Color Palette', 'admiral' ),
				'slug'  => 'dark-gray',
				'color' => '#777777',
			),
			array(
				'name'  => esc_html_x( 'Black', 'Gutenberg Color Palette', 'admiral' ),
				'slug'  => 'black',
				'color' => '#303030',
			),
		) );

		// Add support for responsive embed blocks.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'admiral_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function admiral_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'admiral_content_width', 700 );
}
add_action( 'after_setup_theme', 'admiral_content_width', 0 );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function admiral_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'admiral' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Appears on posts and pages.', 'admiral' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Small Sidebar', 'admiral' ),
		'id'            => 'sidebar-small',
		'description'   => esc_html__( 'Appears on posts and pages except the full width template.', 'admiral' ),
		'before_widget' => '<div class="widget-wrap"><aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Magazine Homepage', 'admiral' ),
		'id'            => 'magazine-homepage',
		'description'   => esc_html__( 'Appears on blog index and Magazine Homepage template. You can use the Magazine widgets here.', 'admiral' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'admiral_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function admiral_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'admiral-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register Genericons.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/genericons/genericons.css', array(), '3.4.1' );

	// Register and Enqueue HTML5shiv to support HTML5 elements in older IE versions.
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.min.js', array(), '3.7.3' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Register and enqueue navigation.js.
	wp_enqueue_script( 'admiral-jquery-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20210324' );

	// Passing Parameters to navigation.js.
	wp_localize_script( 'admiral-jquery-navigation', 'admiral_menu_title', array( 'text' => esc_html__( 'Navigation', 'admiral' ) ) );

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'admiral_scripts' );


/**
 * Enqueue custom fonts.
 */
function admiral_custom_fonts() {
	wp_enqueue_style( 'admiral-custom-fonts', get_template_directory_uri() . '/assets/css/custom-fonts.css', array(), '20180413' );
}
add_action( 'wp_enqueue_scripts', 'admiral_custom_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'admiral_custom_fonts', 1 );


/**
 * Enqueue editor styles for the new Gutenberg Editor.
 */
function admiral_block_editor_assets() {
	wp_enqueue_style( 'admiral-editor-styles', get_theme_file_uri( '/assets/css/gutenberg-styles.css' ), array(), '20191118', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'admiral_block_editor_assets' );


/**
 * Add custom sizes for featured images
 */
function admiral_add_image_sizes() {

	// Add different thumbnail sizes for Magazine Posts widgets.
	add_image_size( 'admiral-thumbnail-small', 120, 80, true );
	add_image_size( 'admiral-thumbnail-medium', 280, 160, true );
	add_image_size( 'admiral-thumbnail-large', 560, 320, true );
}
add_action( 'after_setup_theme', 'admiral_add_image_sizes' );


/**
 * Make custom image sizes available in Gutenberg.
 */
function admiral_add_image_size_names( $sizes ) {
	return array_merge( $sizes, array(
		'post-thumbnail'          => esc_html__( 'Admiral Single Post', 'admiral' ),
		'admiral-thumbnail-large' => esc_html__( 'Admiral Magazine Post', 'admiral' ),
		'admiral-thumbnail-small' => esc_html__( 'Admiral Thumbnail', 'admiral' ),
	) );
}
add_filter( 'image_size_names_choose', 'admiral_add_image_size_names' );


/**
 * Include Files
 */

// Include Theme Info page.
require get_template_directory() . '/inc/theme-info.php';

// Include Theme Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include Extra Functions.
require get_template_directory() . '/inc/extras.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-tags.php';

// Include support functions for Theme Addons.
require get_template_directory() . '/inc/addons.php';

// Include Post Slider Setup.
require get_template_directory() . '/inc/slider.php';

// Include Magazine Functions.
require get_template_directory() . '/inc/magazine.php';

// Include Widget Files.
require get_template_directory() . '/inc/widgets/widget-magazine-posts-columns.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-grid.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-sidebar.php';
