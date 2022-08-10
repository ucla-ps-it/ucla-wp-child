<header class="page-header" <?php if (has_post_thumbnail()) { ?> style="background-image: url(<?php echo $thumbnail[0]; ?>);" <?php } ?>>
  <div class="ucla campus">
    <div class="col span_12_of_12">
      <?php if (is_404()) { ?>
        <div class="breadcrumb"><?php get_breadcrumb(); ?> / 404 Error</div>
        <h1 class="entry-title"><?php esc_html_e('Page Not Found', 'ucla'); ?></h1>
      <?php } else { ?>
        <div class="breadcrumb"><?php get_breadcrumb(); ?></div>
        <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php } ?>
     
      <p class="intro"><?php
      $key_values = get_post_custom_values( 'intro' );

      if (is_array($key_values) || is_object($key_values)) {
        echo '<p class="intro">';
        foreach ($key_values as $key => $value) {
          echo $value;
        }
        echo '</p>';
      }

      ?>

    </div>
  </div>
</header>