<?php
/**
 * Partial to display a resource
*/
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
		get_template_part( 'template-parts/header/featured-image' );
	  get_template_part( 'template-parts/header/entry-header' );
  ?>




	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		//edit_post_link();

		// Single bottom post meta.
		//twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {
		?>
	
		<div class="entry-content">

    <?php if( get_field('r-alt-name') ): ?>
		<p class="standfirst"><?php echo esc_html( get_field('r-alt-name') ); ?></p>
    <?php endif; ?>


			<?php if( get_field('r-summary') ): ?>
				<p class="p-summary"><?php echo esc_html( get_field( 'r-summary' ) ); ?></p>
			<?php endif; ?>
			
			<div class="e-content">
				<?php the_content(); ?>
				</div>
      <?php if( get_field('r-status') ): ?>
				<p><b>Status</b>: <?php echo esc_html( get_field( 'r-status' ) ); ?></p>
				<?php endif; ?>
        
        

				
        <?php
        $authors = get_field('r-authors');
        if( $authors ): ?>
        <p><b>Authors</b></p>
        <ul>
        <?php foreach( $authors as $post ): 
        // Setup this post for WP functions (variable must be named $post).
        setup_postdata($post); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php if( get_field( 'p-job-title' ) ): ?>
              <span class="p-job-title"><?php the_field( 'p-job-title' ); ?></span>
            <?php endif; ?>
            
            <?php if( get_field( 'p-org' ) ): ?>  
              <span class="p-org"><?php the_field( 'p-org' ); ?></span>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
        </ul>
        <?php 
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata(); ?>
        <?php endif; ?>


				<?php if( get_field('r-date-created') ): ?>
				<p><time datetime="<?php echo custom_html_datetime( get_field( 'r-date-created' ) ); ?>"><b>Date Created</b>: <?php echo get_field( 'r-date-created' ) ; ?></time></p>
				<?php endif; ?>
				<?php if( get_field('r-date-modified') ): ?>
				<p><time datetime="<?php echo custom_html_datetime( get_field( 'r-date-modified' ) ); ?>"><b>Date Last Modified</b>: <?php echo get_field( 'r-date-modified' ) ; ?></time></p>
				<?php endif; ?>
				
			
				<?php
				// Check if ACF repeater rows exists for files.
				if( have_rows('r-files') ):
				?>
				<p><b>Download Files:</b></p>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('r-files') ) : the_row(); ?>
					<li>
						<?php 
								// https://www.advancedcustomfields.com/resources/file/
								$file = get_sub_field('r-file'); 
								if( $file ): 
									// Extract values from file.
    							$url = $file['url'];
    							$title = $file['title'];
									$caption = $file['caption'];  // not displaying caption
									$description = $file['description']; // not displaying discription
								?>
								<a href="<?php echo esc_attr($url); ?>"><?php echo esc_attr($title); ?></a> 
								

						<?php endif; ?>
					</li>
					<?php // End loop for files.
						endwhile; ?>
				</ul>

				<?php endif; // end repeater for files ?>


						

					<?php
				// Check if ACF repeater rows exists for embedded media.
				if( have_rows('r-embeds') ):
				?>
				<p><b>oEmbeds:</b></p>
				
				<div class="ucla-ps-embed-container">
					<?php 	
					// Loop through rows
					while( have_rows('r-embeds') ) : the_row(); ?>
						<figure class="ucla-ps-embed-item">
							<?php if( get_sub_field('r-embed-name') ):?>
							<figcaption><?php the_sub_field('r-embed-name'); ?></figcaption>
							<?php endif; ?>
						<?php the_sub_field('r-embed-url'); ?>
					</figure>
					<?php // End loop for embeds.
						endwhile; ?>
				</div>

				<?php endif; // end repeater for embed ?>	

						
				<?php 
				$images = get_field('r-gallery');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $images ): ?>
				<p><b>Photo Gallery:</b></p>
				<figure class="ucla-ps-gallery">
				<?php foreach( $images as $image_id ): ?>
						
								<?php echo wp_get_attachment_image( $image_id, $size ); ?>
						
				<?php endforeach; ?>
				</figure>
				<?php endif; ?>
=
				<div class="ucla-ps-l-researchers">	
				<?php if( get_field('r-doi') ): ?>
				<p><b>DOI:</b> <?php echo esc_html( get_field( 'r-doi' ) ); ?></p>
				<?php endif; ?>
				<?php if( get_field('r-citation') ): ?>
				<p><b>Citation:</b> <?php echo esc_html( get_field( 'r-citation' ) ); ?></p>
				<?php endif; ?>	
				</div>

				<div class="ucla-ps-l-researchers">	
				<h2>Acknowledgements</h2>
				<?php if( get_field('r-contributor') ): ?>
				<p><b>Contributors:</b> <?php echo esc_html( get_field( 'r-contributor' ) ); ?></p>
				<?php endif; ?>
				<?php if( get_field('r-funder') ): ?>
				<p><b>Funders:</b> <?php echo esc_html( get_field( 'r-funder' ) ); ?></p>
				<?php endif; ?>	

				<?php if( get_field('r-partner') ): ?>
				<p><b>Partners:</b> <?php echo esc_html( get_field( 'r-partner' ) ); ?></p>
				<?php endif; ?>	


				
				
				<?php if( get_field('r-copyright-year') ): ?>
				<p>© <?php echo get_field( 'r-copyright-year' ) ; ?> <?php if( get_field('r-copyright-holder') ): ?>
				<?php echo esc_html( get_field( 'r-copyright-holder' ) ); ?>. All rights reserved.
				<?php endif; ?>	</p>
				<?php endif; ?>	
				
				</div>
				
	
</div> <!-- close resources block -->



		</div><!-- .entry-content -->
		<?php
		get_template_part( 'template-parts/navigation' );

	}

	?>

</article><!-- .post -->
