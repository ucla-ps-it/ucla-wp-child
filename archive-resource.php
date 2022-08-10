<?php
/**
 * Template (Name): Archive — Resource
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
				<?php if ( $archive_title ) { ?>
					<h1><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<p class="standfirst"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></p>
				<?php } ?>
		</header>
			
		<?php
	}

	if ( have_posts() ) {
		?>
		<div class="h-feed">	
		<?php
		$i = 0;
		
		while ( have_posts() ) {
			
			$i++;
			if ( $i > 1 ) {
				//echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			
			the_post();
			
			get_template_part( 'template-parts/content-resources', get_post_type() );
		
		}
		
	}
	 elseif ( is_search() ) {
		?>

		<div class="no-search-results-form section-inner thin">

			<?php
			get_search_form(
				array(
					'label' => __( 'search again', 'twentytwenty' ),
				)
			);
			?>

		</div><!-- .no-search-results -->

		<?php
	}
	?>
		</div>	
		<?php
	?>

	<?php get_template_part( 'template-parts/pagination' ); ?>

</main>



<?php get_footer();
