<div class="entry-content">
  <?php // Entry Meta ?>
  <time class="OFFmb-8" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>

  <?php // Entry content ?>
  <h2 class="OFFmb-8"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php the_title(); ?></a></h2>
  <?php the_excerpt('OFFmb-32'); ?>
</div>
