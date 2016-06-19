<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Admiral
 */

if ( ! function_exists( 'admiral_site_logo' ) ) :
/**
 * Displays the site logo in the header area
 */
function admiral_site_logo() {

	if ( function_exists( 'the_custom_logo' ) ) {

		the_custom_logo();

	}

}
endif;


if ( ! function_exists( 'admiral_site_title' ) ) :
/**
 * Displays the site title in the header area
 */
function admiral_site_title() {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	// Return early if site title is deactivated.
	if ( false === $theme_options['site_title'] ) {
		return;
	}

	if ( is_home() or is_page_template( 'template-magazine.php' )  ) : ?>

		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

	<?php else : ?>

		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

	<?php endif;

}
endif;


if ( ! function_exists( 'admiral_post_image_single' ) ) :
/**
 * Displays the featured image on single posts.
 */
function admiral_post_image_single() {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	// Display Post Thumbnail if activated.
	if ( true === $theme_options['post_image_single'] ) :

		the_post_thumbnail();

		endif;

} // admiral_post_image_single()
endif;


if ( ! function_exists( 'admiral_entry_meta' ) ) :
/**
 * Displays the date and comments of a post
 */
function admiral_entry_meta() {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	$postmeta = '';

	// Display date unless user has deactivated it via settings.
	if ( true === $theme_options['meta_date'] ) {

		$postmeta .= admiral_meta_date();

	}

	// Display comments unless user has deactivated it via settings.
	if ( true === $theme_options['meta_comments'] ) {

		$postmeta .= admiral_meta_comments();

	}

	if ( $postmeta ) {

		echo '<div class="entry-meta">' . $postmeta . '</div>';

	}

} // admiral_entry_meta()
endif;


if ( ! function_exists( 'admiral_meta_date' ) ) :
/**
 * Displays the post date
 */
function admiral_meta_date() {

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	return '<span class="meta-date">' . $time_string . '</span>';

}  // admiral_meta_date()
endif;


if ( ! function_exists( 'admiral_meta_author' ) ) :
/**
 * Displays the post author
 */
function admiral_meta_author() {

	$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( esc_html__( 'View all posts by %s', 'admiral' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);

	return '<span class="meta-author"> ' . $author_string . '</span>';

}  // admiral_meta_author()
endif;


if ( ! function_exists( 'admiral_meta_comments' ) ) :
/**
 * Displays the post comments
 */
function admiral_meta_comments() {

	ob_start();
	comments_popup_link( esc_html__( 'No comments', 'admiral' ), esc_html__( 'One comment', 'admiral' ), esc_html__( '% comments', 'admiral' ) );
	$comments_string = ob_get_contents();
	ob_end_clean();

	return '<span class="meta-comments"> ' . $comments_string . '</span>';

}  // admiral_meta_comments()
endif;


if ( ! function_exists( 'admiral_posted_by' ) ) :
/**
 * Displays the post author
 */
function admiral_posted_by() {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	// Return early if author is turned off.
	if ( false === $theme_options['meta_author'] ) {
		return false;
	}

	// Get Author Avatar.
	$avatar = get_avatar( get_the_author_meta( 'ID' ), 32 );

	$byline = sprintf( esc_html_x( 'Posted by %s', 'post author', 'admiral' ), admiral_meta_author() );

	echo '<div class="posted-by"> ' . $avatar . $byline . '</div>';

}  // admiral_posted_by()
endif;


if ( ! function_exists( 'admiral_entry_tags' ) ) :
/**
 * Displays the post tags on single post view
 */
function admiral_entry_tags() {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	// Get tags.
	$tag_list = get_the_tag_list( '', '' );

	// Display tags.
	if ( $tag_list && $theme_options['meta_tags'] ) : ?>

		<div class="entry-tags clearfix">
			<span class="meta-tags">
				<?php echo $tag_list; ?>
			</span>
		</div><!-- .entry-tags -->

	<?php
	endif;

} // admiral_entry_tags()
endif;


if ( ! function_exists( 'admiral_post_navigation' ) ) :
/**
 * Displays Single Post Navigation
 */
function admiral_post_navigation() {

	// Get theme options from database.
	$theme_options = admiral_theme_options();

	if ( true === $theme_options['post_navigation'] ) {

		the_post_navigation( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html_x( 'Previous Post:', 'post navigation', 'admiral' ) . '</span>%title',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Post:', 'post navigation', 'admiral' ) . '</span>%title',
		) );

	}

}
endif;


if ( ! function_exists( 'admiral_breadcrumbs' ) ) :
/**
 * Displays ThemeZee Breadcrumbs plugin
 */
function admiral_breadcrumbs() {

	if ( function_exists( 'themezee_breadcrumbs' ) ) {

		themezee_breadcrumbs( array(
			'before' => '<div class="breadcrumbs-container clearfix">',
			'after' => '</div>',
		) );

	}
}
endif;


if ( ! function_exists( 'admiral_related_posts' ) ) :
/**
 * Displays ThemeZee Related Posts plugin
 */
function admiral_related_posts() {

	if ( function_exists( 'themezee_related_posts' ) ) {

		themezee_related_posts( array(
			'class' => 'related-posts type-page clearfix',
			'before_title' => '<h2 class="archive-title related-posts-title">',
			'after_title' => '</h2>',
		) );

	}
}
endif;


if ( ! function_exists( 'admiral_pagination' ) ) :
/**
 * Displays pagination on archive pages
 */
function admiral_pagination() {

	global $wp_query;

	$big = 999999999; // Need an unlikely integer.

	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'admiral' ) . '</span>&raquo;',
		'prev_text' => '&laquo<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'admiral' ) . '</span>',
		'add_args' => false,
	) );

	// Display the pagination if more than one page is found.
	if ( $paginate_links ) : ?>

		<div class="post-pagination clearfix">
			<?php echo $paginate_links; ?>
		</div>

	<?php
	endif;

} // admiral_pagination()
endif;


/**
 * Displays credit link on footer line
 */
function admiral_footer_text() {
	?>

	<span class="credit-link">
		<?php printf( esc_html__( 'Powered by %1$s and %2$s.', 'admiral' ),
			'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
			'<a href="https://themezee.com/themes/admiral/" title="Admiral WordPress Theme">Admiral</a>'
		); ?>
	</span>

	<?php
}
add_action( 'admiral_footer_text', 'admiral_footer_text' );
