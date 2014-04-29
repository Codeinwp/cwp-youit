<?php
get_header(); ?>
	<div id="primary" class="content-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>