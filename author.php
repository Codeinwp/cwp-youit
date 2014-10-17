<?php
get_header(); ?>
	<section id="primary" class="content-area">
		<?php if ( have_posts() ) : ?>
			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'cwp' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header><!-- .archive-header -->
			<?php
			
				rewind_posts();
			?>
			<?php cwp_content_nav( 'nav-above' ); ?>
			<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'cwp_author_bio_avatar_size', 60 ) ); ?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'cwp' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div><!-- .author-description	-->
			</div><!-- .author-info -->
			<?php endif; 
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
			 cwp_content_nav( 'nav-below' ); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>