<?php
/*
Template Name: N-App - Remove header, No Sidebars
*/

/**
* N-APP Template
*
* Special page template for embeding pages inside mobile apps. 
* We remove some header graphics.
*
*/
// Query string to set request to change dislpay for embeded usage
$n_app = $_GET['n-app'];

// Filter to clear out sidebar widgets to make full page
if ( $n_app == 'true' ) add_action( 'fnbx_child_init', 'nicholls_template_core_full_page');

do_action( 'fnbx_init'); // Default action and filter initialization
do_action( 'fnbx_child_init'); // Child init override or enhance defaults
do_action( 'fnbx_header_init'); // Typically used for doctype

?>
<!--[if lt IE 7]>      <html <?php language_attributes('html'); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes('html'); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes('html'); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes('html'); ?> class="no-js"> <!--<![endif]-->
<head>

	<title><?php fnbx_document_title() ?></title>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,600italic,400,600,700,800,300,300italic|Crimson+Text:400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>

<?php do_action( 'fnbx_wp_head_before', 'wp_head' ) ?>
<?php wp_head() // For plugins ?>
<?php do_action( 'fnbx_wp_head_after', 'wp_head' ) ?>

</head>

<body <?php body_class() ?>>
<!-- START: body -->
<?php do_action( 'fnbx_body_start', 'body' ) ?>

<?php if ( $n_app != 'true' ) : ?>

	<?php do_action( 'nicholls_header_start', 'header-nicholls' ) ?> <!-- START: nicholls-header -->

		<!-- START: header -->
		<?php do_action( 'fnbx_header_start', 'header' ) ?>

			<?php do_action( 'fnbx_header', 'header' ) ?>

		<?php do_action( 'fnbx_header_end', 'header' ) ?>
		<!-- END: header -->

	<?php do_action( 'nicholls_header_end', 'header-nicholls' ) ?> <!-- END: nicholls-header -->

<?php endif; // n-app query string check ?>


<!-- START: wrapper -->
<?php do_action( 'fnbx_wrapper_start', 'wrapper' ) ?>

	<!-- START: container -->
	<?php do_action( 'fnbx_container_start', 'container' ) ?>

		<!-- START: content -->
		<?php do_action( 'fnbx_content_start', 'content' ) ?>

		<!-- START: template_page -->
		<?php do_action( 'fnbx_template_page_start', 'template_page' ) ?>

			<?php
			/* Run The Loop
			 *
			 * If you want to overload this in a child theme then include a file
			 * called fnbx-loop-page.php and that will be used instead.
			 * We also put the template part name 'page' into the global
			 * $fnbx->template_part_name so you can use it.
			 */

			 // Filter to catch this loop template part name into gloabal $fnbx
			 global $fnbx;
			 add_filter( 'get_template_part_fnbx-loop', array(&$fnbx, 'get_template_part_filter'), 1, 2 );
			 get_template_part( 'fnbx-loop', 'page' );
			 
			?>

		<?php do_action( 'fnbx_template_page_end', 'template_page' ) ?>
		<!-- END: template_page -->

<?php get_sidebar() ?>

		<?php do_action( 'fnbx_content_end', 'content' ) ?>
		<!-- END: content -->

	<?php do_action( 'fnbx_container_end', 'container' ) ?>
	<!-- END: container -->
	
<?php do_action( 'fnbx_wrapper_end', 'wrapper' ) ?>
<!-- END: wrapper -->	

<!-- START: nicholls-footer -->
<?php do_action( 'nicholls_footer_start', 'footer-nicholls' ) ?> 

	<!-- START: footer -->
	<?php do_action( 'fnbx_footer_start', 'footer' ) ?>
		<?php do_action( 'fnbx_footer', 'footer' ) ?>

<?php if ( $n_app != 'true' ) : ?>
		
	<div class="column-">
		<h3 class="column-title-">Learn</h3>
		<div class="column-content-">	
			<ul>
				<li><a href="http://www.nicholls.edu/programs/">Degree Programs</a></li>
				<li><a href="http://www.nicholls.edu/financial-aid/">Financial Aid & Scholarships</a></li>
				<li><a href="http://www.nicholls.edu/fees/">Fee Information</a></li>
				<li><a href="http://www.nicholls.edu/honors/">Honors Program</a></li>
				<li><a href="http://www.nicholls.edu/library/">Library</a></li>
				<li><a href="http://www.nicholls.edu/request-info/">Request Information</a></li>
				<li><a href="http://www.nicholls.edu/nicholls-online/">Nicholls Online</a></li>			
			</ul>
		</div>
	</div>

	<div class="column-">
		<h3 class="column-title-">Live</h3>
		<div class="column-content-">	
			<ul>
				<li><a href="http://www.nicholls.edu/housing/">Housing & Meal Plans</a></li>
				<li><a href="http://www.nicholls.edu/organizations/">Student Organizations</a></li>
				<li><a href="http://www.nicholls.edu/recreation/">Recreation</a></li>
				<li><a href="http://geauxcolonels.com/">Athletics</a></li>
				<li><a href="http://www.nicholls.edu/calendar/">Events Calendar</a></li>
				<li><a href="http://www.nicholls.edu/police/">University Police</a></li>
				<li><a href="http://emergency.nicholls.edu/">Emergency Preparedness</a></li>
				<li><a href="http://www.nicholls.edu/ada/">ADA Information</a></li>			
			</ul>
		</div>
	</div>

	<div class="column-">
		<h3 class="column-title-">Explore</h3>
		<div class="column-content-">
			<ul>
				<li><a href="http://www.nicholls.edu/tours/">Campus Tours</a></li>
				<li><a href="http://www.nicholls.edu/about/visiting-thibodaux/">About Thibodaux</a></li>
				<li><a href="http://www.nicholls.edu/about/fast-facts/">Facts About</a></li>
				<li><a href="http://www.nicholls.edu/about/history-and-traditions/">History & Traditions</a></li>
				<li><a href="http://www.nicholls.edu/about/strategic-plan/">Mission & Vision</a></li>
				<li><a href="http://www.nicholls.edu/about/campus-map/">Campus Map</a></li>
				<li><a href="http://www.nicholls.edu/site-map/">Site Map</a></li>
				<li><a href="http://www.nicholls.edu/about/compliance/">Compliance & Policy Information</a></li>
			</ul>
		</div>
	</div>

	<div class="column-">
		<h3 class="column-title-">Apply</h3>
		<div class="column-content-">	
			<ul>
				<li><a href="http://www.nicholls.edu/apply/">Online Application</a></li>
				<li><a href="http://www.nicholls.edu/admission/">Office of Admissions</a></li>
				<li><a href="http://www.nicholls.edu/admission/admissions-requirements/">Admissions Criteria</a></li>
				<li><a href="http://www.nicholls.edu/orientation/">Orientation</a></li>
			</ul>
		</div>
	</div>

	<div class="column-">
		<h3 class="column-title-">News</h3>
		<div class="column-content-">	
			<ul>
				<li><a href="http://www.nicholls.edu/news/">Nicholls News</a></li>
				<li><a href="http://www.nicholls.edu/voila/">Voil&agrave;! Magazine</a></li>
				<li><a href="http://www.nicholls.edu/university-relations/">Office of University Relations</a></li>
				<li><a href="http://www.thenichollsworth.com/">The Nicholls Worth</a></li>
			</ul>
		</div>
	</div>

<?php endif; // n-app query string check ?>
		
	<?php do_action( 'fnbx_footer_end', 'footer' ) ?>
	<!-- END: footer -->

<?php do_action( 'nicholls_footer_end', 'footer-nicholls' ) ?>
<!-- END: nicholls-footer -->

<div id="nicholls-nav-go-top-wrapper" class="nicholls-nav-go-wrapper- nicholls-nav-go-top-wrapper-">
	<div id="nicholls-nav-go-top" class="nicholls-nav-go- nicholls-nav-go-top-">
	<span>Go To &uarr;</span>
	<span><a href="#access">Top</a></span>	
	</div>
</div>

<?php do_action( 'fnbx_wp_footer_before', 'wp_footer' ) ?>
<?php wp_footer() ?>
<?php do_action( 'fnbx_wp_footer_after', 'wp_footer' ) ?>

<?php do_action( 'fnbx_body_end', 'body' ) ?>
<!-- END: body -->
</body>
</html>