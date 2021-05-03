<div class="tranding-blog-section">
  <div class="container">
    <div class="trending-blog-main">

<?php
  $args = array(
    'post_type'  => 'post',
    'meta_query' => array(
      array(
        'key'     => 'is_post_featured',
        'value'   => '1'
      ),
    ),
  );

  $query =  new WP_Query( $args );

  if( $query->have_posts() ):
      while( $query->have_posts() ) : $query->the_post();
      global $post;
    ?>
        <div class="single-trending-blog">
          <div class="row poppins">
            <div class="col-lg-6 col-md-12">
                <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail', [ 'class' => 'img-fluid p-4' ] );
                    }
                ?>
            </div>
            <div class="col-lg-6 col-md-12 py-3 py-md-5 pr-3 pr-md-5">
              <div class="single-trending-blog-content">
                <h6 class="tranding-tag font-size-18">#TrendingArticle</h6>
                <h3 class="single-trending-post-tittle font-size-22"> <?php the_title(); ?> </h3>
                <p class="single-trending-post-text font-size-16 pb-4"> <?php echo visgo_strip_shortcode_gallery( wp_trim_words( get_the_content(), 40 ) ); ?> </p>
                <a href="<?php the_permalink();?>" class="read-more-btn">Read More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      <?php
          endwhile;

          else:

          endif;
      ?>
      </div>
    </div>
  </div>

