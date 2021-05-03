<?php
  $category  = get_query_var('catcity');
  $search = get_query_var('s');

  $term_count_args = [
      'taxonomy'  => 'placecategories',
      'hide_empty' => false,
      'fields'    => 'count'
  ];



  if( $wp_query->is_search && $category == 'placecategories' ) {
    $term_count_args['search'] = $search;
  }

  $term_count = get_terms( $term_count_args );

  $terms_per_page = !empty( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ): 10;
  $max_num_pages  = ceil( $term_count / $terms_per_page );
  $current_page   = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
  $offset         = ( $terms_per_page * $current_page ) - $terms_per_page;

  $term_args = [
      'taxonomy' => 'placecategories',
      'hide_empty' => false,
      'number'   => $terms_per_page,
      'offset'   => $offset
  ];

  if( $wp_query->is_search && $category == 'placecategories' ) {
    $term_args['search'] = $search;
  }

  $taxonomies = get_terms( $term_args );

  if ( !empty( $taxonomies ) ) { ?>

  <!--Start feature-cites-page-tittle-->
  <div class="feature-cites-page-tittle">
    <div class="row">
      <div class="col-md-6">
        <div class="feature-cites-tittle-left">
          <h2 class="feature-cites-tittle text-left font-size-30 poppins font-size-30 ">
            <?php visgo_city_text(); ?>
          </h2>
          <h6>Showing <?php echo $term_count; ?> results</h6>
        </div>
      </div>
    </div>
  </div>
  <!--End feature-cites-page-tittle-->

  <div class="cities">
    <!--Start single-feature-city-main row-->
    <div class="row ">
      <?php  
        foreach ( $taxonomies as $category ) {
          $image_id = get_term_meta( $category->term_id, 'category-image-id', true ); 
          $tax_extra_name = get_term_meta( $category->term_id, 'tax_extra_name', true );
          $tax_extra_second_name = get_term_meta( $category->term_id, 'tax_extra_second_name', true );

          if(  !empty( $image_id ) ) {
              $category_image = wp_get_attachment_url( $image_id, 'visgo_city_feature_image' );
          }
      ?>

        <div class="col-lg-4 col-md-6">
          <div class="single-feature-city-main">
            <a href="<?php the_permalink();?>">
              <div class="single-feature-city " style="background-image: url( <?php if( isset( $category_image ) ) {
                echo esc_url( $category_image );
              } ?>);">
                <div class="single-feature-city-content align-self-end">
                  <h2 class="text-white font-size-45"> <a href=" <?php echo get_term_link( $category ) ?> "> <?php echo $category->name; ?> </a> </h2>
                  <p class="text-white font-size-24"> <?php echo $category->count; ?> audio guide</p>
                </div>
              </div>
            </a>

            <div class="single-feature-city-content">
              <h3 class="single-feature-city-content-tittle"> <?php if( isset( $tax_extra_name ) ) { echo $tax_extra_name; } ?> </h3>
              <h6 class="single-feature-city-content-tittle pb-3">  <?php if( isset( $tax_extra_second_name ) ) { echo $tax_extra_second_name; } ?></h6>
            </div>
          </div>
        </div>
    <?php
      }
      visgo_pagination( $max_num_pages );
      ?>
    </div>
  </div>
 <?php }
?>