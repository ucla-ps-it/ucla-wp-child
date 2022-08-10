<header class="header">
  <div class="front-page-hero">

    <div class="front-page-hero__image">
      <img src="<?php if ( has_post_thumbnail() ) { echo $image; } ?>" alt="">
    </div>

    <div class="front-page-hero__info">
      <div class="front-page-hero__info--wrap">

        <h1 class="front-page-hero__title"><?php the_title(); ?></h1>

        <?php //edit_post_link(); ?>

          <?php  $key_values = get_post_custom_values( 'intro' );

            if (is_array($key_values) || is_object($key_values)) {
              echo '<p class="front-page-hero__intro">';
              foreach ( $key_values as $key => $value ) {
                echo $value;
              }
              echo '</p>';
            }
          ?>

      </div>
    </div>
  </div>
</header>
