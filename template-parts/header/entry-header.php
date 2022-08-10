<?php
/** Displays the post header **/

$entry_header_classes = '';

if ( is_singular() ) {
	$entry_header_classes .= ' header-footer-group';
}

?>

<header class="entry-header<?php echo esc_attr( $entry_header_classes ); ?>">

	<?php
		$title = get_the_title();
		if ( strlen( $title ) == 0 && is_singular() ) {
			the_title( '<h1 class="p-name">', '</h1>' );
		} 
		else if ( ! is_singular() ) {
			
			the_title( '<h2 class="p-name"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
		}

	

	if ( has_excerpt() && ! is_singular() ) {
		?>

		<div class="p-summary standfirst">
			<?php the_excerpt(); ?>
		</div>

		<?php
	}

	?>


</header>
