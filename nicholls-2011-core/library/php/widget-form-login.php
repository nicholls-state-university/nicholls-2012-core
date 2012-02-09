<?php
/**
 * Nicholls Department information widget
 *
 * @since 2.8.0
 */
class WP_Widget_WP_Login_Form extends WP_Widget {

	function WP_Widget_WP_Login_Form() {
		$widget_ops = array('classname' => 'form-wp-login-widget', 'description' => 'WP Login Form' );
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('form_wp_login', 'WP Login Form', $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);

		echo $before_widget;
		
		echo $before_title . $title . $after_title;		
		
		fnbx_html_tag( array(
			'tag' => 'div',
			'tag_type' => 'open',
			'id' => 'form-wp-login',
			'class' => 'form-wp-login-',
			'tag_content_after' => "\n",
		) );
?>

	<?php if ( is_user_logged_in() ) : ?>

		<?php do_action( 'bp_before_sidebar_me' ) ?>

		<div id="sidebar-me">
			<a href="<?php echo bp_loggedin_user_domain() ?>">
				<?php bp_loggedin_user_avatar( 'type=thumb&width=40&height=40' ) ?>
			</a>

			<h4><?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></h4>
			<a class="button logout" href="<?php echo wp_logout_url( bp_get_root_domain() ) ?>"><?php _e( 'Log Out', 'buddypress' ) ?></a>

			<?php do_action( 'bp_sidebar_me' ) ?>
		</div>

		<?php do_action( 'bp_after_sidebar_me' ) ?>

		<?php if ( bp_is_active( 'messages' ) ) : ?>
			<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
		<?php endif; ?>

	<?php else : ?>

		<?php do_action( 'bp_before_sidebar_login_form' ) ?>

		<p id="login-text">
			<?php _e( 'To start connecting please log in first.', 'buddypress' ) ?>
			<?php if ( bp_get_signup_allowed() ) : ?>
				<?php printf( __( ' You can also <a href="%s" title="Create an account">create an account</a>.', 'buddypress' ), site_url( BP_REGISTER_SLUG . '/' ) ) ?>
			<?php endif; ?>
		</p>

		<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
			<label><?php _e( 'Username', 'buddypress' ) ?><br />
			<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>

			<label><?php _e( 'Password', 'buddypress' ) ?><br />
			<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" /></label>

			<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>

			<?php do_action( 'bp_sidebar_login_form' ) ?>
			<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" />
			<input type="hidden" name="testcookie" value="1" />
		</form>

		<?php do_action( 'bp_after_sidebar_login_form' ) ?>

	<?php endif; ?>
	
<?php
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
function widgets_wp_login_form_init() {
	register_widget('WP_Widget_WP_Login_Form');
}
add_action('widgets_init', 'widgets_wp_login_form_init', 1);