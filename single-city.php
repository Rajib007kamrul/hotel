<?php get_header(); ?>

<div class="single-blog-post">
    <div class="container">
        <!-- Start single-blog-post-inner -->
        <div class="row">
            <?php
                if( have_posts() ):
                    get_template_part( 'template-parts/content-single', 'city' );
                else:
                    get_template_part( 'template-parts/content', 'none' );
                endif;
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>