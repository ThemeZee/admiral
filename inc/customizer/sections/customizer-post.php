<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Admiral
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function admiral_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'admiral_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'admiral' ),
		'priority' => 30,
		'panel' => 'admiral_options_panel',
		)
	);

	// Add Post Layout Settings for archive posts.
	$wp_customize->add_setting( 'admiral_theme_options[post_layout]', array(
		'default'           => 'one-column',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'admiral_sanitize_select',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[post_layout]', array(
		'label'    => esc_html__( 'Post Layout (archive pages)', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[post_layout]',
		'type'     => 'select',
		'priority' => 1,
		'choices'  => array(
			'one-column' => esc_html__( 'One Column', 'admiral' ),
			'two-columns' => esc_html__( 'Two Columns', 'admiral' ),
			),
		)
	);

	// Add Setting and Control for Excerpt Length.
	$wp_customize->add_setting( 'admiral_theme_options[excerpt_length]', array(
		'default'           => 20,
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[excerpt_length]', array(
		'label'    => esc_html__( 'Excerpt Length', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[excerpt_length]',
		'type'     => 'text',
		'priority' => 2,
		)
	);

	// Add Post Meta Settings.
	$wp_customize->add_setting( 'admiral_theme_options[postmeta_headline]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( new Admiral_Customize_Header_Control(
		$wp_customize, 'admiral_theme_options[postmeta_headline]', array(
			'label' => esc_html__( 'Post Meta', 'admiral' ),
			'section' => 'admiral_section_post',
			'settings' => 'admiral_theme_options[postmeta_headline]',
			'priority' => 3,
		)
	) );

	$wp_customize->add_setting( 'admiral_theme_options[meta_date]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display post date', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 4,
		)
	);

	$wp_customize->add_setting( 'admiral_theme_options[meta_comments]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[meta_comments]', array(
		'label'    => esc_html__( 'Display post comments', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[meta_comments]',
		'type'     => 'checkbox',
		'priority' => 5,
		)
	);

	// Add Single Post Settings.
	$wp_customize->add_setting( 'admiral_theme_options[single_post_headline]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( new Admiral_Customize_Header_Control( $wp_customize, 'admiral_theme_options[single_post_headline]', array(
		'label' => esc_html__( 'Single Posts', 'admiral' ),
		'section' => 'admiral_section_post',
		'settings' => 'admiral_theme_options[single_post_headline]',
		'priority' => 6,
		)
	) );

	// Featured Image Setting.
	$wp_customize->add_setting( 'admiral_theme_options[post_image_single]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[post_image_single]', array(
		'label'    => esc_html__( 'Display featured image on single posts', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[post_image_single]',
		'type'     => 'checkbox',
		'priority' => 7,
		)
	);

	$wp_customize->add_setting( 'admiral_theme_options[meta_author]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display post author on single posts', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 8,
		)
	);

	$wp_customize->add_setting( 'admiral_theme_options[meta_category]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[meta_category]', array(
		'label'    => esc_html__( 'Display post categories on single posts', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[meta_category]',
		'type'     => 'checkbox',
		'priority' => 9,
		)
	);

	$wp_customize->add_setting( 'admiral_theme_options[meta_tags]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display post tags on single posts', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 10,
		)
	);

	$wp_customize->add_setting( 'admiral_theme_options[post_navigation]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'admiral_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'admiral_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display post navigation on single posts', 'admiral' ),
		'section'  => 'admiral_section_post',
		'settings' => 'admiral_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 11,
		)
	);

}
add_action( 'customize_register', 'admiral_customize_register_post_settings' );
