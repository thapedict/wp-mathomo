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

if( ! function_exists( 'mathomo_setup_theme_support' ) ):
    /**
     * Setup theme support
     */
    function mathomo_setup_theme_support() {
        // translation Ready
        load_theme_textdomain( 'mathomo', get_template_directory() . '/languages' );

        // RSS feed links
        add_theme_support( 'automatic-feed-links' );

        // Handling of document title
        add_theme_support( 'title-tag' );

        // Post thumbnails
        add_theme_support( 'post-thumbnails' );

        // We love HTML5
        add_theme_support( 'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption'
            )
        );

        // Post formats
        add_theme_support( 'post-formats',
            array(
                'aside',
                'gallery',
                'image',
                'quote'
            )
        );

        // Custom logo
        add_theme_support( 'custom-logo',
            array(
                'width' => 300,
                'height' => 100,
                'flex-width' => true
            )
        );

        // Custom header
        add_theme_support( 'custom-header' );

        // Custom Background
        add_theme_support( 'custom-background' );

        // Selective refresh for widgets
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Customize the editor
        add_editor_style();

        // Gutenberg: Theme can do full width
        add_theme_support( 'align-wide' );
    }
endif;
add_action( 'after_setup_theme', 'mathomo_setup_theme_support' );

if( ! function_exists( 'mathomo_register_nav_menus' ) ):
    /**
     * Register navmenus
     */
    function mathomo_register_nav_menus() {
        // We only have the header menu
        register_nav_menu( 'header', __( 'Header Menu', 'mathomo' ) );
    }
endif;
add_action( 'after_setup_theme', 'mathomo_register_nav_menus' );

if( ! function_exists( 'mathomo_register_sidebars' ) ):
    /**
     * Register sidebars
     */
    function mathomo_register_sidebars() {
        // Shared accross all sidebars
        $const = array(
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        );

        // Page Sidebar
        register_sidebar(
            array_merge(
                array(
                    'id' => 'page-sidebar',
                    'name' => __( 'Page Sidebar', 'mathomo' ),
                    'description' => __( 'Shows up on the left of a page or blog post', 'mathomo' )
                ),
                $const
            )
        );

        // For more control footer sidebar spilt into 3 cols
        register_sidebar(
            array_merge(
                array(
                    'id' => 'footer-col-1',
                    'name' => __( 'Footer Column 1', 'mathomo' ),
                    'description' => __( 'Shows up in the footer of a page or blog post', 'mathomo' )
                ),
                $const
            )
        );
        register_sidebar(
            array_merge(
                array(
                    'id' => 'footer-col-2',
                    'name' => __( 'Footer Column 2', 'mathomo' ),
                    'description' => __( 'Shows up in the footer of a page or blog post', 'mathomo' )
                ),
                $const
            )
        );
        register_sidebar(
            array_merge(
                array(
                    'id' => 'footer-col-3',
                    'name' => __( 'Footer Column 3', 'mathomo' ),
                    'description' => __( 'Shows up in the footer of a page or blog post', 'mathomo' )
                ),
                $const
            )
        );
    }
endif;
add_action( 'widgets_init', 'mathomo_register_sidebars' );

if( ! function_exists( 'mathomo_is_woocommerce_activated' ) ):
    /**
     * Check to see if WooCommerce is activated.
     * 
     * @return bool TRUE if active, false if not.
     */
    function mathomo_is_woocommerce_activated() {
        return ( defined( 'WC_VERSION' ) && class_exists( 'WooCommerce' ) );
    }
endif;

if( ! function_exists( 'mathomo_is_jetpack_activated' ) ):
    /**
     * Check to see if Jetpack is activated.
     * 
     * @return bool TRUE if active, false if not.
     */
    function mathomo_is_jetpack_activated() {
        return ( defined( 'JETPACK__VERSION' ) && class_exists( 'Jetpack' ) );
    }
endif;

/**
 * Set Content Width
 */
$content_width = 800;

