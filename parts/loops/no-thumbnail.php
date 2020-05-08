<?php
/**
 * To Show main loop. Excerpts are used and no thumbnails are shown.
 * 
 * @package Mathomo
 */

 ?>

<div id="main-content" class="main-loop no-thumbnail">
    <?php
    while( have_posts() ) {
        the_post();

        get_template_part( 'parts/excerpts/nothumb-excerpt', get_post_format() );
    }    

    mathomo_print_posts_navigation();
    ?>
</div>