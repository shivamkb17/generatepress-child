<?php
/**
 * Advanced Custom Fields related stuff.
 *
 * Must be included in functions.php
 *
 * @package GenerateChild
 * @link https://www.advancedcustomfields.com/resources/
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Initialize ACF Options Page.
 * @link https://www.advancedcustomfields.com/resources/options-page/
 */
if( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));
}

/**
 * Initialize ACF Google Maps.
 * @link https://www.advancedcustomfields.com/resources/acf-settings/
 */
// add_action('acf/init', 'gpc_acf_init');
function gpc_acf_init() {
  acf_update_setting( 'google_api_key', 'key_goes_here' );
}

/**
 * Initialize ACF Gutenberg blocks.
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
add_action( 'acf/init', 'gpc_register_acf_blocks' );
function gpc_register_acf_blocks() {

    // check function exists.
    if( function_exists( 'acf_register_block_type' ) ) {

        // Register a staff block.
        acf_register_block_type(array(
            'name'              => 'staff',
            'title'             => __('Staff'),
            'description'       => __('Staff Block.'),
            'render_template'   => 'template-parts/blocks/staff/staff.php',
            'icon'              => 'smiley',
            'category'          => 'formatting',
            'supports'          => array( 'align' => false ),
            'mode'              => 'auto',
            'keywords'          => array( 'team', 'profile')
        ));

        // Register an image slider block.
        acf_register_block_type(array(
            'name'              => 'image_slider',
            'title'             => __('Image Slider'),
            'description'       => __('Basic image slider block.'),
            'render_template'   => 'template-parts/blocks/image-slider/image-slider.php',
            'icon'              => 'images-alt',
            'category'          => 'formatting',
            'supports'          => array( 'align' => false ),
            'mode'              => 'auto',
            'keywords'          => array( 'gallery', 'image', 'slider'),
            'enqueue_assets' => function(){
                wp_enqueue_style( 'gpc-swiper', 'https://cdn.jsdelivr.net/npm/swiper@8.0.3/swiper-bundle.min.css', false, '8.0.3', 'all' );
                wp_enqueue_script( 'gpc-swiper', 'https://cdn.jsdelivr.net/npm/swiper@8.0.3/swiper-bundle.min.js', '', '8.0.3', true );
                wp_enqueue_script( 'gpc-swiper-init', get_stylesheet_directory_uri() . '/template-parts/blocks/image-slider/image-slider.js', '', '8.0.3', true );
            },
        ));

    }
}

function gpc_acf_block_assets() {
	wp_enqueue_style( 'gpc-staff-block', get_stylesheet_directory_uri() . '/template-parts/blocks/staff/staff.css', array(), '1.0.0' );
}
add_action( 'enqueue_block_assets', 'gpc_acf_block_assets' );