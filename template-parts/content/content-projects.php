<?php
/**
 * Custom template for displaying projects
 *
 * Used for index or list of projects.
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
		
		//edit_post_link();

		// Single bottom post meta.
		//twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

		<div class="entry-content">
			<?php if( get_field('proj-alt-name') ): ?>
			<p class="standfirst"><?php echo esc_html( get_field('proj-alt-name') ); ?></p>
			<?php endif; ?>


			<?php if( get_field('proj-summary') ): ?>
			<p class="p-summary"><?php echo esc_html( get_field( 'proj-summary' ) ); ?></p>
			<?php endif; ?>

			<?php if( get_field('proj-status') ): ?>
			<p><b>Status</b>: <?php echo esc_html( get_field( 'proj-status' ) ); ?></p>
			<?php endif; ?>
		</div>
		

</article>
