<article class="small-post-area">
    <?php 
		if ( has_post_thumbnail() ):
		?>
			<a href="<?php the_permalink(); ?>" class="small-thumb-wrap" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('small-thumb'); ?>
			</a>	
		<?php else: ?>
			<a href="<?php the_permalink(); ?>" class="small-thumb-wrap">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-image-default-small.png" class="attachment-big-thumb wp-post-image"?>
			</a>
		<?php
			endif;
	    ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
</article>
