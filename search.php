<?php

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'prefix_do_loop' );
/**
 * Outputs a custom loop
 *
 * @global mixed $paged current page number if paginated
 * @return void
 */
function prefix_do_loop() {

	
	$s = isset($_GET["s"]) ? $_GET["s"] : "";

	// WP_Query arguments
	$args = array (
		's' => $s,
		'post_type' => 'specialty_drug',
		'posts_per_page' => 5,
		'order' => 'ASC',
		'orderby' => 'title'
	);

	// The Query
	$query = new WP_Query( $args );
	
	show_small_search_form( $s );
	
	
	echo '<h2 style="border-bottom: 1px solid #ececec; padding-bottom: 10px; text-align:center">Search result for <i>'.$s.'</i></h2>';
	
	// The Loop
	if ( $query->have_posts() ) {
		
		echo '<div id="specialty-drug-list">';
		
		while( $query->have_posts() ): $query->the_post(); global $post;
			echo '<div class="specialty-drug">';
				echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
				echo '<div class="sd-excerpt">'.get_the_excerpt().'</div>';
				echo '<a href="'.get_the_permalink().'" class="read-more">Read more</a>';
			echo '</div>';
		
		endwhile;
		
		echo '</div>';
		
	} else {
		// no posts found
		echo '<p class="message">No drugs were found.</p>';
	}

	// Restore original Post Data
	wp_reset_postdata();
	


}

genesis();