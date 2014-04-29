<?php
get_header(); ?>
	<section id="primary" class="content-area">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'cwp' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>
			<?php // cwp_content_nav( 'nav-above' ); 
			$i = 1;
			while ( have_posts() ) : the_post();
				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				 if(is_int(($i-1)/2) || ($i == 1)) {
					?><section class='two-columns'><?php
				 }
				get_template_part( 'content', '2');
				
				if(is_int($i/2) ) {
				?></section> <?php
				
				}
				$i++;
			endwhile;
			
			if(!is_int(($i-1)/2)) {
				?></section><?php
			}
			 cwp_content_nav( 'nav-below' ); ?>
		<?php else : ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'cwp' ); ?></h1>
				</header>
				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'cwp' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		<?php endif; ?>
	</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>