<?php
/**
* Custom Query Shortcode
*
* Uses WordPress shortcode api to insert a custom query into contant areas with shortcode support.
* Format is [list-events] using standard WP_Query arguments [list-posts more=1 tag='tag' category_name='category' cat=cat_num gs_content=number]
* container_style to set the style attribute for container
* container_class to set the class attribute for container
* 
* Currently accespet WP_Query values are:
* posts_per_page, tag, cat, category_name
*
* @since 1.0
* @echo string
*/
function the_events_shortcode($atts) {
	global $wp_query, $posts, $post, $more, $spEvents;
	
	// Defaults
	$qs_query_arr = shortcode_atts( array(
	   'title_tag' => 'div',
	   'container_style' => false,
	   'container_class' => false,	   
	   'limit' => 5,
	   'category_name' => 'Events'
	), $atts );
	
	// Set the temporary variables so we can restore them later
	$more_temp = $more;
	$temp_query = ftf_clone( $wp_query );
	$temp_posts = $posts;
	$temp_post = ftf_clone( $post );	
				
	$list_posts_container_defaults = array(
		'tag_type' => 'open',
		'tag' => 'div',
		'class' => 'list-events-container',
		'return' => true
	);
		
	if ( isset( $qs_query_arr['container_style'] ) ) $list_posts_container_defaults['style'] = $qs_query_arr['container_style'];

	if ( isset( $qs_query_arr['container_class'] ) ) $list_posts_container_defaults['class'] .= ' ' . $qs_query_arr['container_class'];

	$output = ftf_html_tag( $list_posts_container_defaults );
	
	if( function_exists( 'get_events' ) ) {
		$old_display = $wp_query->get( 'eventDisplay' );
		$wp_query->set( 'eventDisplay', 'upcoming' );
		$event_posts = get_events( $qs_query_arr['limit'], $qs_query_arr['category_name'] );
	}
			
	if( $event_posts ) {
		/* Display list of events. */
		if( function_exists( 'get_events' ) ) {

			$output .= ftf_html_tag( array(
				'tag_type' => 'open',
				'tag' => 'ul',
				'class' => 'list-events-list',
				'return' => true
			) );

			foreach( $event_posts as $event_post ) {
			
				setup_postdata( $event_post );
							
				$output .= ftf_html_tag( array(
					'tag' => 'li',
					'tag_type' => 'open',
					'class' => 'list-events-item',
					'return' => true
				) );
				
				$temp_title = get_the_title( $event_post->ID );
				
				$entry_title_link = ftf_html_tag( array(
					'tag' => 'a',
					'class' => 'permalink',
					'title' => $temp_title,
					'href' => get_permalink( $event_post->ID ),
					'tag_content' => $temp_title,
					'return' => true
				) );
				
				$output .= ftf_html_tag( array(
					'tag' => $qs_query_arr['title_tag'],
					'class' => 'list-events-item-title',
					'tag_content' => $entry_title_link,
					'return' => true
				) );						
				
				
				$the_event = the_events_abbr( $event_post->ID, '_EventStartDate', the_event_start_date( $event_post->ID ), 'date-start' );
				
				if ( !the_event_all_day( $post->ID ) ) 
					$the_event .= ' to ' . the_events_abbr( $event_post->ID, '_EventEndDate', the_event_end_date( $event_post->ID ), 'date-end' );
	
				$output .= ftf_html_tag( array(
					'tag' => 'div',
					'class' => 'list-events-item-event',
					'tag_content' => $the_event,
					'return' => true		
				) );
				
				$output .= ftf_html_tag( array(
					'tag' => 'li',
					'tag_type' => 'close',
					'return' => true
				) );
				
			}
			
			$output .= ftf_html_tag( array(
				'tag' => 'ul',
				'tag_type' => 'close',
				'return' => true
			) );					

			if ( eventsGetOptionValue('viewOption') == 'upcoming') {
				$event_url = events_get_listview_link();
			} else {
				$event_url = events_get_gridview_link();
			}

			$events_link = ftf_html_tag( array(
				'tag' => 'a',
				'class' => 'link-events',
				'title' => 'Vew All Events',
				'href' => $event_url,
				'tag_content' => 'Vew All Events',
				'return' => true
			) );

			$output .= ftf_html_tag( array(
				'tag' => 'div',
				'class' => 'list-events-link-events',
				'tag_content' => $events_link,
				'return' => true		
			) );
			
		}
	}

	$wp_query->set('eventDisplay', $old_display);
	
	$output .= ftf_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close',
		'return' => true		
	) );

	// Reset the temporary variables so we can restore them later
	$more = $more_temp;
	$wp_query = ftf_clone( $temp_query );
	$posts = $temp_posts;
	$post = ftf_clone( $temp_post );
	
	wp_reset_query();
	wp_reset_postdata();			
	return $output;
}
add_shortcode( 'list-events', 'the_events_shortcode' );

/**
* Post List Events
*
* Formats date output for posts using "The Event Calendar" WordPress plugin.
*
* @since 1.0
* @echo string
*/
function the_events_abbr( $the_postid, $the_event_meta, $the_date, $the_date_class ) {

	$event_start_date = date ( 'Y-m-d', strtotime( get_post_meta( $the_postid, $the_event_meta, true ) ) );
	$event_start_time = date ( 'H:i:sO', strtotime( get_post_meta( $the_postid, $the_event_meta, true ) ) );

	$the_event = ftf_html_tag( array(
		'tag' => 'abbr',
		'class' => $the_date_class,
		'title' => $event_start_date . 'T' . $event_start_time,
		'tag_content' => $the_date,
		'return' => true
	) );
	
	return $the_event;
					
}

?>