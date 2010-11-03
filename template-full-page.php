<?php
/*
Template Name: Full Page, No Sidebars
*/

function nicholls_full_page() {
	// Widget Sidebar Group
	add_filter( 'sidebars_widgets', 'nicholls_widget_disable_filter' );
	remove_action( 'ftf_container_end', 'ftf_default_widget_sidebar' );
}
add_action( 'ftf_child_init', 'nicholls_full_page');


// $sidebars_widgets = apply_filters('sidebars_widgets', $sidebars_widgets)

	
?>

<?php get_header() ?>

		<?php do_action( 'ftf_template_page_start', 'template_page' ) ?><!-- START: template_page -->

			<?php
			/* Run The Loop
			 *
			 * If you want to overload this in a child theme then include a file
			 * called funbox-loop-page.php and that will be used instead.
			 * We also put the template part name 'page' into the global
			 * $ftf->template_part_name so you can use it.
			 */

			 // Filter to catch this loop template part name into gloabal $ftf
			 add_filter( 'get_template_part_funbox-loop', array(&$ftf, 'get_template_part_filter'), 1, 2 );
			 get_template_part( 'funbox-loop', 'page' );
			 
			?>

		<?php do_action( 'ftf_template_page_end', 'template_page' ) ?><!-- END: template_page -->

<?php get_sidebar() ?>

<?php get_footer() ?>