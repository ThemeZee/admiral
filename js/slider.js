/**
 * Flexslider Setup
 *
 * Adds the Flexslider Plugin for the Featured Post Slideshow
 *
 * @package Admiral
 */

jQuery( document ).ready(function($) {

	/* Add flexslider to #post-slider div */
	$( "#post-slider" ).flexslider({
		animation: admiral_slider_params.animation,
		slideshowSpeed: admiral_slider_params.speed,
		namespace: "zeeflex-",
		selector: ".zeeslides > li",
		smoothHeight: true,
		pauseOnHover: true,
		controlsContainer: ".post-slider-controls"
	});

});
