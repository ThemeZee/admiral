<?php
/**
 * The template for displaying articles in the loop with post excerpts
 *
 * @package Admiral
 */

?>

<div class="post-column clearfix">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php admiral_post_image(); ?>

		<header class="entry-header">

			<?php admiral_entry_meta(); ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content entry-excerpt clearfix">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	</article>

</div>
