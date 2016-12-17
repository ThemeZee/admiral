<?php
/**
 * The template for displaying all single posts.
 *
 * @package Admiral
 */

get_header(); ?>

	<section id="primary" class="content-single content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();

			admiral_breadcrumbs();

			get_template_part( 'template-parts/content', 'single' );

			admiral_related_posts();

			comments_template();

		endwhile; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
