<?php
    global $post;
    $author_id = get_post_field( 'post_author', $post->ID );
    $author    = get_the_author_meta( 'user_nicename', $author_id );
    $catgeories  = get_the_category();
?>
<div class="col-md-12">
    <div class="single-blog-post-inner">
        <h2 class="single-blog-tittle text-center font-size-54 poppins"> <?php the_title(); ?> </h2>

        <div class="single-post-author-details d-flex justify-content-center poppins pt-4">
             <p class="s-p-author-name mr-1 font-size-18 text-center">
                <?php echo $author; ?> | <?php echo get_the_date( 'M Y' ); ?> </p>
             <a href="" class="s-p-category font-size-18 text-center">
             <?php foreach ($catgeories as $category ) {
                 echo $category_link = sprintf(
                    '<a href="%1$s" alt="%2$s">%3$s</a>',
                    esc_url( get_category_link( $category->term_id ) ),
                    esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                    esc_html( $category->name )
                );
             } ?>
         </a>
        </div>
    </div>

    <div class="featured-img text-center py-4 py-md-5">
        <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail', [ 'class' => 'img-fluid' ] );
            }
        ?>
    </div>
</div>

<div class="col-md-10 mx-auto mt-2 mt-md-5">
    <div class="row">
        <div class="col-md-1 ">
            <div class="icon-bar-social">
                <ul>
                    <li> <a href="#" class="facebook"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/Icon.svg" alt=""></a></li>
                    <li><a href="#" class="font-size-18 poppins font-weight-600">225 <br />
                        <span class="font-size-16">Likes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="twitter">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Comment.svg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#" class="twitter">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Share.svg" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-11">
            <div class="content pl-0 pl-md-3">
                <p class="poppins">
                    <?php echo visgo_strip_shortcode_gallery( get_the_content() ); ?>
                </p>
               <?php  if ( $gallery = get_post_gallery( get_the_ID(), false ) ) : ?>
                <div class="media-slider py-4">
                    <div class="single-blog-post-small-img">
                        <?php
                            $imageIds = explode( ',', $gallery['ids'] );
                            foreach( $imageIds as $imageId ) {
                                $image = wp_get_attachment_image_src( $imageId, 'large' );
                            ?>
                            <div class="single-blog-post-small-img-one">
                                <img src="<?php echo $image[0]; ?>" alt="" />
                                <h5 class="single-blog-post-small-img-name pt-3 pt-md-4"> <?php echo get_the_title( $imageId ); ?> </h5>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php endif; ?>
            </div>

            <!--- author --->
            <div class="author-social border-top border-bottom py-3 mt-5">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="autor-img pr-3">
                            <?php echo get_avatar( $comment, 80, 'avatar_default', '', [ 'class' => 'd-flex mr-3 rounded-circle']  ); ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Photo.png" alt="">
                        </div>

                        <div class="author-details">
                            <h4>Author</h4>
                            <h2><?php echo $author; ?></h2>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex align-items-center justify-content-start d-md-flex align-items-md-center justify-content-md-end social pt-4 pt-md-0">
                        <h4 class="pr-3 ">Share this article:</h4>
                        <a href=""> <i class="fab fa-facebook"></i></a>
                        <a href=""> <i class="fab fa-twitter"></i></a>
                        <a href=""> <i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <!--- End author -->
            <?php
                if ( comments_open() || get_comments_number() ) :
                   comments_template();
                endif;
            ?>
        </div>
    </div>
</div>