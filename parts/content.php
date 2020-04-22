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

        mathomo_print_post_meta();

        if( has_post_thumbnail() ) {
            print '<div class="post-thumbnail">';
                the_post_thumbnail( array( 1024, 1024 ) );
            print '</div>';
        }
    ?>

    <div class="post-content">
        <?php
            the_content( mathomo_get_read_more_text() );
        ?>
    </div>

    <?php
        mathomo_print_post_pages();

        mathomo_edit_post_link();
    ?>

    <div class="post-tags">
        <?php
            the_tags(
                '<span class="label">' . __( 'Tags', 'mathomo' ) . '</span><span class="tag">',
                '</span>, <span class="tag">',
                '</span>'
                );
        ?>
    </div>

    <?php
        do_action( 'after_post_content' );
        
        mathomo_prev_next_post_link();

        if( mathomo_show_post_comments() ) {
            comments_template();
        }
    ?>
</article>
