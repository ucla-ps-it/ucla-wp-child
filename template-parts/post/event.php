<?php
/**
 * Partial to display an event
*/
?>

<article <?php post_class("vevent"); ?> id="post-<?php the_ID(); ?>">

<?php
    get_template_part( 'template-parts/header/featured-image' );
    get_template_part( 'template-parts/header/entry-header' );

 

	if ( is_single() ) {
		?>
    <?php if( get_field('e-alt-name') ): ?>
	    <p class="standfirst"><?php echo esc_html( get_field('e-alt-name') ); ?></p>
    <?php endif; ?>

        <?php 
        $event_start = get_field('e-start-date'); 
  
        if ( $event_start ) : ?> 
				<time class="event-date" datetime="<?php echo custom_html_date( $event_start ) ; ?>"><?php echo custom_public_date( $event_start ); ?></time>
        <time class="event-time-start" datetime="<?php echo custom_html_time( $event_start ) ; ?>"><?php echo custom_public_time( $event_start ); ?></time>
				<?php endif; ?>
        
        <?php 
        $event_end_time = get_field('e-end-time'); 
       
        if ( $event_end_time ) : ?> 
          - <time class="event-time-end" datetime="<?php echo custom_html_time( $event_end_time ); ?>"><?php echo custom_public_time($event_end_time); ?></time>
				<?php endif; ?>
        <?php if( get_field('e-venue') ): ?>
    <p class="event-venue"><?php echo esc_html( get_field( 'e-venue' ) ); ?></p>
 	 <?php endif; ?>
        
        <?php 
				// display project website
        $rsvp_link = get_field('e-rsvp-link'); 
        $rsvp_text = get_field('e-rsvp-text'); 
				if( $rsvp_link ): ?>
					<p><a class="button" href="<?php echo esc_url( $rsvp_link ); ?>"><?php echo esc_html( $rsvp_text ); ?></a></p>
				<?php endif; ?>
        

  <?php if( get_field('e-summary') ): ?>
    <p class="p-summary lede"><?php echo esc_html( get_field( 'e-summary' ) ); ?></p>
  <?php endif; ?>



    <div class="e-content">
       <?php the_content(); ?>
			
			
		
        

				<?php
				// Check if ACF repeater rows exists for embedded media.
				if( have_rows('e-embeds') ):
				?>
				
				<div class="ucla-ps-c-oembeds">
					<?php 	
					// Loop through rows
					while( have_rows('e-embeds') ) : the_row(); ?>
						<figure>
							<?php if( get_sub_field('e-embed-name') ):?>
							<figcaption><?php the_sub_field('e-embed-name'); ?></figcaption>
							<?php endif; ?>
						<?php the_sub_field('e-embed-url'); ?>
					</figure>
					<?php // End loop for embeds.
						endwhile; ?>
				</div>

				<?php endif; // end repeater for embed ?>	

						
				<?php 
				$images = get_field('e-gallery');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $images ): ?>
				<figure class="ucla-ps-c-gallery">
				<?php foreach( $images as $image_id ): ?>
						
								<?php echo wp_get_attachment_image( $image_id, $size ); ?>
						
				<?php endforeach; ?>
				</figure>
				<?php endif; ?>

         

       

				<?php
				// Check if ACF repeater rows exists for funders.
				if( have_rows('e-sponsors') ):
				?>
				<div class="ucla-ps-c-sponsors">
				<h2>Sponsors</h2>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('e-sponsors') ) : the_row(); ?>
					<li>
						<?php 
							
								$event_sponsor_name = get_sub_field('e-sponsor-name'); 
								$event_sponsor_description = get_sub_field('e-sponsor-description'); 
								$event_sponsor_logo = get_sub_field('e-sponsor-logo'); 
								$event_sponsor_website = get_sub_field('e-sponsor-website'); 
								

								if( $event_sponsor_name &&  $event_sponsor_website ): 
									echo "<h3 class=\"p-name\"><a href=" . esc_url( $event_sponsor_website ) . ">" . $event_sponsor_name . "</a></h3>"; 
								elseif	( $event_sponsor_name):
									echo "<h3 class=\"p-name\">" . $event_sponsor_name . "</h3>"; 
								endif; 

								if( $event_sponsor_description ): 
									echo "<p class=\"p-summary\">" . $event_sponsor_description . "</p>"; 
								endif;

								if( $event_sponsor_logo  &&  $event_sponsor_website ): ?>
									<a href="<?php echo esc_url( $event_sponsor_website ); ?>">
									<?php	echo wp_get_attachment_image( $event_sponsor_logo, 'thumb' ); ?>
									</a>
								<?php	
								elseif ( $event_sponsor_logo ):
									echo wp_get_attachment_image( $event_sponsor_logo, 'thumb' ); 
								endif;
							?>	
					</li>
					<?php // End loop for sponsors.
						endwhile; ?>
				</ul>
				</div>		
				<?php endif; // end repeater for sponsors ?>



				<?php
				// Check if ACF repeater rows exists for partners.
				if( have_rows('e-partners') ):
				?>
				<div class="ucla-ps-c-sponsors">
				<h2>Partners</h2>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('e-partners') ) : the_row(); ?>
					<li>
						<?php 
								
								$event_partner_name = get_sub_field('e-partner-name'); 
								$event_partner_description = get_sub_field('e-partner-description'); 
								$event_partner_logo = get_sub_field('e-partner-logo'); 
								$event_partner_website = get_sub_field('e-partner-website'); 
								

								if( $event_partner_name &&  $event_partner_website ): 
									echo "<h3 class=\"p-name\"><a href=" . esc_url( $event_partner_website ) . ">" . $event_partner_name . "</a></h3>"; 
								elseif	( $event_partner_name):
									echo "<h3 class=\"p-name\">" . $event_partner_name . "</h3>"; 
								endif; 

								if( $event_partner_description ): 
									echo "<p class=\"p-summary\">" . $event_partner_description . "</p>"; 
								endif;
								if( $event_partner_logo  &&  $event_partner_website ): ?>
									<a href="<?php echo esc_url( $event_partner_website ); ?>">
									<?php	echo wp_get_attachment_image( $event_partner_logo, 'thumb' ); ?>
									</a>
								<?php	
								elseif ( $event_partner_logo ):
									echo wp_get_attachment_image( $event_partner_logo, 'thumb' ); 
								endif;
							?>	
					</li>
					<?php // End loop for partners.
						endwhile; ?>
				</ul>
						</div>
				<?php endif; // end repeater for partners ?>


			
				
        <?php
				// Check if ACF repeater rows exists for files.
				if( have_rows('e-files') ):
				?>
				<div class="ucla-ps-c-file-list">
				<h3>Flyer</h3>
				<ul>
					<?php 	
					// Loop through rows
					while( have_rows('e-files') ) : the_row(); ?>
					<li>
						<?php 
								// https://www.advancedcustomfields.com/resources/file/
								$file = get_sub_field('e-file'); 
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

        <?php if( get_field('e-contact-name') ): ?>
         <p><b>For more information, please contact</b>:</p> 
          <p class="event-contact-name"><?php echo esc_html( get_field( 'e-contact-name' ) ); ?>
          <?php if( get_field('e-contact-email') ): ?>
            <span class="event-contact-email"><?php echo esc_html( get_field( 'e-contact-email' ) ); ?></span>
            <?php endif; ?>
            <?php if( get_field('e-contact-tel') ): ?>
            <span class="event-content-tel"><?php echo esc_html( get_field( 'e-contact-tel' ) ); ?></span>
            <?php endif; ?>
          </p>
        <?php endif; ?> 

        <?php 
				// display event status
				if( get_field_object('e-status') ): 
				$event_status = get_field_object('e-status');
				$event_status_value = $event_status['value'];
				$event_status_label = $event_status['choices'][ $event_status_value ];
				?>
				<p><b>Event Status</b>: <?php echo esc_html( $event_status_label ); ?></p>
				<?php endif; ?>


        <?php if( get_field('e-price') ): ?>
        <p class="event-cost"><b>Price</b>: <?php echo esc_html( get_field( 'e-price' ) ); ?></p>
        <?php endif; ?>
        <?php if( get_field('e-audience') ): ?>
        <p class="event-cost"><b>Audience</b>: <?php echo esc_html( get_field( 'e-audience' ) ); ?></p>
        <?php endif; ?>
       

        <?php 
				// display event mode
				if( get_field_object('e-attendance-mode') ): 
				$event_attendence = get_field_object('e-attendance-mode');
				$event_attendence_value = $event_attendence['value'];
				$event_attendence_label = $event_attendence['choices'][ $event_attendence_value ];
				?>
				<p><b>Attendence mode</b>: <?php echo esc_html( $event_attendence_label ); ?></p>
				<?php endif; ?>

  </div>
		

		<?php
		get_template_part( 'template-parts/navigation' );

	}

	?>
      
</article>
