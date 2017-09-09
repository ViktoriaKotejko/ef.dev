<?php

/**

 * Bota Theme Customizer

 *

 * @package bota

 * @link http://ottopress.com/tag/customizer/

 */



/**

 * Add postMessage support for site title and description for the Theme Customizer.

 *

 * @param WP_Customize_Manager $wp_customize Theme Customizer object.

 *

 */

function bota_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

}

add_action( 'customize_register', 'bota_customize_register' );



/**

 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.

 *

 * @since _s 1.2

 */

function bota_customize_preview_js() {

	wp_enqueue_script( 'bota_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );

}

add_action( 'customize_preview_init', 'bota_customize_preview_js' );



add_action ('admin_menu', 'bota_admin');

function bota_admin() {

}

// add settings to create various social media text areas.



add_action('customize_register', 'bota_customize');

function bota_customize($wp_customize) {



	$wp_customize->add_section( 'bota_socmed_settings', array(

		'title'          => 'Social Media Settings',

		'priority'       => 35,

	) );



	$wp_customize->add_setting( 'twitter', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'twitter', array(

		'label'   => __( 'Twitter url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'facebook', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'facebook', array(

		'label'   => __( 'Facebook url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'googleplus', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'googleplus', array(

		'label'   => __( 'Google + url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'linkedin', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'linkedin', array(

		'label'   => __( 'LinkedIn url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'flickr', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'flickr', array(

		'label'   => __( 'Flickr url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'pinterest', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'pinterest', array(

		'label'   => __( 'Pinterest url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'youtube', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'youtube', array(

		'label'   => __( 'YouTube url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'vimeo', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'vimeo', array(

		'label'   => __( 'Vimeo url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'tumblr', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'tumblr', array(

		'label'   => __( 'Tumblr url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'dribble', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'dribble', array(

		'label'   => __( 'Dribble url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	$wp_customize->add_setting( 'github', array(

		'default'        => '',
		'sanitize_callback' => 'bota_sanitize_text',

	) );



	$wp_customize->add_control( 'github', array(

		'label'   => __( 'Github url:', 'bota' ),

		'section' => 'bota_socmed_settings',

		'type'    => 'text',

	) );

	

	

}