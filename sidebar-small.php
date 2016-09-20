<?php
/**
 * The sidebar containing the small sidebar widget area.
 *
 * @package Admiral
 */

// Get Theme Options from Database.
$theme_options = admiral_theme_options();
?>

	<section id="tertiary" class="small-sidebar widget-area clearfix" role="complementary">

		<?php // Check if Sidebar has widgets.
		if ( is_active_sidebar( 'sidebar-small' ) ) :

			dynamic_sidebar( 'sidebar-small' );

		endif; ?>

	</section><!-- #tertiary -->
