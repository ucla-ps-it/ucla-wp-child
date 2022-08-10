<?php
/**
 * Template Name: Archive — Video
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 **/

get_header();
?>

<main id="main" role="main">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	 if ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
		
	}

	if ( $archive_title || $archive_subtitle ) {
		?>
 		<header class="archive-header">
     <div class="breadcrumb"><?php get_breadcrumb(); ?> / <?php echo wp_kses_post( post_type_archive_title( '', false ) ); ?></div>
				<?php if ( $archive_title ) { ?>
					<h1><?php echo wp_kses_post( post_type_archive_title( '', false ) ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<p class="standfirst"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></p>
				<?php } ?>
		</header>
	
		<?php
	}



	if ( have_posts() ) {
    ?>
    <div class="c-videos">
    <?php
		$i = 0;

		while ( have_posts() ) {
			$i++;
			if ( $i > 1 ) {
				//echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/content/content-videos', get_post_type() );

		}
	} 
?>

    </div>


	<?php get_template_part( 'template-parts/pagination' ); ?>

</main>



<?php get_footer();
