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



<?php

$posts = get_posts( array(
	'posts_per_page' => -1,
	'post_type'      => 'event',
	'post_status' => 'publish,future',
	'order'          => 'DESC',
	'orderby'        => 'meta_value',
	'meta_value'   => date( "Ymd" ),
	'meta_compare' => '>=',
	'meta_key'       => 'e-start-date',
	'meta_type'      => 'DATE',
	'ignore_sticky_posts' => true,
));


if( $posts ) {
	?>
		<h2>Upcoming Events</h2>
		<div class="h-feed">
		<?php	
    foreach( $posts as $post ) {
		?>
		<article <?php post_class("vevent"); ?> id="post-<?php the_ID(); ?>">
		
		<?php			 
			get_template_part( 'template-parts/header/featured-image' );
			
			get_template_part( 'template-parts/header/entry-header' );
			if( get_field('e-alt-name') ): ?>
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
				<hr>
			<?php endif; 
		?>
		</article>
		<?php

		}
		?>
		</div>
		<?php


}

else {
	echo "<p>No upcoming events scheduled.</p>";
}		



$posts = get_posts( array(
	'posts_per_page' => -1,
	'post_type'      => 'event',
	'post_status' => 'publish,future',
	'order'          => 'DESC',
	'orderby'        => 'meta_value',
	'meta_value'   => date( "Ymd" ),
	'meta_compare' => '<',
	'meta_key'       => 'e-start-date',
	'meta_type'      => 'DATE',
	'ignore_sticky_posts' => true,
));


if( $posts ) {
	?>
		<h2>Past Events</h2>
		<div class="h-feed">
		<?php	
    foreach( $posts as $post ) {
		?>
		<article <?php post_class("vevent"); ?> id="post-<?php the_ID(); ?>">
		<figure class="c-hero-image">
<?php the_post_thumbnail( 'medium', ['class' => 'img-responsive'] ); ?>
<?php $caption = get_the_post_thumbnail_caption() ?>
<?php if ( $caption ): ?>
	<figcaption><?php echo esc_html( $caption ); ?></figcaption>
<?php endif; ?>
</figure>
		<?php			 
		
			get_template_part( 'template-parts/header/entry-header' );
			if( get_field('e-alt-name') ): ?>
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
				<hr>
			<?php endif; 
		?>
		</article>
		<?php

		}
		?>
		</div>
		<?php

}


	