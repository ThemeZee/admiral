<?php
/**
 * The template for displaying articles in the search loop
 *
 * @package Admiral
 */
?>

	<div class="post-column clearfix">
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<header class="entry-header">

				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content entry-excerpt clearfix">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		
		</article>
		
	</div>