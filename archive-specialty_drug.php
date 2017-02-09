<?php
/**
* Template Name: Specialty Drug Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

add_action('genesis_before_content', 'archive_with_sidebar');
 
function archive_with_sidebar()
{
	//$queried_object = get_queried_object();
	//show_pre($queried_object);
	
	show_disease_sidebar();
}
 
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop
function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_content() ;
	
	show_small_search_form();
	
	$args = array(
		'post_type' => 'specialty_drug', // enter your custom post type
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '12',  // overrides posts per page in theme settings
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
		echo '<h2 style="border-bottom: 1px solid #ececec; padding-bottom: 10px;">Browse All Drugs</h2>';
		echo '<div id="specialty-drug-list">';
		while( $loop->have_posts() ): $loop->the_post(); global $post;
		echo '<div class="specialty-drug">';
			/* echo '<div class="one-fourth first">';
			echo '<div class="quote-obtuse"><div class="pic">'. get_the_post_thumbnail( $id, array(150,150) ).'</div></div>';
			echo '<div style="margin-top:20px;line-height:20px;text-align:right;"><cite>'.genesis_get_custom_field( '_cd_client_name' ).'</cite><br />'.genesis_get_custom_field( '_cd_client_title' ).'</div>';
			echo '</div>';	
			echo '<div class="three-fourths" style="border-bottom:1px solid #DDD;">';
			echo '<h3>' . get_the_title() . '</h3>';
			echo '<blockquote><p>' . get_the_content() . '</p></blockquote>';	
			echo '</div>'; */
			
			echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
			echo '<div class="sd-excerpt">'.get_the_excerpt().'</div>';
			echo '<a href="'.get_the_permalink().'" class="read-more">Read more</a>';
			
		echo '</div>';
		
		endwhile;
		
		echo '</div>';
		
	endif;
	
	// Outro Text (hard coded)
	echo '</div><!-- end .entry-content -->';
	echo '</div><!-- end .page .hentry .entry -->';
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();