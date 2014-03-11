<?php
get_header();
$myCount = 1;
 ?>
			
			 <div class="featured">
        <div class="banners">
		
			<?php		$args=array(
				  'post_type' => 'post',
				  'post_status' => 'publish',
				  'posts_per_page' => 3,
				  'meta_query' => array( array('key' => '_thumbnail_id')),
				  'ignore_sticky_posts'=> 1
				);
				$my_query = null;
				$i=1;
				
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) {
				while ($my_query->have_posts()) : $my_query->the_post(); 
				if($i <= 2) { ?>
         
		  <?php if($i == 1) { 
		  	$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		   <div class="left-banners">
            <div class="top-banner">

				<div class="img" style="background-image: url(<?php echo $feat_image[0]; ?>);"></div><!--/img-->

				<a href="<?php the_permalink(); ?>" title=""><span><?php the_title(); ?></span></a>
            </div><!--/top-banner-->
			<?php } elseif($i == 2) { 

			$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
            <div class="bottom-banner">
				<div class="img" style="background-image: url(<?php echo $feat_image[0]; ?>);"></div><!--/img-->

	            <a href="<?php the_permalink(); ?>" title=""><span><?php the_title(); ?></span></a>
            </div><!--/bottom-banner-->

			<?php } ?>
		  <?php } 
		if(($i == 2) || (intval($my_query->found_posts) == 1)) {?>
			</div>
		<?php } ?>
			<?php if($i == 3) {
				$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			?>
          <div class="right-banner right">
			<div class="img" style="background-image: url(<?php echo $feat_image[0]; ?>);">
				<div class="color"></div>
			</div><!--/img-->
            <a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a>
          </div>
		  <?php } 
		  
		  $i++;
		  endwhile; 
		  }
		  
		  //Get the Theme options///
		  
		  $options = cwp_get_theme_options();
		  
		  ?>
        </div>
        <div class="top5">
          <div class="top5-title"><?php echo $options['top_5_text']; ?></div>
          <ul>
		  <?php
				$args=array(
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
				while ($my_query->have_posts()) : $my_query->the_post(); ?>
					            <li><a href="<?php the_permalink(); ?>" title=""><span><?php echo $i; ?></span><?php the_title(); ?></a></li>
					<?php
					$i++;
				  endwhile;
				}
				wp_reset_query();  // Restore global post data stomped by the_post().
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
					    
						$cat1 = get_category($options['cat1_slug']);
						$description1 = $cat1->description;
					
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


			<?php /* Start the Loop */ 
			$twocolumns = new WP_Query('posts_per_page=2&cat='.$cat1->cat_ID);
			while ($twocolumns->have_posts()) { 
				$twocolumns->the_post();
				?>
				<?php
				 get_template_part( 'content', '2' ); 
			}
				wp_reset_postdata();
			?>
		
			</section>
		<section class="two-columns">
				<?php 
						$cat2 = get_category($options['cat2_slug']);
						$description2 = $cat2->description;
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



			<?php /* Start the Loop */ 
			$twocolumns = new WP_Query('posts_per_page=2&cat='.$cat2->cat_ID);
			while ($twocolumns->have_posts()) { 
				$twocolumns->the_post();
				?>
				<?php
				 get_template_part( 'content', '2' ); 
			}
			wp_reset_postdata();
			?>
			</section>
			
		<section class="three-columns">
		<?php 
			$cat3 = get_category($options['cat3_slug']);
			$description3 = $cat3->description;
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
 			<?php /* Start the Loop */ 
			$threecolumns = new WP_Query('posts_per_page=3&cat='.$cat3->cat_ID);
			while ($threecolumns->have_posts()) { 
				$threecolumns->the_post();
				?>
				<?php
				 get_template_part( 'content', '3' ); 
			}
			wp_reset_postdata();
			?>
        </section>
			
			
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>