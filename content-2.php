<article>
    <?php 
		if ( has_post_thumbnail() ):
		?>
			<a href="<?php the_permalink(); ?>" class="thumbnail-wrap" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('big-thumb'); ?>
			</a>	
		<?php else: ?>
			<a href="<?php the_permalink(); ?>" class="thumbnail-wrap">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-image-default.png" class="attachment-big-thumb wp-post-image"?>
			</a>
		<?php
			endif;
	    ?>
    <header>
        <h3><?php the_title(); ?></h3>
    </header>
    <p><?php the_excerpt(); ?></p>
    <div class="readmore-wrap">
	    <a href="<?php the_permalink(); ?>" title="<?php the_permalink(); ?>" class="readmore"><?php _e('Read more','cwp')?></a>
	</div>
 </article>
