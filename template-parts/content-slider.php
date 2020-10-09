<?php
/**
 * The template for displaying articles in the slideshow loop
 *
 * @package Admiral
 */

?>

<li id="slide-<?php the_ID(); ?>" class="zeeslide clearfix">

	<?php admiral_slider_image( 'post-thumbnail', array( 'class' => 'slide-image', 'loading' => false ) ); ?>

	<div class="slide-content clearfix">

		<?php admiral_entry_meta(); ?>

		<?php the_title( sprintf( '<h2 class="slide-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-content clearfix">

			<?php the_excerpt(); ?>

		</div><!-- .entry-content -->

	</div>

</li>
