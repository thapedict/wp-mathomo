<?php
/**
 * Theme customizer setting
 * 
 * @package Mathomo
 */

/**
 *  Change WordPress default.
 * 
 * @param WP_Customize_Manager $customize The WP_Customize_Manager.
 */
function mathomo_update_customize_defaults( $customize ) {
    // Change default transport mode
    $customize->get_setting( 'blogname' )->transport = 'postMessage';
    $customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    // Remove default header_textcolor
    $customize->remove_setting( 'header_textcolor' );
    $customize->remove_control( 'header_textcolor' );

    // Remove default color section. (we will add it back later)
    $customize->remove_section( 'colors' );
}
add_action( 'customize_register', 'mathomo_update_customize_defaults' );

/**
 * Load the customizer JS file.
 */
function mathomo_load_customizer_js() {    
    wp_enqueue_script( 'tdt-one-customizer', mathomo_get_uri( '/js/customizer.js' ), array( 'jquery', 'customize-preview' ), MATHOMO_VERSION, true);
}
add_action( 'customize_preview_init', 'mathomo_load_customizer_js' );

/**
 * Gets the defualt color settings.
 * 
 * @param string $id The settings ID.
 * 
 * @return array The default settings.
 */
function mathomo_get_color_settings( $id ) {
    $settings = array(
        'default' => mathomo_get_default_color( $id ),
        'sanitize_callback' => 'sanitize_hex_color',
        'sanitize_js_callback' => 'maybe_hash_hex_color'
    );

    return apply_filters( __FUNCTION__, $id, $settings );
}
