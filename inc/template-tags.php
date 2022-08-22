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

		if ( is_home() or is_page_template( 'template-magazine.php' )  ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'admiral_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function admiral_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) : ?>

			<p class="site-description"><?php echo $description; ?></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'admiral_post_image' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 *
	 * @param string $size Post thumbnail size.
	 * @param array  $attr Post thumbnail attributes.
	 */
	function admiral_post_image( $size = 'post-thumbnail', $attr = array() ) {

		// Display Post Thumbnail.
		if ( has_post_thumbnail() ) : ?>

			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( $size, $attr ); ?>
			</a>

		<?php
		endif;
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
	}
endif;


if ( ! function_exists( 'admiral_entry_meta' ) ) :
	/**
	 * Displays the date and comments of a post
	 */
	function admiral_entry_meta() {

		$postmeta = admiral_meta_date();
		$postmeta .= admiral_meta_comments();

		// Display categories only on single posts.
		if ( is_single() ) {

			$postmeta .= admiral_meta_category();

		}

		echo '<div class="entry-meta">' . $postmeta . '</div>';
	}
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
	}
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
	}
endif;


if ( ! function_exists( 'admiral_meta_comments' ) ) :
	/**
	 * Displays the post comments
	 */
	function admiral_meta_comments() {

		// Check if comments are open or we have at least one comment.
		if ( ! ( comments_open() || get_comments_number() ) ) {
			return;
		}

		ob_start();
		comments_popup_link( esc_html__( 'No comments', 'admiral' ), esc_html__( 'One comment', 'admiral' ), esc_html__( '% comments', 'admiral' ) );
		$comments_string = ob_get_contents();
		ob_end_clean();

		return '<span class="meta-comments"> ' . $comments_string . '</span>';
	}
endif;


if ( ! function_exists( 'admiral_meta_category' ) ) :
	/**
	 * Displays the category of posts
	 */
	function admiral_meta_category() {

		return '<span class="meta-category"> ' . get_the_category_list( ', ' ) . '</span>';

	}
endif;


if ( ! function_exists( 'admiral_posted_by' ) ) :
	/**
	 * Displays the post author
	 */
	function admiral_posted_by() {

		// Get theme options from database.
		$theme_options = admiral_theme_options();

		// Only display if activated in settings.
		if ( true === $theme_options['meta_author'] || is_customize_preview() ) {

			// Get Author Avatar.
			$avatar = get_avatar( get_the_author_meta( 'ID' ), 32 );

			$byline = sprintf( esc_html_x( 'Posted by %s', 'post author', 'admiral' ), admiral_meta_author() );

			echo '<div class="posted-by"> ' . $avatar . $byline . '</div>';

		}
	}
endif;


if ( ! function_exists( 'admiral_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function admiral_entry_tags() {

		// Get tags.
		$tag_list = get_the_tag_list( '', '' );

		// Display tags.
		if ( $tag_list ) : ?>

			<div class="entry-tags clearfix">
				<span class="meta-tags">
					<?php echo $tag_list; ?>
				</span>
			</div><!-- .entry-tags -->

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'admiral_post_navigation' ) ) :
	/**
	 * Displays Single Post Navigation
	 */
	function admiral_post_navigation() {

		// Get theme options from database.
		$theme_options = admiral_theme_options();

		if ( true === $theme_options['post_navigation'] || is_customize_preview() ) {

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

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'admiral' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'admiral' ) . '</span>&raquo;',
		) );

	}
endif;


/**
 * Displays credit link on footer line
 */
function admiral_footer_text() {
	?>

	<span class="credit-link">
		<?php
		// translators: Theme Name and Link to ThemeZee.
		printf( esc_html__( 'WordPress Theme: %1$s by %2$s.', 'admiral' ),
			esc_html__( 'Admiral', 'admiral' ),
			'ThemeZee'
		);
		?>
	</span>

	<?php
}
add_action( 'admiral_footer_text', 'admiral_footer_text' );
