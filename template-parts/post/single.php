<?php
/**
 * Partial to display a single post
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_post_thumbnail(); ?>
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>
  <div class="entry-content">
	<?php the_content(); ?>
	</div>

</article>
