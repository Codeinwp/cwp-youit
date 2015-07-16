<?php
/**
 * cwp Theme Customizer
 *
 * @package cwp
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cwp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Logo */
	$wp_customize->add_section( 'cwp_logo_section' , array(
    	'title'       => __( 'Logo', 'cwp' ),
    	'priority'    => 100,
    	'description' => __('Upload an image for the logo','cwp'),
	) );
	$wp_customize->add_setting( 'logo', array('sanitize_callback' => 'esc_url_raw'));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
	    'label'    => __( 'Logo', 'cwp' ),
	    'section'  => 'cwp_logo_section',
	    'settings' => 'logo',
	) ) );

	/* Footer logo */
	$wp_customize->add_section( 'cwp_footer_logo_section' , array(
    	'title'       => __( 'Footer logo', 'cwp' ),
    	'priority'    => 101,
    	'description' => __('Upload an image for the footer logo','cwp')
	) );
	$wp_customize->add_setting( 'footer_logo', array('sanitize_callback' => 'esc_url_raw'));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo_footer', array(
	    'label'    => __( 'Footer logo', 'cwp' ),
	    'section'  => 'cwp_footer_logo_section',
	    'settings' => 'footer_logo',
	) ) );

	/* Top 5 text (right side of first page) */
	$wp_customize->add_section( 'cwp_top5_section' , array(
    	'title'       => __( 'Top 5 section text', 'cwp' ),
    	'priority'    => 102,
		'description' => __('Enter a text for the top 5 section in the right side','cwp')
	) );
	$wp_customize->add_setting( 'top_5_text', array('default' => 'Top 5 best <span>games</span>', 'sanitize_callback' => 'cwp_youit_top_5_text_sanitization') );
	$wp_customize->add_control( 'top_5_text', array(
	    'label'    => __( 'Top 5 text', 'cwp' ),
	    'section'  => 'cwp_top5_section',
	    'settings' => 'top_5_text',
		'priority'    => 1,
	) );

	/* Search in cats (slugs) separated by commas */


	$categories = get_categories();



	/* First Section slug */
	$cat_slugs = array();
	$categories = get_categories();
	foreach($categories as $categ):
		$cat_slugs[$categ->cat_ID] = $categ->slug;
	endforeach;

	$wp_customize->add_section( 'cwp_field_cat_section' , array(
    	'title'       => __( 'First Section slug', 'cwp' ),
    	'priority'    => 104,
		'description' => __('Choose category for the first section','cwp')
	) );
	$wp_customize->add_setting( 'cat1_slug', array('sanitize_callback' => 'cwp_youit_cat_slug_sanitization') );
	$wp_customize->add_control(
		'cat1_slug',
		array(
			'type' => 'radio',
			'label' => 'First Section slug',
			'section' => 'cwp_field_cat_section',
			'choices' => $cat_slugs,
		)
	);

	/* Second Section slug */

	$wp_customize->add_section( 'cwp_field_cat2_section' , array(
    	'title'       => __( 'Second Section slug', 'cwp' ),
    	'priority'    => 105,
		'description' => __('Choose category for the second section','cwp')
	) );
	$wp_customize->add_setting( 'cat2_slug', array('sanitize_callback' => 'cwp_youit_cat_slug_sanitization'));
	$wp_customize->add_control(
		'cat2_slug',
		array(
			'type' => 'radio',
			'label' => 'Second Section slug',
			'section' => 'cwp_field_cat2_section',
			'choices' => $cat_slugs,
		)
	);

	/* Third Section slug */

	$wp_customize->add_section( 'cwp_field_cat3_section' , array(
    	'title'       => __( 'Third Section slug', 'cwp' ),
    	'priority'    => 106,
		'description' => __('Choose category for the third section','cwp')
	) );
	$wp_customize->add_setting( 'cat3_slug', array('sanitize_callback' => 'cwp_youit_cat_slug_sanitization'));
	$wp_customize->add_control(
		'cat3_slug',
		array(
			'type' => 'radio',
			'label' => 'Third Section slug',
			'section' => 'cwp_field_cat3_section',
			'choices' => $cat_slugs,
		)
	);

}
add_action( 'customize_register', 'cwp_customize_register' );

function cwp_youit_top_5_text_sanitization( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function cwp_youit_searchcat_sanitization( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function cwp_youit_cat_slug_sanitization( $input ) {
    $cat_slugs = array();
	$categories = get_categories();
	foreach($categories as $categ):
		$cat_slugs[$categ->cat_ID] = $categ->slug;
	endforeach;

    if ( array_key_exists( $input, $cat_slugs ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cwp_customize_preview_js() {
	wp_enqueue_script( 'cwp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'cwp_customize_preview_js' );
