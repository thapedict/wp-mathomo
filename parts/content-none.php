<?php
/**
 * The default nothing found template part
 * 
 * @package Mathomo
 */
?>

<article id="post-0" class="no-results nothing-found">
<?php

HTMLER::h1_e( __( 'Oops! Nothing Found', 'mathomo' ), array( 'class' => 'page-title' ) );

echo '<div class="post-content">';

    if ( is_home() && current_user_can( 'publish_posts' ) ) :
        /* translators: 1: link to WP admin new post page. */
        $get_started = sprintf( 
            __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mathomo' ),
            esc_url( admin_url( 'post-new.php' ) )
        );

        HTMLER::p_kses_e( $get_started );
    else :    
        $error_msg = is_search() ?
            // for search
            __( 'Your search didn\'t match anything. Please try using different keywords.', 'mathomo' ):
            // for everything else.
            __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mathomo' );
        
        HTMLER::p_kses_e( $error_msg );
        
        get_search_form();
    endif;

echo '</div>';

?>
</article>