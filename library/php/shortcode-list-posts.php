<?php
/**
* Custom Query Shortcode
*
* Uses WordPress shortcode api to insert a custom query into contant areas with shortcode support.
* Format is [list-posts] using standard WP_Query arguments [list-posts more=1 tag='tag' category_name='category' cat=cat_num gs_content=number]
* qs_more can be set to 0 to ignore the more separator
* qs_content value with shorten the content area to number of characters and HTML for the_content is stripped out. A 0 value excludes content.
* qs_thumbnail value other than false will include the post thumbnail
* qs_container_style to set the style attribute for container
* qs_container_class to set the class attribute for container
* 
* Currently accespet WP_Query values are:
* posts_per_page, tag, cat, category_name
*
* @since 1.0
* @echo string
*/
function custom_query_shortcode($atts) {
	global $more, $wp_query, $posts, $post;
	
	// Defaults
	$qs_query_arr = shortcode_atts( array(
	   'qs_title_tag' => 'div',
	   'qs_more' => 1,
	   'qs_content' => 0,
	   'qs_thumbnail' => false,
	   'qs_container_style' => false,
	   'qs_container_class' => false,	   
	   'posts_per_page' => -1,
	   'tag' => false,
	   'cat' => false,
	   'category_name' => false,
	), $atts );
	
	foreach( $qs_query_arr as $qs_query_key => $qs_query_value ) {
		if ( $qs_query_value == false ) {
			unset( $qs_query_arr[ $qs_query_key ] );
			continue;
		}
		if ( strstr( $qs_query_key, 'qs_' ) ) {
			$the_query_arr[$qs_query_key] = $qs_query_value;
			unset( $qs_query_arr[ $qs_query_key ] );
		}	
	}
	
	// Set the temporary variables so we can restore them later
	$more_temp = $more;
	$temp_query = wp_clone( $wp_query );
	$temp_posts = $posts;
	$temp_post = wp_clone( $post );
		
	$the_query_custom = new WP_Query( $qs_query_arr );
	$more = $the_query_arr['qs_more'];
	$the_query_custom->in_the_loop = true;
	
	if ( $the_query_custom->have_posts() ) {
	
		$list_posts_container_defaults = array(
			'tag_type' => 'open',
			'tag' => 'div',
			'class' => 'list-posts-container',
			'return' => true
		);	
		
		if ( isset( $the_query_arr['qs_container_style'] ) ) $list_posts_container_defaults['style'] = $the_query_arr['qs_container_style'];
	
		if ( isset( $the_query_arr['qs_container_class'] ) ) $list_posts_container_defaults['class'] .= ' ' . $the_query_arr['qs_container_class'];
	
		$output = ftf_html_tag( $list_posts_container_defaults );
	
		$output .= ftf_html_tag( array(
			'tag_type' => 'open',
			'tag' => 'ul',
			'class' => 'list-posts-list',
			'return' => true
		) );
			
	while ( $the_query_custom->have_posts() ) {
	
			$the_query_custom->the_post();
			
			setup_postdata( $the_query_custom->post );			
			
			$content = '';
			if ( $the_query_arr['qs_content'] != 0 ) {
				
				$this_content = get_the_content();
				$this_content = do_shortcode( $this_content );
				$this_content = strip_tags( $this_content );
				$this_content = substr( $this_content, 0 , $the_query_arr['qs_content'] );
				$thumbnail = '';
				if ( isset( $the_query_arr['qs_thumbnail'] ) ) $thumbnail = ftf_get_the_post_thumbnail();
				$content = ftf_html_tag( array(
					'tag' => 'div',
					'class' => 'list-posts-item-content',
					'tag_content' => $thumbnail . $this_content . '...',
					'return' => true
				) );
	
			}
						
			$output .= ftf_html_tag( array(
				'tag' => 'li',
				'tag_type' => 'open',
				'class' => 'list-posts-item',
				'return' => true
			) );
			
			$temp_title = get_the_title( $the_query_custom->post->ID );
			
			$entry_title_link = ftf_html_tag( array(
				'tag' => 'a',
				'class' => 'permalink',
				'title' => $temp_title,
				'href' => get_permalink( $the_query_custom->post->ID ),
				'tag_content' => $temp_title,
				'return' => true
			) );
			
			$output .= ftf_html_tag( array(
				'tag' => $the_query_arr['qs_title_tag'],
				'class' => 'list-posts-item-title',
				'tag_content' => $entry_title_link,
				'return' => true
			) );

			$temp_date = mysql2date( get_option('date_format'), $the_query_custom->post->post_date ) . ' at ' . get_the_time( '', $the_query_custom->post->ID );
			
			$temp_date_abbr = ftf_html_tag( array(
				'tag' => 'abbr',
				'class' => 'published',
				'title' => get_the_time( 'Y-m-d', $the_query_custom->post->ID ) . 'T' . get_the_time( 'H:i:sO', $the_query_custom->post->ID ),
				'tag_content' => $temp_date,
				'return' => true
			) );
			
			$output .= ftf_html_tag( array(
				'tag' => 'div',
				'class' => 'list-posts-item-date',
				'tag_content' => $temp_date_abbr,
				'return' => true		
			) );
			
			$output .= $content;
			
			$output .= ftf_html_tag( array(
				'tag' => 'li',
				'tag_type' => 'close',
				'return' => true
			) );			
	
		}
		
		$output .= ftf_html_tag( array(
			'tag_type' => 'close',
			'tag' => 'ul',
			'return' => true
		) );
		
		$output .= ftf_html_tag( array(
			'tag_type' => 'close',
			'tag' => 'div',
			'return' => true
		) );		
		
	}

	// Reset the temporary variables so we can restore them later
	$more = $more_temp;
	$wp_query = wp_clone( $temp_query );
	$posts = $temp_posts;
	$post = wp_clone( $temp_post );
	
	wp_reset_query();
	wp_reset_postdata();
	return $output;
}
add_shortcode( 'list-posts', 'custom_query_shortcode' );

?>