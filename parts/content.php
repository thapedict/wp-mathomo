<?php
/**
 * The template part to display post content
 * 
 * @package Mathomo
 */
?>

<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
    <?php
        do_action( 'before_post_content' );

        the_title( '<h1 class="page-title">', '</h1>' );

        if( has_post_thumbnail() && ! post_password_required() ) {
            print '<div class="post-thumbnail">';
                the_post_thumbnail( array( 1024, 1024 ) );
            print '</div>';
        }
    ?>

    <div class="post-content">
        <?php
            the_content();
        ?>
    </div>

    <?php
        mathomo_print_post_pages();

        mathomo_edit_post_link();
    ?>

    <?php
        do_action( 'after_post_content' );
        
        mathomo_prev_next_post_link();
    ?>
</article>
