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
* qs_template formats the li output { = <div>, } = </div> and use terms %title%, %date%, %thumbnail%, %content%
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
	   'qs_template' => '%title% %date% %thumbnail% %content%',
	   'posts_per_page' => -1,
	   'tag' => false,
	   'cat' => false,
	   'category_name' => false,
	   'category__not_in' => false,
	), $atts );
	
	foreach( $qs_query_arr as $qs_query_key => $qs_query_value ) {
		if ( $qs_query_value == false ) {
			unset( $qs_query_arr[ $qs_query_key ] );
			continue;
		}
		if ( strstr( $qs_query_key, 'qs_' ) ) {
			$the_query_arr[$qs_query_key] = $qs_query_value;
			if ( $qs_query_key == 'category__not_in' )
				$the_query_arr['category__not_in'] = explode( ',', $qs_query_arr['category__not_in'] );
			unset( $qs_query_arr[ $qs_query_key ] );
		}	
	}
	
	// Set the temporary variables so we can restore them later
	$more_temp = $more;
	$temp_query = ftf_clone( $wp_query );
	$temp_posts = $posts;
	$temp_post = ftf_clone( $post );
		
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
						
			// Thumbnail
			$thumbnail = '';
			if ( isset( $the_query_arr['qs_thumbnail'] ) ) {
				
				if ( !empty( $the_query_arr['qs_thumbnail'] ) ) {
					list( $t_height, $t_width ) = split( 'x', $the_query_arr['qs_thumbnail'] );
					if ( empty( $t_height ) ) $t_height = $t_width;
					if ( empty( $t_width ) ) $t_width = $t_height;
					
					if ( is_numeric( $t_height ) && is_numeric( $t_width ) )
						$t_size = array( $t_height, $t_width );
					else
						$t_size = $the_query_arr['qs_thumbnail'];
						
					$thumbnail = ftf_get_the_post_thumbnail( $the_query_custom->post->ID, $t_size );
					
				} else {

					$thumbnail = ftf_get_the_post_thumbnail();
				}
			}
				
			// Content
			$content = '';
			if ( $the_query_arr['qs_content'] != 0 ) {
				
				$this_content = get_the_content();
				$this_content = strip_shortcodes( $this_content );
				// Strip http:// urls incase of oembeds
				$this_content = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $this_content);
				$this_content = strip_tags( $this_content );
				$this_content_length = intval( $the_query_arr['qs_content'] );
				$this_content = substr( $this_content, 0 , $this_content_length );

				$content = ftf_html_tag( array(
					'tag' => 'div',
					'class' => 'list-posts-item-content',
					'tag_content' => $this_content . '...',
					'return' => true
				) );
	
			}
			
			// Title
			$temp_title = get_the_title( $the_query_custom->post->ID );
			
			$entry_title_link = ftf_html_tag( array(
				'tag' => 'a',
				'class' => 'permalink',
				'title' => $temp_title,
				'href' => get_permalink( $the_query_custom->post->ID ),
				'tag_content' => $temp_title,
				'return' => true
			) );
			
			$title = ftf_html_tag( array(
				'tag' => $the_query_arr['qs_title_tag'],
				'class' => 'list-posts-item-title',
				'tag_content' => $entry_title_link,
				'return' => true
			) );
			
			// Date
			$temp_date = mysql2date( get_option('date_format'), $the_query_custom->post->post_date ) . ' at ' . get_the_time( '', $the_query_custom->post->ID );
			
			$temp_date_abbr = ftf_html_tag( array(
				'tag' => 'abbr',
				'class' => 'published',
				'title' => get_the_time( 'Y-m-d', $the_query_custom->post->ID ) . 'T' . get_the_time( 'H:i:sO', $the_query_custom->post->ID ),
				'tag_content' => $temp_date,
				'return' => true
			) );
			
			$date = ftf_html_tag( array(
				'tag' => 'div',
				'class' => 'list-posts-item-date',
				'tag_content' => $temp_date_abbr,
				'return' => true		
			) );
						
			$output .= ftf_html_tag( array(
				'tag' => 'li',
				'tag_type' => 'open',
				'class' => 'list-posts-item',
				'return' => true
			) );
			
			// $output .= $title . $date. $thumbnail . $content;
			
			$t_search = array( '{', '}', '%title%', '%thumbnail%', '%date%', '%content%' );
			$t_replace = array( '<div>', '</div>', $title, $thumbnail, $date, $content );
			$t_result = str_replace( $t_search, $t_replace, $the_query_arr['qs_template'] );
			
			$output .= $t_result . $ttest;
			
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
	$wp_query = ftf_clone( $temp_query );
	$posts = $temp_posts;
	$post = ftf_clone( $temp_post );
	
	wp_reset_query();
	wp_reset_postdata();
	return $output;
}
add_shortcode( 'list-posts', 'custom_query_shortcode' );

?>