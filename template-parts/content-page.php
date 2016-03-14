<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Admiral
 */
?>

	<header class="page-header clearfix">
			
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		
	</header>
			
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php the_post_thumbnail(); ?>

		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<!-- <?php trackback_rdf(); ?> -->
			<div class="page-links"><?php wp_link_pages(); ?></div>	
		</div><!-- .entry-content -->

	</article>