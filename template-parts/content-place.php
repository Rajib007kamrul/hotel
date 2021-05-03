<?php
    global $post;
    $place_name     = get_post_meta( $post->ID, 'place_name', true );
    $place_status     = get_post_meta( $post->ID, 'place_status', true );
?>
<div class="row border no-gutters mb-4 mb-md-5  shadow">
    <div class="col-lg-6 ">
        <div class="single-city-img mx-auto ">
        <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'visgo_place_list_image', [ 'class' => 'img-fluid' ] );
            }
        ?>
        </div>
    </div>
    <div class="col-lg-6 ">
        <div class="single-feature-city-main px-3 px-md-4 mx-auto">
            <div class="single-feature-city-content">
                <div class="review-star">
                <?php
                    // $comment_number = get_comments_number( $post->ID );
                    // if( $comment_number > 0 ) {
                    //     $average = floor( visgo_comment_rating_get_average_ratings( $post->ID ) ); 
                    //         for ( $i = 1; $i <= 5; $i++ ) {
                    //             if( $i <= $average ) {
                    //                 echo "<i class='fas fa-star'></i>";
                    //             } else {
                    //                echo "<i class='far fa-star'></i>";
                    //             }
                    //         }
                        ?>
                        <!-- <div class="review-num d-inline">&#40; <?php //echo get_comments_number($post->ID); ?>  &rpar;</div> -->
                <?php //} ?>
                    <!-- <a href=""><i class="far fa-heart float-right"></i></a> -->
                    <?php echo get_simple_likes_button( get_the_ID(), 0 ); ?>
                </div>
                <h3 class="single-feature-city-inner-tittle"> <?php the_title(); ?>  </h3>
                <h6 class="single-feature-city-inner-tittle mb-3 border-bottom"> <?php if( isset( $place_name ) ) { echo $place_name; } ?> </h6>
                <div class="single-feature-city-bottom-content">
                    <h6 class="font-size-16 poppins"> <?php echo visgo_strip_shortcode_gallery( wp_trim_words(get_the_content(), 40 ) ); ?> </h6>
                    <div class="single-feature-city-bottom-recommend poppins">
                        <h4 class="d-inline font-size-16">  <?php if( isset( $place_status ) & !empty( $place_status) ) { echo '<i class="fas fa-check mr-2"></i>'. $place_status; } ?>   </h4>
                        <div class="single-feature-city-view-details d-inline">
                            <a href="<?php the_permalink(); ?>">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Col-lg-4-->
</div>