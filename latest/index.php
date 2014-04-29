<?php get_header(); ?>
<div id="primary" class="content-area">
	<section class="full-width">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post(); 
					get_template_part( 'content', '2' ); 
				endwhile;
				cwp_content_nav( 'nav-below' );
			endif;
		?>
	</section>			
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>