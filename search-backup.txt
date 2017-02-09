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

	// get all the post types
	$post_types = get_post_types();

	// get specific post types in the order given
	// $post_types = array( 'recipe', 'page', 'post' );

	foreach ( $post_types as $post_type ) {
		$s = isset($_GET["s"]) ? $_GET["s"] : "";

		// WP_Query arguments
		$args = array (
			's' => $s,
			'post_type' => $post_type,
			'posts_per_page' => 5,
			'order' => 'ASC',
			'orderby' => 'title'
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			echo '<strong>'. $post_type . '</strong>';
			while ( $query->have_posts() ) {
				$query->the_post();
				// do something
				echo '<p>' . get_the_title() . '</p>';
			}
		} else {
			// no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();
	}


}

genesis();