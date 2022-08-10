<?php
/**
 * Custom template for displaying people
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 **/

?>

<article <?php post_class('c-video'); ?> id="post-<?php the_ID(); ?>">
    
<?php if( get_field('ucla_ps_video_url') ):?>
  <?php the_field('ucla_ps_video_url'); ?>
<?php endif; ?>
		
    <div class="entry-content">
    <?php
    //get_template_part( 'template-parts/header/featured-image' );
    get_template_part( 'template-parts/header/entry-header' );
    ?>	
    


		</div><!-- .entry-content -->


</article><!-- .post -->
