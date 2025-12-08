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

<div class="wpr-postbox-meta postbox__meta wpr-blog-stories-tag-wrap d-flex">

    <?php if (!empty($unikon_blog_cat)) : ?>
        <?php if (!empty($categories[0]->name)) : 
            $color =  get_term_meta($categories[0]->term_id, '_unikon_post_cat_color', true)
            ?>
            <a data-bg-color="<?php echo esc_attr($color); ?>" class="wpr-blog-categorize" href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                <?php echo esc_html($categories[0]->name); ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($unikon_blog_date)) : ?>
        <span>
            <?php the_time(get_option('date_format')); ?>
        </span>
    <?php endif; ?>

</div>