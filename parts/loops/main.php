<?php
/**
 * To Show main loop. Excerpts with thumbnails are shown.
 * 
 * @package Mathomo
 */

 ?>

<div id="main-content" class="main-loop">
    <?php
    while( have_posts() ) {
        the_post();

        get_template_part( 'parts/excerpts/excerpt', get_post_format() );
    }    

    mathomo_print_posts_navigation();
    ?>
</div>