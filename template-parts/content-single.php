<?php
/**
 * The template for displaying single posts
 *
 * @package Admiral
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php admiral_post_image_single(); ?>

	<header class="entry-header">

		<?php admiral_entry_meta(); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php admiral_posted_by(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content clearfix">

		<?php the_content(); ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'admiral' ),
			'after'  => '</div>',
		) ); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php admiral_entry_tags(); ?>
		<?php admiral_post_navigation(); ?>

	</footer><!-- .entry-footer -->

</article>
