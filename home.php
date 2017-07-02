<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Admiral
 */

get_header();

// Get Theme Options from Database.
$theme_options = admiral_theme_options();
?>

	<section id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Display Slider.
		if ( true === $theme_options['slider_blog'] ) :

			get_template_part( 'template-parts/post-slider' );

		endif;

		// Display Magazine Homepage Widgets.
		admiral_magazine_widgets();

		if ( have_posts() ) : ?>

			<?php // Display Homepage Title.
			if ( '' !== $theme_options['blog_title'] ) : ?>

				<header class="page-header clearfix">

					<h1 class="blog-title"><?php echo wp_kses_post( $theme_options['blog_title'] ); ?></h1>

				</header>

			<?php endif; ?>

			<?php admiral_breadcrumbs(); ?>

			<div id="post-wrapper" class="post-wrapper clearfix">

				<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; ?>

			</div>

			<?php admiral_pagination(); ?>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
