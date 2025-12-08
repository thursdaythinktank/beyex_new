<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */

if ( is_single() ) : ?>
    <article id="post-<?php the_ID();?>" <?php post_class( 'wpr-blog-search-item' );?> >
        <div class="wpr-blog-grid-item p-relative mb-40">
    
            <?php if ( has_post_format('image') ): ?>
            <div class="wpr-blog-grid-thumb w-img fix mb-30">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </div>
            <?php endif;?>

            <?php $img_space = has_post_format('image') ? 'has-img' : 'no-img'; ?>

            <div class="wpr-blog-grid-content <?php echo esc_attr($img_space) ?>">
    
                <?php get_template_part( 'template-parts/blog/search-result-meta' ); ?>
    
                <h3 class="wpr-blog-grid-title"><?php the_title();?> </h3>
    
                <?php the_content();?>

                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'unikon' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>
    
                <?php print unikon_get_tag();?>
            </div>
        </div>
    </article>
<?php else: ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('wpr-postbox-item postbox__item wpr-postbox-item p-relative wpr-blog-search-item mb-40'); ?>>
        <?php if (has_post_thumbnail()): ?>
        <?php get_template_part('template-parts/blog/blog-media'); ?>
        <?php endif; ?>

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
                <?php get_template_part( 'template-parts/blog/blog-search-btn' ); ?>
            </div>
    </article>

    
<?php endif;?>