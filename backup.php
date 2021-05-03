
        <!--Start single-feature-city-main row-->
            <?php
                // get_custom_post( 'place' );
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                  'post_type' => $post_type,
                  'posts_per_page' => !empty( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ): 10,
                  'paged' => $paged
                );
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) : ?>
        <!--Start feature-cites-page-tittle-->
        <div class="feature-cites-page-tittle">
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-cites-tittle-left">
                        <h2 class="feature-cites-tittle text-left font-size-30 poppins font-size-30 ">
                          Find New adventures in Egypt
                        </h2>
                        <h6>Showing <?php echo $query->post_count; ?> results</h6>
                    </div>
                </div>
            </div>
        </div>

        <!--End feature-cites-page-tittle-->
        <div class="single-city-main-inner  mt-3 mt-lg-4 pb-3 pb-md-5">                
                    <?php    
                    while ( $query->have_posts() ) : $query->the_post();
                         get_template_part( 'template-parts/content', 'place' );
                        endwhile;
                    echo "</div>";
                    //pagination
                    visgo_pagination();
                    //reset
                    wp_reset_postdata();
                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
            ?>
        </div>