<!DOCTYPE html>
<html <?php language_attributes( 'en' ) ?>>
    <!-- head sandwitch -->
<head>
  <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<!-- body sandwitch -->
<body   <?php body_class() ?>>

<header class="site-header">
      <div class="container">
        <h1 class="school-logo-text float-left">
          <a href="<?php echo home_url('/'); ?>"><strong>Fictional</strong> University</a>
        </h1>
        <a href="<?php echo esc_url(site_url('/search')) ?>"  class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        <i  class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
        <div class="site-header__menu group">
          <nav class="main-navigation">
            <ul>
              <li <?php  echo (is_page('about-us') || wp_get_post_parent_id(get_the_ID(  )) === 16 ? 'class="current-menu-item"' : " " )   ?>  ><a href="<?php  echo esc_url(home_url('/about-us')); ?>">About Us</a></li>
              <li <?php  if(get_post_type('program') === 'program')  "class='current-menu-item'";  ?> ><a href="<?php echo get_post_type_archive_link( 'program' ) ?>">Programs</a></li>
              <li  <?php  if(get_post_type() ==="event" or is_page( 'past-events' )) { echo 'class="current-menu-item"'; } else { echo " "; };
              ?>   ><a href="<?php echo get_post_type_archive_link('event' ); ?>">Events</a></li>
              <li><a href="#">Campuses</a></li>
              <li <?php echo ( get_post_type() === 'post' ? 'class="current-menu-item"':" ")  ?>   ><a href="<?php echo esc_url( home_url( '/blog' ) ) ?>">Blog</a></li>
            </ul>
          </nav>
          <div class="site-header__util">
             <!-- check user logged in / not -->
             <?php
               
               if(is_user_logged_in()){ ?>
               <a href="<?php echo esc_url( home_url( '/my-notes' ) )  ?>" class="btn btn--small btn--orange float-left push-right">My Notes</a>
                <a href="<?php echo wp_logout_url('/') ?>" class="btn btn--small btn--dark-orange float-left btn--with-photo">
                  <span class="site-header__avatar"> <?php echo get_avatar( get_current_user_id(),60) ?>   </span>
                  <span class="btn__text">Log Out</span>
                </a>
                <?php
               }else{
                ?>
                <a href="<?php echo wp_login_url() ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
                <a href="<?php echo wp_registration_url() ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
               <?php }
             ?>

            
            
            <span href="<?php echo esc_url(site_url('/search')) ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
          </div>
        </div>
      </div>
    </header>
    
