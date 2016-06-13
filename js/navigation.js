/**
 * jQuery Navigation Plugin
 * Includes responsiveMenu() function
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
	# Responsive Navigation for WordPress menus
	--------------------------------------------------------------*/
	$.fn.responsiveMenu = function( options ) {

		if (options === undefined) options = {};

		/* Set Defaults */
		var defaults = {
			menuClass: "menu",
			toggleClass: "menu-toggle",
			toggleText: "",
			maxWidth: "60em"
		};

		/* Set Variables */
		var vars = $.extend( {}, defaults, options ),
			menuClass = vars.menuClass,
			toggleID = (vars.toggleID) ? vars.toggleID : vars.toggleClass,
			toggleClass = vars.toggleClass,
			toggleText = vars.toggleText,
			maxWidth = vars.maxWidth,
			$this = $( this ),
			$menu = $( '.' + menuClass );

		/********************
		* Mobile Navigation *
		*********************/

		/* Add dropdown toggle for submenus on mobile navigation */
		$menu.find( 'li.menu-item-has-children' ).prepend( '<span class=\"submenu-dropdown-toggle\"></span>' );

		/* Add dropdown animation for submenus on mobile navigation */
		$menu.find( 'li.menu-item-has-children ul' ).each( function () {
			$( this ).hide();
		} );
		$menu.find( '.submenu-dropdown-toggle' ).on('click', function(){
			$( this ).parent().find( 'ul:first' ).slideToggle();
			$( this ).toggleClass( 'active' );
		});

	};

	/**--------------------------------------------------------------
	# Setup Navigation Menus
	--------------------------------------------------------------*/
	$( document ).ready( function() {

		/* Setup Main Navigation */
		$( "#main-navigation" ).responsiveMenu({
			menuClass: "main-navigation-menu",
			toggleClass: "main-navigation-toggle",
			toggleText: admiral_menu_title,
			maxWidth: "60em"
		});

		/* Setup Top Navigation */
		$( "#top-navigation" ).responsiveMenu({
			menuClass: "top-navigation-menu",
			toggleClass: "top-navigation-toggle",
			maxWidth: "60em"
		});

		/* Setup Footer Navigation */
		$( "#footer-links" ).responsiveMenu({
			menuClass: "footer-navigation-menu",
			toggleClass: "footer-navigation-toggle",
			maxWidth: "60em"
		});

	} );

}(jQuery));
