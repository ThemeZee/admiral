<?php
/**
 * The template for displaying posts in the Magazine Sidebar widget
 *
 * @package Admiral
 */

// Get widget settings.
$post_excerpt = get_query_var( 'admiral_post_excerpt', false );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-post clearfix' ); ?>>

	<?php admiral_post_image( 'admiral-thumbnail-large' ); ?>

	<header class="entry-header">

		<?php admiral_magazine_entry_date(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->

	<?php // Display post excerpt if enabled.
	if ( $post_excerpt ) : ?>

		<div class="entry-content">

			<?php the_excerpt(); ?>

		</div><!-- .entry-content -->

	<?php endif; ?>

</article>
