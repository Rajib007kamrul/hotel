<?php

if ( ! class_exists( 'Visgo_Tax_Meta' ) ) {

class Visgo_Tax_Meta {

	public function __construct() {
		add_action( 'placecategories_add_form_fields', [ $this, 'add_feature_field' ], 10, 2 );
		add_action( 'created_placecategories', [ $this, 'save_feature_meta' ], 10, 2 );
		add_action( 'placecategories_edit_form_fields', [ $this, 'edit_feature_field' ], 10, 2 );
		add_action( 'edited_placecategories', [ $this, 'update_feature_meta' ], 10, 2 );
		add_filter('manage_edit-placecategories_columns', [ $this, 'add_feature_column' ] );
		add_filter('manage_placecategories_custom_column', [ $this, 'add_feature_column_content' ], 10, 3 );
	}

	 public static function init() {
	    static $instance =false;

	    if ( ! $instance ) {
	        $instance = new self();
	    }

	    return $instance;
	 }


	public function add_feature_field( $taxonomy ) {
    ?>

    	<div class="form-field term-group">
	        <label for="featuret-group"> <?php _e('Extra Name', 'my_plugin'); ?>  </label>
			<input type="text" name="tax_extra_name" value="">
	    </div>

	    <div class="form-field term-group">
	        <label for="featuret-group"> <?php _e('Extra Second Name', 'my_plugin'); ?>  </label>
			<input type="text" name="tax_extra_second_name" value="">
	    </div>

	    <div class="form-field term-group">
	        <label for="featuret-group"><?php _e('Is Feature Category', 'my_plugin'); ?>
				<input type="radio" name="is_tax_featured" value="1">
				<?php esc_attr_e( 'YES', 'visgo' ); ?>
				<input type="radio" name="is_tax_featured" value="0" checked>
				<?php esc_attr_e( 'NO', 'visgo' ); ?>
			</label>
	    </div>

		<?php
	}

	public function save_feature_meta( $term_id, $tt_id ){
	    if( isset( $_POST['is_tax_featured'] ) ){
	        $feature = $_POST['is_tax_featured'] ;
	        add_term_meta( $term_id, 'is_tax_featured', $feature, true );
	    }

	    if( isset( $_POST['tax_extra_name'] ) ){
	        $tax_extra_name = $_POST['tax_extra_name'] ;
	        add_term_meta( $term_id, 'tax_extra_name', $tax_extra_name, true );
	    }

	    if( isset( $_POST['tax_extra_second_name'] ) ){
	        $tax_extra_second_name = $_POST['tax_extra_second_name'] ;
	        add_term_meta( $term_id, 'tax_extra_second_name', $tax_extra_second_name, true );
	    }

	    

	}

	public function  edit_feature_field( $term, $taxonomy ) {
		 $is_tax_featured = get_term_meta( $term->term_id, 'is_tax_featured', true );
		 $tax_extra_name = get_term_meta( $term->term_id, 'tax_extra_name', true );
		 $tax_extra_second_name = get_term_meta( $term->term_id, 'tax_extra_second_name', true );

    ?>
       	<tr class="form-field term-group">
    		<td> <label for="featuret-group"><?php _e('Extra Name', 'my_plugin'); ?> </label> </td>

			<td>
				<input type="text" name="tax_extra_name" value=" <?php if( isset( $tax_extra_name ) ) { echo $tax_extra_name; } ?>" >
			</td>
	    </tr>

	    <tr class="form-field term-group">
    		<td> <label for="featuret-group"><?php _e('Extra Second Name', 'my_plugin'); ?> </label> </td>

			<td>
				<input type="text" name="tax_extra_second_name" value=" <?php if( isset( $tax_extra_second_name ) ) { echo $tax_extra_second_name; } ?>" >
			</td>
	    </tr>

    	<tr class="form-field term-group">
    		<td> <label for="featuret-group"><?php _e('Is Feature Category', 'my_plugin'); ?> </label> </td>

			<td>
				<input type="radio" name="is_tax_featured" value="1" <?php checked( $is_tax_featured, '1' ); ?> >
				<?php esc_attr_e( 'YES', 'visgo' ); ?>
				<input type="radio" name="is_tax_featured" value="0" <?php checked( $is_tax_featured, '0' ); ?> >
				<?php esc_attr_e( 'NO', 'visgo' ); ?>
			</td>
	    </tr>
	<?php
	}

	public function update_feature_meta( $term_id, $tt_id ){
	 	if( isset( $_POST['is_tax_featured'] ) ){
	 		$feature = $_POST['is_tax_featured'] ;
        	update_term_meta( $term_id, 'is_tax_featured', $feature );
    	}

    	if( isset( $_POST['tax_extra_name'] ) ){
	 		$tax_extra_name = $_POST['tax_extra_name'] ;
        	update_term_meta( $term_id, 'tax_extra_name', $tax_extra_name );
    	}

    	if( isset( $_POST['tax_extra_second_name'] ) ){
	 		$tax_extra_second_name = $_POST['tax_extra_second_name'] ;
        	update_term_meta( $term_id, 'tax_extra_second_name', $tax_extra_second_name );
    	}
	}

	public function add_feature_column( $columns ){
	    $columns['feature'] = __( 'Featured', 'my_plugin' );
	    $columns['extra_name'] = __( 'Extra Name', 'my_plugin' );
	    $columns['extra_second_name'] = __( 'Extra Second Name', 'my_plugin' );

	    return $columns;
	}

	public function add_feature_column_content( $content, $column_name, $term_id ){

		if( $column_name == 'extra_name' ){
	        $term_id = absint( $term_id );
	    	$tax_extra_name = get_term_meta( $term_id, 'tax_extra_name', true );
	        $content .= $tax_extra_name;
	    	return $content;
    	}

    	if( $column_name == 'extra_second_name' ){
	        $term_id = absint( $term_id );
	    	$tax_extra_second_name = get_term_meta( $term_id, 'tax_extra_second_name', true );
	        $content .= $tax_extra_second_name;
	    	return $content;
    	}
    	
    	if( $column_name == 'feature' ){
	        $term_id = absint( $term_id );
	    	$feature = get_term_meta( $term_id, 'is_tax_featured', true );
	        $content .= ( $feature == 1) ? 'Yes' : 'NO';
	    	return $content;
    	}

    	return $content;
	}
}
	Visgo_Tax_Meta::init();
}