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
	
<?php do_action( 'fnbx_wrapper_end', 'wrapper' ) ?>
<!-- END: wrapper -->	

<!-- START: nicholls-footer -->
<?php do_action( 'nicholls_footer_start', 'footer-nicholls' ) ?> 

	<!-- START: footer -->
	<?php do_action( 'fnbx_footer_start', 'footer' ) ?>
		<?php do_action( 'fnbx_footer', 'footer' ) ?>
		
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
			<li><a href="http://www.nicholls.edu/athletics/">Athletics</a></li>
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

<div id="nicholls-info-copyright" class="nicholls-info-copyright-">
	<small>&copy; <?php echo date("Y") ?> Nicholls State University</small>
</div>
		
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