<?php
/**
 * Template (Name): Archive — Project
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
<h1><?php echo wp_kses_post( post_type_archive_title( '', false ) ); ?></h1>
<?php } ?>

<?php if ( $archive_subtitle ) { ?>
<p class="standfirst"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></p>
<?php } ?>
</header>
<?php
}


if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content-projects', get_post_type() );
	}
}

get_template_part( 'template-parts/pagination' );
?>

</main>

<?php get_footer();