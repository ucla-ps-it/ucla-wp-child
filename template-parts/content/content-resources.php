<?php
/**
 * Custom template for displaying resources
 *
 * Used for index or list of resources.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 **/

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php
		get_template_part( 'template-parts/header/featured-image' );

	  get_template_part( 'template-parts/header/entry-header' );

  ?>


		<?php

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

		<div class="entry-content">
			<?php if( get_field('r-alt-name') ): ?>
			<p class="standfirst"><?php echo esc_html( get_field('r-alt-name') ); ?></p>
			<?php endif; ?>


			<?php if( get_field('r-summary') ): ?>
			<p class="p-summary"><?php echo esc_html( get_field( 'r-summary' ) ); ?></p>
			<?php endif; ?>

			<?php if( get_field('r-status') ): ?>
			<p><b>Status</b>: <?php echo esc_html( get_field( 'r-status' ) ); ?></p>
			<?php endif; ?>
		</div>
		

</article>
