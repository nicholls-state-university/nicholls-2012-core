<?php
/*
Template Name: Archives Monthly
*/
?>

<?php get_header() ?>

		<?php do_action( 'fnbx_template_page_start', 'template_page' ) ?><!-- START: template_page -->

			<!-- START: Loop Template Part -->
			<?php do_action( "fnbx_template_loop_start", $fnbx->template_part_name  ) ?>
			<?php do_action( "fnbx_template_loop_{$fnbx->template_part_name}_start", $fnbx->template_part_name ) ?>
			
			<?php 
			
			/* 
			Show next & previous navigation when applicable 
			
			Need to study the behavor of
			
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<?php fnbx_post_navigation_box_auto( 'above' ); ?>
			<?php endif; ?>
			
			*/ 
			?>
			<?php fnbx_post_navigation_box_auto( 'above' ); ?>
						
			<?php while ( have_posts() ) : the_post() ?>
			
				<!-- START: post -->
				<?php do_action( 'fnbx_template_loop_post_start', fnbx_get_the_id() ) ?>
				<?php do_action( "fnbx_template_loop_{$fnbx->template_part_name}_post_start", fnbx_get_the_id() ) ?>
			
					<?php do_action( 'fnbx_template_loop_entry_title', fnbx_get_the_id() ) ?>
						
						<!-- START: entry-content -->
						<?php do_action( 'fnbx_template_loop_content_start', 'entry-content' ) ?>
						<?php do_action( "fnbx_template_loop_content_{$fnbx->template_part_name}_start", 'entry-content'  ) ?>
							
							<?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'fnbx_lang' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="link-pages">' . __( 'Pages:', 'fnbx_lang' ), 'after' => '</div>' ) ); ?>

							<h2>Archives by Month:</h2>
							<ul>
								<?php wp_get_archives('type=monthly'); ?>
							</ul>
							
						<?php do_action( "fnbx_template_loop_content_{$fnbx->template_part_name}_end", 'entry-content'  ) ?>
						<?php do_action( 'fnbx_template_loop_content_end', 'entry-content' ) ?>
						<!-- END: entry-content -->
				
				<?php do_action( "fnbx_template_loop_{$fnbx->template_part_name}_post_end", fnbx_get_the_id() ) ?>		
				<?php do_action( 'fnbx_template_loop_post_end', fnbx_get_the_id() ) ?>
				<!-- END: post -->
			
			<?php endwhile; ?>
			
			<?php /* Show next & previous navigation when applicable */ ?>
			<?php fnbx_post_navigation_box_auto( 'below' ); ?>
			
			<?php do_action( "fnbx_template_loop_{$fnbx->template_part_name}_end", $fnbx->template_part_name ) ?>
			<?php do_action( "fnbx_template_loop_end", $fnbx->template_part_name  ) ?>
			<!-- END: Loop Template Part -->

		<?php do_action( 'fnbx_template_page_end', 'template_page' ) ?><!-- END: template_page -->

<?php get_sidebar() ?>

<?php get_footer() ?>