<?php
/**
 * Magazine Posts Sidebar Widget
 *
 * Display the latest posts from a selected category.
 * Intented to be used in one of the sidebar widget areas.
 *
 * @package Admiral
 */

/**
 * Magazine Widget Class
 */
class Admiral_Magazine_Posts_Sidebar_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 */
	function __construct() {

		// Setup Widget.
		parent::__construct(
			'admiral-magazine-posts-sidebar', // ID.
			sprintf( esc_html__( 'Magazine Posts: Sidebar (%s)', 'admiral' ), wp_get_theme()->Name ), // Name.
			array(
				'classname' => 'admiral_magazine_posts_sidebar',
				'description' => esc_html__( 'Displays your posts from a selected category. You can use this widget in the Main Sidebar widget area.', 'admiral' ),
				'customize_selective_refresh' => true,
			) // Args.
		);

		// Delete Widget Cache on certain actions.
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );

	}


	/**
	 * Set default settings of the widget
	 */
	private function default_settings() {

		$defaults = array(
			'title'				=> '',
			'category'			=> 0,
			'number'			=> 4,
			'excerpt'			=> false,
			'meta_date'			=> true,
			'meta_comments'		=> false,
		);

		return $defaults;

	}


	/**
	 * Main Function to display the widget
	 *
	 * @uses this->render()
	 *
	 * @param array $args / Parameters from widget area created with register_sidebar().
	 * @param array $instance / Settings for this widget instance.
	 */
	function widget( $args, $instance ) {

		$cache = array();

		// Get Widget Object Cache.
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_admiral_magazine_posts_sidebar', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		// Display Widget from Cache if exists.
		if ( isset( $cache[ $this->id ] ) ) {
			echo $cache[ $this->id ];
			return;
		}

		// Start Output Buffering.
		ob_start();

		// Get Widget Settings.
		$settings = wp_parse_args( $instance, $this->default_settings() );

		// Output.
		echo $args['before_widget'];
		?>

		<div class="widget-magazine-posts-sidebar widget-magazine-posts clearfix">

			<?php // Display Title.
			$this->widget_title( $args, $settings ); ?>

			<div class="widget-magazine-posts-content">

				<?php $this->render( $settings ); ?>

			</div>

		</div>

		<?php
		echo $args['after_widget'];

		// Set Cache.
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'widget_admiral_magazine_posts_sidebar', $cache, 'widget' );
		} else {
			ob_end_flush();
		}

	} // widget()


	/**
	 * Renders the Widget Content
	 *
	 * Switches between two or three column layout style based on widget settings
	 *
	 * @uses this->magazine_posts_two_column_sidebar() or this->magazine_posts_three_column_sidebar()
	 * @used-by this->widget()
	 *
	 * @param array $settings / Settings for this widget instance.
	 */
	function render( $settings ) {

		// Get latest posts from database.
		$query_arguments = array(
			'posts_per_page' => (int) $settings['number'],
			'ignore_sticky_posts' => true,
			'cat' => (int) $settings['category'],
		);
		$posts_query = new WP_Query( $query_arguments );
		$i = 0;

		// Check if there are posts.
		if ( $posts_query->have_posts() ) :

			// Limit the number of words for the excerpt.
			add_filter( 'excerpt_length', 'admiral_magazine_posts_excerpt_length' );

			// Display Posts.
			while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

					<header class="entry-header">

						<?php admiral_post_image( 'admiral-thumbnail-large' ); ?>

						<?php $this->entry_meta( $settings ); ?>

						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

					</header><!-- .entry-header -->

					<?php if ( true === $settings['excerpt'] ) : ?>

					<div class="entry-content clearfix">

						<?php the_excerpt(); ?>

					</div><!-- .entry-content -->

					<?php endif; ?>

				</article>

				<?php
			endwhile;

			// Remove excerpt filter.
			remove_filter( 'excerpt_length', 'admiral_magazine_posts_excerpt_length' );

		endif;

		// Reset Postdata.
		wp_reset_postdata();

	} // render()


	/**
	 * Displays Entry Meta of Posts
	 *
	 * @param array $settings / Settings for this widget instance.
	 */
	function entry_meta( $settings ) {

		$postmeta = '';

		if ( true === $settings['meta_date'] ) {

			$postmeta .= admiral_meta_date();

		}

		if ( true === $settings['meta_comments'] ) {

			$postmeta .= admiral_meta_comments();

		}

		if ( $postmeta ) {

			echo '<div class="entry-meta">' . $postmeta . '</div>';

		}

	} // entry_meta()


	/**
	 * Displays Widget Title
	 *
	 * @param array $args / Parameters from widget area created with register_sidebar().
	 * @param array $settings / Settings for this widget instance.
	 */
	function widget_title( $args, $settings ) {

		// Add Widget Title Filter.
		$widget_title = apply_filters( 'widget_title', $settings['title'], $settings, $this->id_base );

		if ( ! empty( $widget_title ) ) :

			// Link Category Title.
			if ( $settings['category'] > 0 ) :

				// Set Link URL and Title for Category.
				$link_title = sprintf( esc_html__( 'View all posts from category %s', 'admiral' ), get_cat_name( $settings['category'] ) );
				$link_url = esc_url( get_category_link( $settings['category'] ) );

				// Display Widget Title with link to category archive.
				echo '<div class="widget-header">';
				echo '<h3 class="widget-title"><a class="category-archive-link" href="'. $link_url .'" title="'. $link_title . '">'. $widget_title . '</a></h3>';
				echo '</div>';

			else :

				// Display default Widget Title without link.
				echo $args['before_title'] . $widget_title . $args['after_title'];

			endif;

		endif;

	} // widget_title()


	/**
	 * Update Widget Settings
	 *
	 * @param array $new_instance / New Settings for this widget instance.
	 * @param array $old_instance / Old Settings for this widget instance.
	 * @return array $instance
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['category'] = (int) $new_instance['category'];
		$instance['number'] = (int) $new_instance['number'];
		$instance['excerpt'] = ! empty( $new_instance['excerpt'] );
		$instance['meta_date'] = ! empty( $new_instance['meta_date'] );
		$instance['meta_comments'] = ! empty( $new_instance['meta_comments'] );

		$this->delete_widget_cache();

		return $instance;
	}


	/**
	 * Displays Widget Settings Form in the Backend
	 *
	 * @param array $instance / Settings for this widget instance.
	 */
	function form( $instance ) {

		// Get Widget Settings.
		$settings = wp_parse_args( $instance, $this->default_settings() );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'admiral' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $settings['title']; ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Category:', 'admiral' ); ?></label><br/>
			<?php // Display Category Select.
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'admiral' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $settings['category'],
					'name'               => $this->get_field_name( 'category' ),
					'id'                 => $this->get_field_id( 'category' ),
				);
				wp_dropdown_categories( $args );
			?>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts:', 'admiral' ); ?>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $settings['number']; ?>" size="3" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['excerpt'] ); ?> id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" />
				<?php esc_html_e( 'Display post excerpt', 'admiral' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'meta_date' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['meta_date'] ); ?> id="<?php echo $this->get_field_id( 'meta_date' ); ?>" name="<?php echo $this->get_field_name( 'meta_date' ); ?>" />
				<?php esc_html_e( 'Display post date', 'admiral' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'meta_comments' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['meta_comments'] ); ?> id="<?php echo $this->get_field_id( 'meta_comments' ); ?>" name="<?php echo $this->get_field_name( 'meta_comments' ); ?>" />
				<?php esc_html_e( 'Display post comments', 'admiral' ); ?>
			</label>
		</p>
<?php
	} // form()


	/**
	 * Delete Widget Cache
	 */
	public function delete_widget_cache() {

		wp_cache_delete( 'widget_admiral_magazine_posts_sidebar', 'widget' );

	}
}

/**
 * Register Widget
 */
function admiral_register_magazine_posts_sidebar_widget() {

	register_widget( 'Admiral_Magazine_Posts_Sidebar_Widget' );

}
add_action( 'widgets_init', 'admiral_register_magazine_posts_sidebar_widget' );
