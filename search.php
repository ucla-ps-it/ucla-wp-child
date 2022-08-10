<?php get_header(); ?>
<main id="main">
  <div class="ucla campus">
    <?php if ( have_posts() ) : ?>
    <header class="header">
      <h1 class="entry-title">
        <?php printf( esc_html__( 'Search Results for: %s', 'ucla' ), get_search_query() ); ?>
      </h1>
    </header>
    <div class="ucla campus">
      <div class="col span_9_of_12">
        <?php 
        while ( have_posts() ) : the_post(); 
          include 'templates/entry-content.php'; 
        endwhile; 
          get_template_part( 'nav', 'below' ); 
        else : ?>
        <article id="post-0" class="post no-results not-found">
          <header class="header">
            <h1 class="entry-title">
              <?php esc_html_e( 'Nothing Found', 'ucla' ); ?></h1>
          </header>
          <div class="entry-content">
            <p>
              <?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'ucla' ); ?>
            </p>
            <?php get_search_form(); ?>
          </div>
        </article>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
