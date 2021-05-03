<?php /* Template Name: Place Template */  get_header(); ?>

 <?php get_search_form(); ?>

<!-- Start Feature Cities-->
<div class="feature-cites feature-cites-page font-muli pt-5">
    <div class="container">

        <!--Start single-feature-city-main row-->
        <?php
            // get_custom_post( 'place' );
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
              'post_type' => 'place',
              'posts_per_page' => !empty( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ): 10,
              'paged' => $paged
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
        ?>

        <!--Start feature-cites-page-tittle-->
        
        <div class="feature-cites-page-tittle">
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-cites-tittle-left">
                        <h2 class="feature-cites-tittle text-left font-size-30 poppins font-size-30 ">  <?php visgo_place_text(); ?>
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
                //pagination
                visgo_pagination();
                //reset
                // wp_reset_postdata();
                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
            ?>
        </div>
    </div>
</div>
<!--End single-feature-city-main row-->
<?php get_template_part( 'template-parts/content', 'contact' ); ?>
<?php get_footer(); ?>