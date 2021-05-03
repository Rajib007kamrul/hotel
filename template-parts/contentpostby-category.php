  <?php

    $categories = get_terms( array(
        'taxonomy' => 'category',
        'parent'   => 0
    ) );

    if( !empty( $categories ) ) {
        foreach ($categories  as $category ) {
  ?>
    <!-- Start Blog Travel Tips -->
  <div class="blog-travel-tips ">
    <div class="container">
      <div class="blog-travel-tips-inner">
        <div class="row ">
          <div class="col-md-3 col-5">
            <h2 class="blog-travel-tips-inner-tittle text-left"> <?php echo $category->name; ?> </h2>
          </div>
          <div class="col-md-9  col-7 pt-3 pt-md-2 ">
            <hr>
          </div>
        </div>
        <!--Start Travel-tips row One -->
        <div class="row">
            <?php

                $args=array(
                    'posts_per_page' => -1,
                    'post_type'      => 'post',
                    'tax_query'      => array(
                      array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    => $category->term_id,
                      ),
                  ),
                );

                $query = new WP_Query( $args );

                if( $query->have_posts() ):
                  while( $query->have_posts() ) : $query->the_post();
                      get_template_part( 'template-parts/content' );
                  endwhile;
                else:
                      get_template_part( 'template-parts/content', 'none' );
                endif;
            ?>
        </div>
        <!--End Travel-tips row One -->
      </div>
    </div>
  </div>
  <!-- End Blog Travel Tips -->
    <?php
        }
    }
?>