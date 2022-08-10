<article class="h-entry post-<?php the_ID(); ?>" id="post-<?php the_ID(); ?>">
  <?php // Entry Meta ?>
  <figure>
    <a href="<?php the_permalink(); ?>" rel="bookmark">
      <?php setup_postdata($post); ?>
      <?php the_post_thumbnail( 'medium', ['class' => 'u-photo'] ); ?>
    </a>
  </figure> 
<div>
  <h3 class="p-name"><a class="link u-url" href="<?php the_permalink(); ?>"
      rel="bookmark"><?php the_title(); ?></a></h3>
  <p class="p-summary"><?= wp_strip_all_tags( get_the_excerpt(), true ) ?></p>
  <time class="dt-published"
    datetime="<?php echo get_post_time( 'Y-n-j' ); ?>"><?php echo get_post_time( 'F j, Y' ); ?></time>
</div>

</article>
