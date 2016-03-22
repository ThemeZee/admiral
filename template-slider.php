<?php
/**
 * Template Name: Post Slider
 *
 * Description: A custom page template which displays the post slider and page content
 *
 * @package Admiral
 */

get_header(); ?>

	<section id="primary" class="content-single content-area">
		<main id="main" class="site-main" role="main">
			
			<?php while (have_posts()) : the_post(); ?>

					<header class="page-header clearfix">
			
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
						
					</header>
					
					<?php admiral_breadcrumbs(); ?>
					
					<?php get_template_part( 'template-parts/post-slider' ); ?>
							
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<?php the_post_thumbnail(); ?>

						<div class="entry-content clearfix">
							<?php the_content(); ?>
							<!-- <?php trackback_rdf(); ?> -->
							<div class="page-links"><?php wp_link_pages(); ?></div>	
						</div><!-- .entry-content -->

					</article>
				
				<?php comments_template(); ?>

			<?php endwhile; ?>
		
		</main><!-- #main -->
	</section><!-- #primary -->
	
	<?php get_sidebar(); ?>

<?php get_footer(); ?>