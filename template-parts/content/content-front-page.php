<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 **/

?>

<article <?php post_class( 'h-entry entry-content' ); ?> id="post-<?php the_ID(); ?>">
  <?php

  if ( ! is_search() ) {
    get_template_part( 'template-parts/header/featured-image' );
  }	
	
  get_template_part( 'template-parts/header/entry-header' );

	?>
<?php
$content = get_the_content();
if ( strlen( $content ) > 0 ) {
  ?>
  <div class="e-content entry-content">

	<?php the_content(); ?>

  </div><!-- .entry-content -->
  <?php } ?>
</article><!-- .post -->