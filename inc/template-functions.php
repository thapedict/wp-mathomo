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
            'print_description' => true
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
                'menu_id' => 'header-menu',
                'menu_class' => 'nav-menu'
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
        $default_img_src = apply_filters( 'mathomo_default_post_thumbnail', mathomo_get_uri( '/assets/img/thumbnail-150x150.png' ) );

        $thumbnail = has_post_thumbnail() ? get_the_post_thumbnail( null, array( 150, 150 ) ): sprintf( '<img class="attachment-post-thumbnail" src="%s" alt="%s" />', esc_url( $default_img_src ), esc_attr( get_the_title() ) );

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
                    __( 'Edit <span class="screen-reader-text">%s</span> &raquo;', 'mathomo' ),
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

if( ! function_exists( 'mathomo_print_post_pages' ) ):
    /**
     *  Print post pages
     */
    function mathomo_print_post_pages() {
        global $numpages;
            
        if( $numpages > 1 ) {
            wp_link_pages(
                array(
                    'before' => '<div class="post-pages">' . __( 'Pages:', 'mathomo' ),
                    'after' => '</div>'
                )
            );          
        }
    }
endif;

if( ! function_exists( 'mathomo_get_read_more_text' ) ):
    /**
     *  Returns the read more text
     * 
     * @return string The read more
     */
    function mathomo_get_read_more_text() {
        return sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		);
    }
endif;

if( ! function_exists( 'mathomo_prev_next_post_link' ) ):
    /**
     *  Prints previous & next post links
     */
    function mathomo_prev_next_post_link() {
        $prev_next = get_previous_post_link( '<div class="nav-previous">%link</div>', '&laquo; %title' );
        $prev_next .= get_next_post_link( '<div class="nav-next">%link</div>', '%title &raquo;' );

        if( $prev_next ) {
            $aria_label = HTMLER::span( __( 'Post navigation', 'mathomo' ), array( 'class' => 'screen-reader-text' ) );

            $prev_next = HTMLER::div_kses( $prev_next, array( 'class' => 'nav-links' ) );

            HTMLER::nav_raw_e( $aria_label . $prev_next, array( 'class' => 'navigation post-navigation' ) );
        }
    }
endif;

if( ! function_exists( 'mathomo_get_the_date' ) ):
    /**
     * Get the date of current post.
     * 
     * @return string HTML with the date
     */
    function mathomo_get_the_date() {
        $posted_on = $updated_on = '';

        /* translators: %s: posted on date */
        $posted_on_text = esc_html( __( 'Posted on', 'mathomo' ) );
        /* translators: %s: The last modified date */
        $updated_on_text = esc_html( __( 'Last Modified', 'mathomo' ) );

        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $updated_date = sprintf(
                '<time class="post-entry-date updated" datetime="%1$s">%2$s</time>',
                    esc_attr( get_the_modified_date( DATE_W3C ) ),
                    esc_html( get_the_modified_date() )
            );

            
            $updated_date = sprintf( '<span class="screen-reader-text">%1$s</span> %2$s', $updated_on_text , $updated_date );

            $updated_on = HTMLER::span_raw( $updated_date, array( 'class' => 'post-last-modified', 'title' => $updated_on_text ) );
        }

        $posted_date = sprintf(
            '<time class="post-entry-date published" datetime="%1$s">%2$s</time>',
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date() )
        );

        $posted_date = sprintf( '<span class="screen-reader-text">%1$s</span> %2$s', $posted_on_text , $posted_date );

        // Determine class to use: We will hide if we have an updated on date
        $posted_on_class = $updated_on ? 'post-posted-on screen-reader-text': 'post-posted-on';
        
        $posted_on = HTMLER::span_raw( $posted_date, array( 'class' => $posted_on_class, 'title' => $posted_on_text ) );

        
		return '<span class="post-date">' . $posted_on . $updated_on . '</span>';
    }
endif;

if( ! function_exists( 'mathomo_print_post_meta' ) ):
    /**
     *  Print post meta
     */
    function mathomo_print_post_meta() {
        print '<div class="post-meta">';
            $author_link = HTMLER::a( get_the_author(), array( 'href' => get_author_posts_url( get_the_author_meta( 'ID' ) ) ) );
            /* translators: %s: author link */
            $author_link = sprintf( __( 'By %s', 'mathomo' ), $author_link );

            HTMLER::span_raw_e( $author_link, array( 'class' => 'post-author' ) );

            echo mathomo_get_the_date();

            /* translators: %s: the category list */
            $posted_in = sprintf( __( 'Posted in %s', 'mathomo' ), get_the_category_list( ', ' ) );

            HTMLER::span_raw_e( $posted_in, array( 'class' => 'post-categories' ) );
        print '</div>';
    }
endif;

if( ! function_exists( 'mathomo_get_theme_credits' ) ):
    /**
     *  Return theme designer credits.
     * 
     * @return string Theme credit.
     */
    function mathomo_get_theme_credits() {
        /* translators: %s: link to theme designer */
        return sprintf( __( 'Designed By %s', 'mathomo' ), '<a href="https://thapedict.co.za/">Thapedict</a>' );
    }
endif;

if( ! function_exists( 'mathomo_get_theme_copyright' ) ):
    /**
     * Return copyright text.
     * 
     * @return string Theme copyright text.
     */
    function mathomo_get_theme_copyright() {
        $copyright = '&copy;' . date( 'Y' ) . ' - ' . get_bloginfo( 'name', 'display' );

        return get_theme_mod( 'copyright_text', $copyright );
    }
endif;

if( ! function_exists( 'mathomo_print_search_form' ) ):
    /**
     * Prints out search form for the mobile-drawer
     * 
     * @param bool $for_woocommerce If we should print a product search form.
     */
    function mathomo_print_search_form( $for_woocommerce = false ) {
        echo '<div id="mobile-drawer-search">';

        if( $for_woocommerce && mathomo_is_woocommerce_activated() ) {
            the_widget( 'WC_Widget_Product_Search' );
        } else {
            get_search_form();
        }

        echo '</div>';
    }
endif;
