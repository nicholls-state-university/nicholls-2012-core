<?php


/*
* Funbox Shut Up Theme Default Actions
*
* Default actions for the Funbox Theme Framework are added by the ftf_init
* located in the funbox/header.php file
* This allows child themes to override the entire group of of actions or 
* modify the actions individually.
*
* @since 1.0
*/
function ftf_defaut_init_actions() {

	// Enqueue some javascript
	add_action( 'ftf_wp_head_before', 'nicholls_enqueue_javascript' );

	// Doctype
	add_action( 'ftf_header_init', 'ftf_doctype' );

	// Head Meta
	add_action( 'ftf_wp_head_before', 'ftf_head_meta_content_type' );
	add_action( 'ftf_wp_head_before', 'ftf_head_meta_template' );
	add_action( 'ftf_wp_head_before', 'ftf_head_meta_robots' );
	add_action( 'ftf_wp_head_before', 'ftf_head_meta_author' );
	add_action( 'ftf_wp_head_before', 'ftf_head_meta_copyright' );
	add_action( 'ftf_wp_head_before', 'ftf_head_meta_revised' );

	// Nicholls Core Stylesheet CSS
	add_action( 'ftf_wp_head_before', 'nicholls_core_stylesheets' );
	// Stylesheet CSS
	add_action( 'ftf_wp_head_before', 'ftf_head_link_stylesheet' );

	// Feeds
	add_action( 'ftf_header_init', 'ftf_head_automatic_feeds' );

	// Links
	add_action( 'ftf_wp_head_before', 'ftf_head_link_pingback' );
	add_action( 'ftf_wp_head_before', 'ftf_head_link_breadcrumb' );

	// Layout - Main
	add_action( 'ftf_wrapper_start', 'ftf_layout_element_open' );
	add_action( 'ftf_wrapper_end', 'ftf_layout_element_close' );	
	add_action( 'ftf_header_start', 'ftf_layout_element_open' );
	add_action( 'ftf_header_end', 'ftf_layout_element_close' );
	add_action( 'ftf_container_start', 'ftf_layout_element_open' );
	add_action( 'ftf_container_end', 'ftf_layout_element_close' );	
	add_action( 'ftf_content_start', 'ftf_layout_element_open' );
	add_action( 'ftf_content_end', 'ftf_layout_element_close' );	
	add_action( 'ftf_footer_start', 'ftf_layout_element_open' );
	add_action( 'ftf_footer_end', 'ftf_layout_element_close' );
	
	// Layout - Loop
	add_action( 'ftf_template_loop_post_start', 'ftf_layout_post_open' );
	add_action( 'ftf_template_loop_post_end', 'ftf_layout_post_close' );		
	add_action( 'ftf_template_loop_content_start', 'ftf_layout_element_open_class_only' );
	add_action( 'ftf_template_loop_content_end', 'ftf_layout_element_close' );

	// ISSUE: BuddyPress WPMU adminbar CSS needs to be loaded properly
	if ( is_user_logged_in() ) 
		add_action( 'ftf_wp_head_before', 'nicholls_bp_adminbar_stylesheet' );
	else
		define( BP_DISABLE_ADMIN_BAR, true );
		
	// Website Title
	add_action( 'ftf_header', 'ftf_default_title' );

	// Website Description
	add_action( 'ftf_header', 'ftf_default_description' );
	
	// Add Accessiblity and Menu before nicholls-header
	add_action( 'nicholls_header_start', 'ftf_access_menu' );
	
	// Nicholls Primary Menu
	add_action( 'nicholls_header_start', 'nicholls_top_menu' );	
	
	// Nicholls Header - custom header.php - Layout
	add_action( 'nicholls_header_start', 'nicholls_layout_wrapper_element_open' );	
	add_action( 'nicholls_header_end', 'nicholls_layout_wrapper_element_close' );
	add_action( 'nicholls_header_start', 'ftf_layout_element_open' );	
	add_action( 'nicholls_header_end', 'ftf_layout_element_close' );	

	// Nicholls Logo Primary Info and Links
	add_action( 'nicholls_header_start', 'nicholls_core_header' );	

	// Widget Sidebar Group
	add_action( 'ftf_container_end', 'ftf_default_widget_sidebar' );

	// Default Footer Content
	add_action( 'ftf_footer', 'ftf_footer_default' );	
		
	// For all archives we put a page title, for author and categories we put desicription meta if available
	if ( is_archive() ) {
		// Loop template page title and description for some
		add_action( 'ftf_template_loop_start', 'ftf_page_title_default' );
		if ( is_author() || is_category() ) add_action( 'ftf_template_loop_start', 'ftf_page_description_default' );	
		// Loop template post thumbnail & content
		add_action( 'ftf_template_loop_content_start', 'ftf_the_post_thumbnail' );
	}
	
	// Home example adding a post thumbnail
	if ( is_home() ) add_action( 'ftf_template_loop_content_start', 'ftf_the_post_thumbnail' );

	// Content meta do we want brief or verbose, we could also filter or change with language files.
	if ( is_home() || ( is_archive() || is_search() ) ) 
		add_action( 'ftf_template_loop_content_end', 'ftf_post_meta_brief' );
	// This should cover is_single, is_attachement, is_image
	elseif ( !is_page() )
		add_action( 'ftf_template_loop_content_end', 'ftf_post_meta_verbose' );		
	
	// Put an edit link for pages since we don't show meta
	if ( is_page() ) add_action( 'ftf_template_loop_content_end', 'ftf_post_meta_edit' );		

	// Comments? We'll only add to the single post template using an action
	if ( is_single() ) add_action( 'ftf_template_single_end', 'ftf_comments_template_separate' );
		
	if ( is_attachment() ) {

		// Attachment parent
		add_action( 'ftf_template_loop_start', 'ftf_entry_parent_title' );

		/*
		Example for using the global $ftf->template_part_name to set an action.
		For the attachement.php template it will be ftf_template_loop_content_attachment_start
		For the image.php template ftf_template_loop_content_image_start
		
		This will use specialized functions to pull the image or attachment to the top part of
		the loop template. This can also be done by making a respective funbox-loop-image.php or
		funbox-loop-attachment.php file in the child theme, yet using the action is very 
		interesting.
		*/
		
		// Attachment template content
		add_action( 'ftf_template_loop_content_attachment_start', 'ftf_attachment_content' );
		// Attachment template Comments
		add_action( 'ftf_template_attachment_end', 'ftf_comments_template_separate' );
		// Image template content
		add_action( 'ftf_template_loop_content_image_start', 'ftf_image_content' );
		// Image template comments
		add_action( 'ftf_template_image_end', 'ftf_comments_template_separate' );
	}	

	// 404 Not Found page.
	if ( is_404() ) {
		// 404 template content (see: /library/php/404.php)
		add_action( 'ftf_template_loop_content_404_end', 'ftf_search_form' );
		add_action( 'ftf_template_loop_content_404_end', 'ftf_404_report' );
		add_action( 'ftf_template_loop_content_404_end', 'ftf_404_pagelist' );
		// 404 title shortcode replace filter (see: /library/php/404.php)
		add_filter( 'ftf_entry_title_shortcode', 'ftf_404_title_shortcode_filter' );
		// 404 Post Class error filter (see: /library/php/404.php)
		add_filter( 'ftf_post_class', 'ftf_404_post_class_filter' );
	}

	// Comments restricted to comment open, but could be switched on for other resons.
	if ( comments_open() ) {	
		// Comment Special Reply Javascripts for threaded comments
		add_action( 'ftf_wp_head_before', 'ftf_enqueue_script_comment_reply' );
		// Comment Layout
		add_action( 'ftf_template_comments_start', 'ftf_layout_element_open' );
		add_action( 'ftf_template_comments_start', 'ftf_layout_element_close' );
		// Comment Navigation
		add_action( 'ftf_template_comments_comments_list_start', 'ftf_comment_navigation_box_above' );
		// Standard Mixed Comments and Pings
		add_action( 'ftf_template_comments_comments_list', 'ftf_comment_list_default' );
		// Comment Navigation
		add_action( 'ftf_template_comments_comments_list_end', 'ftf_comment_navigation_box_below' );
	}
	
	// Stats for WordPress queries and render time
	add_action( 'ftf_footer', 'ftf_stats' );

	// The default actions get... an action. 
	do_action( 'ftf_defaut_actions' );
}
// Default inits for funbox/header.php
add_action( 'ftf_init', 'ftf_defaut_init_actions' );

// Default init for adding post thumbnail & nav menu support to funbox/functions.php
add_action( 'ftf_loaded', 'ftf_post_thumbnails_default_setup' );
add_action( 'ftf_loaded', 'ftf_nav_menus_default_setup' );

/**
* Funbox Theme Centric Filters
*
* Adds various filters for WordPress and Funbox Theme functions.
*
* @since 1.0
*/
function ftf_default_filters() {

	// Filter Header display tag
	add_filter( 'ftf_default_title', 'ftf_header_title_filter' );

	// Filter Main Titles
	add_filter( 'ftf_entry_title', 'ftf_entry_title_filter' );
	add_filter( 'ftf_entry_title', 'ftf_entry_title_filter' );
	add_filter( 'ftf_entry_title_shortcode', 'ftf_entry_title_shortcode_filter' );

	// Filter Post Classes
	add_filter( 'body_class', 'ftf_body_class_filter' );

	// Filter Post Classes
	add_filter( 'post_class', 'ftf_post_class_filter' );

	// Filter hfeed for non-pages
	add_filter( 'ftf_content_class', 'ftf_hfeed_class_filter' );

	// Filter entry for posts and pages
	add_filter( 'ftf_entry_content_class', 'ftf_entry_class_filter' );

	// Filter Comment Classes
	add_filter( 'comment_class', 'ftf_comment_class_filter' );
}
// Funbox Them Centric Default FIlters
add_action( 'ftf_init', 'ftf_default_filters' );

?>