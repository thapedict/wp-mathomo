<?php
/**
 * Mathomo Theme functions
 * 
 * @package Mathomo
 */

define( 'MATHOMO_VERSION', '1.0.0' );

/**
 * Get the escaped template directory URI.
 * 
 * @param string $append The string to append to the URI.
 */
function mathomo_get_uri( $append = '' ) {
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
                'flex-width' => true,
                'flex-height' => true
            )
        );

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

if( ! function_exists( 'mathomo_enqueue_scripts' ) ):
    /**
     * Enqueue needed frontend scripts and styles
     */
    function mathomo_enqueue_scripts() {
        $CSS = get_template_directory_uri() . "/assets/css/";
        $JS = get_template_directory_uri() . "/assets/js/";

        // Font Awesome
        wp_enqueue_style( 'fontawesome', $CSS . 'fontawesome-all.min.css', false, '1.0.0' );
        // Grid + Reset, then Basic Styling
        wp_enqueue_style( 'mathomo-grid-basic', $CSS . 'grid-basic.min.css', false, MATHOMO_VERSION );
        // MobileNav
        wp_enqueue_style( 'mathomo-mobilenav', $CSS . 'jquery.mobilenav.css', false, '1.0.0' );
        // ScrollToTop
        wp_enqueue_style( 'mathomo-scrolltotop', $CSS . 'jquery.scrolltotop.css', false, '1.0.0' );
        // Main Style
        wp_enqueue_style( 'mathomo-style', get_stylesheet_uri(), array( 'fontawesome', 'mathomo-grid-basic', 'mathomo-mobilenav', 'mathomo-scrolltotop' ), MATHOMO_VERSION );

        // Optional WooCommerce
        if( mathomo_is_woocommerce_activated() ) {
            wp_enqueue_style( 'mathomo-woocommerce', $CSS . 'woocommerce.css', false, MATHOMO_VERSION );     
        }

        // MobileNav
        wp_enqueue_script( 'mathomo-mobilenav', $JS . 'jquery.mobilenav.js', array( 'jquery' ), '1.0.0' );
        // ScrollToTop
        wp_enqueue_script( 'mathomo-scrolltotop', $JS . 'jquery.scrolltotop.js', array( 'jquery' ), '1.0.0' );
        // Main JS Script
        wp_enqueue_script( 'mathomo-main', $JS . 'main.js', array( 'mathomo-mobilenav', 'mathomo-scrolltotop' ), MATHOMO_VERSION );

        // Comment script
        if( mathomo_show_page_comments() || mathomo_show_post_comments() ) {
            if ( comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        }
    }
endif;
add_action( 'wp_enqueue_scripts', 'mathomo_enqueue_scripts' );

/**
 * Should theme show page comments.
 * 
 * @return bool TRUE to show comments, FALSE to hide.
 */
function mathomo_show_page_comments() {
    return (bool) apply_filters( __FUNCTION__, get_theme_mod( 'show_page_comments', false ) );
}

/**
 * Should theme show post comments.
 * 
 * @return bool TRUE to show comments, FALSE to hide.
 */
function mathomo_show_post_comments() {
    return (bool) apply_filters( __FUNCTION__, get_theme_mod( 'show_post_comments', true ) );
}

/**
 * WordPress v5.2 requires themes to support wp_body_open.
 */
function mathomo_before_header() {
    if( function_exists('wp_body_open') ) {
        wp_body_open();
    } else {
        do_action('wp_body_open');
    }
}
add_action('body_header_before', 'mathomo_before_header');

/**
 * Returns the default color.
 * 
 * @TODO Find out why header_textcolor is returning "Invalid value".
 * 
 * @param string $name The setting name of the color.
 * 
 * @return string A hex color string if found, or empty string if none found.
 */
function mathomo_get_default_color( $name ) {
    $default_colors = array(
        'header_text_color' => '#000000',
        'header_backcolor' => '#FFFFFF',
        'pagetitle_textcolor' => '#FFFFFF',
        'headings_textcolor' => '#FFFFFF',
        'content_backcolor' => '#000000',
        'footerwidget_textcolor' => '#FFFFFF',
        'footerwidget_backcolor' => '#101010',
        'footerstrip_textcolor' => '#FFFFFF',
        'footerstrip_backcolor' => '#000000'
    );

    if( isset( $default_colors[ $name ] ) ) {
        return $default_colors[ $name ];
    } else {
        return '';
    }
}

/**
 * Add block editor styling css.
 */
function mathomo_add_block_editor_assets() {
    wp_enqueue_style( 'mathomo-editor-style', mathomo_get_uri( '/assets/css/editor-style.css' ), array( 'wp-block-editor' ), MATHOMO_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'mathomo_add_block_editor_assets' );

/**
 * Register new block styles.
 */
function mathomo_register_block_styles() {
    // Add quotes to blockquotes
    register_block_style(
        'core/pullquote',
        array(
            'name' => 'with-quotes',
            'label' => __( 'With Quotes', 'mathomo' )
        )
    );
}
add_action( 'init', 'mathomo_register_block_styles' );

// Load template helper functions
if( ! class_exists( 'HTMLER' ) ) {
    require_once get_template_directory() . '/inc/class-htmler.php';
}
require_once get_template_directory() . '/inc/template-functions.php';

// Load customizer settings
require_once get_template_directory() . '/inc/customize.php';
