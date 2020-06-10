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

/**
 * Adds a color section with colors to the customizer.
 * 
 * @TODO Find out why 'header_textcolor' is returning "Invalid value".
 * 
 * @param WP_Customize_Manager $customize The WP_Customize_Manager.
 */
function mathomo_add_theme_colors_settings( $customize ) {
    $customize->add_panel( 'colors_panel', array(
        'title' => __( 'Colors' ),
        'priority' => 10
    ) );

    // Add Color sections
    $customize->add_section( 'header_colors', array(
        'title' => __( 'Header', 'mathomo' ),
        'panel' => 'colors_panel'
    ) );

    // Footer Colors Section
    $customize->add_section( 'footer_colors', array(
        'title' => __( 'Footer', 'mathomo' ),
        'panel' => 'colors_panel'
    ) );

    // header_textcolor
    $customize->add_setting( 'header_text_color', mathomo_get_color_settings( 'header_text_color' ) );
    $customize->add_control(
        new WP_Customize_Color_Control(
            $customize,
            'header_text_color',
            array(
                'label' => __( 'Header Text Color', 'mathomo' ),
                'settings' => 'header_text_color',
                'section' => 'header_colors'
                )
        ) 
    );

    // header_backcolor
    $customize->add_setting( 'header_backcolor', mathomo_get_color_settings( 'header_backcolor' ) );
    $customize->add_control(
        new WP_Customize_Color_Control(
            $customize,
            'header_backcolor',
            array(
                'label' => __( 'Header Back Color', 'mathomo' ),
                'section' => 'header_colors'
                )
        ) 
    );

    // footerwidget_textcolor
    $customize->add_setting( 'footerwidget_textcolor', mathomo_get_color_settings( 'footerwidget_textcolor' ) );
    $customize->add_control(
        new WP_Customize_Color_Control(
            $customize,
            'footerwidget_textcolor',
            array(
                'label' => __( 'Widgets Area Text Color', 'mathomo' ),
                'section' => 'footer_colors'
                )
        ) 
    );

    // footerwidget_backcolor
    $customize->add_setting( 'footerwidget_backcolor', mathomo_get_color_settings( 'footerwidget_backcolor' ) );
    $customize->add_control(
        new WP_Customize_Color_Control(
            $customize,
            'footerwidget_backcolor',
            array(
                'label' => __( 'Widgets Area Back Color', 'mathomo' ),
                'section' => 'footer_colors'
                )
        ) 
    );
}
add_action( 'customize_register', 'mathomo_add_theme_colors_settings' );
