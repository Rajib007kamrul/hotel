<!-- Start Footer-->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4 order-0 order-md-0">
                <div class="contact-us-text">
                    <h4 class="text-capitalize font-size-22"> <?php echo  __('contact us','visgo'); ?> </h4>
                    <p class="font-size-18"> <?php echo get_theme_mod('phone_section');?> </p>
                    <span> <?php echo get_theme_mod('email_section');?>  </span>
                    <div class="footer-social-icon">
                       <ul>
                        <a href=" <?php echo esc_url( get_theme_mod('fb_section') );?> "> <i class="fab fa-facebook-f"></i> </a>
                        <a href=" <?php echo esc_url( get_theme_mod('twitter_section') );?> "> <i class="fab fa-twitter"></i> </a>
                        <a href=" <?php echo esc_url( get_theme_mod('instragram_section') );?> "> <i class="fab fa-instagram"></i> </a>
                        <a href=" <?php echo esc_url( get_theme_mod('pinterest_section') );?> "> <i class="fab fa-pinterest"></i> </a>
                        <a href=" <?php echo esc_url( get_theme_mod('google_section') );?> "> <i class="fab fa-google-plus-g"></i> </a>
                    </div>
                </div>
            </div>
            <div class="col text-left text-md-center  mt-4 mt-md-4 mt-lg-0 order-3 order-md-1">
                <div class="footer-logo">
                    <?php
                        $footer_logo = get_theme_mod( 'footer_logo_upload' );
                        if ( empty( $footer_logo ) ) {
                          $footer_logo = get_template_directory_uri() . '/assets/img/logo.png';
                        }
                    ?>
                    <img src="<?php echo $footer_logo; ?>" alt="visgo" />
                    <p class="copyright-text"><?php echo get_theme_mod('copyright_section');?> </p>
                </div>
            </div>
            <div class="col-md-4 offset-0 offset-md-0 offset-lg-1  mt-4 mt-lg-0 order-2 order-md-3">
                <div class="footer-download-btn">
                    <h6> <?php echo __( 'Enjoy immersive audio guides to the world\'s most fascinating places.','visgo'); ?> </h6>
                    <div class="play-app-img d-flex">
                        <a href="<?php echo esc_url( get_theme_mod('app_store') );?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/app-store.png" alt="" /></a>
                        <a href="<?php echo esc_url( get_theme_mod('play_store') );?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/google-play.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
    </body>
  </html>