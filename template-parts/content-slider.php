
  <div class="Slider-main-area">
    <div class="carousel-container">
      <div class="carousel carousel--tabbed">
        <?php
          $args = array(
            'post_type' => 'slider',
            'posts_per_page' => 4
          );

          $query = new WP_Query( $args );
          $titles = [];
        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post();
            global $post;
            $titles[$post->ID]  = $post->post_title;
            $featured_img_url   = get_the_post_thumbnail_url(get_the_ID(),'full');
            $slider_extra_image = get_post_meta( $post->ID, 'slider_extra_image_id', true );
            if(  !empty( $slider_extra_image ) ) {
                $featured_second_img_url = wp_get_attachment_url( $slider_extra_image, 'full' );
            }
      ?>

      <div class="carousel__item masthead" style="background-image: url( <?php echo esc_url( $featured_img_url ); ?> );">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-7 d-flex align-items-center">
                <div class="intro-text text-center text-md-left">
                  <h2 class="intro-heading"> <?php the_title(); ?> </h2>
                  <?php 
                    $phrase = wp_trim_words( get_the_content(), 40 );
                    $phrase = apply_filters('the_content', $phrase);
                    $replace = '<p class="hero-para">';
                    echo str_replace('<p>', $replace, $phrase);
                  ?>
                </div>
              </div>
              <div
                class="col-md-5 d-flex align-items-center justify-content-center d-md-flex align-items-md-center justify-content-md-end ">
                <div class="slide-img">
                  <?php
                      if ( !empty( $featured_second_img_url ) ) {
                        echo'<img class="img-fluid my-4" src="'. $featured_second_img_url .'" alt="">';
                      } else {
                        echo '<img class="img-fluid my-4" src="'. get_template_directory_uri() .'/assets/img/Silver.png" alt="">';
                      }?>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php
          endwhile;
          // wp_reset_postdata();
        endif;
      ?>
      </div>
      <div class="indicator">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center">
              <?php if( !empty( $titles ) ) { ?>
                  <ul class="menu menu--tabbed ">
                    <?php foreach ($titles as $key => $value): ?>
                        <li><a href="#"> <?php echo $value; ?> </a></li>
                    <?php endforeach ?>
                  </ul>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>