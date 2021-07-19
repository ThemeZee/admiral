<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Admiral
 */

// Load Customizer Helper Functions.
require( get_template_directory() . '/inc/customizer/functions/sanitize-functions.php' );
require( get_template_directory() . '/inc/customizer/functions/callback-functions.php' );

// Load Custom Controls.
require( get_template_directory() . '/inc/customizer/controls/category-dropdown-control.php' );
require( get_template_directory() . '/inc/customizer/controls/header-control.php' );
require( get_template_directory() . '/inc/customizer/controls/links-control.php' );
require( get_template_directory() . '/inc/customizer/controls/plugin-control.php' );
require( get_template_directory() . '/inc/customizer/controls/upgrade-control.php' );

// Load Customizer Sections.
require( get_template_directory() . '/inc/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-slider.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-info.php' );

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 * @param object $wp_customize / Customizer Object.
 */
function admiral_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel.
	$wp_customize->add_panel( 'admiral_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'admiral' ),
	) );

	// Change default background section.
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->get_section( 'background_image' )->title   = esc_html__( 'Background', 'admiral' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add selective refresh for site title and description.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => 'admiral_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'admiral_customize_partial_blogdescription',
	) );

	// Add Display Site Title Setting.
	$wp_customize->add_setting( 'admiral_theme_options[site_title]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'admiral_theme_options[site_title]', array(
		'label'    => esc_html__( 'Display Site Title', 'admiral' ),
		'section'  => 'title_tagline',
		'settings' => 'admiral_theme_options[site_title]',
		'type'     => 'checkbox',
		'priority' => 10,
	) );

	// Add Display Tagline Setting.
	$wp_customize->add_setting( 'admiral_theme_options[site_description]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'admiral_theme_options[site_description]', array(
		'label'    => esc_html__( 'Display Tagline', 'admiral' ),
		'section'  => 'title_tagline',
		'settings' => 'admiral_theme_options[site_description]',
		'type'     => 'checkbox',
		'priority' => 11,
	) );

} // admiral_customize_register_options()
add_action( 'customize_register', 'admiral_customize_register_options' );


/**
 * Render the site title for the selective refresh partial.
 */
function admiral_customize_partial_blogname() {
	bloginfo( 'name' );
}


/**
 * Render the site tagline for the selective refresh partial.
 */
function admiral_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function admiral_customize_preview_js() {
	wp_enqueue_script( 'admiral-customizer-preview', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20191022', true );
}
add_action( 'customize_preview_init', 'admiral_customize_preview_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 */
function admiral_customize_preview_css() {
	wp_enqueue_style( 'admiral-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '20191022' );
}
add_action( 'customize_controls_print_styles', 'admiral_customize_preview_css' );
