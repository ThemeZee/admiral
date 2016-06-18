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

<?php admiral_breadcrumbs(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_post_thumbnail(); ?>

	<div class="entry-content clearfix">

		<?php the_content(); ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'admiral' ),
			'after'  => '</div>',
		) ); ?>

	</div><!-- .entry-content -->

</article>
