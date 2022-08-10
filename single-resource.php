<?php
/**
 * Template (Name): Single — Resource
 * This template is used to display a single resource.  
 * The template name is in () to disallow users to select it. 
 * WordPress template hierachy used to to auto-select it based on slug.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
**/

get_header();
?>

<main id="main" role="main">

<?php
/* The loop starts here */
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/resource', get_post_type() );
	}
}
?>

</main>

<?php get_footer(); ?>
