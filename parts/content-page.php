<?php
/**
 * The template part to display page content
 * 
 * @package Mathomo
 */
?>

<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
<?php
    do_action( 'before_page_content' );

    the_title( '<h1 class="page-title">', '</h1>' );

    if( has_post_thumbnail() ) {
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

    do_action( 'after_page_content' );
?>
</article>
