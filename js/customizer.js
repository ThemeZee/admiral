/**
 * Customizer Live Preview
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Admiral
 */

( function( $ ) {

	/* Default WordPress Customizer settings */
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#logo .site-title' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.header-main .site-description' ).text( to );
		} );
	} );

	/* Blog Title */
	wp.customize( 'admiral_theme_options[blog_title]', function( value ) {
		value.bind( function( to ) {
			$( '#main .blog-header .blog-title' ).text( to );
		} );
	} );

	/* Sidebar Titles */
	wp.customize( 'admiral_theme_options[sidebar_main_title]', function( value ) {
		value.bind( function( to ) {
			$( '#secondary .sidebar-header .sidebar-title' ).text( to );
		} );
	} );

	wp.customize( 'admiral_theme_options[sidebar_small_title]', function( value ) {
		value.bind( function( to ) {
			$( '#tertiary .sidebar-header .sidebar-title' ).text( to );
		} );
	} );

} )( jQuery );
