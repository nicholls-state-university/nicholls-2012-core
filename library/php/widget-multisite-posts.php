<?php

/**
*************   Multisite Posts Widget *************
*/

/**
 * Multisite Posts Widget init
 *
 * Calls 'widgets_init' action after all of the WordPress widgets have been
 * registered.
 *
 * @since 1.0
 */
function widget_multisite_posts_init() {
	register_widget('WP_Widget_Multisite_Posts');
}
add_action('widgets_init', 'widget_multisite_posts_init', 1);


/**
 * Multisiste Posts Widget Class
 *
 * @since 1.0
 */
class WP_Widget_Multisite_Posts extends WP_Widget {

	function WP_Widget_Multisite_Posts() {
		$widget_ops = array('classname' => 'widget-multisite-posts', 'description' => __( "The Multisite Posts Widget displays headline entries for other sites under WordPress Multisite.") );
		$this->WP_Widget('widget-funroe-image-posts', __('Multisite Posts Widget'), $widget_ops);
		$this->alt_option_name = 'widget-multisite-posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget-multisite-posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) )
			return $cache[$args['widget_id']];

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Multisite Posts Widget') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		if ( !$blog_id = (int) $instance['blog_id'] )
			$blog_id = 1;			

		global $more, $wp_query, $posts, $post;
	
		// Set the temporary variables so we can restore them later
		$more_temp = $more;
		$temp_query = fnbx_clone( $wp_query );
		$temp_posts = $posts;
		$temp_post = fnbx_clone( $post );
		
		switch_to_blog( $blog_id );
	
		$default_query = array(
			'showposts' => $number,
		);	
			
		$the_query_custom = new WP_Query( $default_query );
		$the_query_custom->in_the_loop = true;
		
		if ( $the_query_custom->have_posts() ) {
		
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;		
			fnbx_html_tag( array(
				'tag_type' => 'open',
				'tag' => 'div',
				'class' => 'ms-posts-container'
			) );
			
			fnbx_html_tag( array(
				'tag_type' => 'open',
				'tag' => 'ul'
			) );
						
			while ( $the_query_custom->have_posts() ) {
		
				$the_query_custom->the_post();
				
				setup_postdata( $the_query_custom->post );
				
				// is_sticky?
	
				fnbx_html_tag( array(
					'tag_type' => 'open',
					'tag' => 'li'
				) );
				
				// Title
				$temp_title = get_the_title( $the_query_custom->post->ID );
				$temp_link = get_permalink( $the_query_custom->post->ID );
	
				$entry_title_link_defaults = array(
					'tag' => 'a',
					'class' => 'permalink',
					'title' => $temp_title,
					'href' => $temp_link,
					'tag_content' => $temp_title,
					'return' => true
				);
				
				$entry_title_link = fnbx_html_tag( $entry_title_link_defaults );
				
				fnbx_html_tag( array(
					'tag' => 'h4',
					'tag_content' => $entry_title_link
				) );
	
				fnbx_html_tag( array(
					'tag_type' => 'close',
					'tag' => 'li'
				) );
			}
	
			fnbx_html_tag( array(
				'tag_type' => 'close',
				'tag' => 'ul'
			) );
			
			fnbx_html_tag( array(
				'tag_type' => 'close',
				'tag' => 'div'
			) );
			
			echo $after_widget;
		}
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('widget-multisite-posts', $cache, 'widget');
		
		restore_current_blog();
	
		// Reset the temporary variables so we can restore them later
		$more = $more_temp;
		$wp_query = fnbx_clone( $temp_query );
		$posts = $temp_posts;
		$post = fnbx_clone( $temp_post );
		
		wp_reset_query();
		wp_reset_postdata();
		update_post_caches($posts);

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['blog_id'] = (int) $new_instance['blog_id'];
		$instance['number'] = (int) $new_instance['number'];
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget-multisite-posts']) )
			delete_option('widget-multisite-posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget-multisite-posts', 'widget');
	}

	function form( $instance ) {
		$title = esc_attr($instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 5;
		if ( !$blog_id = (int) $instance['blog_id'] )
			$blog_id = 1;			
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('blog_id'); ?>"><?php _e('Blog ID:'); ?></label>
		<input id="<?php echo $this->get_field_id('blog_id'); ?>" name="<?php echo $this->get_field_name('blog_id'); ?>" type="text" value="<?php echo $blog_id; ?>" size="3" /><br />
		<small><?php _e('(at most 15)'); ?></small></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)'); ?></small></p>
<?php
	}
}

?>