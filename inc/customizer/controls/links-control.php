<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package Admiral
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Admiral_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'admiral' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/themes/admiral/', 'admiral' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=admiral&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'admiral' ); ?>
					</a>
				</p>

				<p>
					<a href="http://preview.themezee.com/?demo=admiral&utm_source=customizer&utm_campaign=admiral" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'admiral' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/docs/admiral-documentation/', 'admiral' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=admiral&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'admiral' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/changelogs/?action=themezee-changelog&type=theme&slug=admiral', 'admiral' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Changelog', 'admiral' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/admiral/reviews/', 'admiral' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'admiral' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
