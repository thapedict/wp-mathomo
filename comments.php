<?php
/**
 * The comments template.
 * 
 * @package Mathomo
 */

if( post_password_required() ) {
    return;
}

echo '<div class="post-comments">';

    HTMLER::h2_e( __( 'Comments', 'mathomo' ), array( 'class' => 'comments-title' ) );

    if( have_comments() ) {
        // show comments
        echo '<div class="older-comments">';
                wp_list_comments(
                    array(
                        'avatar_size' => 48,
                        'short_ping' => true,
                        'style' => 'div'
                        )
                );

                the_comments_navigation();
        echo '</div>';
    } else {
        // No comments yet
        if ( comments_open() ) {
            HTMLER::h4_e( __( 'This post has no comments yet. Be the first to comment.', 'mathomo' ), array( 'class' => 'no-comments-yet align-center' ) );
        }
    }

    if( comments_open() ) {
        // show comments form
        comment_form();
    } else {
        HTMLER::h4_e( __( 'Comments are now closed.', 'mathomo' ), array( 'class' => 'comments-closed align-center' ) );
    }

echo '</div>';
