<?php
/**
 * The 404 template.
 * 
 * @package Mathomo
 */

get_header();

?>

<section id="main">
    <div class="container">

    <?php
        get_template_part( 'parts/content', 'none' );
    ?>

    </div>
</section>

<?php

get_footer();

?>