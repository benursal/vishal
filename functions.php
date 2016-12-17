<?php
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );

//* We tell the name of our child theme
define( 'Child_Theme_Name', __( 'SpecialtyRx Journey', 'genesis-child' ) );

//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );

//* Add HTML5 responsive recognition
add_theme_support( 'genesis-responsive-viewport' );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );