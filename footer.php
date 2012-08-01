<?php
/**
* Footer Template
*
* Template for standard footer.
*
* @package FNBX Theme
* @subpackage Template
*/
?>

		<?php do_action( 'fnbx_content_end', 'content' ) ?>
		<!-- END: content -->

	<?php do_action( 'fnbx_container_end', 'container' ) ?>
	<!-- END: container -->

	<!-- START: footer -->
	<?php do_action( 'fnbx_footer_start', 'footer' ) ?>
		<?php do_action( 'fnbx_footer', 'footer' ) ?>
		
<div class="column-">
	<h3>Learn</h3>
	<ul>
		<li><a href="http://www.nicholls.edu/programs/">Degree Programs</a></li>
		<li><a href="http://www.nicholls.edu/honors/">Honors Program</a></li>
		<li><a href="http://www.nicholls.edu/financial-aid/">Financial Aid & Scholarships</a></li>
		<li><a href="http://www.nicholls.edu/fees/">Fee Information</a></li>
		<li><a href="http://www.nicholls.edu/request-info/">Request Information</a></li>
	</ul>
</div>

<div class="column-">
	<h3>Live</h3>
	<ul>
		<li><a href="http://www.nicholls.edu/housing/">Housing & Meal Plans</a></li>
		<li><a href="http://www.nicholls.edu/organizations/">Student Organizations</a></li>
		<li><a href="http://www.nicholls.edu/recreation/">Recreation</a></li>
		<li><a href="http://www.nicholls.edu/athletics/">Athletics</a></li>
		<li><a href="http://www.nicholls.edu/calendar/">Events Calendar</a></li>
		<li><a href="http://emergency.nicholls.edu/">Emergency Preparedness</a></li>
	</ul>
</div>

<div class="column-">
	<h3>Explore</h3>
	<ul>
		<li><a href="http://www.nicholls.edu/tours/">Campus Tours</a></li>
		<li><a href="http://www.nicholls.edu/about/visiting-thibodaux/">About Thibodaux</a></li>
		<li><a href="http://www.nicholls.edu/about/fast-facts/">Facts About</a></li>
		<li><a href="http://www.nicholls.edu/about/history-and-traditions/">History & Traditions</a></li>
		<li><a href="http://www.nicholls.edu/about/strategic-plan/">Mission & Vision</a></li>
		<li><a href="http://www.nicholls.edu/about/campus-map/">Campus Map</a></li>
		<li><a href="http://www.nicholls.edu/disclaimer/">Legal Disclaimer</a></li>
		<li><a href="http://www.nicholls.edu/ada/">ADA Coordinator</a></li>
	</ul>
</div>

<div class="column-">
	<h3>Apply</h3>
	<ul>
		<li><a href="http://www.nicholls.edu/apply/">Online application</a></li>
		<li><a href="http://www.nicholls.edu/admission/">Office of Admissions</a></li>
		<li><a href="http://www.nicholls.edu/admission/admissions-requirements/">Admissions Criteria</a></li>
		<li><a href="http://www.nicholls.edu/orientation/">Orientation</a></li>
	</ul>
</div>

<div class="column-">
	<h3>News</h3>
	<ul>
		<li><a href="http://www.nicholls.edu/news/">Nicholls News</a></li>
		<li><a href="http://www.nicholls.edu/voila/">Voil&agrave;! Magazine</a></li>
		<li><a href="http://www.nicholls.edu/university-relations/">Office of University Relations</a></li>
		<li><a href="http://www.thenichollsworth.com/">The Nicholls Worth</a></li>
	</ul>
</div>
		
	<?php do_action( 'fnbx_footer_end', 'footer' ) ?>
	<!-- END: footer -->

<?php do_action( 'fnbx_wrapper_end', 'wrapper' ) ?>
<!-- END: wrapper -->

<?php do_action( 'fnbx_wp_footer_before', 'wp_footer' ) ?>
<?php wp_footer() ?>
<?php do_action( 'fnbx_wp_footer_after', 'wp_footer' ) ?>

<?php do_action( 'fnbx_body_end', 'body' ) ?>
<!-- END: body -->
</body>
</html>