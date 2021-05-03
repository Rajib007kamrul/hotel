<?php

class Theme_Shortcode {

  	public function __construct() {
      add_shortcode( 'post_list', [ $this, 'post_list_render' ] );
      add_shortcode( 'feature_post', [ $this, 'feature_post_render' ] );
      // City List
  		add_shortcode( 'city_list', [ $this, 'city_list_render' ] );
      // Place List
  		add_shortcode( 'place_list', [ $this, 'place_list_render' ] );
      //Feature Place
      add_shortcode( 'feature_place', [ $this, 'feature_place_render' ] );
      // Feature City
      add_shortcode( 'feature_city', [ $this, 'feature_city_render' ] );
  	}

    public function post_list_render( $atts, $content = "" ) {
      extract( shortcode_atts( [], $atts ) );
      ob_start();
      get_template_part('template-parts/contentpostby','category');
      return ob_get_clean();
    }

    public function feature_post_render( $atts, $content = "" ) {
      extract( shortcode_atts( [], $atts ) );
      ob_start();
      get_template_part('template-parts/content','featured');
      return ob_get_clean();
    }

  	public function city_list_render( $atts, $content = "" ) {
    	extract( shortcode_atts( [], $atts ) );
    	ob_start();
      echo '<div class="row">';
       get_template_part('template-parts/content','city');
      echo "</div>";
		  return ob_get_clean();
  	}

  	public function place_list_render( $atts, $content = "" ) {
    	extract( shortcode_atts( [], $atts ) );
    	ob_start();
      ?>
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
      <?php 
      return ob_get_clean();
  	}

  	public function feature_place_render( $atts, $content = "" ) {
  		extract( shortcode_atts( [], $atts ) );
    	ob_start();
?>
<div class="iconic-place font-muli">
  <div class="container-fluid">
    <h2 class="iconic-place-tittle tex-left "> <?php echo __('Iconic Places','visgo'); ?> </h2>
    <?php get_custom_featured_post( 'place', 'featuredplace' ); ?>
  </div>
</div>
    <?php
		return ob_get_clean();
  	}

  	public function feature_city_render( $atts, $content = "" ) {
  		extract( shortcode_atts( [], $atts ) );
    	ob_start();
?>
<div class="feature-cites font-muli">
  <div class="container-fluid">
    <h2 class="feature-cites-tittle tex-left "> <?php echo __('Featured Cities','visgo'); ?> </h2>
      <?php get_template_part('template-parts/content','featuredcity'); ?>
    </div>
</div>
    <?php
		return ob_get_clean();
  	}
}

new Theme_Shortcode();
