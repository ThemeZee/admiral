<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package Admiral
 */

/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function admiral_theme_options() {

	// Merge theme options array from database with default options array.
	$theme_options = wp_parse_args( get_option( 'admiral_theme_options', array() ), admiral_default_options() );

	// Return theme options.
	return $theme_options;

}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function admiral_default_options() {

	$default_options = array(
		'site_title'        => true,
		'site_description'  => true,
		'blog_title'        => '',
		'post_layout'       => 'one-column',
		'excerpt_length'    => 20,
		'meta_date'         => true,
		'meta_author'       => true,
		'meta_category'     => true,
		'meta_comments'     => true,
		'meta_tags'         => true,
		'post_image_single' => true,
		'post_navigation'   => true,
		'slider_magazine'   => false,
		'slider_blog'       => false,
		'slider_category'   => 0,
		'slider_limit'      => 8,
		'slider_animation'  => 'slide',
		'slider_speed'      => 7000,
	);

	return $default_options;
}
