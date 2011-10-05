<?php
/**
 * Nicholls Department information widget
 *
 * @since 2.8.0
 */
class WP_Widget_Nicholls_Department extends WP_Widget {

	function WP_Widget_Nicholls_Department() {
		$widget_ops = array('classname' => 'nicholls-department-widget', 'description' => 'Nicholls Department Information' );
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('nicholls_department_info', 'Nicholls Department Information', $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
	
		$widget_options = get_option( 'nicholls_core_theme_options' );
		$title = get_bloginfo( 'name' );
		if ( !empty( $widget_options[ 'title_prefix' ] ) ) 
				$title = $widget_options[ 'title_prefix' ] . ' &raquo; ' . $title;

		echo $before_widget;
		
		echo $before_title . $title . $after_title;		
		
		fnbx_html_tag( array(
			'tag' => 'div',
			'tag_type' => 'open',
			'id' => 'nicholls-department-info',
			'class' => 'nicholls-department-info-',
			'tag_content_after' => "\n",
		) );

		if ( !empty( $widget_options['address_location'] ) )
			$this->html_field_display( 'Office Location', 'department-address-location-', '<br />' . $widget_options['address_location'] );
		if ( !empty( $widget_options['address_mailing'] ) || !empty( $widget_options['address_cityzip'] ) )
			$this->html_field_display( 'Mailing Address', 'department-address-mailing-', '<br />' .$widget_options['address_mailing'] . '<br />' .  $widget_options['address_cityzip'] );
		if ( !empty( $widget_options['phone'] ) )
			$this->html_field_display( 'Phone', 'department-phone-', ' ' . $widget_options['phone'] );
		if ( !empty( $widget_options['fax'] ) )
			$this->html_field_display( 'Fax', 'department-fax-', ' ' . $widget_options['fax'] );
		
		if ( !empty( $widget_options['email_address'] ) ) {
			$email = fnbx_html_tag( array(
				'tag' => 'a',
				'href' => 'mailto:' . $widget_options['email_address'],
				'tag_content' => $widget_options['email_name'],
				'tag_content_after' => "\n",
				'return' => true
			) );
			
			$this->html_field_display( 'E-mail', 'department-email-', ' ' . $email );
		}
		
		if ( !empty( $widget_options['note'] ) )
			$this->html_field_display( '', 'department-note-', $widget_options['note'] );

		fnbx_html_tag( array(
			'tag' => 'div',
			'tag_type' => 'close',
			'tag_content_after' => "\n"
		) );
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}

	function form( $instance ) {
		fnbx_html_tag( array(
			'tag' => 'strong',
			'tag_content' => 'This widget has no settings!!',
			'tag_content_after' => '<br />Look at the Nicholls menu item to set department info'
		) );
	}
	
	function html_field_display( $title = '', $class = '', $info_contents = '' ) {
		if ( $info_contents == '' ) return;
		
		if ( $title != '' ) {
			$info = fnbx_html_tag( array(
				'tag' => 'strong',
				'tag_content' => $title . ':',
				'tag_content_after' => $info_contents,
				'return' => true
			) );
		} else {
			$info = $info_contents;
		}
		
		fnbx_html_tag( array(
			'tag' => 'div',
			'class' => $class,
			'tag_content' => $info,
			'tag_content_after' => "\n",
		) );
		
		echo $contents;
	}


	
}

// Register Nicholls Widget Class
function nicholls_widgets_init() {
	register_widget('WP_Widget_Nicholls_Department');
}
add_action('widgets_init', 'nicholls_widgets_init', 1);
?>