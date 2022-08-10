<?php 
/**
 * Template (Name): Page
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
**/

get_header(); ?>

<main role="main" id="main" <?php post_class(); ?>>

<?php 
if (have_posts()){
  while (have_posts()){
    the_post(); ?>
 
    <header>
      <p class="breadcrumb"><?php get_breadcrumb(); ?> / <?php the_title(); ?></p>
      <h1><?php the_title(); ?></h1>
    </header>
      
    <div class="entry-content">  
    <?php get_template_part( 'template-parts/header/featured-image' );?>
    <?php the_content(); ?>
    </div>
    <?php get_template_part("template-parts/page/acf-blocks"); ?>
<?php
  }
}
?>

  </main>

<?php get_footer(); ?>
