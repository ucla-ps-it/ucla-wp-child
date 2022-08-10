<?php
/**
 * Template (Name): Archive
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
**/

get_header();

$description = get_the_archive_description();
?>

<?php if ( have_posts() ) : ?>

<header class="page-header">
  <h1><?php echo wp_kses_post( post_type_archive_title( '', false ) ); ?></h1>
  <?php if ( $description ) : ?>
  <p class="standfirst"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></p>
  <?php endif; ?>
</header><!-- .page-header -->

<?php while ( have_posts() ) : ?>
<?php the_post(); ?>
<?php get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) ); ?>
<?php endwhile; ?>

<?php else : ?>
<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>