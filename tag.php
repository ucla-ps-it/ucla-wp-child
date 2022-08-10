<?php /* Templates for all archive includings tags,  categories, dates, authors, etc. https://wphierarchy.com/ */

get_header(); ?>

<main id="main" class="main">

  <?php // if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="header">
      <div class="ucla campus">
        <div class="col span_12_of_12">
          <p class="breadcrumb"><?php get_breadcrumb(); ?></p>
          <h1 class="entry-title"><?php single_term_title(); ?></h1>
        </div>
      </div>
    </header>

    <div class="ucla campus entry-content">

      <div class="col span_7_of_12">

        <div class="archive-meta"><?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?></div>

        <?php

        $tag = get_queried_object();

        // Example argument that defines three posts per page.
        $args = array(
          'posts_per_page' => 0,
          'tax_query'  => array(
            array(
               'taxonomy'  => 'post_tag',
               'field'     => 'slug',
               'terms'     =>  array(
                 $tag->slug,
               ),
             ),
           ),
         );

        // Variable to call WP_Query.
        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) :

            // Start the Loop
            while ( $the_query->have_posts() ) : $the_query->the_post();

            // Loop Content
            include 'templates/entry-content.php';

            // End the Loop
            endwhile;

        else:

        // If no posts match this query, output this text.
            _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
        endif;

        wp_reset_postdata();
        ?>

      </div>

      <div class="col span_2_of_12"></div>
      <div class="col span_3_of_12">
        <?php dynamic_sidebar('Tags Widget Area'); ?>
      </div>

    </div>


    <?php //endwhile; endif; ?>

  </article>



</main>

<?php get_footer(); ?>
