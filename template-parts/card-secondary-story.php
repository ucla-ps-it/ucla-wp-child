<article class="story__secondary-card">
  <?php // Entry Meta ?>
  <a class="story__secondary-card-link" href="<?php echo get_permalink( $post->ID ); ?>">
    <?php the_post_thumbnail( 'thumbnail', ['class' => 'story__secondary-card-image'] ); ?>
    <h3 class="story__secondary-card-title"><span class="story__secondary-title-text"><?php the_title(); ?></span></h3>
  </a>
  <?php // Entry content ?>
  
  <div class="story__secondary-card-content">
  <?php the_excerpt('mb-32', ['class' => 'story__secondary-card-blurb']); ?>
  </div>

</article>
