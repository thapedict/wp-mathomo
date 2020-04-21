<?php
/**
 * The default page template.
 * 
 * @package Mathomo
 */

get_header();

?>

<section id="main">
    <div class="container">

    <?php
        the_post();

        get_template_part( 'parts/content', get_post_type() );
    ?>

    </div>
</section>

<?php

get_footer();

?>