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

if( ! function_exists( 'mathomo_print_posts_navigation' ) ):
    /**
     * Print of posts navigation
     */
    function mathomo_print_posts_navigation() {
        the_posts_navigation(
            array( 
                    'prev_text' => __('&larr; Previous Posts', 'tdt-one'),
                    'next_text' => __('Next Posts &rarr;', 'tdt-one')
            )
        );
    }
endif;

if( ! function_exists( 'mathomo_print_the_date' ) ):
    /**
     * Showing of the post date.
     */
    function mathomo_print_the_date( $format = null ) {
        $date = get_the_date( $format );

        echo $date;
    }
endif;

if( ! function_exists( 'mathomo_get_permalink' ) ):
    /**
     * Return escaped permalink.
     * 
     * @return string escaped permalink.
     */
    function mathomo_get_permalink() {
        return esc_url( get_the_permalink() );
    }
endif;

if( ! function_exists( 'mathomo_print_post_thumbnail' ) ):
    /**
     * Print post thumbnail (150x150)
     */
    function mathomo_print_post_thumbnail( $before = '<div class="post-thumbnail">', $after = '</div>' ) {
		if ( post_password_required() || is_attachment() ) {
			return;
        }
        
        // if post doesn't have a featured image
        $default_img_src = apply_filters( 'mathomo_default_post_thumbnail', mathomo_get_uri( '/assets/img/thumbnailx150.png') );

        $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail( null, array( 150, 150 ) ): sprintf( '<img class="attachment-post-thumbnail" src="%s" alt="%s" />', esc_url( $default_img_src), esc_attr( get_the_title() ) );

        echo $before, $thumbnail, $after;
    }
endif;

if( ! function_exists( 'mathomo_edit_post_link' ) ):
    /**
     *  Print edit post link
     */
    function mathomo_edit_post_link( $before = '<div class="post-edit-link">', $after = '</div>' ) {
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'mathomo' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            $before,
            $after
        );
    }
endif;
