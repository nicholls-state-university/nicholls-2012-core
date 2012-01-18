<?php
/**
* Nicholls Core Theme Filters
*
* Action hooks used by the Funbox Theme
*
* @package Nicholls Core
* @subpackage Hooks
*/

function nicholls_head_title_prefix_filter( $title_str = '' ) {
	
	$nicholls_options = get_option( 'nicholls_core_theme_options' );
	$separator = ' &raquo; ';
	
	if ( !empty( $nicholls_options[ 'title_prefix' ] ) ) 
		$title_str .= $separator . $nicholls_options[ 'title_prefix' ];
	
	global $current_site;
	if ( $current_site->blog_id != 1 ) {
		if ( stristr( $nicholls_options[ 'title_prefix' ],'Nicholls State University' ) === false )
			$title_str .= $separator . 'Nicholls State University';
	}
	
	return $title_str;
}
add_filter( 'fnbx_title_site_name', 'nicholls_head_title_prefix_filter' );

function nicholls_main_title_prefix_filter( $title_array = array() ) {
	
	$nicholls_options = get_option( 'nicholls_core_theme_options' );
	
	if ( !empty( $nicholls_options[ 'title_prefix' ] ) ) 
		$title_array[ 'tag_content_before' ] = '<span class="blog-title-prefix-">' . $nicholls_options[ 'title_prefix' ] . '</span>';
		
	return $title_array;
}
add_filter( 'fnbx_default_title', 'nicholls_main_title_prefix_filter' );
