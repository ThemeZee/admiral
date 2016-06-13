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

		<header class="sidebar-header clearfix">

			<?php // Display Homepage Title.
			if ( '' !== $theme_options['sidebar_small_title'] ) : ?>

				<h2 class="sidebar-title"><?php echo wp_kses_post( $theme_options['sidebar_small_title'] ); ?></h2>

			<?php endif; ?>

		</header>

		<?php // Check if Sidebar has widgets.
		if ( is_active_sidebar( 'sidebar-small' ) ) :

			dynamic_sidebar( 'sidebar-small' );

		endif; ?>

	</section><!-- #tertiary -->
