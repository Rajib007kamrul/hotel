<?php get_header(); ?>
  <?php get_template_part('searchformcity'); ?>
<!-- Start Feature Cities-->
<div class="feature-cites feature-cites-page font-muli pt-5">
  <div class="container">
      <?php get_template_part('template-parts/content','city'); ?>
  </div>
</div>
<!--End single-feature-city-main row-->
<?php get_footer(); ?>