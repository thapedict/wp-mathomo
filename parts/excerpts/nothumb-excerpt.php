<?php
/**
 * Excerpt with no thumbnail template
 * 
 * @package Mathomo
 */
?>

<article id="post-<?php the_id(); ?>" <?php post_class( 'post-excerpt' ); ?>>
    <h2 class="post-title">
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
    </h2>
    <div class="post-meta">
        <span class="post-author">
            <?php
                /* translators: %s: author name */
                printf( __( 'By %s', 'mathomo' ), get_the_author() );
            ?>
        </span>
        <span class="post-date">
            <?php mathomo_print_the_date(); ?>
        </span>
        <span class="post-categories">
            <?php the_category( ', ' ); ?>
        </span>
    </div>
    <div class="post-excerpt">
        <?php the_excerpt(); ?>
    </div>
    <div  class="post-read-more-link" >
    <?php
        HTMLER::a_e( __( 'Read More', 'mathomo' ), array( 'href' => get_the_permalink(), 'class' => 'button' ) );
    ?>
    </div>
</article>
