<?php
// ==============================================================
// ACF DYNAMIC CONTENT BLOCKS TURNS WORDPRESS INTO A REAL CMS
// STRUCTURED CONTENT RULES
// Blocks adapted for the UCLA Web Component HTML structure.
// ==============================================================
// TABLE OF CONTENTS
// 01. FEATURED STORY CARD BLOCK
// 01: INTRODUCTION BLOCK
// 02: SECTION BLOCK
// 03: CARDS BLOCK
// 04: SCHOOL CARDS BLOCK
// 05: TEXT BLOCK
// 06: IMAGE BLOCK
// 09: CTA BLOCK
// 10: EVENTS BLOCK
// 11: POST BLOCK
// 12: PAGES BLOCK
// 14: PEOPLE BLOCK
// 15: PROJECTS BLOCK
// 16: VIDEOS & OEMBEDS BLOCK
// 17: STATS BLOCK
// 18: ACCORDION BLOCK
// ==============================================================
// END TABLE OF CONTENTS
// ==============================================================

// THE MAGIC BEGINS

if (function_exists('have_rows')) {
if( have_rows('c-content-blocks') ):
  ?>

<div class="acf-blocks-container">
  <?php

	 // loop through the rows of data
		while ( have_rows('c-content-blocks') ) : the_row();

  // ==============================================================
  // 01. FEATURED STORY CARD BLOCK
  // ==============================================================

  if( get_row_layout() == 'c-featured-story-block' ): 
  // radio button docs https://www.advancedcustomfields.com/resources/radio-button/
  // --c-gateway : The Gateway
  // --c-newsroom : The Newsroom
  // --c-stack : The Stack
  // --c-alt : The Alternate  
  $posts = get_sub_field('c-featured-story-card');
  $ucla_ps_c_visual_style = get_sub_field_object('c-featured-story-block-visual-style');

  if( $posts ): ?>
      <div class="c-featured-stories"> 
      <div class="h-feed" <?php if( !empty($ucla_ps_c_visual_style ) ): echo 'data-layout="' . esc_attr($ucla_ps_c_visual_style['value']) . '"' ; endif; ?>>
      <?php foreach ( $posts as $post):  ?>
      <article class="h-entry" id="post-<?php the_ID(); ?>">
        <figure>
          <a href="<?php the_permalink(); ?>" rel="bookmark">
            <?php setup_postdata($post); ?>
            <?php the_post_thumbnail( 'medium', ['class' => 'u-photo c-post-img'] ); ?>
          </a>
        </figure>
        <div>
          <h3 class="p-name"><a class="link u-url" href="<?php the_permalink(); ?>"
              rel="bookmark"><?php the_title(); ?></a></h3>
          <p class="p-summary"><?= wp_strip_all_tags( get_the_excerpt(), true ) ?></p>
          <time class="dt-published"
            datetime="<?php echo get_post_time( 'Y-n-j' ); ?>"><?php echo get_post_time( 'F j, Y' ); ?></time>
        </div>
      </article>

      <?php endforeach; ?>
      </div>
      </div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

    <?php endif; 
  endif;
  ?>
  <?php	
// ==============================================================
// END FEATURED STORY CARD BLOCK
// ==============================================================
?>

  <?php	

			// ==============================================================
      // 01. START INTRODUCTION BLOCK
      // ==============================================================
        
        if( get_row_layout() == 'c-intro-block' ):

          $c_intro_heading = get_sub_field('c-intro-heading');
          $c_intro_standfirst = get_sub_field('c-intro-standfirst');
          $c_intro_lede = get_sub_field('c-intro-lede');
          $c_intro_desc = get_sub_field('c-intro-desc');
        
          ?>
    <div class="c-intro-block">
    <?php if( !empty( $c_intro_heading ) ): ?>
      <h1 class="c-title-name"><?php echo $c_intro_heading; ?></h1>
    <?php endif; ?>
    <?php if( !empty( $c_intro_standfirst ) ): ?>
      <p class="standfirst"><?php echo $c_intro_standfirst; ?></p>
    <?php endif; ?>
    <?php if( !empty( $c_intro_lede ) ): ?>
      <p class="lede"><?php echo $c_intro_lede; ?></p>
    <?php endif; ?>
    <?php if( !empty( $c_intro_desc ) ): ?>
      <?php echo $c_intro_desc; ?>
    <?php endif; ?> 
    </div>
  <?php
        endif;	
        // ==============================================================
        // 01. END INTRODUCTION BLOCK
        // ==============================================================

      ?>




  <?php							
  // ==============================================================
  // 02. START SECTION BLOCK 
  // ==============================================================

  if( get_row_layout() == 'c-section-block' ):
    
    echo 	'<section class="c-section-block">';
    
  
    $c_section_block_heading = esc_html(get_sub_field('c-section-block-heading'));
    $c_section_block_title = esc_html(get_sub_field('c-section-block-title'));
    $c_section_block_image = get_sub_field('c-section-block-image');
    $c_section_block_desc = get_sub_field('c-section-block-desc');
    $c_section_block_links = esc_html(get_sub_field('c-section-block-links'));
    $size = 'full'; 
  

    if( !empty ($c_section_block_heading)):
      echo '<p class="h4 c-section-block-heading">'. $c_section_block_heading .'</p>';
    endif;  

    if (!empty ($c_section_block_image) ): 
      echo wp_get_attachment_image( $c_section_block_image, $size );
      ?>
      <img src="<?php echo esc_url($c_section_block_image['url']); ?>"
    alt="<?php echo esc_attr($c_section_block_image['alt']); ?>" />
  <?php endif; 
      
  
  if( !empty ($c_section_block_title)):
    echo '<h2>'. $c_section_block_title .'</h2>';
  endif;  
  if( !empty ($c_section_block_desc)):
    echo '<div class="c-section-desc">';
    echo  $c_section_block_desc;
    echo '</div>';
  endif;
  // links repeater starts here 
  if( have_rows('c-section-block-links') ): // check if the nested repeater field has rows of data
    echo '<ul>';
    while (have_rows('c-section-block-links')): the_row();
    
    
      $c_section_block_link_title = get_sub_field('c-section-block-link-title');
      $c_section_block_link_url = get_sub_field('c-section-block-link-url'); 
    if ($c_section_block_links): ?>
    <li><a class="btn btn--lightbg" href="<?php echo esc_url($c_section_block_link_url); ?>"><?php echo $c_section_block_link_title; ?></a></li>
  <?php endif;

  endwhile; 
  echo "</ul>";	
endif; // links repeater ends here 

echo '</section>';
endif; 

// ==============================================================
// 02. END SECTION BLOCK
// ==============================================================

?>



  <?php 
// ==============================================================
// 03. START CARD BLOCK
// ==============================================================
//wp_reset_query();
      if( get_row_layout() == 'c-card-block' ): // check current row layout
        $c_cards_heading = get_sub_field('c-cards-heading');
        $c_cards_summary = get_sub_field('c-cards-summary');
  
        
				if( have_rows('c-card-list') ): // check if the nested repeater field has rows of data
         
			?>
   <div class="c-cards">
    <?php
if( !empty( $c_cards_heading ) ): ?>
    <h2 class="c-title-name"><?php echo $c_cards_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_cards_summary ) ): ?>
    <p><?php echo $c_cards_summary; ?></p>
    <?php endif; ?>
    <div class="c-card-stack">
    <?php
      while (have_rows('c-card-list')): the_row();
        

				// vars
				$c_card_heading = get_sub_field('c-card-heading');
				$c_card_desc = get_sub_field('c-card-desc');
        $c_card_image = get_sub_field('c-card-image');
        $size = 'medium'; 
				$c_card_link = get_sub_field('c-card-link');
				//$c_card_link_title = get_sub_field('c-card-link-title');
				?>
    <article class="c-card h-entry">

      <?php if (!empty ($c_card_image) ): ?>
      <?php if ($c_card_link): ?><a class="u-url"
        href="<?php echo $c_card_link; ?>"><?php endif; ?>
        <?php
          echo wp_get_attachment_image( $c_card_image, $size );
        ?>
      <?php endif; ?>
      <?php if ( !empty ($c_card_heading) ):		?>
      <h2 class="p-name"><?php echo $c_card_heading; ?></h2>
      <?php endif; ?>
      <?php if ($c_card_link): ?></a><?php endif; ?>
      <?php if( !empty ($c_card_desc)):		?>
        <?php echo $c_card_desc; ?>
      <?php endif; ?>
    </article>

    <?php endwhile; ?>
    </div>
  </div>
  <?php endif; ?>
  <?php endif; 
// ==============================================================
// 04. END CARD BLOCK SPAN 5 
// ==============================================================
?>


<?php 
// ==============================================================
// 04. START SCHOOL CARD BLOCK
// ==============================================================
wp_reset_query();
  if( get_row_layout() == 'c-school-card-block' ): // check current row layout
    $c_school_cards_heading = get_sub_field('c-school-cards-heading');
    $c_school_cards_summary = get_sub_field('c-school-cards-summary');

    
    if( have_rows('c-school-card-list') ): // check if the nested repeater field has rows of data
      
  ?>

    <?php
    if( !empty( $c_school_cards_heading ) ): ?>
    <div class="c-schoool-cards-intro">
    <h2><?php echo $c_school_cards_heading; ?></h2>
    </div>
    <?php endif; ?>
    <?php if( !empty( $c_school_cards_summary ) ): ?>
    <div class="c-schoool-cards-intro">
    <?php echo $c_school_cards_summary; ?>
    </div>
    <?php endif; ?>
    

    <div class="school-card__section c-school-card-stack">
    <?php
    while (have_rows('c-school-card-list')): the_row();
      // vars
      $c_school_card_heading = get_sub_field('c-school-card-title');
      $c_school_card_summary = get_sub_field('c-school-card-summary');
      $c_school_card_desc = get_sub_field('c-school-card-desc');
      $c_school_card_ribbon = get_sub_field('c-school-card-ribbon');
      $c_school_card_image = get_sub_field('c-school-card-image');
      $size = 'square';
      $class = 'c-school-image';
      $c_school_card_link = get_sub_field('c-school-card-link');
      ?>
      <article class="c-school-card h-entry">

      <?php if (!empty ($c_school_card_image) ): ?>
        <div class="c-school-card-image">
        <?php if ($c_school_card_link): ?><a class="u-url"
          href="<?php echo $c_school_card_link; ?>">
        <?php endif; ?>
        <?php echo wp_get_attachment_image( $c_school_card_image, $size, $class ); ?>
        <?php if ($c_school_card_link): ?></a><?php endif; ?>
        </div>
      <?php endif; ?>
      <div class="c-school-card-content">
      <?php if ( !empty ($c_school_card_heading) ):		?>
        <h2 class="c-school-card__title">
      <?php if ($c_school_card_link): ?><a class="u-url"
        href="<?php echo $c_school_card_link; ?>">  
      <?php echo $c_school_card_heading; ?>
      <?php if ($c_school_card_link): ?></a><?php endif; ?> 
      </h2>
      <?php endif; ?>

      <?php if ( !empty ($c_school_card_summary) ):		?>
        <p class="c-school-card__summary"><?php echo $c_school_card_summary; ?></p>
      <?php endif; ?>
      <?php if ( !empty ($c_school_card_ribbon) ):		?>
        <p class="c-school-card__ribbon"><?php echo $c_school_card_ribbon; ?></p>
      <?php endif; ?>

      <?php if( !empty ($c_school_card_desc)):		?>
        <div class="e-content school-card__info">
        <?php echo $c_school_card_desc; ?>
        </div>
      <?php endif; ?>
      </div>
    </article>
    <?php endif; ?>
    <?php endwhile; ?>
    </div>
  <?php endif; ?>

  <?php endif; 
// ==============================================================
// 04. END SCHOOL CARD BLOCK
// ==============================================================
?>

<?php
// ==============================================================
// 05. START TEXT BLOCK 
// ==============================================================

if( get_row_layout() == 'c-text-block' ):
  $c_text_heading = get_sub_field('c-text-heading');
  $c_text = get_sub_field('c-text');

  ?>
  <div class="c-text">
    <?php if ($c_text_heading): ?>
    <h2><?php echo $c_text_heading; ?></h2>
    <?php endif;	?>
    <?php echo $c_text; ?>
  </div>
  <?php
endif;	
// ==============================================================
//05. END TEXT BLOCK
// ==============================================================

?>



  <?php
// ==============================================================
// 06. START IMAGE BLOCK
// ==============================================================
wp_reset_query();
if( get_row_layout() == 'c-image-block' ):

  $c_image = get_sub_field('c-image');
  $c_image_link = get_sub_field('c-image-link');
  $c_image_heading = get_sub_field('c-image-heading');
  $c_image_text = get_sub_field('c-image-text');

  ?>
  <div class="c-image-block">
    <?php if ($c_image_link): ?>
    <a class="c-img-link" href="<?php echo $c_image_link; ?>">
      <?php endif; ?>
      <img src="<?php echo $c_image['url']; ?>"
        alt="<?php echo $c_image['alt'] ?>" />
      <?php if ($c_image_link): ?>
    </a>
    <?php endif; ?>

    <?php if ($c_image_heading): ?>
      <h2><?php echo $c_image_heading; ?></h2>
      <p><?php echo $c_image_text; ?></p>
    <?php endif; ?>
  </div>
  <?php
endif;	
// ==============================================================
// 06. END IMAGE BLOCK
// ==============================================================

?>





<?php
// ==============================================================  
// 09. START CTA BLOCK
// ==============================================================
wp_reset_query(); 

if( get_row_layout() == 'c-cta-block' ):

  echo  '<div class="c-section">';

  $c_cta_list = esc_html(get_sub_field('c-cta-list'));
  
    // links repeater starts here 
    if( have_rows('c-cta-list') ): // check if the nested repeater field has rows of data

      
      echo '<ul>';
      while (have_rows('c-cta-list')): the_row();
      
        $c_cta_text = get_sub_field('c-cta-text');
        $c_cta_link = get_sub_field('c-cta-link'); 
      
      if ($c_cta_list): ?>
        <li><a href="<?php echo esc_url($c_cta_link); ?>"><button><?php echo $c_cta_text; ?></button></a></li>
      <?php endif;

    endwhile; 
    echo "</ul>";
    
  endif; // links repeater ends here 
  
  echo '</div>';
endif;

// ==============================================================
// 09. END CTA BLOCK
// ==============================================================
        
?>




  <?php
// ==============================================================
// 10. START EVENT BLOCK
// ==============================================================
?>

  <?php 
  wp_reset_query();
  if( get_row_layout() == 'c-events-block' ): 
    $c_events_heading = get_sub_field('c-events-heading');
    $c_events_summary = get_sub_field('c-events-summary');

  $posts = get_sub_field('c-events-list');
  if( $posts ): ?>
  <div class="c-events">
    <?php
if( !empty( $c_events_heading ) ): ?>
    <h2 class="c-title-name"><?php echo $c_events_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_events_summary ) ): ?>
    <p><?php echo $c_events_summary; ?></p>
    <?php endif; ?>
    <div class="h-feed">
    <?php foreach ( $posts as $post):  ?>
    <article class="h-entry" id="post-<?php the_ID(); ?>">

      <figure>
        
          <?php setup_postdata($post); ?>
          <?php the_post_thumbnail( 'medium', ['class' => 'c-event-img'] ); ?>

      </figure>
      <h2 class="p-name"><a href="<?php the_permalink(); ?>"
          rel="bookmark"><?php the_title(); ?></a></h2>

      <?php
      if( get_field('e-alt-name') ): ?>
      <p class="p-summary">
        <?php echo esc_html( get_field('e-alt-name') ); ?></p>
      <?php endif; ?>

      <div class="e-content">
        <?php
    $event_start = get_field('e-start-date'); 
    if ( $event_start ) : ?>
        <time class="event-date"
          datetime="<?php echo custom_html_date( $event_start ) ; ?>"><?php echo custom_public_date( $event_start ); ?></time>
        <time class="event-time-start"
          datetime="<?php echo custom_html_time( $event_start ) ; ?>"><?php echo custom_public_time( $event_start ); ?></time>
        <?php endif; ?>
        <?php
      $event_end_time = get_field('e-end-time'); 
			if ( $event_end_time ) : ?>
        - <time class="event-time-end"
          datetime="<?php echo custom_html_time( $event_end_time ); ?>"><?php echo custom_public_time($event_end_time); ?></time>
        <hr>
        <?php endif; ?>
      </div>
    </article>
    <?php endforeach; ?>
    </div>
  </div>
  <?php 
  endif; 
endif; 
wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

  <?php 
// ==============================================================
// 10: END EVENT BLOCK 
// ==============================================================

?>



  <?php 

// ==============================================================
// 11. START POST BLOCK
// ==============================================================
wp_reset_query();
if( get_row_layout() == 'c-blog-posts-block' ): 
  $c_blog_posts_heading = get_sub_field('c-blog-posts-heading');
  $c_blog_posts_summary = get_sub_field('c-blog-posts-summary');

$posts = get_sub_field('c-post-list');
if( $posts ): ?>

  <div class="c-blog-posts">
    <?php
if( !empty( $c_blog_posts_heading ) ): ?>
    <h2 class="c-title-name"><?php echo $c_blog_posts_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_blog_posts_summary ) ): ?>
    <p><?php echo $c_blog_posts_summary; ?></p>
    <?php endif; ?>
    <div class="h-feed">
    <?php foreach ( $posts as $post):  ?>
    <article class="story__secondary-card has-background-white h-entry" id="post-<?php the_ID(); ?>">
        <a class="story__secondary-card-link" href="<?php the_permalink(); ?>" rel="bookmark">
          <?php setup_postdata($post); ?>
          <?php the_post_thumbnail( 'thumbnail', ['class' => 'story__secondary-card-image c-post-img'] ); ?>
          <time class="story__secondary-card-date dt-published"
          datetime="<?php echo get_post_time( 'Y-n-j' ); ?>"><?php echo get_post_time( 'F j, Y' ); ?></time>
          <h3 class="story__secondary-card-title p-name"><?php the_title(); ?></h3>
        </a>
      <div class="story__secondary-card-content e-content">
        
        <div class="story__secondary-card-blurb p-summary"><?php the_excerpt(); ?></div>
        
      </div>
    </article>

    <?php endforeach; ?>
    </div>
    </div>
  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

  <?php endif; 
endif;
?>
  <?php	
// ==============================================================
// 11. END POST BLOCK 
// ==============================================================
?>




  <?php
// ==============================================================
// 12. START PAGES BLOCK
// ==============================================================
?>

  <?php
  wp_reset_query();
  if( get_row_layout() == 'c-pages-block' ): 
    $c_pages_heading = get_sub_field('c-pages-heading');
    $c_pages_summary = get_sub_field('c-pages-summary');

		$posts = get_sub_field('c-page-list');
    if( $posts ): 
?>
  <div class="c-pages">
    <?php
if( !empty( $c_pages_heading ) ): ?>
    <h2 class="c-title-name"><?php echo $c_pages_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_pages_summary ) ): ?>
    <p><?php echo $c_pages_summary; ?></p>
    <?php endif; ?>
    <div class="container">
    <?php foreach ( $posts as $post):  ?>
    <article class="h-entry" id="post-<?php the_ID(); ?>">

      <?php setup_postdata($post); 
        if ( has_post_thumbnail() ):
          ?>

      <?php the_post_thumbnail( 'thumb', ['class' => 'c-pages-block-img'] ); ?>

      <?php endif; ?>

      <h2 class="p-name"><a
          href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>



    </article>

    <?php endforeach; ?>
    </div>
  </div>

  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

  <?php 
  endif;
endif;
// ==============================================================
// 12. END PAGES BLOCK
// ==============================================================

?>



 



  <?php
// ==============================================================
// 14. START PEOPLE BLOCK
// ==============================================================
?>


  <?php
	wp_reset_query();
  if( get_row_layout() == 'c-people-block' ):
    $c_people_heading = get_sub_field('c-people-heading');
    $c_people_summary = get_sub_field('c-people-summary');

		$posts = get_sub_field('c-people-list');
    if( $posts ): 
?>
  <div class="c-people">
    <?php
if( !empty( $c_people_heading ) ): ?>
    <h2 class="c-title-name"><?php echo $c_people_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_people_summary ) ): ?>
    <p><?php echo $c_people_summary; ?></p>
    <?php endif; ?>
    <div class="h-feed">

    <?php foreach ( $posts as $post):  
    $p_job_title = get_field('p-job-title');
    $p_org = get_field( 'p-org' );
    $p_summary = get_field( 'p-summary' );
    // $image = get_field( 'p-photo' );
	
    // if( $image ):
    //   // Image variables.
    //   $url = $image['url'];
    //   $title = $image['title'];
    //   $alt = $image['alt'];
    //   $caption = $image['caption'];
    //   $size = 'square_lrg';
		// 	$avatar = $image['sizes'][ $size ];
    // endif;  
    ?>

    <article class="h-entry person-card-grey" id="post-<?php the_ID(); ?>">
    <?php if ( has_post_thumbnail() ) : ?>
    <figure class="person-card__figure"><a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail( 'square_thumb', ['class' => 'person-card__image u-photo avatar'] ); ?></a>
    <?php $caption = get_the_post_thumbnail_caption() ?>
    <?php if ( $caption ): ?>
    <figcaption><?php echo esc_html( $caption ); ?></figcaption>
    <?php endif; ?>
    </figure>
    <?php endif; ?>
    <div class="person-card__info-wrapper">
      <h1 class="person-card__name p-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <?php if( $p_job_title ): ?>
      <h2 class="person-card__department"><span class="p-job-title"><?php echo esc_html( $p_job_title ); ?></span><?php if( $p_org ): ?>, <span class="p-org"><?php echo esc_html( $p_org ); ?></span><?php endif; ?>
      </h2>
			<?php endif; ?>
      <?php if( $p_summary ): ?>
        <p class="person-card__description p-summary"><?php echo esc_html($p_summary); ?></p>
			<?php endif; ?>
      </div>  
    </article>

    <?php endforeach; ?>
  </div></div>

  <?php wp_reset_postdata();  ?>

  <?php 
  endif;
endif;  
// ==============================================================
// 14. END PEOPLE BLOCK
// ==============================================================
?>




  <?php
// ==============================================================
// 15. START PROJECTS BLOCK
// ==============================================================
?>

  <?php
  wp_reset_query();
  if( get_row_layout() == 'c-project-block' ): 
    $c_project_heading = get_sub_field('c-project-heading');
    $c_project_summary = get_sub_field('c-project-summary');
  
		$posts = get_sub_field('c-project-list');
    if( $posts ): 
?>
  <div class="c-projects">
    <?php
if( !empty( $c_project_heading ) ): ?>
    <h2 class="c-title-name"><?php echo $c_project_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_project_summary ) ): ?>
    <p><?php echo $c_project_summary; ?></p>
    <?php endif; ?>
      <div class="h-feed">
    <?php foreach ( $posts as $post):  
    $project_summary = get_field('proj-summary');
    ?>
    <article class="h-entry" id="post-<?php the_ID(); ?>">
      <?php if (!empty ( the_post_thumbnail() ) ): ?>
      <figure>
        <a href="<?php the_permalink(); ?>">
          <?php setup_postdata($post); ?>
          <?php the_post_thumbnail( 'medium', ['class' => 'c-project-img'] ); ?>
        </a>
      </figure>
      <?php endif; ?>
      <h2 class="p-name"><a
          href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php if( !empty( $project_summary ) ): ?>
      <p class="p-summary"><?php echo $project_summary ?></p>
      <?php endif; ?>


    </article>

    <?php endforeach; ?>
  </div></div>

  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

  <?php 
  endif;
endif;
// ==============================================================
// 15. END PROJECTS BLOCK
// ==============================================================

?>


  <?php	
// ==============================================================
// 16. START OEMBED MEDIA BLOCK
// https://wordpress.org/support/article/embeds/
// ==============================================================

if( get_row_layout() == 'c-oembed-block' ):

			$c_oembed_heading = get_sub_field('c-oembed-heading');
			$c_oembed_summary = get_sub_field('c-oembed-summary');
      $c_oembed_url = get_sub_field('c-oembed-url');
      $c_embed_posts = get_sub_field('c-oembed-list');
       
		
			?>
  <div class="c-oembed">

    <?php if( !empty( $c_oembed_heading ) ): ?>
    <h2 class="c-title-name"><?php echo $c_oembed_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_oembed_summary ) ): ?>
    <p><?php echo $c_oembed_summary; ?></p>
    <?php endif; ?>
    <?php echo $c_oembed_url; ?>

    
    <?php
				// Check if ACF repeater rows exists for embedded media.
				if( have_rows('c-oembed-list') ):
				?>
				
				<div class="c-oembeds">
					<?php 	
					// Loop through rows
					while( have_rows('c-oembed-list') ) : the_row(); ?>
						<figure>
							<?php if( get_sub_field('c-oembed-name') ):?>
							<figcaption><?php the_sub_field('c-oembed-name'); ?></figcaption>
							<?php endif; ?>
            <?php if( get_sub_field('c-oembed-url') ):?>
						  <?php the_sub_field('c-oembed-url'); ?>
            <?php endif; ?>
              
					</figure>
					<?php // End loop for embeds.
						endwhile; ?>
				</div>

				<?php endif; // end repeater for embed ?>	
  </div>
  <?php
endif;	
// ==============================================================
// 16. END OEMBED MEDIA BLOCK
// ==============================================================

?>




  <?php  

// ==============================================================
// 17. START STATS BLOCK
// ==============================================================


			if( get_row_layout() == 'c-stats-block' ): // check current row layout
        $c_stats_block_heading = get_sub_field('c-stats-block-heading');
        $c_stats_block_summary = get_sub_field('c-stats-block-summary');

				if( have_rows('c-stats-block-list') ): // check if the nested repeater field has rows of data

			?>
  <div class="stat-set c-stats">
    <?php
if( !empty( $c_stats_block_heading ) ): ?>
    <h2><?php echo $c_stats_block_heading; ?></h2>
    <?php endif; ?>
    <?php if( !empty( $c_stats_block_summary ) ): ?>
    <p class="lede"><?php echo $c_stats_block_summary; ?></p>
    <?php endif; ?>
    <div class="stat-wrapper container">
    <?php
					
			while (have_rows('c-stats-block-list')): the_row();
				// vars
				$c_stats_block_value = get_sub_field('c-stats-block-value');
				$c_stats_block_metric = get_sub_field('c-stats-block-metric');
				$c_stats_block_desc = get_sub_field('c-stats-block-desc');
				$c_stats_block_link = get_sub_field('c-stats-block-link');
			
				?>
    <figure class="stat-tout c-stat">

      <?php if ( !empty ($c_stats_block_value) ):		?>
        <span class="stat-tout__number c-stat-value">
        <?php echo $c_stats_block_value; ?>
        <?php if( !empty ($c_stats_block_metric)):		?>
        <span class="stat-tout__metric">
        <?php echo $c_stats_block_metric; ?>
        </span>
      <?php endif; ?>
        </span> 
      <?php endif; ?>
      

      
      <figcaption class="stat-tout__info-wrap c-stat-desc">
        

        <?php if( !empty ($c_stats_block_desc)):		?>
        <span class="stat-tout__label c-stat-desc">
          <?php echo $c_stats_block_desc; ?>
        </span>
        <?php endif; ?>
        <?php if ($c_stats_block_link): ?>
        <a class="u-url" href="<?php echo $c_stats_block_link; ?>"><svg
            class="icon arrow-forward" width="48" height="24"
            viewBox="0 0 48 24" aria-labelledby="icon-arrow-forward" role="img">
            <title id="icon-arrow-forward">External Link</title>
            <g>
              <path id="Path"
                d="M36 4l-1.41 1.41L40.17 11H4v2h36.17l-5.58 5.59L36 20l8-8z" />
            </g>
          </svg></a>
        <?php endif; ?>
      </figcaption>
    </figure>

    <?php endwhile; ?>
  </div></div>
  <?php endif; ?>
  <?php endif; 
// ==============================================================
// 17. END STATS BLOCK
// ==============================================================
?>

<?php 
// ==============================================================
// 18. START ACCORDION BLOCK
// ==============================================================
wp_reset_query();
      if( get_row_layout() == 'c-accordion-block' ): // check current row layout
        
        if( have_rows('c-accordion-list') ): // check if the nested repeater field has rows of data

        echo  '<div class="c-accordion">';
         
      ?>
  

    <?php
      // create unique counter to add unique id for each item on accordion
      $counter = 1;
      while (have_rows('c-accordion-list')): the_row();
        // vars
        $c_accordion_heading = get_sub_field('c-accordion-heading');
        $c_accordion_desc = get_sub_field('c-accordion-desc');
        ?>
      <div class="wp-block-pb-accordion-item wp-block-pb-accordion-item c-accordion__item js-accordion-item is-read" data-initially-open="false" data-click-to-close="true" data-auto-close="true" data-scroll="false" data-scroll-offset="0">
      <?php if ( !empty ($c_accordion_heading) ):    ?>
      <h2 id="at-<?php echo $counter; ?>" class="c-accordion__title js-accordion-controller" role="button"><?php echo $c_accordion_heading; ?></h2>
      <?php endif; ?>

      <?php if( !empty ($c_accordion_desc)):   ?>
      <div id="ac-<?php echo $counter; ?>" class="c-accordion__content">
        <?php echo $c_accordion_desc; ?>
      </div>
      <?php endif; ?>
      </div>
    <?php $counter++; ?>
    <?php endwhile; ?>

  <?php endif;
  echo '</div>';
  endif;
// ==============================================================
// 18. CLOSE ACCORDION BLOCK 
// ==============================================================
?>




  <?php endwhile;
// CLOSE LOOP OF FLEXIBLE CONTENT
?>
</div>
  <?php 
else :
	//test if blocks used
  //echo 'No ACF blocks found';
  ?>

<?php
endif; // END OF ACF MAGIC.

}else {
  //test if ACF plugin is installed and activated
  echo 'ACF plugin is not activated';
}
?>