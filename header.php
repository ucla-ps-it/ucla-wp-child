<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <div id="skip-nav" class="skip-nav" role="navigation" aria-label="Skip navigation">
    <a class="button" href="#menu">Skip to Navigation</a>
    <a class="button mobile" href="#primary-ham">Skip to Navigation</a>
    <a class="button" href="#main">Skip to Main Content</a>
    <a class="button" href="#footer">Skip to Footer Links</a>
  </div>

  <header id="header">
    <div class="header-logo">
      <div class="header-logo__wrap">
        <a href="http://ucla.edu"><img class="header-logo__image" src="/wp-content/themes/ucla-ps-wp/images/ucla_logo_white.svg" alt="UCLA Logo" /></a>
      </div>
    </div>
    <div class="ucla campus header">
      <div class="site-name">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
      </div>

      <?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
      <div id="menu-secondary">
        <?php wp_nav_menu( array(
          'theme_location' => 'secondary-menu',
          'depth' => 1,
          'container_class' => 'nav-secondary',
          'container_id' => 'nav-second',
          'menu_id' => 'nav-secondary__list',
          'menu_class' => 'nav-secondary__list',
          'container_aria_label' => 'Secondary Menu',
          'list_class' => 'nav-secondary__item',
          'link_class' => 'nav-secondary__link'
        )) ?>
      </div>
      <?php } ?>
        <?php if ( has_nav_menu( 'main-menu' ) ) { ?>
          <nav id="menu">
            <button id="primary-ham" class="hamburger" type="button" aria-label="Menu" aria-controls="navigation" alt="navigation and search">
              <span class="hamburger__box">
                <span class="hamburger__inner"></span>
              </span>
            </button>
      
            
            <nav id="nav-main" class="nav-primary" aria-label="Main Menu">
              <ul class="nav-primary__list" id="menu-primary-menu">
                <?php
                wp_nav_menu( array(
                  'theme_location' => 'main-menu',
                  'container' => false,
                  'depth' => 2,
                  // 'menu_class' => 'nav-primary__list',
                  'items_wrap' => '%3$s',
                  'walker' => new ucla_header_menu_walker()
                ));
                if ( has_nav_menu( 'secondary-menu' ) ) { 
                  wp_nav_menu( array(
                    'theme_location' => 'secondary-menu',
                    'depth' => 1,
                    'items_wrap' => '%3$s',
                    'list_class' => 'nav-secondary__item',
                    'link_class' => 'nav-secondary__link',
                    'container' => false
                  ));
                }
                ?>
              </ul>
            </nav>
            
        </nav>
      
      <?php } // end if has_nav_menu ?>

      


      </div>
    </div>

    <!-- <div id="search"></div> -->

  </header>