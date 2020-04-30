<?php
/**
 * The footer template
 * 
 * @package Mathomo
 */
?>

<footer>
<?php
    get_sidebar( 'footer' );
?>
    <section id="footer-strip">
        <div class="container">
            <div class="theme-credits-wrap">
                <?php
                    HTMLER::span_kses_e( mathomo_get_theme_copyright(), array( 'class' => 'copyright-notice' ) );
                    HTMLER::span_kses_e( mathomo_get_theme_credits(), array( 'class' => 'theme-credits' ) );
                ?>
            </div>
        </div>
    </section>
</footer>

<?php
    wp_footer();
?>
</body>
</html>