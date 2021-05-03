<?php
    global $post;
    $place_distance = get_post_meta( $post->ID, 'place_distance', true );
    $place_time     = get_post_meta( $post->ID, 'place_time', true );
    $place_image    = get_the_post_thumbnail_url( $post->ID, 'visgo_place_feature_image' );
?>
<div class="col-lg-3 col-md-6">
  <div class="single-iconic-place"
    style="background-image: url( <?php if( isset( $place_image ) ) { echo esc_url( $place_image ); } ?>);">
    <div class="single-iconic-place-content align-self-end">
      <h2 class="text-white font-size-30">  <?php the_title(); ?> </h2>
      <div class="iconic-place-time d-flex text-white font-size-16">
        <div class="iconic-place-time-left mr-3 ">
          <i class="fas fa-walking"></i> <?php echo $place_distance; ?>
        </div>
        <div class="iconic-place-time-right">
          <i class="far fa-clock"></i> <?php echo $place_time; ?>
        </div>
      </div>
    </div>
  </div>
</div>