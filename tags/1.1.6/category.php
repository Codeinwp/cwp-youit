<?php
get_header(); ?>
	<section id="primary" class="content-area">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( '%s', 'cwp' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->
			<?php
			/* Start the Loop */
			$cwp_youit_i = 1;
			while ( have_posts() ) : the_post();
				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				 if(is_int(($cwp_youit_i-1)/2) || ($cwp_youit_i == 1)) {
					?><section class='two-columns'><?php
				 }
				get_template_part( 'content', '2');
				
				if(is_int($cwp_youit_i/2) ) {
				?></section> <?php
				
				}
				$cwp_youit_i++;
			endwhile;
			
			if(!is_int(($cwp_youit_i-1)/2)) {
				?></section><?php
			}
			cwp_content_nav( 'nav-below' );
			?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>