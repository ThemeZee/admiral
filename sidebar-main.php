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

		<header class="sidebar-header clearfix">

			<?php // Display Homepage Title.
			if ( '' !== $theme_options['sidebar_main_title'] ) : ?>

				<h2 class="sidebar-title"><?php echo wp_kses_post( $theme_options['sidebar_main_title'] ); ?></h2>

			<?php endif; ?>

		</header>

		<div id="main-navigation-wrap" class="primary-navigation-wrap">

			<nav id="main-navigation" class="primary-navigation navigation clearfix" role="navigation">
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
			</nav><!-- #main-navigation -->

		</div>

		<?php // Check if Sidebar has widgets.
		if ( is_active_sidebar( 'sidebar' ) ) :

			dynamic_sidebar( 'sidebar' );

		endif; ?>

	</section><!-- #secondary -->
