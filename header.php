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
  <div class="header">
    <div class="container">
	<?php $options = cwp_get_theme_options(); 
		  $cats = array_map('intval', explode(", ", $options['searchcat']));
		  if(isset($_GET['cat'])) {
			$catToSearch = $_GET['cat'];
		  }
		  else {
			$catToSearch = false;
		  }
		  ?>
      <div class="logo left">
        <a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" ><img src="<?php echo $options['logo']; ?>" alt="YouIT"></a>
      </div>
      <div class="span7 search">
	  <form action='<?php echo esc_url( home_url( '/' ) ); ?>' method='GET'>
        <div class="search-location">
          <span><?php _e('Search in:','cwp'); ?></span>
		  <input type="radio" name="cat" value="all" id='catall' <?php if(!$catToSearch) {?> CHECKED <?php } ?> /><label for="catall"><?php _e('All Categories', 'cwp'); ?></label>
		  <?php foreach($cats as $cat) {
			$myCat = get_category($cat);
		  ?>
			<input type="radio" id="s<?php echo $myCat->cat_ID; ?>" name="cat" value="<?php echo $myCat->cat_ID; ?>" <?php  if($catToSearch == $myCat->cat_ID) { ?> CHECKED <?php  } ?>/><label for="s<?php echo $myCat->cat_ID; ?>"><?php echo $myCat->cat_name; ?></label>
		  <?php } ?>
        </div>
        <div class="span6 search-box">
          <span class="left"></span>
          <input <?php if(isset($_GET['s'])) { ?> value='<?php echo esc_attr($_GET['s']); ?>' <?php } ?> name='s' type="text"/>
          <input type="submit" value=""/>
          <span class="right"></span>
      </div>
	  </form>
      </div>
    </div>
  </div>
  <div class="navigation">
    <div class="container">
        <nav class="navbar">
          <ul class="nav">
            <li><a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo  get_template_directory_uri(); ?>/images/nav-home.png" alt=""/></a></li>
			         <?php wp_nav_menu( array( 'container'	=>	false, 'theme_location' => 'primary', 'walker'=> new cwp_Walker_Nav_menu(), 'fallback_cb'=> false,  'menu_class' => '', 'depth'=> 2,  'items_wrap' => '%3$s') ); ?>
          </ul>
        </nav>
    </div>
  </div>
    <div id="main" class="container site-main">