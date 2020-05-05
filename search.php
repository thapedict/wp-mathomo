<?php
/**
 * The search template
 * 
 * @package Mathomo
 */

get_header();

?>

<section id="main">
    <div class="container">
    <?php
        /* translators: %s: search query */
        $title = sprintf( __( 'Search Results for: %s', 'mathomo' ), get_search_query() );
        
        HTMLER::h1_e( $title, array( 'class' => 'page-title' ) );

        if( have_posts() ) {        
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