<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if(get_header_image()): ?>
	<div class="container">
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
	</div>
	<?php endif; ?>
	<div class="header">
		<div class="container">
			<?php
			if(get_theme_mod('logo')):
				echo ' <div class="logo left">';
					echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home"><img src="'.get_theme_mod('logo').'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"></a>';
				echo '</div>';
			else:
				echo ' <div class="span3 main-title">';
					echo '<h1><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';
					echo '<h2><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'description' ).'</a></h2>';
				echo '</div>';
			endif;
			?>
			<div class="search-header">
			<?php
				add_filter( 'get_search_form', 'cwp_search_form_header' );
				get_search_form();
				remove_filter( 'get_search_form', 'cwp_search_form_header' );
			?>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
		<div class="clearfix"></div>
	</div><!-- .header -->

  <div class="navigation navigation-top">
    <div class="container">

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h1 class="menu-toggle"><?php _e( 'Menu', 'cwp' ); ?></h1>

          	<ul class="nav">
           		<li class="homebtn">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo  get_template_directory_uri(); ?>/images/nav-home.png" alt=""/>
					</a>
				</li>
				<?php wp_nav_menu( array( 
									'container'			=>	false, 
									'theme_location' 	=> 'primary', 
									'walker'			=> new cwp_Walker_Nav_menu(), 
									'fallback_cb'		=> false,  
									'menu_class' 		=> '', 
									'depth'				=> 2,  
									'items_wrap' 		=> '%3$s'
								) ); ?>
          	</ul>
          	<div class="clearfix"></div>
		</nav><!-- #site-navigation -->

		<div class="clearfix"></div>
    </div>
  </div>
    <div id="main" class="container site-main">