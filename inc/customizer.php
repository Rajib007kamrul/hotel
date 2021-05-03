<?php

class Theme_Customizer {

  public function __construct() {
    add_action( 'customize_register', [ $this, 'customize_register' ] );
  }

  public function customize_register( $wp_customize ) {
  		/*** Header Section **/

		$wp_customize->add_section('header_section',array(
			'title'    => __('Header Settings','robo'),
			'priority' => 10,
		));

		$wp_customize->add_setting('logo_upload', array(
			'default'   => '',
			'transport' =>'postMessage'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'logo_upload', array(
			'label'    => __( 'Logo Upload' ),
			'section'  => 'header_section',
			'settings' =>'logo_upload'
		)));

		$wp_customize->add_setting('white_logo_upload', array(
			'default'   => '',
			'transport' =>'postMessage'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'white_logo_upload', array(
			'label'    => __( 'White Logo Upload' ),
			'section'  => 'header_section',
			'settings' =>'white_logo_upload'
		)));


		$wp_customize->add_setting('footer_logo_upload', array(
			'default'   => '',
			'transport' =>'postMessage'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'footer_logo_upload', array(
			'label'    => __( 'Footer Logo Upload' ),
			'section'  => 'header_section',
			'settings' =>'footer_logo_upload'
		)));


		$wp_customize->add_setting('header_audio_link', array(
		  'default' => __('','robo'),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'header_audio_link', array(
		  'label' => __( 'Audio Link' ),
		  'section' => 'header_section',
		  'type'=>'text'
		) );


		/*** Content Section ***/

		$wp_customize->add_section('content_section',array(
			'title'=> __('Content Settings','robo'),
			'priority'=>10,
		));

		$wp_customize->add_setting('city_text', array(
		  'default' => __('','robo'),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'city_text', array(
		  'label' => __( 'City Text' ),
		  'section' => 'content_section',
		  'type'=>'text'
		) );


		$wp_customize->add_setting('place_text', array(
		  'default' => __('','robo'),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'place_text', array(
		  'label' => __( 'Place Text' ),
		  'section' => 'content_section',
		  'type'=>'text'
		) );



		$wp_customize->add_setting('city_link_text', array(
		  'default' => __('','robo'),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'city_link_text', array(
		  'label' => __( 'Show All City Link' ),
		  'section' => 'content_section',
		  'type'=>'text'
		) );



		/*** Social Media Section **/

		$wp_customize->add_section('footer_section',array(
			'title'=> __('Footer Settings','robo'),
			'priority'=>10,
		));

		$wp_customize->add_setting('fb_section', array(
		  'default' => __('https://www.facebook.com/','robo'),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'fb_section', array(
		  'label' => __( 'FB Link' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );

		$wp_customize->add_setting('twitter_section', array(
		  'default' => __ ( 'https://www.google.com/', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'twitter_section', array(
		  'label' => __( 'Twitter Link', 'robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );


		$wp_customize->add_setting('instragram_section', array(
		  'default' => __('https://twitter.com/','robo'),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'instragram_section', array(
		  'label' => __( 'Instragram Link','robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );


		$wp_customize->add_setting('pinterest_section', array(
		  'default' => __( 'https://www.pinterest.com/', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'pinterest_section', array(
		  'label' => __( 'Pinterest Link','robo'),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );



		$wp_customize->add_setting('google_section', array(
		  'default' => __( 'https://www.google.com/', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'google_section', array(
		  'label' => __( 'Google Plus Link','robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );

		$wp_customize->add_setting('email_section', array(
		  'default' => __( '', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'email_section', array(
		  'label' => __( 'Email','robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );

		$wp_customize->add_setting('phone_section', array(
		  'default' => __( '', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'phone_section', array(
		  'label' => __( 'Phone','robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );

		$wp_customize->add_setting('app_store', array(
		  'default' => __( '', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'app_store', array(
		  'label' => __( 'App Store Link','robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );

		$wp_customize->add_setting('play_store', array(
		  'default' => __( '', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'play_store', array(
		  'label' => __( 'Play Store Link','robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );

		$wp_customize->add_setting('copyright_section', array(
		  'default' => __( '&copy; 2020 visgo.llc.', 'robo' ),
		  'transport'=>'refresh'
		) );

		$wp_customize->add_control( 'copyright_section', array(
		  'label' => __( 'Copy Right Text','robo' ),
		  'section' => 'footer_section',
		  'type'=>'text'
		) );
  }
}

new Theme_Customizer();