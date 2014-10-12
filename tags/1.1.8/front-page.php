<?php

	get_header();
	$cwp_youit_count = 1;

if ( get_option( 'show_on_front' ) == 'page' ){?>
  <div id="primary" class="content-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
<?php } else { ?>
<div class="featured">
    <div class="banners">
		<?php
			$args = array(
				'post_type' 			=> 'post',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> 3,
//				'meta_query' 			=> array( array('key' => '_thumbnail_id')),
				'ignore_sticky_posts'	=> 1
			);
			$my_query = null;
			$i = 1;
			$cwp_youit_query = new WP_Query($args);
			if( $cwp_youit_query->have_posts() ) {
				while ($cwp_youit_query->have_posts()) : $cwp_youit_query->the_post();
					if($i <= 2) {
						if($i == 1) {
							$cwp_youit_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							echo '<div class="left-banners">';
								echo '<div class="top-banner">';
								if(isset($cwp_youit_feat_image[0])):	
									echo '<div class="img" style="background-image: url('.$cwp_youit_feat_image[0].');"></div>';
								else:
									echo '<div class="img no-thumbnail"></div>';
								endif;
									echo '<a href="'.get_permalink().'" title="'.get_permalink().'"><span>'.get_the_title().'</span></a>';
								echo '</div>';
						}
						elseif($i == 2) {
							$cwp_youit_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							echo '<div class="bottom-banner">';
							if(isset($cwp_youit_feat_image[0])):
								echo '<div class="img" style="background-image: url('.$cwp_youit_feat_image[0].');"></div>';
							else:
								echo '<div class="img no-thumbnail"></div>';
							endif;
								echo '<a href="'.get_permalink().'" title=""><span>'.get_the_title().'</span></a>';
							echo '</div>';
						}
					}
					if(($i == 2) || (intval($cwp_youit_query->found_posts) == 1)) {
						echo '</div>';
					}
					if($i == 3) {
						$cwp_youit_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							echo '<div class="right-banner right">';
							if(isset($cwp_youit_feat_image[0])):
								echo '<div class="img" style="background-image: url('.$cwp_youit_feat_image[0].');">';
							else:
								echo '<div class="img no-thumbnail">';
							endif;
									echo '<div class="color"></div>';
								echo '</div>';
								echo '<a href="'.get_permalink().'" title="'.get_permalink().'">'.get_the_title().'</a>';
							echo '</div>';
					}
				$i++;
				endwhile;
			}
			wp_reset_postdata();
		  ?>
    </div><!-- END .banners -->
    <div class="top5">
		<?php
			if(get_theme_mod('top_5_text')):
				echo '<div class="top5-title">'.get_theme_mod('top_5_text').'</div>';
			endif;
		?>
        <ul>
		<?php
			$args = array(
				'orderby'				=> 'comment_count',
				'order'					=> 'DESC',
				'post_type' 			=> 'post',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> 5,
				'ignore_sticky_posts'	=> 1
			);
			$cwp_youit_query = null;
			$i=1;
			$cwp_youit_query = new WP_Query($args);
			if( $cwp_youit_query->have_posts() ) {
				while ($cwp_youit_query->have_posts()) : $cwp_youit_query->the_post();
					echo '<li><a href="'.get_permalink().'" title="'.get_permalink().'"><span>'.$i.'</span>'.get_the_title().'</a></li>';
					$i++;
				endwhile;
			}
			wp_reset_postdata();
		?>
		</ul>
        <div class="top-cwp_youit_categories top-categories">
			<ul>
				<?php wp_list_categories('title_li=&orderby=count&order=DESC&number=3'); ?>
			</ul>
		  </div>
        </div>
    </div>
    <div class="clear"></div>
	<div id="primary" class="content-area">
		<section class="two-columns">
				<?php
					if(get_theme_mod('cat1_slug')):
					    $cwp_youit_cat1 = get_category(get_theme_mod('cat1_slug'));
						$cwp_youit_description1 = $cwp_youit_cat1->description;
					else:
						$cwp_youit_categories = get_categories(array('number' => 1));
						if(isset($cwp_youit_categories) && !empty($cwp_youit_categories) && isset($cwp_youit_categories[0]) && isset($cwp_youit_categories[0]->cat_ID)):
							$cwp_youit_cat1 = get_category($cwp_youit_categories[0]->cat_ID);
							$cwp_youit_description1 = $cwp_youit_cat1->description;
						endif;
					endif;
				?>
				<header class="section-title news">
					<?php
						if($cwp_youit_description1 == FALSE ) {
							echo '
								<h2 class="nodesc">' . $cwp_youit_cat1->cat_name . '</h2>
								<span class="more nodesc"><a href="' . esc_url(get_category_link($cwp_youit_cat1->cat_ID)) . '" title="">View all</a></span>
							';
						} else {
							echo '
								<h2>' . $cwp_youit_cat1->cat_name . '</h2>
								<span class="subtitle">' . $cwp_youit_description1 . '</span>
								<span class="more"><a href="' . esc_url(get_category_link($cwp_youit_cat1->cat_ID)) . '" title="">View all</a></span>
							';
						}
					?>
				</header>
			<?php
			$cwp_youit_twocolumns = new WP_Query('posts_per_page=2&cat='.$cwp_youit_cat1->cat_ID);
			while ($cwp_youit_twocolumns->have_posts()) {
				$cwp_youit_twocolumns->the_post();
				get_template_part( 'content', '2' );
			}
			wp_reset_postdata();
			?>
		</section>
		<section class="two-columns">
				<?php
					if(get_theme_mod('cat2_slug')):
					    $cwp_youit_cat2 = get_category(get_theme_mod('cat2_slug'));
						$cwp_youit_description2 = $cwp_youit_cat2->description;
					else:
						$cwp_youit_categories = get_categories(array('number' => 1));
						if(isset($cwp_youit_categories) && !empty($cwp_youit_categories) && isset($cwp_youit_categories[0]) && isset($cwp_youit_categories[0]->cat_ID)):
							$cwp_youit_cat2 = get_category($cwp_youit_categories[0]->cat_ID);
							$cwp_youit_description2 = $cwp_youit_cat2->description;
						endif;
					endif;
				?>

				<header class="section-title reviews">
					<?php
						if($cwp_youit_description2 == 0 ) {
							echo '
								<h2 class="nodesc">' . $cwp_youit_cat2->cat_name . '</h2>
								<span class="more nodesc"><a href="' . esc_url(get_category_link($cwp_youit_cat2->cat_ID)) . '" title="">View all</a></span>
							';
						} else {
							echo '
								<h2>' . $cwp_youit_cat2->cat_name . '</h2>
								<span class="subtitle">' . $cwp_youit_description2 . '</span>
								<span class="more"><a href="' . esc_url(get_category_link($cwp_youit_cat2->cat_ID)) . '" title="">View all</a></span>
							';
						}
					?>
				</header>
			<?php
			$cwp_youit_twocolumns = new WP_Query('posts_per_page=2&cat='.$cwp_youit_cat2->cat_ID);
			while ($cwp_youit_twocolumns->have_posts()) {
				$cwp_youit_twocolumns->the_post();
				get_template_part( 'content', '2' );
			}
			wp_reset_postdata();
			?>
			</section>
			<section class="three-columns">
				<?php
					if(get_theme_mod('cat3_slug')):
					    $cwp_youit_cat3 = get_category(get_theme_mod('cat3_slug'));

						$cwp_youit_description3 = $cwp_youit_cat3->description;
					else:
						$cwp_youit_categories = get_categories(array('number' => 1));
						if(isset($cwp_youit_categories) && !empty($cwp_youit_categories) && isset($cwp_youit_categories[0]) && isset($cwp_youit_categories[0]->cat_ID)):
							$cwp_youit_cat3 = get_category($cwp_youit_categories[0]->cat_ID);
							$cwp_youit_description3 = $cwp_youit_cat3->description;
						endif;
					endif;
				?>
				<header class="section-title articles">
					<?php
						if($cwp_youit_description3 == 0 ) {
							echo '
								<h2 class="nodesc">' . $cwp_youit_cat3->cat_name . '</h2>
								<span class="more nodesc"><a href="' . esc_url(get_category_link($cwp_youit_cat3->cat_ID)) . '" title="">View all</a></span>
							';
						} else {
							echo '
								<h2>' . $cwp_youit_cat3->cat_name . '</h2>
								<span class="subtitle">' . $cwp_youit_description3 . '</span>
								<span class="more"><a href="' . esc_url(get_category_link($cwp_youit_cat3->cat_ID)) . '" title="">View all</a></span>
							';
						}
					?>
				</header>
 			<?php
			$cwp_youit_threecolumns = new WP_Query('posts_per_page=3&cat='.$cwp_youit_cat3->cat_ID);
			while ($cwp_youit_threecolumns->have_posts()) {
				$cwp_youit_threecolumns->the_post();
				get_template_part( 'content', '3' );
			}
			wp_reset_postdata();
			?>
        </section>
</div>
<?php
}
get_sidebar(); ?>
<?php get_footer(); ?>