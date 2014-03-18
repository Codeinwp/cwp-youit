<?php
if ( ! isset( $content_width ) )
	$content_width = 625;
function cwp_wp_nav_menu_args( $args = '' ) {
	$args['container'] = '';
	$args['items_wrap'] = '%3$s';
	return $args;
}
add_filter( 'wp_nav_menu_args', 'cwp_wp_nav_menu_args' );
function cwp_setup() {
	load_theme_textdomain( 'cwp', get_template_directory() . '/languages' );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'cwp' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'cwp' ) );
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
	
 
	add_image_size( 'fo-thumb', 459, 158, true );
	add_image_size( 'fv-thumb', 180, 329, true );
	add_image_size( 'big-thumb', 300, 176, true );
	add_image_size( 'small-thumb', 134, 100, true );
	
	
	$args = array(
		'width'         => 960,
		'height'        => 60,
		'default-image' => '',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'cwp_setup' );
function cwp_do_media() {
	wp_enqueue_media();
	wp_enqueue_script('media-upload');
}
add_action('admin_enqueue_scripts', 'cwp_do_media');
/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
 * Adds support for a custom header image.
 */ 
 
add_action( 'pre_get_posts', 'cwp_search_by_cat' );
function cwp_search_by_cat()
	{
		if ( is_search())
			{
				$myCat = get_query_var('cat');
				$cat = empty( $myCat ) ? '' : (int) $myCat;
				add_query_arg( 'cat', $cat );
			}
	}

	
class cwp_Walker_Category_Checklist extends Walker {
	var $tree_type = 'category';
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id'); //TODO: decouple this
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	function start_el( &$output, $category, $depth=0, $args=Array(), $id = 0 ) {
		extract($args);
		if ( empty($taxonomy) )
			$taxonomy = 'category';
		if ( $taxonomy == 'category' )
			$name = 'post_category';
		else
			$name = 'tax_input['.$taxonomy.']';
		$class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
		if($category->count >= 1)
		$output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
	}
	function end_el( &$output, $category, $depth = 0, $args = array() ) {
		if($category->count >=1)
			$output .= "</li>\n";
	}
}
class cwp_Walker_Category_radio extends Walker {
	var $tree_type = 'category';
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id'); //TODO: decouple this
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	function start_el( &$output, $category, $depth=0, $args=Array(), $id = 0 ) {
		extract($args);
		if ( empty($taxonomy) )
			$taxonomy = 'category';
		if ( $taxonomy == 'category' )
			$name = 'post_category';
		else
			$name = 'tax_input['.$taxonomy.']';
		$class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
		if($category->count >= 1)
		$output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="radio" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
	}
	function end_el( &$output, $category, $depth = 0, $args = array() ) {
		if($category->count >=1)
			$output .= "</li>\n";
	}
}
 class cwp_Walker_Nav_menu extends Walker_Nav_Menu {
	/**
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	/**
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}
	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$description = ! empty( $item->attr_title ) ? ' <span>'  . esc_attr( $item->attr_title ) .'</span>' : '';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ).$description. $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}
 
 
function cwp_scripts_styles() {
	global $wp_styles;
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	 wp_enqueue_script('jquery');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'cwp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'cwp-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */
	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'cwp' ) ) {
		$subsets = 'latin,latin-ext';
		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'cwp' );
		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';
		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'cwp-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}
	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'cwp-style', get_stylesheet_uri() );
	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'cwp-ie', get_template_directory_uri() . '/css/ie.css', array( 'cwp-style' ), '20121010' );
	$wp_styles->add_data( 'cwp-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'cwp_scripts_styles' );
/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since cwp 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function cwp_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	// Add the site name.
	$title .= get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'cwp' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'cwp_wp_title', 10, 2 );
/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since cwp 1.0
 */
function cwp_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'cwp_page_menu_args' );
/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since cwp 1.0
 */
function cwp_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'cwp' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'cwp' ),
		'before_widget' => '<aside id="%1$s" class="all-about">',
		'after_widget' => '</aside>',
		'before_title' => '<span>',
		'after_title' => '</span>',
	) );
	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'cwp' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'cwp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'cwp' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'cwp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'First footer widget area', 'cwp' ),
		'id' => 'sidebar-first-footer',
		'description' => __( 'Appears in footer', 'cwp' ),
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<span>',
		'after_title' => '</span>',
	) );
	
}
add_action( 'widgets_init', 'cwp_widgets_init' );
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since cwp 1.0
 */
function cwp_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cwp' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cwp' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own cwp_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since cwp 1.0
 */
function cwp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'cwp' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'cwp' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
		<article id="comment-<?php comment_ID(); ?>" class="media">
				<div class='pull-left'>
					<?php	echo get_avatar( $comment, 44 ); ?>
				</div> 
				<section class="media-body">
				<h5 class="media-heading">
				<?php
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'cwp' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'cwp' ), get_comment_date(), get_comment_time() )
					);
				?>
				</h5>
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cwp' ); ?></p>
			<?php endif; ?>
			
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'cwp' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'cwp' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own cwp_entry_meta() to override in a child theme.
 *
 * @since cwp 1.0
 */
function cwp_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'cwp' ) );
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'cwp' ) );
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cwp' ), get_the_author() ) ),
		get_the_author()
	);
	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'cwp' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'cwp' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'cwp' );
	}
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}

/* excerpt limit */ 
add_filter( 'excerpt_length', 'cwp_excerpt_length', 999 ); 
function cwp_excerpt_length( $length ) {
	return 30;
}

/* default title */
add_filter( 'the_title', 'cwp_no_title');
function cwp_no_title ($title) {
	if( $title == "" ){
		$title = "(No title)";
	}
	return $title;
}

function custom_search_form( $form ) {
    $form = '<form method="get" id="quick-search" action="'.esc_url( home_url( '/' ) ).'" >';

    $form .= '<input type="text" value="' . get_search_query() . '" name="s" id="s" />';
    $form .= '<input type="submit" value="Search" id="header-submit" />';

    $form .= '</form>';
    return $form;
}
add_filter( 'get_search_form', 'custom_search_form' );

function cwp_search_form_header( $form ) {
	$cats = array();
	$categories = get_categories();
	foreach($categories as $categ):
		if(get_theme_mod($categ->slug)):
			array_push($cats, $categ);
		endif;
	endforeach;	

	if(isset($_GET['cat'])) {
		$catToSearch = $_GET['cat'];
	}
	else {
		$catToSearch = false;
	}
	if(!$catToSearch) {
		$tmpc = "1";
	}
	else {
		$tmpc = "0";
	}
	
	$form = '<form action="'.esc_url( home_url( '/' ) ).'" method="GET">';
		$form .= '<div class="search-location">';
			$form .= '<span>'.__('Search in:','cwp').'</span>';
			$form .= '<input type="radio" name="cat" value="all" id="catall" '.checked( $tmpc, "1", false ).' />';
			$form .= '<label for="catall">'.__('All Categories', 'cwp').'</label>';
			
			foreach($cats as $cat) { 
				$form .= '<input type="radio" id="s'.$cat->cat_ID.'" name="cat" value="'.$cat->cat_ID.'" '.checked( $catToSearch, $cat->cat_ID, false ).' />';
				$form .= '<label for="s'.$cat->cat_ID.'">'.$cat->name.'</label>';
			}
		$form .= '</div>';
		$form .= '<div class="span6 search-box">';
			$form .= '<span class="left"></span>';
			if(isset($_GET['s'])){
				$tmp_val = esc_attr($_GET['s']);
			}
			else {
				$tmp_val = "";
			}
			$form .= '<input value="'.$tmp_val.'" name="s" type="text"/>';
				$form .= '<input type="submit" value=""/>';
				$form .= '<span class="right"></span>';
		$form .= '</div>';
	$form .= '</form>';
	return $form;
}
function cwp_add_editor_styles() {
    add_editor_style( '/css/custom-editor-style.css' );
}
add_action( 'init', 'cwp_add_editor_styles' );