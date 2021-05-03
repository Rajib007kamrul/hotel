<?php
	get_header();
	get_template_part('template-parts/content','slider');
?>
<div class="feature-cites font-muli">
  <div class="container-fluid">
    <h2 class="feature-cites-tittle tex-left "> <?php echo __('Featured Cities','visgo'); ?> </h2>
    <?php get_template_part('template-parts/content','featuredcity'); ?>
    </div>
</div>

<div class="iconic-place font-muli">
  <div class="container-fluid">
    <h2 class="iconic-place-tittle tex-left "> <?php echo __('Iconic Places','visgo'); ?> </h2>
      <?php
       // get_custom_featured_post( 'place', 'featuredplace' );
        $args = array(
          'post_type' => 'place',
          'posts_per_page' => 4,
          'meta_query' => array(
            array(
              'key'     => 'is_post_featured',
              'value'   => '1'
            ),
          ),
        );
        $place_query = new WP_Query( $args );
        if ( $place_query->have_posts() ) :
        echo '<div class="row ">';
          while ( $place_query->have_posts() ) : $place_query->the_post();
            get_template_part('template-parts/content','featuredplace');
          endwhile;
        echo '</div>';
          // wp_reset_postdata();
          echo '<a href="'.get_post_type_archive_link( "place" ) .'" class="all-city-btn mt-3"> Show all Place  </a>';
        else :
         get_template_part( 'template-parts/content', 'none' );
        endif;
      ?>
  </div>
</div>

<?php
      get_template_part( 'template-parts/content', 'contact' );
      get_footer();
?>