<?php @header('Content-Type: text/html; charset=' . get_option('blog_charset')); ?>

<?php while ( have_posts() ) : the_post() ?>
		
	<?php the_content(); ?>
				
<?php endwhile; ?>

