<?php
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );

//echo get_stylesheet_directory_uri();

//* We tell the name of our child theme
define( 'Child_Theme_Name', __( 'SpecialtyRx Journey', 'genesis-child' ) );

//define('DONOTCACHEPAGE', true);


//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );

//* Add HTML5 responsive recognition
//add_theme_support( 'genesis-responsive-viewport' );

//* Remove the entry title (requires HTML5 theme support)
//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'template_redirect', 'wpse_124609_remove_titles' );
/**
 * Move or remove some post titles.
 */
function wpse_124609_remove_titles() {

    if ( is_front_page() ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

    } else if ( is_page() || is_single() ) {
        add_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}

// Load Font Awesome
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	//wp_enqueue_style( 'media-queries', get_stylesheet_directory_uri() . '/media-queries.css' );

}

add_action( 'genesis_meta', 'sp_viewport_meta_tag' );
function sp_viewport_meta_tag() {
 echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">';
}

add_theme_support( 'genesis-footer-widgets', 3 );

// SHORTCODES 

function search_medicine_func( $atts ){
	
	$html = '<div class="search-box">
				<h3>Find Your Specialty Drug</h3>
				
				<form action="' . home_url( '/' ) . '" role="search" method="get">
					<div class="my-row">
						<div class="column-left form-control-column">
							<input type="text" class="form-control input-lg" placeholder="enter brand or generic name" name="s"/> 
						</div>
						<div class="column-left button-column">
							 <input type="hidden" value="specialty_drugs" name="post_type" id="post_type" />
							<button type="submit" class="btn btn-cta">Search Drugs</button>
						</div>
					</div>
				</form>
				<p>
					or <a href="'.site_url('specialty_drug').'">Browse all Drugs</a>
				</p>
			 </div>';
	
	return $html;
}


add_shortcode( 'search_medicine', 'search_medicine_func' );

function show_pre( $arr )
{
	echo '<pre>';
	print_r( $arr );
	echo '</pre>';
}

function featured_disease_categories_func( $atts ){
	
	// get items for menu named "Featured Diseases"
	$diseases = wp_get_nav_menu_items('Featured Diseases');
	
	//show_pre( $diseases );
	
	//if( 
	
	$html = '<div class="d-categories col-80 with-offset">
				<div class="my-row">';
				
			foreach( $diseases as $row )
			{
				$html .= '<div class="column-left">
							<a href="'.$row->url.'" class="btn btn-md btn-block btn-simple">'
								.$row->title. ' <i class="fa fa-caret-right" aria-hidden="true"></i>
							</a>
						</div>';				
			}	
					
	$html .= '</div>
			 
			 <p class="text-center">
				<a href="'.site_url('browse-diseases').'" class="btn btn-browse-all">
					Browse All Diseases <i class="fa fa-caret-right" aria-hidden="true"></i>
				</a>
  			 </p>
			 </div>';
			 
	return $html;
}

add_shortcode( 'featured_disease_categories', 'featured_disease_categories_func' );


function diseases_func( $atts ){
	
	
	$a = shortcode_atts( array(
        'parent_id' => ''
    ), $atts );
	
	// default argument settings
	$args = array(
		'taxonomy' => 'disease',
	);
	
	// if it has a parent
	if( $a['parent_id'] != '' )
	{
		$args['parent'] = $a['parent_id'];
		$args['hide_empty'] = false;
	}
	
	// get items for menu named "Featured Diseases"
	$diseases = get_terms( $args );
	
	
	//show_pre( $diseases );
	
	//if( 
	
	$html = '<div class="d-categories col-80 with-offset">
				<div class="my-row">';
				
			foreach( $diseases as $row )
			{
				$html .= '<div class="column-left">
							<a href="'.site_url('disease').'/'.$row->slug.'" class="btn btn-md btn-block btn-simple">'
								.$row->name. ' <i class="fa fa-caret-right" aria-hidden="true"></i>
							</a>
						</div>';				
			}	
					
	$html .= '</div>';
			 
	return $html;
}

add_shortcode( 'diseases', 'diseases_func' );


function sk_custom_loop( $args = array() ) {

	global $wp_query, $more;

	$defaults = array(); //* For forward compatibility
	$args     = apply_filters( 'genesis_custom_loop_args', wp_parse_args( $args, $defaults ), $args, $defaults );

	$wp_query = new WP_Query( $args );

	// added this based on http://www.relevanssi.com/knowledge-base/relevanssi_do_query/
	relevanssi_do_query( $wp_query );

	//* Only set $more to 0 if we're on an archive
	$more = is_singular() ? $more : 0;

	genesis_standard_loop();

	//* Restore original query
	wp_reset_query();

}

add_action( 'wp_enqueue_scripts', 'wsm_custom_stylesheet' );
function wsm_custom_stylesheet() {
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/custom.css', array(), date('YmdHis') );
}


/* Change Excerpt length */
function custom_excerpt_length( $length ) {
	return 30;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function show_disease_sidebar( $slug = '' )
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
	
	// check if the slug is empty.  If it is, then it must be ALL
	
	if( empty( $slug ) )
	{
		echo '<li class="current">';
	}
	else
	{
		echo '<li>';
	}
	
	echo '<a href="'.site_url('specialty_drug').'">All</a></li>';
	
	
	// loop through the diseases
	foreach( $diseases as $disease )
	{
		if( $slug == $disease->slug )
		{
			$style = 'font-weight:bold';
		}
		else
		{
			$style = '';
		}
				
		echo '<li><a href="'.site_url('disease').'/'.$disease->slug.'" style="'.$style.'">'.$disease->name.'</a>';
		
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
				if( $slug == $child->slug )
				{
					echo '<li class="current">';
				}
				else
				{
					echo '<li>';
				}
				
				echo '<a href="'.site_url('disease').'/'.$child->slug.'">'.$child->name.'</a></li>';
			}
			
			echo '</ul>';
		}
		
		echo '</li>';
	}
	
	echo '</ul>';
	echo '</div>';
}

function show_small_search_form( $s = '' )
{
	echo	'<form action="' . home_url( '/' ) . '" role="search" class="small-search" method="get">
				<div class="my-row">
					<div class="column-left form-control-column">
						<input type="text" class="form-control input-lg" placeholder="enter brand or generic name" value="'.$s.'" name="s"/> 
					</div>
					<div class="column-left button-column">
						 <input type="hidden" value="specialty_drugs" name="post_type" id="post_type" />
						<button type="submit" class="btn btn-cta">Search Drugs</button>
					</div>
				</div>
			</form>';
}