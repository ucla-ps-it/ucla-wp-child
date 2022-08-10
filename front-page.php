<?php
/**
 * Template Name: Front Page
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 **/

get_header();

/* Start the Loop */
if ( have_posts() ) {
while ( have_posts() ) {
	the_post();
	get_template_part( 'template-parts/page/acf-blocks' );
	get_template_part( 'template-parts/content/content-front-page' );
	}
}
?>

<?php get_footer();
