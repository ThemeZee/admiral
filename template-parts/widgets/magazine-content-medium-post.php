<?php
/**
 * The template for displaying medium posts in Magazine Post widgets
 *
 * @package Admiral
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'medium-post clearfix' ); ?>>

	<?php admiral_post_image( 'admiral-thumbnail-medium' ); ?>

	<header class="entry-header">

		<?php admiral_magazine_entry_date(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

</article>
