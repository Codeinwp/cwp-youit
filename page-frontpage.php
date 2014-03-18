<?php
	/*
	Template Name: Custom frontpage template
	*/
	
	get_header();
	$myCount = 1;
 ?>
			
<div class="featured">
    <div class="banners">
		<?php		
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 3,
				'meta_query' => array( array('key' => '_thumbnail_id')),
				'ignore_sticky_posts'=> 1
			);
			$my_query = null;
			$i = 1;
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post(); 
					if($i <= 2) {
						if($i == 1) { 
							$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							echo '<div class="left-banners">';
								if(isset($feat_image[0])):
								echo '<div class="top-banner">';
									echo '<div class="img" style="background-image: url('.$feat_image[0].');"></div>';
									echo '<a href="'.get_permalink().'" title="'.get_permalink().'"><span>'.get_the_title().'</span></a>';
								echo '</div>';
								endif;
						} 
						elseif($i == 2) { 
							$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
							if(isset($feat_image[0])):
							echo '<div class="bottom-banner">';
								echo '<div class="img" style="background-image: url('.$feat_image[0].');"></div>';
								echo '<a href="'.get_permalink().'" title=""><span>'.get_the_title().'</span></a>';
							echo '</div>';
							endif;
						}
					} 
					if(($i == 2) || (intval($my_query->found_posts) == 1)) {
						echo '</div>';
					}
					if($i == 3) {
						$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
						if(isset($feat_image[0])):
							echo '<div class="right-banner right">';
								echo '<div class="img" style="background-image: url('.$feat_image[0].');">';
									echo '<div class="color"></div>';
								echo '</div>';
								echo '<a href="'.get_permalink().'" title="'.get_permalink().'">'.get_the_title().'</a>';
							echo '</div>';
						endif;	
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
				'orderby'=>'comment_count',
				'order'=>'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 5,
				'ignore_sticky_posts'=> 1
			);
			$my_query = null;
			$i=1;
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post();
					echo '<li><a href="'.get_permalink().'" title="'.get_permalink().'"><span>'.$i.'</span>'.get_the_title().'</a></li>';
					$i++;
				endwhile;
			}
			wp_reset_postdata();
		?>
		</ul>
        <div class="top-categories">
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
					    $cat1 = get_category(get_theme_mod('cat1_slug'));
						$description1 = $cat1->description;
					else:
						$categories = get_categories(array('number' => 1));
						if(isset($categories) && !empty($categories) && isset($categories[0]) && isset($categories[0]->cat_ID)):
							$cat1 = get_category($categories[0]->cat_ID);
							$description1 = $cat1->description;
						endif;					
					endif;	
				?>
				<header class="section-title news">
					<?php 
						if($description1 == FALSE ) {
							echo '
								<h2 class="nodesc">' . $cat1->cat_name . '</h2>
								<span class="more nodesc"><a href="' . esc_url(get_category_link($cat1->cat_ID)) . '" title="">View all</a></span>
							';
						} else {
							echo '
								<h2>' . $cat1->cat_name . '</h2>
								<span class="subtitle">' . $description1 . '</span>
								<span class="more"><a href="' . esc_url(get_category_link($cat1->cat_ID)) . '" title="">View all</a></span>
							';
						} 
					?>
				</header>
			<?php 
			$twocolumns = new WP_Query('posts_per_page=2&cat='.$cat1->cat_ID);
			while ($twocolumns->have_posts()) { 
				$twocolumns->the_post();
				get_template_part( 'content', '2' ); 
			}
			wp_reset_postdata();
			?>
		</section>
		<section class="two-columns">
				<?php 
					if(get_theme_mod('cat2_slug')):
					    $cat2 = get_category(get_theme_mod('cat2_slug'));
						$description2 = $cat2->description;
					else:
						$categories = get_categories(array('number' => 1));
						if(isset($categories) && !empty($categories) && isset($categories[0]) && isset($categories[0]->cat_ID)):
							$cat2 = get_category($categories[0]->cat_ID);
							$description2 = $cat2->description;
						endif;					
					endif;	
				?>

				<header class="section-title reviews">
					<?php 
						if($description2 == 0 ) {
							echo '
								<h2 class="nodesc">' . $cat2->cat_name . '</h2>
								<span class="more nodesc"><a href="' . esc_url(get_category_link($cat2->cat_ID)) . '" title="">View all</a></span>
							';
						} else {
							echo '
								<h2>' . $cat2->cat_name . '</h2>
								<span class="subtitle">' . $description2 . '</span>
								<span class="more"><a href="' . esc_url(get_category_link($cat2->cat_ID)) . '" title="">View all</a></span>
							';
						} 
					?>
				</header>
			<?php 
			$twocolumns = new WP_Query('posts_per_page=2&cat='.$cat2->cat_ID);
			while ($twocolumns->have_posts()) { 
				$twocolumns->the_post();
				get_template_part( 'content', '2' ); 
			}
			wp_reset_postdata();
			?>
			</section>
			<section class="three-columns">
				<?php 
					if(get_theme_mod('cat3_slug')):
					    $cat3 = get_category(get_theme_mod('cat3_slug'));
						$description3 = $cat3->description;
					else:
						$categories = get_categories(array('number' => 1));
						if(isset($categories) && !empty($categories) && isset($categories[0]) && isset($categories[0]->cat_ID)):
							$cat3 = get_category($categories[0]->cat_ID);
							$description3 = $cat3->description;
						endif;					
					endif;						
				?>
				<header class="section-title articles">
					<?php 
						if($description3 == 0 ) {
							echo '
								<h2 class="nodesc">' . $cat3->cat_name . '</h2>
								<span class="more nodesc"><a href="' . esc_url(get_category_link($cat3->cat_ID)) . '" title="">View all</a></span>
							';
						} else {
							echo '
								<h2>' . $cat3->cat_name . '</h2>
								<span class="subtitle">' . $description3 . '</span>
								<span class="more"><a href="' . esc_url(get_category_link($cat3->cat_ID)) . '" title="">View all</a></span>
							';
						} 
					?>
				</header>
 			<?php  
			$threecolumns = new WP_Query('posts_per_page=3&cat='.$cat3->cat_ID);
			while ($threecolumns->have_posts()) { 
				$threecolumns->the_post();
				get_template_part( 'content', '3' ); 
			}
			wp_reset_postdata();
			?>
        </section>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>