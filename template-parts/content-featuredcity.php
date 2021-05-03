    <?php
        $taxonomies = get_terms( array(
            'taxonomy' => 'placecategories',
            'number'  => 4,
            'hide_empty' => false,
            'meta_query' => array(
                 array(
                    'key'       => 'is_tax_featured',
                    'value'     => 1,
                    'compare'   => '='
                 )
            )
        ) );

        if ( !empty( $taxonomies ) ) {
            echo '<div class="row ">';
            foreach ( $taxonomies as $category ) {
                $image_id = get_term_meta( $category->term_id, 'category-image-id', true );
                if(  !empty( $image_id ) ) {
                    $category_image = wp_get_attachment_url( $image_id, 'visgo_city_feature_image' );
                }
            ?>
                <div class="col-lg-3 col-md-6">
                  <div class="single-feature-city  single-feature-city-bg-1" style="background-image: url( <?php if( isset( $category_image ) ) {
                        echo esc_url( $category_image );
                    } ?>);">
                    <div class="single-feature-city-content align-self-end">
                      <h2 class="text-white font-size-45">
                            <a href=" <?php echo esc_url( get_term_link( $category )); ?> " >  <?php echo $category->name; ?> </a> </h2>
                      <p class="text-white font-size-24"> <?php echo $category->count; ?> audio guide</p>
                    </div>
                  </div>
                </div>
        <?php
            }
            echo '<a href="'. esc_url( get_theme_mod( 'city_link_text') ) .'" class="all-city-btn mt-3"> Show all cities  </a>';
            echo "</div>";
        }
    ?>