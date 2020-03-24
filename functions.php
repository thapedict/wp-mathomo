<?php
/**
 * Mathomo Theme functions
 * 
 * @package Mathomo
 */

define( 'MATHOMO_VERSION', '1.0.0', true );

/**
 * Get the escaped template directory URI.
 * 
 * @param string $append The string to append to the URI.
 */
function mathomo_get_directory_uri( $append = '' ) {
    return esc_url( get_template_directory_uri() . $append );
}

