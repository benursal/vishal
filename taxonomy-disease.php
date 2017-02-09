<?php
add_action('genesis_before_content', 'archive_with_sidebar');
 
function archive_with_sidebar()
{
	//$queried_object = get_queried_object();
	//show_pre($queried_object);
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	
	show_disease_sidebar( $term->slug );
}


// Remove stuff
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Add our custom loop
add_action( 'genesis_loop', 'tax_archive_loop' );
function tax_archive_loop() 
{

	//$queried_object = get_queried_object();
	//show_pre($queried_object);


	$taxonomy = 'disease';
	$queried_term = get_query_var($taxonomy);
	$terms = get_terms(
		$taxonomy, 
		array(
			'slug' => $queried_term,
			'hide_empty' => false
		)
	);

	show_small_search_form();
	
	
	//show_pre( $terms );
    // Define the query
	$args = array(
		'post_type' => 'specialty_drug',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'disease',
				'field'    => 'slug',
				'terms'    => $queried_term
			),
		)
	);
	
// run the query 
    $query = new WP_Query( $args );
    if( $query->have_posts() ) { 
		
		echo '<h2 style="border-bottom: 1px solid #ececec; padding-bottom: 10px;">Browse Drugs for <i>'. $terms[0]->name .'</i></h2>';
		echo '<div id="specialty-drug-list">';
		
		while( $query->have_posts() ): $query->the_post(); global $post;
			echo '<div class="specialty-drug">';
				echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
				echo '<div class="sd-excerpt">'.get_the_excerpt().'</div>';
				echo '<a href="'.get_the_permalink().'" class="read-more">Read more</a>';
			echo '</div>';
		
		endwhile;
		
		echo '</div>';
	}       
	else
	{
		echo '<h3 style="margin-top:30px; text-align:center;">There are no drugs for <i>'. $terms[0]->name . '</i> yet. </h3>';
	}
    // use reset postdata to restore orginal query
    wp_reset_postdata();
} 
genesis();