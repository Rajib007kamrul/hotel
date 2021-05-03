<?php /* Template Name: Blog Template */ get_header(); ?>

  <!-- Start Blog  -->
  <div class="blog-section">
    <div class="container">
      <h2 class="blog-tittle font-size-54 text-capitalize text-center">Our Blog</h2>
    </div>
  </div>
  <!-- End Blog  -->

  <?php get_template_part('template-parts/content','featured'); ?>
  <?php get_template_part('template-parts/contentpostby','category'); ?>
  <?php get_template_part( 'template-parts/content', 'contact' ); ?>

<?php get_footer(); ?>