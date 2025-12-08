<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */

$unikon_audio_url = function_exists('get_field') ? get_field('unikon_post_audio') : NULL;
$gallery_images = function_exists('get_field') ? get_field('post_gallery') : NULL;
$unikon_video_url = function_exists('get_field') ? get_field('unikon_post_video') : NULL;

$unikon_blog_single_social = get_theme_mod('unikon_blog_single_social', true);
$blog_tag_col = $unikon_blog_single_social ? 'col-xl-8 col-lg-6' : 'col-xl-12';

$enable_box_social = get_theme_mod('unikon_post_box_social_switch', false);

if (is_single()) : ?>
    <!-- details start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('wpr-postbox-details-article mb-40'); ?>>
        <div class="wpr-postbox-details-article-inner">
            <!-- content start -->
            <?php the_content(); ?>

            <?php
            wp_link_pages([
                'before'      => '<div class="page-links">' . esc_html__('Pages:', 'unikon'),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ]);
            ?>
            <?php get_template_part('template-parts/blog/blog-single-share'); ?>
        </div>
    </article>
    <!-- details end -->
<?php else :

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('wpr-postbox-item postbox__item wpr-postbox-item p-relative mb-40'); ?>>
        <?php get_template_part('template-parts/blog/blog-media'); ?>

        <div class="wpr-postbox-content postbox__content">

            <?php get_template_part('template-parts/blog/blog-meta'); ?>

            <h3 class="wpr-postbox-title postbox__title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <div class="wpr-postbox-text postbox__text">
                <?php the_excerpt(); ?>
            </div>

            <div class="wpr-postbox-btn-box d-flex align-items-center justify-content-between">
                <!-- blog btn -->
                <?php get_template_part('template-parts/blog/blog-btn'); ?>

                <?php if ($enable_box_social && function_exists('unikon_blog_post_social')) : ?>
                    <?php echo unikon_blog_post_social(); ?>
                <?php endif; ?>
            </div>
    </article>

<?php endif; ?>