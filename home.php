<?php
/**
 * The Home (Blog Index) template.
 * 
 * @package Mathomo
 */

get_header();

?>

<section id="main">
    <div class="container">
    <?php
        $blog_page = get_option( 'page_for_posts' );
        if ( $blog_page ) {
            $page = get_page( $blog_page );

            if( is_paged() ) {
                /* translators:
                    1: post title
                    2: page number
                */
                $page->post_title = sprintf( __( '%1$s / %2$s', 'mathomo' ), $page->post_title, $paged );
            }

            HTMLER::h1_kses_e( $page->post_title, array('class' => 'page-title' ) );
        }
        
        if ( have_posts() ) {
            get_template_part( 'parts/loops/main' );
        } else {
            get_template_part( 'parts/content', 'none' );
        }
    ?>
    </div>
</section>

<?php

get_footer();

?>