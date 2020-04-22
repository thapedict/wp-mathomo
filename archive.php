<?php
/**
 * The default archive template
 * 
 * @package Mathomo
 */

get_header();

?>

<section id="main">
    <div class="container">
    <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="archive-description">', '</div>' );

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