<?php get_header(); ?>

<main class="main">

  <article id="post-0" class="post not-found">

    <?php include 'templates/page-header.php'; ?>

    <div class="entry-content">

        <p>We scoured the Internet — all the way back to the beginning — and still couldn’t find the page you’re looking for.</p>
        <p>It looks like this was the result of either:</p>
        <ul class="bulleted">
          <li>a mistyped address</li>
          <li>an out-of-date link</li>
        </ul>
      <?php // get_search_form(); ?>
      
        <img src="wp-content/themes/ucla-ps-wp/images/404_not_found.jpg" alt="UCLA Computer">
				<p>ARPANET, the computer network that became the internet, was designed and built at UCLA. A team led by Leonard Kleinrock sent the world’s first message over the network on Oct. 29, 1969.</p>

    </div>

  </article>

</main>

<?php get_footer(); ?>
