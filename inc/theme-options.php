<?php
function cwp_settings_field_cat() {
	$options = cwp_get_theme_options();
?>
<div id='cat-box' style='display:none'>
	<div style='overflow:scroll; width:600px; height:330px;'>
	<ul id='sluglist'>
		<?php wp_category_checklist(0, 0, array(intval($options['cat1_slug'])), false, new cwp_Walker_Category_radio()); ?>
	</ul>
	
</div>
<input type='button' onclick="javascript:tb_remove()" value='Select' id='catboxbutton' />
</div>
<div style='display:inline' id='cat-current-name1'><?php $category = get_category($options['cat1_slug']); echo $category->cat_name; ?></div>
<input type='hidden' id='catbox' name='cwp_theme_options[cat1_slug]' value="<?php echo esc_attr( $options['cat1_slug'] ); ?>" /> <a href='#TB_inline?width=450&height=600&inlineId=cat-box' class='thickbox'><?php _e('Select', 'cwp'); ?></a>
	<script type='text/javascript'>
		jQuery('#catboxbutton').click(function() {
			jQuery('#catbox').val(jQuery('#sluglist input:CHECKED').val());
			jQuery('#cat-current-name1').text(jQuery('#sluglist input:CHECKED').parent().text());
		});
	</script>
<?php
}
function cwp_logo() {
	$options = cwp_get_theme_options();
?>
<img id='logodemo' src='<?php echo esc_attr($options['logo'] );  ?>' style='max-width:60px;' />
<input type='hidden' id='logoUpload' name='cwp_theme_options[logo]' value="<?php echo esc_attr( $options['logo'] ); ?>" />  <input id="logoUpload_button" type="button" value="<?php _e('Upload Logo', 'cwp'); ?>" />
<script type='text/javascript'>
jQuery('#logoUpload_button').click(function() {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    wp.media.editor.send.attachment = function(props, attachment) {
        jQuery('#logoUpload').val(attachment.url);
        jQuery('#logodemo').attr('src', attachment.url);
        wp.media.editor.send.attachment = send_attachment_bkp;
    }
    wp.media.editor.open();
    return false;       
});
</script>
<?php
}

function cwp_footer_logo() {
	$options = cwp_get_theme_options();
?>
<img id='footerlogodemo' src='<?php echo esc_attr($options['footer_logo'] );  ?>' style='max-width:60px;' />
<input type='hidden' id='footerlogoUpload' name='cwp_theme_options[footer_logo]' value="<?php echo esc_attr( $options['footer_logo'] ); ?>" />  <input id="fotologoUpload_button" type="button" value="<?php _e('Upload footer Logo', 'cwp'); ?>" />
<script type='text/javascript'>
jQuery('#footerlogoUpload_button').click(function() {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    wp.media.editor.send.attachment = function(props, attachment) {
        jQuery('#footerlogoUpload').val(attachment.url);
        jQuery('#footerlogodemo').attr('src', attachment.url);
        wp.media.editor.send.attachment = send_attachment_bkp;
    }
    wp.media.editor.open();
    return false;       
});
</script>
<?php
}

function cwp_searchcat() {
	$options = cwp_get_theme_options();
?>
<style>
	.children {
		margin-left:20px !important;
	}
	#selectSearchCat {
		margin-top:20px;
	}
</style>
<?php add_thickbox() ?>
<div id='search-cat-box' style='display:none'>
<div style='overflow:scroll; width:600px; height:330px;'>
<ul id='searchcheckbox'>
<?php
 $cats = array_map('intval', explode(", ", $options['searchcat']));
 foreach($cats as $cat){
	$mycat = get_category($cat);
	$arrayOfCats[] = $mycat->cat_name;
 }
 $stringOfCats = implode(', ', $arrayOfCats);
 wp_category_checklist(0, 0, $cats, false, new cwp_Walker_Category_Checklist()); ?>
</ul>
</div>
<input type='button' onclick="javascript:tb_remove()" id='selectSearchCat' value='<?php _e('Select', 'cwp'); ?>' />
</div>
<div id='listOfCats' style='display:inline'><?php echo $stringOfCats; ?></div>
<input type='hidden' id='searchcat' name='cwp_theme_options[searchcat]' value="<?php echo esc_attr( $options['searchcat'] ); ?>" /> <a href='#TB_inline?width=100%&height=100%&inlineId=search-cat-box' class='thickbox'><?php _e('Select', 'cwp'); ?></a>
<script type='text/javascript'>
	var selectedsearch;
	var searchstring = [];
	var Categories = [];
	jQuery('#selectSearchCat').click (function() {
		  searchstring = [];
		 selectedsearch = jQuery("#searchcheckbox input:checked");
		jQuery(selectedsearch).each(function() {
			searchstring.push(jQuery(this).val());
			Categories.push(jQuery(this).parent().parent().text());
			
		});
		console.log(Categories);
		 jQuery('#searchcat').val(searchstring.join(', '));
		 jQuery('#listOfCats').text(Categories.join(', '));
	});
</script>
<?php
}
function cwp_settings_field_cat2() {
	$options = cwp_get_theme_options();
?>
<div id='cat-box2' style='display:none'>
	<div style='overflow:scroll; width:600px; height:330px;'>
	<ul id='sluglist2'>
		<?php wp_category_checklist(0, 0, array(intval($options['cat2_slug'])), false, new cwp_Walker_Category_radio()); ?>
	</ul>
	
</div>
<input type='button' onclick="javascript:tb_remove()" value='Select' id='catboxbutton2' />
</div>
<div style='display:inline' id='cat-current-name2'><?php $category = get_category($options['cat2_slug']); echo $category->cat_name; ?></div>
<input type='hidden' id='catbox2' name='cwp_theme_options[cat2_slug]' value="<?php echo esc_attr( $options['cat2_slug'] ); ?>" /> <a href='#TB_inline?width=100%&height=100%&inlineId=cat-box2' class='thickbox'><?php _e('Select', 'cwp'); ?></a>
	<script type='text/javascript'>
		jQuery('#catboxbutton2').click(function() {
			jQuery('#catbox2').val(jQuery('#sluglist2 input:CHECKED').val());
			jQuery('#cat-current-name2').text(jQuery('#sluglist2 input:CHECKED').parent().text());
		});
	</script>
<?php
}
function cwp_settings_field_cat3() {
	$options = cwp_get_theme_options();
?><div id='cat-box3' style='display:none'>
	<div style='overflow:scroll; width:600px; height:330px;'>
	<ul id='sluglist3'>
		<?php wp_category_checklist(0, 0, array(intval($options['cat3_slug'])), false, new cwp_Walker_Category_radio()); ?>
	</ul>
	
</div>
<input type='button' onclick="javascript:tb_remove()" value='Select' id='catboxbutton3' />
</div>
<div style='display:inline' id='cat-current-name3'><?php $category = get_category($options['cat3_slug']); echo $category->cat_name; ?></div>
<input type='hidden' id='catbox3' name='cwp_theme_options[cat3_slug]' value="<?php echo esc_attr( $options['cat3_slug'] ); ?>" /> <a href='#TB_inline?width=100%&height=100%&inlineId=cat-box3' class='thickbox'><?php _e('Select', 'cwp'); ?></a>
	<script type='text/javascript'>
		jQuery('#catboxbutton3').click(function() {
			jQuery('#catbox3').val(jQuery('#sluglist3 input:CHECKED').val());
			jQuery('#cat-current-name3').text(jQuery('#sluglist3 input:CHECKED').parent().text());
		});
	</script>
<?php
}

function cwp_top_5_text () {
	$options = cwp_get_theme_options();
	?><div>
	 <input type=text name='cwp_theme_options[top_5_text]' value='<?php echo $options['top_5_text']; ?>' />
	</div>
	<?php
}
function cwp_theme_options_init() {
	register_setting(
		'cwp_options',       // Options group, see settings_fields() call in cwp_theme_options_render_page()
		'cwp_theme_options', // Database option, see cwp_get_theme_options()
		'cwp_theme_options_validate' // The sanitization callback, see cwp_theme_options_validate()
	);
	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
	);
	// Register our individual settings fields
	add_settings_field(
		'cat1_slug',  // Unique identifier for the field for this section
		__( 'First Section slug', 'cwp' ), // Setting field label
		'cwp_settings_field_cat', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
	
		// Register our individual settings fields
	add_settings_field(
		'cat2_slug',  // Unique identifier for the field for this section
		__( 'Second Section slug', 'cwp' ), // Setting field label
		'cwp_settings_field_cat2', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
	
	add_settings_field(
		'cat3_slug',  // Unique identifier for the field for this section
		__( 'Third Section slug', 'cwp' ), // Setting field label
		'cwp_settings_field_cat3', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	
	
		add_settings_field(
		'logo',  // Unique identifier for the field for this section
		__( 'Logo url', 'cwp' ), // Setting field label
		'cwp_logo', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	

	
	add_settings_field(
		'searchcat',  // Unique identifier for the field for this section
		__( 'Search in cats (slugs) separated by commas', 'cwp' ), // Setting field label
		'cwp_searchcat', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
		add_settings_field(
		'top_5_text',  // Unique identifier for the field for this section
		__( 'Top 5 text', 'cwp' ), // Setting field label
		'cwp_top_5_text', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
			add_settings_field(
		'footer_logo',  // Unique identifier for the field for this section
		__( 'Footer logo url', 'cwp' ), // Setting field label
		'cwp_footer_logo', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see cwp_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
}
add_action( 'admin_init', 'cwp_theme_options_init' );
 
function cwp_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_cwp_options', 'cwp_option_page_capability' );
/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 */
function cwp_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'cwp' ),   // Name of page
		__( 'Theme Options', 'cwp' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'cwp_theme_options_render_page' // Function that renders the options page
	);
	if ( ! $theme_page )
		return;
}
add_action( 'admin_menu', 'cwp_theme_options_add_page' );
function cwp_get_default_theme_options() {
	$default_theme_options = array(
		'cat1_slug' => '1',
		'cat2_slug' => '1',
		'cat3_slug' => '1',
		'searchcat' => '1',
		'top_5_text'=> 'Top 5 best <span>games</span>',
		'logo'		=>  get_template_directory_uri()."/images/logo.png",
		'footer_logo' =>  get_template_directory_uri()."/images/footer-logo.png"
	);
	if ( is_rtl() )
 		$default_theme_options['theme_layout'] = 'sidebar-content';
	return apply_filters( 'cwp_default_theme_options', $default_theme_options );
}
function cwp_get_theme_options() {
	return get_option( 'cwp_theme_options', cwp_get_default_theme_options() );
}
function cwp_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : wp_get_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'cwp' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>
		<form method="post" action="options.php">
			<?php
				settings_fields( 'cwp_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}
/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 */
function cwp_theme_options_validate( $input ) {
	$output = $defaults = cwp_get_default_theme_options();
	
	if(isset($input['cat1_slug']))
		$output['cat1_slug'] = $input['cat1_slug'];
	
	if(isset($input['cat2_slug']))
		$output['cat2_slug'] = $input['cat2_slug'];
	
	if(isset($input['logo']))
		$output['logo'] = $input['logo'];
	
	if(isset($input['searchcat']))
		$output['searchcat'] = $input['searchcat'];
		
	if(isset($input['top_5_text']))
		$output['top_5_text'] = $input['top_5_text'];
		
	if(isset($input['footer_logo']))
		$output['footer_logo'] = $input['footer_logo'];
	
	if(isset($input['cat3_slug']))
		$output['cat3_slug'] = $input['cat3_slug'];
	
	return apply_filters( 'cwp_theme_options_validate', $output, $input, $defaults );
}
