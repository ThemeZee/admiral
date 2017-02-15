<?php
/**
 * The template for displaying large posts in Magazine Post widgets
 *
 * @package Admiral
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-post clearfix' ); ?>>

	<?php admiral_post_image( 'admiral-thumbnail-large' ); ?>

	<header class="entry-header">

		<?php admiral_magazine_entry_meta(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_excerpt(); ?>

	</div><!-- .entry-content -->

</article>
