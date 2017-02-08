<?php
/**
* Template Name: Specialty Drug Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

add_action('genesis_before_content', 'archive_with_sidebar');
 
function archive_with_sidebar()
{
	$diseases = get_terms(
		array(
			'taxonomy' => 'disease',
			'hide_empty' => false,
			'parent' => 0,
			'order_by' => 'name',
			'order' => 'ASC'
		)
	);
	
	echo '<div class="disease-sidebar">';
	echo '<h3>Disease Categories</h3>';
	echo '<ul class="diseases">';
	echo '<li class="current"><a href="'.site_url('specialty_drug').'">All</a></a>';
	
	// loop through the diseases
	foreach( $diseases as $disease )
	{
		echo '<li><a href="'.site_url('disease').'/'.$disease->slug.'">'.$disease->name.'</a>';
		
		// get children diseases
		$child_diseases = get_terms(
			array(
				'taxonomy' => 'disease',
				'hide_empty' => false,
				'parent' => $disease->term_id,
				'order_by' => 'name',
				'order' => 'ASC'
			)
		);
		
		// if there are children diseases
		if( count( $child_diseases ) > 0 )
		{
			echo '<ul class="sub-disease">';
			
			// loop through the children
			foreach( $child_diseases as $child )
			{
				echo '<li><a href="'.site_url('disease').'/'.$child->slug.'">'.$child->name.'</a>';
			}
			
			echo '</ul>';
		}
		
		echo '</li>';
	}
	
	echo '</ul>';
	echo '</div>';
}
 
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop
function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_content() ;
	
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