<?php
/**
 * Template Name: Magazine Homepage
 *
 * Description: A custom page template for displaying the magazine homepage widgets.
 *
 * @package Admiral
 */

get_header();

// Get Theme Options from Database.
$theme_options = admiral_theme_options();
?>

	<section id="primary" class="content-magazine content-single content-area">
		<main id="main" class="site-main" role="main">

		<?php admiral_breadcrumbs(); ?>

		<?php // Display Slider.
		if ( true === $theme_options['slider_magazine'] ) :

			get_template_part( 'template-parts/post-slider' );

		endif; ?>

		<?php
		// Display Magazine Homepage Widgets.
		admiral_magazine_widgets();
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
