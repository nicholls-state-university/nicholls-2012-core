<?php



/*
* Mega menu admin root check
*
* Make sure that the current dashboard for the root blog
*
* @since 1.0
*/
function megamenu_is_root_admin() {
	global $blog_id;
	
	$root_blog_id = get_current_site()->blog_id;
	if ( $root_blog_id == $blog_id ) return true;
	return false;
}

/*
* Template Redirect
*
* Redirect templates for mega menu requests. To be used in jquery effects
*
* @since 1.0
*/
// Template Redirect
function megamenu_template_redirect() {
    global $wp_query, $post;

    if ( $post->post_type == 'megamenu' ) {    
		load_template( NICHOLLS_CORE_DIR . '/megamenu/megamenu-template.php' );
		die();
    }

}
if ( megamenu_is_root_admin() ) add_action('template_redirect', 'megamenu_template_redirect');



function megamenu_init() {
	
	if ( function_exists( 'register_post_type' ) ) {
		// Register viewmaker as a custom post_type
	
		$viewmaker_post_type = array(
			'labels' => array( 'name' => 'megamenu' ),
			'public' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'menu_position' => 20,
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'rewrite' => array( 'slug' => 'megamenu', 'with_front' => false ),
			'taxonomies' => array( 'MenuGroup' )
		);
		
		register_post_type( 'viewmaker', $viewmaker_post_type );
		
		$viewmaker_taxonomy = array( 
			'hierarchical' => false, 
			'label' => __('View Menu Type', 'megamenu'), 
			'query_var' => 'megamenugroup', 
			'rewrite' => array( 'slug' => 'megamenugroup' ) 
			);
		
		register_taxonomy( 'megamenu', 'megamenu', $viewmaker_taxonomy );

	}

}
if ( megamenu_is_root_admin() ) add_action('init', 'megamenu_init');

?>