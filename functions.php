<?php
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );

//* We tell the name of our child theme
define( 'Child_Theme_Name', __( 'SpecialtyRx Journey', 'genesis-child' ) );

//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );

//* Add HTML5 responsive recognition
//add_theme_support( 'genesis-responsive-viewport' );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Load Font Awesome
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
	wp_enqueue_style( 'media-queries', get_stylesheet_directory_uri() . '/media-queries.css?ver='.date('YmdHis') );

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
				<form>
					<div class="my-row">
						<div class="column-left form-control-column">
							<input type="text" class="form-control input-lg" placeholder="enter brand or generic name" /> 
						</div>
						<div class="column-left button-column">
							<button type="submit" class="btn btn-cta">Search Drugs</button>
						</div>
					</div>
				</form>
				<p>
					or <a href="#">Browse all Drugs</a>
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
				<a href="#" class="btn btn-browse-all">
					Browse All Diseases <i class="fa fa-caret-right" aria-hidden="true"></i>
				</a>
  			 </p>
			 </div>';
			 
	return $html;
}

add_shortcode( 'featured_disease_categories', 'featured_disease_categories_func' );


