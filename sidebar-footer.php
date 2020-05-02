<?php
/**
 * The footer sidebar template.
 * 
 * @package Mathomo
 */
?>
<section id="widget-area">
    <div class="container">
        <div class="footer-cols ts-ns-3">
            <div id="col-1">
                <?php
                    dynamic_sidebar( 'footer-col-1' );
                ?>
            </div>
            <div id="col-2">
                <?php
                    dynamic_sidebar( 'footer-col-2' );
                ?>
            </div>
            <div id="col-3">
                <?php
                    dynamic_sidebar( 'footer-col-3' );
                ?>
            </div>
        </div>
    </div>
</section>
