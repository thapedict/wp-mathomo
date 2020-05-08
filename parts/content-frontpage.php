<?php
/**
 * The template part to display front-page content
 * 
 * @package Mathomo
 */
?>

<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
<?php
    do_action( 'before_page_content' );
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
