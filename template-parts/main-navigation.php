<?php
/***
 * Main Navigation
 *
 * Displays the main navigation menu and social icons menu below the main header area
 *
 * @package Admiral
 */

?>

	<div id="main-navigation-container" class="main-navigation-container container clearfix">

		<?php
		// Check if there is a social menu.
		if ( has_nav_menu( 'social' ) ) : ?>

			<div id="header-social-icons" class="header-social-icons social-icons-navigation clearfix">

				<?php
				// Display Social Icons Menu.
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container' => false,
					'menu_class' => 'social-icons-menu',
					'echo' => true,
					'fallback_cb' => '',
					'link_before' => '<span class="screen-reader-text">',
					'link_after' => '</span>',
					'depth' => 1,
					)
				);
				?>

			</div>

		<?php endif; ?>

		<nav id="main-navigation" class="primary-navigation navigation clearfix" role="navigation">

			<div class="main-navigation-menu-wrap">
				<?php
					// Display Main Navigation.
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_class' => 'main-navigation-menu',
						'echo' => true,
						'fallback_cb' => 'admiral_default_menu',
						)
					);
				?>
			</div>

		</nav><!-- #main-navigation -->

	</div>
