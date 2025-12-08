<?php

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */

$categories = get_the_terms($post->ID, 'category');

$unikon_blog_date = get_theme_mod('unikon_blog_date', true);
$unikon_blog_comments = get_theme_mod('unikon_blog_comments', true);
$unikon_blog_author = get_theme_mod('unikon_blog_author', true);
$unikon_blog_cat = get_theme_mod('unikon_blog_cat', false);
$unikon_blog_tags = get_theme_mod('unikon_blog_tags', true);

?>


<div class="wpr-postbox-meta postbox__meta postbox__details-meta wpr-blog-details-user-box">

    <?php if (!empty($unikon_blog_author)): ?>
        <span>
            <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <img src="<?php print get_avatar_url(get_the_author_meta('ID')); ?>" alt="author-img">
                <?php print get_the_author(); ?>
            </a>
        </span>
    <?php endif; ?>

    <?php if (!empty($unikon_blog_date)): ?>
        <span>
            <?php the_time(get_option('date_format')); ?>
        </span>
    <?php endif; ?>

    <?php if (!empty($unikon_blog_comments)): ?>
        <span>
            <a href="<?php comments_link(); ?>">
                <?php comments_number(); ?>
            </a>
        </span>
    <?php endif; ?>

</div>