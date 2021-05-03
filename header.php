<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body>
  <?php
    $class = "navbar navbar-expand-lg navbar-dark fixed-top";
    $logo = get_theme_mod( 'logo_upload' );
    $white_logo = get_theme_mod( 'white_logo_upload' );
    if ( empty( $logo ) ) {
      $logo = get_template_directory_uri() . '/assets/img/logo.svg';
    }
    if ( empty( $white_logo ) ) {
      $white_logo = get_template_directory_uri() . '/assets/img/white-logo.svg';
    }
  ?>
  <nav <?php body_class( $class ); ?> id="mainNav">
    <div class="container-fluid">
      <?php 
        if( is_home() || is_front_page() ) { ?>

          <a class="navbar-brand js-scroll-trigger" href="<?php echo home_url('/'); ?>">
            <img class="header-logo d-none d-lg-block" src="<?php echo $white_logo; ?>" alt="" />
            <img class="header-logo d-lg-none" src="<?php echo $logo; ?>" alt="" />
          </a>

        <?php } else { ?>

          <a class="navbar-brand js-scroll-trigger" href="<?php echo home_url('/'); ?>">
            <img class="header-logo" src="<?php echo $logo; ?>" alt="" />
          </a>

        <?php } ?>


      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar top-bar"></span>
        <span class="icon-bar middle-bar"></span>
        <span class="icon-bar bottom-bar"></span>
      </button>

    <?php
          $defaults = array(
            'visgo_location'  => 'primary',
            'container_id'    => 'navbarsExampleDefault',
            'container'       => 'div',
            'container_class' => 'navbar-collapse collapse',
            'items_wrap'      => '<ul class="navbar-nav text-uppercase ml-auto pb-3 pb-lg-0 mt-2 mt-lg-0 pt-2 pt-lg-0" %2$s">%3$s</ul>',
          );

          wp_nav_menu( $defaults );
      ?>
    </div>
  </nav>