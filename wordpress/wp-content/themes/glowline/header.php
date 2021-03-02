<!DOCTYPE html>
<html <?php language_attributes(); ?> >
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />   
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php    wp_head();   ?>
  </head>
  <body <?php body_class(); ?>>
    <?php wp_body_open();?>
 <!--Main Header Start -->
    <div class="header-wrapper" id="header">
      <!-- Top Header Start -->
      <header>
        <a class="skip-link screen-reader-text" href="#page"><?php _e( 'Skip to content', 'glowline' ); ?></a>
        <div class="container">
          <div class="header">
            <!-- Logo Start -->
        <div class="logo">

      <?php glowline_the_custom_logo(); ?>
          <?php
           if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php else : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php endif; ?>
        </div>
            <!-- Menu Start -->
            <div id="main-menu-wrapper">
              <a href="#" id="pull" class="toggle-mobile-menu"></a>
              <nav class="navigation clearfix mobile-menu-wrapper">
                <?php glowline_nav_menu(); ?>
              </nav>
			 				<!-- search Start -->
							<div id="searchform-wrap" class="main-searchform-wrap"> 
			<?php  get_template_part( 'search','form'); ?>
			</div> 
          </div>
             </div>
               </div>
                  </header>
