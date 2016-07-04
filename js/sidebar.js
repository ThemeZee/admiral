/**
 * Sidebar JS
 *
 * Adds a toggle icon with slide animation for the sidebar on mobile devices
 *
 * Copyright 2015 ThemeZee
 * Free to use under the GPLv2 and later license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Author: Thomas Weichselbaumer (themezee.com)
 *
 * @package Admiral
 */

(function($) {

	/**--------------------------------------------------------------
	# Responsive Sidebar
	--------------------------------------------------------------*/
	$.fn.responsiveSidebar = function( options ) {

		if ( options === undefined ) {
			options = {};
		}

		/* Set Defaults */
		var defaults = {
			toggleID: "sidebar-toggle",
			maxWidth: "400px"
		};

		/* Set Variables */
		var vars = $.extend( {}, defaults, options ),
			toggleID = vars.toggleID,
			maxWidth = vars.maxWidth,
			$sidebar = $( this );

		/* Add sidebar toggle effect */
		$( '#' + toggleID ).on('click', function(){
			$( this ).toggleClass( 'active' );
			if ( $sidebar.is( ':visible' ) ) {
				hideSidebar();
			} else {
				showSidebar();
			}
		});

		/* Close Sidebar when title is clicked */
		$sidebar.find( '.sidebar-header' ).on('click', function(){
			$( this ).toggleClass( 'active' );
			if ( $sidebar.is( ':visible' ) ) {
				hideSidebar();
			}
		});

		/* Show sidebar and fade content area */
		function showSidebar() {

			$sidebar.show();
			$sidebar.animate( { 'max-width': maxWidth }, 300 );
			$( '#' + toggleID ).hide();

		}

		/* Hide sidebar and show full content area */
		function hideSidebar() {

			$sidebar.animate({ 'max-width': '0' },  300, function(){
				$sidebar.hide();
			});

			$( '#' + toggleID ).show();

		}

		/* Reset sidebar on desktop screen sizes */
		function resetSidebar() {

			$sidebar.show();
			$sidebar.css( { 'max-width': '100%' } );

		}

	};

	/**--------------------------------------------------------------
	# Setup Sidebars
	--------------------------------------------------------------*/
	$( document ).ready( function() {

		/* Add sidebar toggles */
		$( '#primary' ).prepend( '<button id=\"main-sidebar-toggle\" class=\"main-sidebar-toggle sidebar-toggle\"></button>' );
		$( '#primary' ).prepend( '<button id=\"small-sidebar-toggle\" class=\"small-sidebar-toggle sidebar-toggle\"></button>' );

		/* Setup Main Sidebar */
		$( ".main-sidebar" ).responsiveSidebar({
			toggleID: "main-sidebar-toggle",
			maxWidth: "350px"
		});

		/* Setup Small Sidebar */
		$( ".small-sidebar" ).responsiveSidebar({
			toggleID: "small-sidebar-toggle",
			maxWidth: "280px"
		});

	} );

}(jQuery));
