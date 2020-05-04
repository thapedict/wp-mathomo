<?php
/**
 * The default nothing found template part
 * 
 * @package Mathomo
 */
?>

<article id="post-0" class="no-results nothing-found">
<?php
if ( is_home() && current_user_can( 'publish_posts' ) ) :

    printf(
        '<p>' . wp_kses(
            /* translators: 1: link to WP admin new post page. */
            __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mathomo' ),
            array(
                'a' => array(
                    'href' => array(),
                ),
            )
        ) . '</p>',
        esc_url( admin_url( 'post-new.php' ) )
    );

else :
    HTMLER::h4_e( __( 'Oops! Nothing Found', 'mathomo' ), array( 'class' => 'page-title' ) );
    
    $error_msg = is_search() ?
        // for search
        __( 'Your search didn\'t match anything. Please try using different keywords.', 'mathomo' ):
        // for everything else.
        __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mathomo' );
    
    HTMLER::p_e( $error_msg );
    
    get_search_form();

endif;
?>
</article><!-- .page-content -->