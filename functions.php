<?php

if ( ! function_exists( 'visgo_setup' ) ) {
    function visgo_setup() {
		load_theme_textdomain( 'visgo', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_image_size( 'visgo_blog_thumbnail', 376, 190 );
		add_image_size( 'visgo_compettion_thumbnail', 470, 245 );
		add_image_size( 'visgo_blog_full', 900, 300 );

		add_image_size( 'visgo_city_feature_image', 360,350,true );
		add_image_size( 'visgo_place_feature_image', 360,350,true );
		add_image_size( 'visgo_place_list_image', 570,300,true );
		add_image_size( 'visgo_place_single_image', 550,300,true );

		add_editor_style();
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'visgo' ),
			'footer' => esc_html__( 'footer Menu', 'visgo' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-logo', array(
		   'flex-width' => false,
		   'height'     => 80,
	   	   'width'      => 250,
		) );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tar_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_image_size( 'feature_blog', 684, 355, false );
		add_image_size( 'blog_post', 380, 150, false );
		add_image_size( 'feature_competition', 684, 355, false );
		add_image_size( 'competition_post', 684, 355, false );
		add_image_size( 'competition_single_post', 684, 355, false );
    }
}

add_action( 'after_setup_theme', 'visgo_setup' );

if ( ! function_exists( 'visgo_widgets_init' ) ) {
    function visgo_widgets_init() {
    	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'visgo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Sidebar Widget', 'visgo'),
			'before_widget' => '<div id="%1$s" class="card my-4 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="card-header">',
			'after_title'   => '</h2>',
		) );
    }
}

add_action( 'widgets_init', 'visgo_widgets_init' );

if ( ! function_exists( 'visgo_scripts' ) ) {
    function visgo_scripts() {
    	global $wp_query;

    	wp_enqueue_style( 'visgo_style_css', get_template_directory_uri() . '/style.css');
    	wp_enqueue_style( 'visgo_bootstrp_css', get_template_directory_uri() . '/assets/css/vendor/bootstrap.min.css');
    	wp_enqueue_style( 'visgo_all_css', get_template_directory_uri() . '/assets/css/all.min.css');
    	wp_enqueue_style( 'visgo_sal_css', get_template_directory_uri() . '/assets/css/vendor/sal.css');
    	wp_enqueue_style( 'visgo_slick_css', get_template_directory_uri() . '/assets/css/vendor/slick.min.css');
    	wp_enqueue_style( 'visgo_slick_themecss', get_template_directory_uri() . '/assets/css/vendor/slick-theme.min.css');
    	wp_enqueue_style( 'visgo_main_css', get_template_directory_uri() . '/assets/css/main.css');

    	wp_enqueue_script( 'jquery' );
    	wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'visgo_bootstrap_js', get_template_directory_uri() . '/assets/js/vendor/bootstrap.bundle.min.js', ['jquery'],true);
		wp_enqueue_script( 'visgo_easing_js', get_template_directory_uri() . '/assets/js/vendor/jquery.easing.min.js',['jquery'],'1.0.0',true);
		wp_enqueue_script( 'visgo_slick_js', get_template_directory_uri() . '/assets/js/vendor/slick.min.js',['jquery'],'1.0.0',true);
		wp_enqueue_script( 'visgo_sal_js', get_template_directory_uri() . '/assets/js/vendor/sal.js',['jquery'],'1.0.0',true);
		wp_enqueue_script( 'visgo_main_js', get_template_directory_uri() . '/assets/js/main.js',['jquery'],'1.0.0',true);
		wp_enqueue_script( 'visgo_custom_js', get_template_directory_uri() . '/assets/js/custom.js',['jquery'],'1.0.0',true);
		wp_enqueue_script('comment-reply');

		wp_localize_script( 'visgo_custom_js', 'visgo',
			array(
				'ajaxurl'        => admin_url( 'admin-ajax.php' ),
				'nonce'          => wp_create_nonce( "visgo-nonce" )
			)
		);
    }
}

add_action( 'wp_enqueue_scripts', 'visgo_scripts' );

function visgo_nav_class( $classes, $item ){
    $classes[] = "nav-item";
    return $classes;
}

add_filter( 'nav_menu_css_class' , 'visgo_nav_class' , 10 , 2 );

function visgo_class_to_all_menu_anchors( $atts ) {
    $atts['class'] = 'nav-link js-scroll-trigger';
    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'visgo_class_to_all_menu_anchors', 10 );

add_filter( 'body_class','visgo_body_classes' );

function visgo_body_classes( $classes ) {
    if ( is_home() || is_front_page() ) {
      $classes[] = 'homepage-navabr';
    } else {
      $classes[] = 'citynav';
    }

    return $classes;
}

add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );

function add_loginout_link( $items, $args ) {
	$header_audio_link = get_theme_mod( 'header_audio_link' );

    if ( !empty( $header_audio_link ) ) {
    	$items .= '<li class="nav-item"><a href="'. $header_audio_link .'" class="btn btn-pink mt-2">Create your audio guide</a></li>';
    }
    
    return $items;
}

add_action( 'init', 'register_post' );

function register_post() {
	// $city_arr  = array( 'supports' => array( 'title', 'editor', 'thumbnail' ), 'has_archive' => true );
	// $city      = new post_type( 'City', 'city', $city_arr );
	// $city_tax_arr = array( "cityCategories" => array( 'singular_name' => 'City Category', 'query_var'=> true  ) );
	// $city->taxonomies( 'city', $city_tax_arr );

	$place_arr = array( 'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ), 'has_archive' => true );
	$place     = new post_type( 'Place', 'place', $place_arr );
	$place_tax_arr = array( "placeCategories" => array( 'singular_name' => 'Place Category', 'query_var'=> true ) );
	$place->taxonomies( 'place', $place_tax_arr );

	$slider_arr = array( 'supports' => array( 'title', 'editor', 'thumbnail' ), );
	$slider     = new post_type( 'Slider', 'slider', $slider_arr );
}

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);

    return $content;
});

function template_chooser( $template ) {
  global $wp_query;
	$post_type = get_query_var('post_type');
	$category  = get_query_var('catcity');
	$search    = get_query_var('s');

  if( $wp_query->is_search && $post_type == 'place' ) {
    return locate_template('archive-place.php');  //  redirect to archive-search.php
  }

  if( $wp_query->is_search && $category == 'placecategories' ) {
    return locate_template('archive-city.php');  //  redirect to archive-search.php
  }

  return $template;
}
add_filter('template_include', 'template_chooser');

function themeslug_query_vars( $qvars ) {
    $qvars[] = 'catcity';
    return $qvars;
}
add_filter( 'query_vars', 'themeslug_query_vars' );

add_filter( 'body_class', function( $classes ) {
	if( is_home() || is_front_page() ) {
		$classes[] = 'homepage-navabr';
	} else {
		$classes[] = 'citynav';
	}
    return $classes;
} );

require get_template_directory() . '/inc/class-ajax.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/Shortcode.php';
require get_template_directory() . '/inc/custom_post.php';
require get_template_directory() . '/inc/functions.php';
require get_template_directory() . '/inc/class-visgo-walker-comment.php';
require get_template_directory() . '/inc/class-tax-meta.php';
require get_template_directory() . '/inc/class-tax-meta-media.php';
// require get_template_directory() . '/inc/class-comment-meta.php';
require get_template_directory() . '/inc/post-meta.php';
require get_template_directory() . '/inc/class-wp-bootstrap-comments.php';