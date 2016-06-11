<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Admiral
 */

get_header();

// Get Theme Options from Database
$theme_options = admiral_theme_options();
?>

	<section id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">

				<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>

			</header><!-- .page-header -->

			<?php admiral_breadcrumbs(); ?>

			<div id="homepage-posts" class="post-wrapper clearfix">

				<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content' );

				endwhile; ?>

			</div>

			<?php admiral_pagination(); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
