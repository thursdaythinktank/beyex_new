<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox_quote__item format-quote mb-40' );?>>
    <div class="post-text">
        <?php the_content();?>
    </div>
</article>