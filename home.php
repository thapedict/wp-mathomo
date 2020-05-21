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