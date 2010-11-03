<?php
/**
* Nicholls Core Theme Actions
*
* Action hooks used by the Funbox Theme
*
* @package Nicholls Core
* @subpackage Hooks
*/



/**
* Nicholls Core Actions
* 
* Default Nicholls actions. May overide or add to Funbox Theme actions. 
* Executed by Funbox Action: ftf_child_init
*
*/
function nicholls_core_actions() {
		
	// ISSUE: Remove FTF BuddyPress search & login bar because we don't need it yet
	remove_action( 'ftf_header_start', 'ftf_bp_search_login_bar' );
	
}
add_action( 'ftf_child_init', 'nicholls_core_actions' );


/**
* Nicholls Open Wrapper Element
*
* Uses ftf_layout_element_open() to open a div adding -wrapper to the element name
*
*/
function nicholls_layout_wrapper_element_open( $element = '' ) {
	if ( $element == '' ) return;
		
	ftf_layout_element_open( $element . '-wrapper' );
}

/**
* Nicholls Close Wrapper Element
*
* Uses ftf_layout_element_close() to open a div adding -wrapper to the element name
*
*/
function nicholls_layout_wrapper_element_close( $element = '' ) {
	if ( $element == '' ) return;
		
	ftf_layout_element_close( $element . '-wrapper' );
}

/**
* Nicholls Core CSS Stylesheet
*
* Load the core stylesheet CSS
*
*/
function nicholls_core_stylesheets() {
	// Stylesheet
	ftf_write_link_tag( array( 
		'rel' => 'stylesheet',
		'type' => 'text/css',
		'href' => NICHOLLS_CORE_URL . '/style.css'
	) );


	// Nicholls Menu CSS Stylesheet
	// ISSUE: Need to load this properly!!
	ftf_write_link_tag( array( 
		'rel' => 'stylesheet',
		'type' => 'text/css',
		'href' => get_bloginfo( 'url' ) . '/site-tools/menus/css/'
	) );
	
}

/**
* Nicholls Adminbar CSS Stylesheet
*
* Load the core stylesheet CSS
*
* ISSUE: Need to load this properly!!
*/
function nicholls_bp_adminbar_stylesheet() {
	// Stylesheet
	ftf_write_link_tag( array( 
		'rel' => 'stylesheet',
		'type' => 'text/css',
		'href' => NICHOLLS_CORE_URL . '/library/css/adminbar.css'
	) );	
}

// Use action to enqueue javascript
function nicholls_enqueue_javascript() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-pngfix' , NICHOLLS_CORE_URL . '/library/js/jquery.pngFix.js', array( 'jquery' ), '1.2' );	
	wp_enqueue_script( 'jquery-corner' , NICHOLLS_CORE_URL . '/library/js/jquery.corner.js', array( 'jquery' ), '2.01' );
	wp_enqueue_script( 'jquery-hoverintent' , NICHOLLS_CORE_URL . '/library/js/jquery.hoverIntent.minified.js', array( 'jquery' ), 'r5' );
	wp_enqueue_script( 'nicholls-core-js' , NICHOLLS_CORE_URL . '/library/js/nicholls-core.js', array( 'jquery' ), '1.0' );	
}


// Remove Sidebars Widgets
function nicholls_widget_disable_filter( $widget_groups ) {
	$widget_groups['primary'] = array();
	$widget_groups['secondary'] = array();
	return $widget_groups;
}
// $widget_groups = apply_filters( 'ftf_widgets',  $widget_groups );

?>