<?php  get_header(); ?>

<?php get_search_form(); ?>

<!-- Start Feature Cities-->
<div class="feature-cites feature-cites-page font-muli pt-5">
    <div class="container">
        <!--Start single-feature-city-main row-->
        <div class="single-city-main-inner  mt-3 mt-lg-4 pb-3 pb-md-5">
            <?php
                if( have_posts() ) : ?>

                <!--Start feature-cites-page-tittle-->
                <div class="feature-cites-page-tittle">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-cites-tittle-left">
                                <h2 class="feature-cites-tittle text-left font-size-30 poppins font-size-30 "> <?php visgo_place_text(); ?>
                                </h2>
                                <h6>Showing  results</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!--End feature-cites-page-tittle-->
                <div class="single-city-main-inner  mt-3 mt-lg-4 pb-3 pb-md-5">  
            <?php
                    while( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', 'place' );
                    endwhile;
                echo "</div>";
                else:
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                visgo_pagination();
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>