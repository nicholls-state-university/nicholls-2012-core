<?php
/*
Template Name: Full Page, No Sidebars
*/

function fnbx_template_core_full_page() {
	// Widget Sidebar Group
	add_filter( 'sidebars_widgets', 'core_widget_disable_filter' );
	remove_action( 'fnbx_container_end', 'fnbx_default_widget_sidebar' );
}
add_action( 'fnbx_child_init', 'fnbx_template_core_full_page');

?>

<?php get_header() ?>

		<?php do_action( 'fnbx_template_page_start', 'template_page' ) ?><!-- START: template_page -->

			<?php
			/* Run The Loop
			 *
			 * If you want to overload this in a child theme then include a file
			 * called funbox-loop-page.php and that will be used instead.
			 * We also put the template part name 'page' into the global
			 * $fnbx->template_part_name so you can use it.
			 */

			 // Filter to catch this loop template part name into gloabal $fnbx
			 add_filter( 'get_template_part_funbox-loop', array(&$fnbx, 'get_template_part_filter'), 1, 2 );
			 get_template_part( 'funbox-loop', 'page' );
			 
			?>

		<?php do_action( 'fnbx_template_page_end', 'template_page' ) ?><!-- END: template_page -->

<?php get_sidebar() ?>

<?php get_footer() ?>