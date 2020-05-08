<?php
/**
 * The default Front Page template.
 * 
 * @package Mathomo
 */

get_header();

?>

<section id="main">
    <div class="container">
    <?php
        if( is_home() && is_front_page() ) {
            /* Blog Page */
            if( have_posts() ) {
                get_template_part( 'parts/loops/main' );
            } else {
                get_template_part( 'parts/content', 'none' );
            }
        } else {
            /* Static Page */
            the_post();

            get_template_part( 'parts/content', 'frontpage' );
        }
    ?>
    </div>
</section>

<?php

get_footer();

?>