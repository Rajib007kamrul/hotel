<?php
add_action( 'admin_init', 'add_meta_boxes' );

function add_meta_boxes() {
    add_meta_box( 'post_metabox', __( 'Post Information', 'visgo' ), 'visgo_post_meta', [ 'post', 'city', 'place' ] );
    add_meta_box( 'place_metabox',__( 'Place Information', 'visgo' ),'visgo_place_meta', [ 'place' ] );
    add_meta_box( 'slider_metabox',__( 'Slider Information', 'visgo' ),'visgo_slider_meta', [ 'slider' ] );
}

function visgo_post_meta() {
	global $post;
	$is_post_featured = get_post_meta( $post->ID, 'is_post_featured', true );
	if ( empty( $is_post_featured ) ) {
		$is_post_featured = 0;
	}
	?>
	<table>
		<tbody>
			<tr>
				<td>
					Is Feature Post
					<label>
						<input type="radio" name="is_post_featured" value="1" <?php checked( $is_post_featured, '1' ); ?>>
						<?php esc_attr_e( 'YES', 'visgo' ); ?>
					</label>
					<label>
						<input type="radio" name="is_post_featured" value="0" <?php checked( $is_post_featured, '0' ); ?>>
						<?php esc_attr_e( 'NO', 'visgo' ); ?>
					</label>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}

function visgo_place_meta() {
	global $post;
	$place_distance = get_post_meta( $post->ID, 'place_distance', true );
	$place_time     = get_post_meta( $post->ID, 'place_time', true );
	$place_name     = get_post_meta( $post->ID, 'place_name', true );
	$place_status     = get_post_meta( $post->ID, 'place_status', true );
?>
	<table>
		<tbody>
			<tr class="form-field">
				<td>
					<label> Place Name </label>
					<input type="text" name="place_name" value="<?php if( isset( $place_name ) ) { echo $place_name; } ?>">
				</td>
			</tr>
			<tr class="form-field">
				<td>
					<label> Place Status </label>
					<input type="text" name="place_status" value="<?php if( isset( $place_status ) ) { echo $place_status; } ?>">
				</td>
			</tr>
			<tr class="form-field">
				<td>
					<label> Distance </label>
					<input type="text" name="place_distance" value="<?php if( isset( $place_distance ) ) { echo $place_distance; } ?>">
				</td>
				<td>
					<label> Time </label>
					<input type="text" name="place_time" value="<?php if( isset( $place_time ) ) { echo $place_time; } ?>">
				</td>
			</tr>
		</tbody>
	</table>
<?php
}

function save_post_field( $post_id, $post ) {
	if( 'post' == $post->post_type || 'city' == $post->post_type || 'place' == $post->post_type  ) {
		if( isset( $_POST['is_post_featured'] ) ) {
    		update_post_meta( $post_id, 'is_post_featured', $_POST['is_post_featured'] );
    	}
    }
}

add_action( 'save_post', 'save_post_field', 10, 2 );

function save_place_field( $post_id, $post ) {
	if( 'place' != $post->post_type )
		return ;

	if( isset( $_POST['place_distance'] ) ) {
		update_post_meta( $post_id, 'place_distance', $_POST['place_distance'] );
	}

	if( isset( $_POST['place_time'] ) ) {
		update_post_meta( $post_id, 'place_time', $_POST['place_time'] );
	}

	if( isset( $_POST['place_name'] ) ) {
		update_post_meta( $post_id, 'place_name', $_POST['place_name'] );
	}

	if( isset( $_POST['place_status'] ) ) {
		update_post_meta( $post_id, 'place_status', $_POST['place_status'] );
	}
}

add_action( 'save_post', 'save_place_field', 10, 2 );

remove_filter('the_content', 'wpautop');

function visgo_slider_meta() {
	global $post;
	$slider_extra_image_id = get_post_meta( $post->ID, 'slider_extra_image_id', true );
	$image  = "";
 	if( $slider_extra_image_id !== "" ) {
			$image_link = wp_get_attachment_url( $slider_extra_image_id, "full" );
			$image        = '<img src="'.$image_link.'" alt="" style="max-width:100%;"/>';
 	}
?>

	<style type="text/css">
		.work-thumbinail-container{ max-width: 260px; max-height: 260px;overflow: hidden; }
		.work-thumbinail-container img{width: 100%; height: 100%;}
		.hidden{display: none;}
	</style>

	<div class="slider-thumbinail-container">
		<?php echo $image; ?>
	</div>

	<input type="hidden" class="slider_extra_image_id" name="slider_extra_image_id" value="<?php echo $slider_extra_image_id; ?>">
	<a href="javascript:void(0);" class="upload-work-thumbinail <?php if ( $slider_extra_image_id !== "" ){ echo 'hidden'; } ?> "> Upload Thumbnail</a>
	<a href="javascript:void(0);" class="delete-work-thumbinail <?php if ( $slider_extra_image_id === "" ) { echo 'hidden'; } ?> "> Remove Thumbnail </a>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var frame,
			metaBox      = $('#slider_metabox'),
			addImgLink   = metaBox.find('.upload-work-thumbinail'),
			delImgLink   = metaBox.find('.delete-work-thumbinail'),
			imgContainer = metaBox.find( '.slider-thumbinail-container'),
			imgIdInput   = metaBox.find('.slider_extra_image_id');
			// ADD IMAGE LINK
		  	addImgLink.on( 'click', function( event ){
		  		event.preventDefault();
		  		// If the media frame already exists, reopen it.
		    	if ( frame ) {
		      		frame.open();
		      		return;
		      	}
		      	// Create a new media frame
		    	frame = wp.media({
		      		title: 'Select or Upload Media for your work Thumbnail',
		      		button: {
		        		text: 'Add Image'
		      		},
		      		multiple: false  // Set to true to allow multiple files to be selected
		    	});
		    	frame.on( 'select', function() {
		    		// Get media attachment details from the frame state
		    	    var attachment = frame.state().get('selection').first().toJSON();
		    	    // Send the attachment URL to our custom image input field.
		    	    imgContainer.append( '<img src="'+attachment.url+'" alt="" style="max-width:100%;" />' );
		    	    // Send the attachment id to our hidden input
		    	    imgIdInput.val( attachment.id );
		    	    // Hide the add image link
		    	    addImgLink.addClass( 'hidden' );
		    	    // Unhide the remove image link
		    	    delImgLink.removeClass( 'hidden' );
		    	});
		    	// Finally, open the modal on click
		    	frame.open();
		    });

		    // DELETE IMAGE LINK
	      	delImgLink.on( 'click', function( event ){
	        	event.preventDefault();
	        	// Clear out the preview image
	        	imgContainer.html( '' );
	        	// Un-hide the add image link
	        	addImgLink.removeClass( 'hidden' );
	        	// Hide the delete image link
	        	delImgLink.addClass( 'hidden' );
	        	// Delete the image id from the hidden input
	        	imgIdInput.val( '' );
	      	});
		});
	</script>

<?php
}

function save_slider_field(  $post_id, $post ) {
	if( 'slider' != $post->post_type )
		return ;

	$slider_extra_image_id = "";

	if ( isset( $_POST[ "slider_extra_image_id"] ) ) {
        $slider_extra_image_id = $_POST["slider_extra_image_id"];
    }

    update_post_meta( $post_id, "slider_extra_image_id", $slider_extra_image_id );
}

add_action( 'save_post', 'save_slider_field', 10, 2 );