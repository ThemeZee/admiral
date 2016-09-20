<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Admiral
 */

// Get Theme Options from Database.
$theme_options = admiral_theme_options();
?>

	<section id="secondary" class="main-sidebar widget-area clearfix" role="complementary">

		<?php // Check if there is a top navigation menu.
		if ( has_nav_menu( 'secondary' ) ) : ?>

		<div id="sidebar-navigation-wrap" class="secondary-navigation-wrap">

			<nav id="sidebar-navigation" class="secondary-navigation navigation clearfix" role="navigation">
				<?php
					// Display Main Navigation.
					wp_nav_menu( array(
						'theme_location' => 'secondary',
						'container' => false,
						'menu_class' => 'sidebar-navigation-menu',
						'echo' => true,
						'fallback_cb' => '',
						)
					);
				?>
			</nav><!-- #main-navigation -->

		</div>

		<?php endif; ?>

		<?php // Check if Sidebar has widgets.
		if ( is_active_sidebar( 'sidebar' ) ) :

			dynamic_sidebar( 'sidebar' );

		endif; ?>

	</section><!-- #secondary -->
