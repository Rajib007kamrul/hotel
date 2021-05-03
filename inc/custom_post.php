<?php

/* Custom Post Type Class */

class post_type{

	public function __construct( $name, $singluar_name, $args ){
		$this -> register_post_type($name, $singluar_name, $args);
	}

	//Registering Post Types
	public function register_post_type( $name, $singluar_name, $args ) {

	    $args = array_merge(
			array(
				'labels' => array(
							'name' 			=> _x( $name, '' ),
							'singular_name' => _x( $singluar_name, ''),
							'add_new'		=> _x( "Add New $singluar_name", ''),
							'add_new_item' 	=> _x( "Add New $singluar_name", ''),
							'edit_item' 	=> __( "Edit $singluar_name", '' ),
							'new_item' 		=> __( "New $singluar_name", '' ),
							'view_item' 	=> __( "View $singluar_name", '' ),
							'search_items' 	=> __( "Search $name", ''),
							'not_found' 	=> __( "No $name found", ''),
							'all_items' => __( "All $name", '' ),
							'not_found_in_trash' 	=> __("No $name found in Trash", '' ),
							'parent_item_colon' 	=> __( '', ''),
							'menu_name' 	=>  _x( $name, '' )
						  ),
				'public' 	=> true,
				'show_in_rest' => true,
				'query_var' => strtolower($singluar_name),
				'hierarchical' => true,
				'rewrite' 	=> array('slug' => $name),
				// 'menu_icon' =>	admin_url().'images/media-button-video.gif',
            //	'supports' 	=> array('title','editor')
				'supports' 	=> array(''),

			),
			$args
	    );

		register_post_type(strtolower($name),$args);
	}

	//Taxonomies
	public function taxonomies( $post_types, $tax_arr ) {

		$taxonomies = array();

		foreach ($tax_arr as $name => $arr){

			$singular_name = $arr['singular_name'];

			$labels = array(
					'name' => _x( $name, '' ),
					'singular_name' => _x( $singular_name, '' ),
					'add_new' => _x( "Add New $singular_name", '' ),
					'add_new_item' => _x( "Add New $singular_name", '' ),
					'edit_item' => __( "Edit $singular_name", '' ),
					'new_item' => __( "New $singular_name", '' ),
					'view_item' => __( "View $singular_name", '' ),
					'update_item' => __( "Update $singular_name", ''),
					'search_items' => __( "Search $name", '' ),
					'not_found' => __ ( "$name Not Found", '' ),
					'not_found_trash' => __ ( "$name Not Found in Trash", '' ),
					'all_items' => __( "All $name", '' ),
					'separate_items_with_comments' => __( "Separate tags with commas", '' )
			);

			$defaultArr = array(
				'hierarchical' => true,
				'query_var' => true,
				'rewrite' => array('slug' => $name),
				'labels' => $labels,
				'show_in_rest' => true
			);

			$taxonomies[$name] =  array_merge($defaultArr, $arr);
		}

		$this->register_all_taxonomies( $post_types, $taxonomies );
	}

	public function register_all_taxonomies( $post_types, $taxonomies ) {
		foreach( $taxonomies as $name => $arr ) {
			register_taxonomy(strtolower($name),strtolower($post_types), $arr);
		}
	}
}