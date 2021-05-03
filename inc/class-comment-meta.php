<?php

if ( ! class_exists( 'Visgo_Comment_Meta' ) ) {

	class Visgo_Comment_Meta {

		public function __construct() {
	 		add_action( 'comment_form_logged_in_after', [ $this, 'visgo_comment_rating_rating_field' ] );
			add_action( 'comment_form_after_fields', [ $this, 'visgo_comment_rating_rating_field' ] );
			add_action( 'comment_post', [ $this, 'visgo_comment_rating_save_comment_rating' ] );
			//Make the rating required.
			add_filter( 'preprocess_comment', [ $this, 'visgo_comment_rating_require_rating' ] );
			//Display the rating on a submitted comment.
			add_filter( 'comment_text', [ $this, 'visgo_comment_rating_display_rating' ] );

			//Enqueue the plugin's styles.
			add_action( 'wp_enqueue_scripts', [ $this, 'visgo_comment_rating_styles' ] );
		}

	  	 public static function init() {
		    static $instance =false;

		    if ( ! $instance ) {
		        $instance = new self();
		    }

		    return $instance;
		 }

		public function visgo_comment_rating_rating_field () {
			if ( 'place' == get_post_type() ) { 
		?>
			<label for="rating">Rating<span class="required">*</span></label>
			<fieldset class="comments-rating">
				<span class="rating-container">
					<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
						<input type="radio" id="rating-<?php echo esc_attr( $i ); ?>" name="rating" value="<?php echo esc_attr( $i ); ?>" /><label for="rating-<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></label>
					<?php endfor; ?>
					<input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label for="rating-0">0</label>
				</span>
			</fieldset>
			<?php }
		}

			//Save the rating submitted by the user.
		public function visgo_comment_rating_save_comment_rating( $comment_id ) {
			if ( ( isset( $_POST['rating'] ) ) && ( '' !== $_POST['rating'] ) )  {
				$rating = intval( $_POST['rating'] );
				add_comment_meta( $comment_id, 'rating', $rating );
			}
		}

		public function visgo_comment_rating_require_rating( $commentdata ) {
			if ( 'place' == get_post_type() ) {
				//if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( $_POST['rating'] ) ) )
				wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
			}

			return $commentdata;
		}

		public function visgo_comment_rating_display_rating( $comment_text ){

			if ( $rating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
				$stars = '<div class="review-star">';
				for ( $i = 1; $i <= 5; $i++ ) {
			        if( $i <= $rating ) {
                        $stars .='<i class="fas fa-star"></i>';
                    } else {
                       $stars .='<i class="far fa-star"></i>';
                    }
				}
				$stars .= '</div>';
				$comment_text = $comment_text . $stars;
				return $comment_text;
			} else {
				return $comment_text;
			}
		}

		public function visgo_comment_rating_styles() {
			if( is_single() )  {
				wp_register_style( 'visgo-comment-rating-styles', get_template_directory_uri() . '/assets/css/comments.css' );
				wp_enqueue_style( 'dashicons' );
				wp_enqueue_style( 'visgo-comment-rating-styles' );
			}
		}
	}

	Visgo_Comment_Meta::init();
}