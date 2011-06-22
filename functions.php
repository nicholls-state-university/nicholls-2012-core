<?php

// Define theme core file location and uri
define( 'NICHOLLS_CORE_DIR', get_theme_root() . '/nicholls-2011-core' );
define( 'NICHOLLS_CORE_URL', content_url() . '/themes/nicholls-2011-core' );

// Include core functions, actions, and filters.
require_once( NICHOLLS_CORE_DIR . '/library/php/functions.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/actions.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/filters.php' );

// Include shortcodes
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-columns.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-list-pages.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-list-posts.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-list-events.php' );
require_once( NICHOLLS_CORE_DIR . '/library/php/shortcode-shortcode.php' );

// Include widgets
require_once( NICHOLLS_CORE_DIR . '/library/php/widget-nicholls-department-info.php' );
if ( is_multisite() ) require_once( NICHOLLS_CORE_DIR . '/library/php/widget-multisite-posts.php' );

/**
* Conditional includes for specific WordPress and plugin settings
*/
define( 'BP_USE_WP_ADMIN_BAR', true );
if ( !is_user_logged_in() ) define( 'BP_DISABLE_ADMIN_BAR', true );

/**
* Conditional includes for fuctions and classes in WordPress admin panels 
*/
if ( is_admin() ) {
	require_once( NICHOLLS_CORE_DIR . '/library/php/admin.php' );
}

/*
* Funbox Theme Support Filter
*
* Since this may be delpolyed on WordPress sites lacking some theme support features.
*
* @since 1.0
*/
function ftf_theme_support_filter( $features ) {
	// Set and filter WordPress theme support features
	$features['post-formats'] = false;
	$features['custom-background'] = false;
	return $features;
}
add_filter( 'ftf_theme_support', 'ftf_theme_support_filter' );

/*
* Funbox Theme Custom Header Filter
*
* Modifies the output for custom header css.
*
* @since 1.0
*/
function ftf_theme_custom_header_filter( $custom_header ) {
	// Set and filter WordPress theme support features
	$custom_header['no_header_text'] = false;
	$custom_header['css_name'] = '.header-nicholls-';
	$custom_header['header_image'] = NICHOLLS_CORE_URL . '/library/images/backgrounds/bg-1.jpg';
	$custom_header['header_image_width'] = 962;
	$custom_header['header_image_width'] = 158;
	$custom_header['css_position_x'] = right;
	return $custom_header;
}
add_filter( 'ftf_custom_header', 'ftf_theme_custom_header_filter' );

?>