<div class="col-lg-6 col-md-12 pb-5 pb-md-5">
	<div class="row">
	  <div class="col-md-5 col-lg-6 col-12 mx-auto">
	  	<?php
    		if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'thumbnail', [ 'class' => 'img-fluid' ] );
			}
		?>
	  </div>
	  <div class="col-md-6 col-12">
	    <a href="<?php the_permalink(); ?>"> <h4 class="blog-travel-tips-tittle mt-3 mt-md-0 font-size-22 poppins"> <?php the_title(); ?> </h4>  </a>

	    <div class="travel-tips-post-details  ">
	      <h5 class="text-left blog-travel-tips-name font-size-16 poppins border-bottom pb-2 "> </h5>
	      <p class="tips-five-min d-inline font-size-16 poppins">
	        5 min read |
	      </p>
	      <p class="tips-post-time d-inline font-size-16 poppins">
	        <?php echo get_the_date( 'M Y' ); ?>
	      </p>
	      <a href="<?php the_permalink(); ?>"><i class="far fa-heart float-right mt-2"></i></a>
	    </div>
	  </div>
	</div>
</div>
