<?php
get_header(); ?>
	<section id="primary" class="content-area">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'cwp' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'cwp' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'cwp' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'cwp' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cwp' ) ) . '</span>' );
					else :
						_e( 'Archives', 'cwp' );
					endif;
				?></h1>
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
			
			if(!is_int($cwp_youit_i-1/2)) {
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