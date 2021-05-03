<?php get_header(); ?>

  <!-- Start Blog  -->
  <div class="blog-section">
    <div class="container">
      <h2 class="blog-tittle font-size-54 text-capitalize text-center">  </h2>
    </div>
  </div>
  <!-- End Blog  -->

<div class="feature-cites feature-cites-page font-muli pt-5">
    <div class="container">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'post' );
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
		?>
	</div>
</div>

<?php get_footer(); ?>