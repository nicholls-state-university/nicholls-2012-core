<?php
	
/*
* Page list shortcode
*
* Creates lists of pages especially good for creating
* table of contents for child pages.
* [column width= padding= class= style=] content [/column]
* Use width and padding for style attribute columns
* Use style to control full div style attribute (default is below)
* eliminate all and use class to make custom css controled columns
*
* @since 1.0
*/
function list_pages_shortcode( $atts, $content = null ) {
	
	// Defaults
	$the_toc_arr_defaults = array(
		'depth'        => 0,
		'show_date'    => false,
		'date_format'  => get_option('date_format'),
		'child_of'     => get_the_id(),
		'exclude'      => false,
		'include'      => false,
		'title_li'     => '',
		'authors'      => false,
		'sort_column'  => 'menu_order, post_title',
		'link_before'  => false,
		'link_after'   => false,
		'exclude_tree' => false,
		'toc_container_tag' => 'div',
		'toc_container_class' => 'list-pages-container',
		'toc_title_tag' => 'h3',
		'toc_title_class' => 'list-pages-title',
		'toc_title_text' => 'Contents',
		'toc_wrapper_tag' => 'ul'
	);
	
	$toc_settings = array();
	$toc_query = array();

	$the_toc_arr = shortcode_atts( $the_toc_arr_defaults, $atts );

	foreach( $the_toc_arr as $the_toc_key => $the_toc_value ) {
		if ( !$the_toc_value && $the_toc_key != 'title_li' ) continue;
		if ( !strstr( $the_toc_key, 'toc' ) ) 
			$toc_query[$the_toc_key] = $the_toc_value;
		else
			$toc_settings[$the_toc_key] = $the_toc_value;
	}
   
   if ( isset( $toc_settings['toc_title_text'] ) ) {
	   $toc_title_defaults = array(
		   'tag' => $toc_settings['toc_title_tag'],
		   'tag_content' => $toc_settings['toc_title_text'],
		   'return' => true
	   );
	   
	   if ( isset( $toc_settings['toc_title_class'] ) ) $toc_title_defaults['class'] = $toc_settings['toc_title_class'];
	   
	   $toc_title = fnbx_html_tag( $toc_title_defaults );
   }
   
   // Never Echo
   $toc_query['echo'] = 0;
   
   $toc_list = wp_list_pages( $toc_query );
   $toc = fnbx_html_tag( array(
	   'tag' => $toc_settings['toc_wrapper_tag'],
	   'tag_content' => $toc_list,
	   'return' => true
	) );
   
   
   if ( isset( $toc_settings['toc_container_tag'] ) ) {
	   $toc_defaults = array(
		   'tag' => $toc_settings['toc_container_tag'],
		   'return' => true
	   );
	   
	   if ( isset( $toc_settings['container_class'] ) )  $toc_defaults['class'] = $toc_settings['toc_container_class'];
	   
	   $toc_defaults['tag_content'] = $toc_title . $toc;
	   
	   $contents = fnbx_html_tag( $toc_defaults );   
   } else {
	   $contents = $toc_title . $toc;
   }
   
   
   return $contents;
}
add_shortcode('list-pages', 'list_pages_shortcode');
