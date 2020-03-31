<?php
/**
 * Template helper functions
 * 
 * @package Mathomo
 */


if( ! function_exists( 'mathomo_print_site_header' ) ):
    /**
     * Prints site header
     *
     * @param array $args Options for printing the site header
     */
    function mathomo_print_site_header( array $args = array() ) {
        $defaults = array(
            'wrapper_id' => '',
            'wrapper_class' => 'site-header',
            'print_description' => false
        );

        $args = wp_parse_args( $defaults, $args );

        $content = '';

        if( has_custom_logo() ) {
            $content = get_custom_logo();
        } else {
            // Blog name
            $title = __( 'Home', 'mathomo' );
            $link = HTMLER::a( get_bloginfo( 'name' ), array( 'href' => home_url(), 'title' => $title ) );
            
            $content = HTMLER::h1_raw( $link, array( 'class' => 'site-name' ) );

            // Blog Description
            if( $args[ 'print_description' ] ) {
                $content .= HTMLER::div( get_bloginfo( 'description' ), array( 'class' => 'site-description' ) );
            }
        }

        HTMLER::div_raw_e( $content, array( 'id' => $args[ 'wrapper_id' ], 'class' => $args[ 'wrapper_class' ] ) );
    }
endif;

if( ! function_exists( 'mathomo_print_header_menu' ) ):
    /**
     * Prints header menu
     */
    function mathomo_print_header_menu() {
        wp_nav_menu(
            array(
                'theme_location' => 'header',
                'menu_id' => 'header-menu'
            )
            );
    }
endif;
