<?php
/**
 * Custom functions that are not template related
 *
 * @package Admiral
 */

if ( ! function_exists( 'admiral_default_menu' ) ) :
/**
 * Display default page as navigation if no custom menu was set
 */
function admiral_default_menu() {

	echo '<ul id="menu-main-navigation" class="main-navigation-menu menu">'. wp_list_pages( 'title_li=&echo=0' ) .'</ul>';

}
endif;


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function admiral_body_classes( $classes ) {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	// Add post columns classes.
	if ( 'two-columns' === $theme_options['post_layout'] ) {
		$classes[] = 'post-layout-two-columns';
	} else {
		$classes[] = 'post-layout-one-column';
	}

	return $classes;
}
add_filter( 'body_class', 'admiral_body_classes' );


/**
 * Change excerpt length for default posts
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function admiral_excerpt_length( $length ) {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	// Return excerpt text.
	if ( isset( $theme_options['excerpt_length'] ) and $theme_options['excerpt_length'] >= 0 ) :
		return absint( $theme_options['excerpt_length'] );
	else :
		return 30; // Number of words.
	endif;
}
add_filter( 'excerpt_length', 'admiral_excerpt_length' );


/**
 * Function to change excerpt length for posts in category posts widgets
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function admiral_magazine_posts_excerpt_length( $length ) {
	return 20;
}


/**
 * Change excerpt more text for posts
 *
 * @param String $more_text Excerpt More Text.
 * @return string
 */
function admiral_excerpt_more( $more_text ) {
	return '';
}
add_filter( 'excerpt_more', 'admiral_excerpt_more' );


/**
 * Set wrapper start for wooCommerce
 */
function admiral_wrapper_start() {
	echo '<section id="primary" class="content-area">';
	echo '<main id="main" class="site-main" role="main">';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'admiral_wrapper_start', 10 );


/**
 * Set wrapper end for wooCommerce
 */
function admiral_wrapper_end() {
	echo '</main><!-- #main -->';
	echo '</section><!-- #primary -->';
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'admiral_wrapper_end', 10 );
