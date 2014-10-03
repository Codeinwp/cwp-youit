<?php
get_header(); ?>
	<div id="primary" class="content-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php 
				get_template_part( 'content', get_post_format() ); 
				?>
				
				<?php if( function_exists(get_social_icons)): ?>
					<div class="social-wrap-single">
						<?php get_social_icons(); ?>
					</div>
				<?php endif;?>

				<?php
				$cwp_youit_prev_post = get_adjacent_post(false, '', true);
				$cwp_youit_next_post = get_adjacent_post(false, '', false);
				if(!empty($cwp_youit_next_post) || !empty($cwp_youit_prev_post)) {
				?>				
				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'cwp' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'cwp' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'cwp' ) . '</span>' ); ?></span>
					<div class="clearfix"></div>
				</nav><!-- .nav-single -->

				<?php if( function_exists(cwp_related_post)): ?>
					<div class="related-post-single">
						<?php cwp_related_post(); ?>
					</div>
				<?php endif; ?>

				<?php } comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>