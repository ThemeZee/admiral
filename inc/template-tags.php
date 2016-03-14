<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Admiral
 */
	
/**
 * Displays the site title in the header area
 */
function admiral_site_title() { ?>

	<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<h1 class="site-title"><?php bloginfo('name'); ?></h1>
	</a>

<?php
}
add_action( 'admiral_site_title', 'admiral_site_title' );


if ( ! function_exists( 'admiral_header_image' ) ):
/**
 * Displays the custom header image below the navigation menu
 */
function admiral_header_image() {
	
	// Get theme options from database
	$theme_options = admiral_theme_options();	
	
	// Display featured image as header image on static pages
	if( get_header_image() ) : 

		// Hide header image on front page
		if ( true == $theme_options['custom_header_hide'] and is_front_page() ) {
			return;
		}
		?>
		
		<div id="headimg" class="header-image">
			
			<?php // Check if custom header image is linked
			if( $theme_options['custom_header_link'] <> '' ) : ?>
			
				<a href="<?php echo esc_url( $theme_options['custom_header_link'] ); ?>">
					<img src="<?php echo get_header_image(); ?>" />
				</a>
				
			<?php else : ?>
			
				<img src="<?php echo get_header_image(); ?>" />
				
			<?php endif; ?>
			
		</div>
	
	<?php 
	endif;
}
endif;


if ( ! function_exists( 'admiral_post_image_single' ) ):
/**
 * Displays the featured image on single posts
 */
function admiral_post_image_single() {
	
	// Get Theme Options from Database
	$theme_options = admiral_theme_options();
	
	// Display Post Thumbnail if activated
	if ( true == $theme_options['post_image_single'] ) :

		the_post_thumbnail();

	endif;

} // admiral_post_image_single()
endif;


if ( ! function_exists( 'admiral_entry_meta' ) ):	
/**
 * Displays the date, author and categories of a post
 */
function admiral_entry_meta() {

	// Get Theme Options from Database
	$theme_options = admiral_theme_options();
	
	$postmeta = '';
	
	// Display date unless user has deactivated it via settings
	if ( true == $theme_options['meta_date'] ) {
		
		$postmeta .= admiral_meta_date();
		
	}
	
	// Display categories unless user has deactivated it via settings
	if ( true == $theme_options['meta_category'] ) {
	
		$postmeta .= admiral_meta_category();
	
	}
		
	if( $postmeta ) {
		
		echo '<div class="entry-meta">' . $postmeta . '</div>';
			
	}

} // admiral_entry_meta()
endif;


if ( ! function_exists( 'admiral_meta_date' ) ):
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


if ( ! function_exists( 'admiral_meta_category' ) ):
/**
 * Displays the category of posts
 */	
function admiral_meta_category() { 

	return '<span class="meta-category"> ' . get_the_category_list(' / ') . '</span>';
	
} // admiral_meta_category()
endif;


if ( ! function_exists( 'admiral_meta_author' ) ):
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


if ( ! function_exists( 'admiral_posted_by' ) ):
/**
 * Displays the post author
 */
function admiral_posted_by() {  
	
	// Get Theme Options from Database
	$theme_options = admiral_theme_options();
	
	// Return early if author is turned off
	if ( false == $theme_options['meta_author'] ) {
		return false;
	}
	
	// Get Author Avatar
	$avatar = get_avatar( get_the_author_meta( 'ID' ), 32 );
	
	$byline = sprintf( esc_html_x( 'Posted by %s', 'post author', 'admiral' ), admiral_meta_author() );
	
	echo '<div class="posted-by"> ' . $avatar . $byline . '</div>';

}  // admiral_posted_by()
endif;


if ( ! function_exists( 'admiral_entry_tags' ) ):
/**
 * Displays the post tags on single post view
 */
function admiral_entry_tags() {
	
	// Get Theme Options from Database
	$theme_options = admiral_theme_options();
	
	// Get Tags
	$tag_list = get_the_tag_list('', '');
	
	// Display Tags
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


if ( ! function_exists( 'admiral_more_link' ) ):
/**
 * Displays the more link on posts
 */
function admiral_more_link() { ?>

	<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php esc_html_e( 'Continue reading &raquo;', 'admiral' ); ?></a>

<?php
}
endif;


if ( ! function_exists( 'admiral_post_navigation' ) ):
/**
 * Displays Single Post Navigation
 */	
function admiral_post_navigation() { 
	
	// Get Theme Options from Database
	$theme_options = admiral_theme_options();
	
	if ( true == $theme_options['post_navigation'] ) {

		the_post_navigation( array( 'prev_text' => '&laquo; %title', 'next_text' => '%title &raquo;' ) );
			
	}
	
}	
endif;


if ( ! function_exists( 'admiral_breadcrumbs' ) ):
/**
 * Displays ThemeZee Breadcrumbs plugin
 */	
function admiral_breadcrumbs() { 
	
	if ( function_exists( 'themezee_breadcrumbs' ) ) {

		themezee_breadcrumbs( array( 
			'before' => '<div class="breadcrumbs-container container clearfix">',
			'after' => '</div>'
		) );
		
	}
}	
endif;


if ( ! function_exists( 'admiral_related_posts' ) ):
/**
 * Displays ThemeZee Related Posts plugin
 */	
function admiral_related_posts() { 
	
	if ( function_exists( 'themezee_related_posts' ) ) {

		themezee_related_posts( array( 
			'class' => 'related-posts type-page clearfix',
			'before_title' => '<h2 class="archive-title related-posts-title">',
			'after_title' => '</h2>'
		) );
		
	}
}	
endif;


if ( ! function_exists( 'admiral_pagination' ) ):
/**
 * Displays pagination on archive pages
 */	
function admiral_pagination() { 
	
	global $wp_query;

	$big = 999999999; // need an unlikely integer
	
	 $paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',				
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages,
			'next_text' => '&raquo;',
			'prev_text' => '&laquo',
			'add_args' => false
		) );

	// Display the pagination if more than one page is found
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
function admiral_footer_text() { ?>

	<span class="credit-link">
		<?php printf( esc_html__( 'Powered by %1$s and %2$s.', 'admiral' ), 
			'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
			'<a href="https://themezee.com/themes/admiral/" title="Admiral WordPress Theme">Admiral</a>'
		); ?>
	</span>

<?php
}
add_action( 'admiral_footer_text', 'admiral_footer_text' );