 
 <article>
           <?php the_post_thumbnail('big-thumb'); ?>
            <header>
              <h3><?php the_title(); ?></h3>
            </header>
            <p><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" title=""><?php _e('Read more','cwp')?></a>
 </article>
