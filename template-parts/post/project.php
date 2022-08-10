<?php
/**
 * Partial to display a project
*/
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php
		get_template_part( 'template-parts/header/featured-image' );

	  get_template_part( 'template-parts/header/entry-header' );

  ?>
		<?php
		//edit_post_link();

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>
<?php

	if ( is_single() ) {
		?>

<?php if( get_field('proj-alt-name') ): ?>
	<p class="standfirst"><?php echo esc_html( get_field('proj-alt-name') ); ?></p>
<?php endif; ?>

<?php if( get_field('proj-summary') ): ?>
	<p class="p-summary lede"><b>Summary</b>: <?php echo esc_html( get_field( 'proj-summary' ) ); ?></p>
<?php endif; ?>

	<div class="e-content">
			<?php the_content(); ?>

			<?php 
				// display project website
				$link = get_field('proj-website'); 
				if( $link ): ?>
					<p><a class="button" href="<?php echo esc_url( $link ); ?>">Project Website</a></p>
				<?php endif; ?>
			
			<?php if( get_field('proj-start-date') ): ?>
				<time datetime="<?php echo custom_html_datetime( get_field( 'proj-start-date' ) ); ?>"><b>Project Date</b>: <?php echo get_field( 'proj-start-date' ) ; ?></time>
				<?php endif; ?>
				<?php if( get_field('proj-end-date') ): ?>
				 to <time datetime="<?php echo custom_html_datetime( get_field( 'proj-end-date' ) ); ?>"> <?php echo get_field( 'proj-end-date' ) ; ?></time>
				<?php endif; ?>

				

			<?php 
				// display projects status
				if( get_field_object('proj-status') ): 
				$project_status = get_field_object('proj-status');
				$project_status_value = $project_status['value'];
				$project_status_label = $project_status['choices'][ $project_status_value ];
				?>
				<p><b>Status</b>: <?php echo esc_html( $project_status_value ); ?></p>
				<?php endif; ?>
        
        
			
				
        <?php
				// display project authors
        $authors = get_field('proj-authors');
        if( $authors ): ?>
				<div class="ucla-ps-c-authors">
        <p><b>Leadership</b></p>
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
				</div>
        <?php 
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata(); ?>
        <?php endif; ?>

				
			
				<div class="ucla-ps-c-citations">	
				<?php if( get_field('proj-doi') ): ?>
				<p><b>DOI:</b> <?php echo esc_html( get_field( 'proj-doi' ) ); ?></p>
				<?php endif; ?>
				<?php if( get_field('proj-citation') ): ?>
				<p><b>Citation:</b> <?php echo acf_esc_html( get_field( 'proj-citation' ) ); ?></p>
				<?php endif; ?>	
				</div>

				
				
				<?php
				// Check if ACF repeater rows exists for files.
				if( have_rows('proj-files') ):
				?>
				<div class="ucla-ps-c-file-list">
				<h3>Files</h3>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('proj-files') ) : the_row(); ?>
					<li>
						<?php 
								// https://www.advancedcustomfields.com/resources/file/
								$file = get_sub_field('proj-file'); 
								if( $file ): 
									// Extract values from file.
    							$url = $file['url'];
    							$title = $file['title'];
									$caption = $file['caption'];  // not displaying caption
									$description = "<span class=\"p-summary\">" . $file['description'] . "</span>"; // for displaying discription
								?>
								<a href="<?php echo esc_attr($url); ?>"><?php echo esc_attr($title); ?></a> 
								<?php echo $description; ?></span>

						<?php endif; ?>
					</li>
					<?php // End loop for files.
						endwhile; ?>
				</ul>
				</div>
				
				<?php endif; // end repeater for files ?>


				<?php
	// relationship for related resources
	$project_resources = get_field('proj-resources');
	if( $project_resources ): ?>
	<div class="ucla-ps-c-related-content">
	<h2>Resources</h2>
	<div class="h-feed">
	<?php foreach( $project_resources as $project_resource ): 
			$permalink = get_permalink( $project_resource->ID );
			$title = get_the_title( $project_resource->ID );
			$summary = get_field( 'r-summary', $project_resource->ID );
			$image = get_the_post_thumbnail($project_resource->ID, 'medium' );
			?>
			<article class="h-entry">
			<?php if($image) :?>
				<?php echo $image ?>
			<?php endif; ?>
			<header>
				<h3 class="p-name"><a class="u-url" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h3>
			</header>	
			<?php if($summary) :?>
				<p class="p-summary"><?php echo esc_html( $summary ); ?></p>
			<?php endif; ?>	
		
			</article>
		
	<?php endforeach; ?>
	</div>
	</div>

	<?php endif; ?>

				<?php
				// Check if ACF repeater rows exists for embedded media.
				if( have_rows('proj-embeds') ):
				?>
				
				<div class="ucla-ps-c-oembeds">
					<?php 	
					// Loop through rows
					while( have_rows('proj-embeds') ) : the_row(); ?>
						<figure>
							<?php if( get_sub_field('proj-embed-name') ):?>
							<figcaption><?php the_sub_field('proj-embed-name'); ?></figcaption>
							<?php endif; ?>
						<?php the_sub_field('proj-embed-url'); ?>
					</figure>
					<?php // End loop for embeds.
						endwhile; ?>
				</div>

				<?php endif; // end repeater for embed ?>	

						
				<?php 
				$images = get_field('proj-gallery');
				$size = 'medium'; // (thumbnail, medium, large, full or custom size)
				if( $images ): ?>
				<figure class="ucla-ps-c-gallery">
				<?php foreach( $images as $image ): ?>
					<?php echo wp_get_attachment_image( $image, $size, "", array( "class" => "ucla-ps-c-gallery-img" ) ); ?>
				<?php endforeach; ?>
				</figure>
				<?php endif; ?>



				<?php
				// Check if ACF repeater rows exists for funders.
				if( have_rows('proj-funders') ):
				?>
				<div class="ucla-ps-c-sponsors">
				<h2>Funders</h2>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('proj-funders') ) : the_row(); ?>
					<li>
						<?php 
							
								$project_funder_name = get_sub_field('proj-funder-name'); 
								$project_funder_description = get_sub_field('proj-funder-description'); 
								$project_funder_logo = get_sub_field('proj-funder-logo'); 
								$project_funder_website = get_sub_field('proj-funder-website'); 
								

								if( $project_funder_name &&  $project_funder_website ): 
									echo "<h3 class=\"p-name\"><a href=" . esc_url( $project_funder_website ) . ">" . $project_funder_name . "</a></h3>"; 
								elseif	( $project_funder_name):
									echo "<h3 class=\"p-name\">" . $project_funder_name . "</h3>"; 
								endif; 

								if( $project_funder_description ): 
									echo "<p class=\"p-summary\">" . $project_funder_description . "</p>"; 
								endif;

								if( $project_funder_logo  &&  $project_funder_website ): ?>
									<a href="<?php echo esc_url( $project_funder_website ); ?>">
									<?php	echo wp_get_attachment_image( $project_funder_logo, 'thumb' ); ?>
									</a>
								<?php	
								elseif ( $project_funder_logo ):
									echo wp_get_attachment_image( $project_funder_logo, 'thumb' ); 
								endif;
							?>	
					</li>
					<?php // End loop for funders.
						endwhile; ?>
				</ul>
				</div>		
				<?php endif; // end repeater for funders ?>



				<?php
				// Check if ACF repeater rows exists for partners.
				if( have_rows('proj-partners') ):
				?>
				<div class="ucla-ps-c-sponsors">
				<h2>Partners</h2>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('proj-partners') ) : the_row(); ?>
					<li>
						<?php 
								
								$project_partner_name = get_sub_field('proj-partner-name'); 
								$project_partner_description = get_sub_field('proj-partner-description'); 
								$project_partner_logo = get_sub_field('proj-partner-logo'); 
								$project_partner_website = get_sub_field('proj-partner-website'); 
								

								if( $project_partner_name &&  $project_partner_website ): 
									echo "<h3 class=\"p-name\"><a href=" . esc_url( $project_partner_website ) . ">" . $project_partner_name . "</a></h3>"; 
								elseif	( $project_partner_name):
									echo "<h3 class=\"p-name\">" . $project_partner_name . "</h3>"; 
								endif; 

								if( $project_partner_description ): 
									echo "<p class=\"p-summary\">" . $project_partner_description . "</p>"; 
								endif;
								if( $project_partner_logo  &&  $project_partner_website ): ?>
									<a href="<?php echo esc_url( $project_partner_website ); ?>">
									<?php	echo wp_get_attachment_image( $project_partner_logo, 'thumb' ); ?>
									</a>
								<?php	
								elseif ( $project_partner_logo ):
									echo wp_get_attachment_image( $project_partner_logo, 'thumb' ); 
								endif;
							?>	
					</li>
					<?php // End loop for partners.
						endwhile; ?>
				</ul>
						</div>
				<?php endif; // end repeater for partners ?>


				<?php
				// Check if ACF repeater rows exists for contributors.
				if( have_rows('proj-contributors') ):
				?>
				<div class="ucla-ps-c-sponsors">
				<h2>Contributors</h2>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('proj-contributors') ) : the_row(); ?>
					<li>
						<?php 
								
								$project_contributor_name = get_sub_field('proj-contributor-name'); 
								$project_contributor_description = get_sub_field('proj-contributor-description'); 
								$project_contributor_logo = get_sub_field('proj-contributor-logo'); 
								$project_contributor_website = get_sub_field('proj-contributor-website'); 
								

								if( $project_contributor_name &&  $project_contributor_website ): 
									echo "<h3 class=\"p-name\"><a href=" . esc_url( $project_contributor_website ) . ">" . $project_contributor_name . "</a></h3>"; 
								elseif	( $project_contributor_name):
									echo "<h3 class=\"p-name\">" . $project_contributor_name . "</h3>"; 
								endif; 

								if( $project_contributor_description ): 
									echo "<p class=\"p-summary\">" . $project_contributor_description . "</p>"; 
								endif;
								if( $project_contributor_logo  &&  $project_contributor_website ): ?>
									<a href="<?php echo esc_url( $project_contributor_website ); ?>">
									<?php	echo wp_get_attachment_image( $project_contributor_logo, 'thumb' ); ?>
									</a>
								<?php	
								elseif ( $project_contributor_logo ):
									echo wp_get_attachment_image( $project_contributor_logo, 'thumb' ); 
								endif;
							?>	
					</li>
					<?php // End loop for contributors.
						endwhile; ?>
				</ul>
					</div>
					
				<?php endif; // end repeater for contributors ?>
				
				<?php
					wp_reset_postdata();
	// relationship for related blog posts
	$related_blog_posts = get_field('proj-related-posts');
	if( $related_blog_posts ): ?>
	<div class="ucla-ps-c-related-content">
	<h2>Related Blog Posts</h2>
	<div class="h-feed">
	<?php foreach( $related_blog_posts as $related_blog_post ): 
			$blog_post_permalink = get_permalink( $related_blog_post->ID );
			$blog_post_title = get_the_title( $related_blog_post->ID );
			//$blog_post_excerpt = get_the_excerpt( $related_blog_post->ID );
			$blog_post_image = get_the_post_thumbnail($related_blog_post->ID, 'medium' );
			?>
			<article class="h-entry">
			<?php if($blog_post_image) :?>
				<?php echo $blog_post_image ?>
			<?php endif; ?>
			<header>
				<h1 class="p-name"><a class="u-url" href="<?php echo esc_url( $blog_post_permalink ); ?>"><?php echo esc_html( $blog_post_title ); ?></a></h1>
			</header>	
			<?php if($blog_post_excerpt) :?>
				<p class="p-summary"><?php echo esc_html( $blog_post_excerpt ); ?></p>
			<?php endif; ?>	
		
			</article>
		
	<?php endforeach; ?>
	</div>
	</div>

	<?php endif; ?>

	<?php  // Reset the global post object
  wp_reset_postdata(); ?>

	<?php
	// relationship for related projects
	$related_projects = get_field('proj-related-projects');
	if( $related_projects ): ?>
	<div class="ucla-ps-c-related-content">
	<h2>Related Projects</h2>
	<div class="h-feed">
	<?php foreach( $related_projects as $related_project ): 
			$permalink = get_permalink( $related_project->ID );
			$title = get_the_title( $related_project->ID );
			$summary = get_field( 'proj-summary', $related_project->ID );
			$image = get_the_post_thumbnail($related_project->ID, 'medium' );
			?>
			<article class="h-entry">
			<?php if($image) :?>
				<?php echo $image ?>
			<?php endif; ?>
			<header>
				<h1 class="p-name"><a class="u-url" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h1>
			</header>	
			<?php if($summary) :?>
			<p class="p-summary"><?php echo esc_html( $summary ); ?></p>
			<?php endif; ?>	
			</article>
	<?php endforeach; ?>
	</div>
	</div>
	<?php endif; ?>

	<?php  // Reset the global post object
  wp_reset_postdata(); ?>
	<?php
	// relationship for related events
	$related_events = get_field('proj-related-events');
	if( $related_events ): ?>
	<div class="ucla-ps-c-related-content">
	<h2>Related Events</h2>
	<div class="h-feed">
	<?php foreach( $related_events as $related_event ): 
			$permalink = get_permalink( $related_event->ID );
			$title = get_the_title( $related_event->ID );
			$summary = get_field( 'e-summary', $related_event->ID );
			$image = get_the_post_thumbnail($related_event->ID, 'medium' );
			$startdate = get_field( 'e-start-datetime', $related_event->ID );
			?>
			<article class="h-entry">
			<?php if($image) :?>
				<?php echo $image ?>
			<?php endif; ?>
			<header>
				<h1 class="p-name"><a class="u-url" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h1>
			</header>	
			<?php if($summary) :?>
				<p class="p-summary"><?php echo esc_html( $summary ); ?></p>
			<?php endif; ?>	
			<?php if($startdate) :?>
			<time datetime="<?php echo custom_html_datetime( get_field( 'e-start-datetime' ) ); ?>"><?php echo get_field( 'proj-start-date' ) ; ?></time>
			<?php endif; ?>
			</article>
		
	<?php endforeach; ?>
	</div>
	</div>
	<?php endif; ?>
				
				
				<?php if( get_field('r-copyright-year') ): ?>
				<p>© <?php echo custom_year( get_field( 'r-copyright-year' ) ); ?> <?php if( get_field('r-copyright-holder') ): ?>
				<?php echo esc_html( get_field( 'r-copyright-holder' ) ); ?>. All rights reserved.
				<?php endif; ?>	</p>
				<?php endif; ?>	
				
</div>
			



		<?php
		//get_template_part( 'template-parts/navigation' );

	}

	?>

</article><!-- .post -->
