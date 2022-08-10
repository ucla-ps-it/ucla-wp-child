<?php
/**
 * Partial to display featured image
 *
**/
?>
<?php
if ( has_post_thumbnail() ): ?>
<figure class="c-hero-image">
<?php endif; ?>	
<?php the_post_thumbnail( 'large', ['class' => 'img-responsive'] ); ?>
<?php $caption = get_the_post_thumbnail_caption() ?>
<?php if ( $caption ): ?>
	<figcaption><?php echo esc_html( $caption ); ?></figcaption>
<?php endif; ?>
<?php
if ( has_post_thumbnail() ): ?>
</figure>
<?php endif; ?>

