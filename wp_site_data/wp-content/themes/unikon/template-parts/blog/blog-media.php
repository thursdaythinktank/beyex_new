<?php

$unikon_audio_url = function_exists('get_field') ? get_field('unikon_post_audio') : NULL;
$gallery_images = function_exists('get_field') ? get_field('post_gallery') : NULL;
$unikon_video_url = function_exists('get_field') ? get_field('unikon_post_video') : NULL;

$is_single = is_single() ? true : false;

$blog_single_layout_from_customizer = get_theme_mod('unikon_blog_single_layout', 'blog_single_default');
$blog_single_layout_from_page = function_exists('get_field') ? get_field('unikon_post_single_layout') : '';

$blog_single_layout = !empty($blog_single_layout_from_page) ? $blog_single_layout_from_page : $blog_single_layout_from_customizer;

?>

<?php if (has_post_format('image')): ?>
    <?php if ( has_post_thumbnail() ): ?>   
        <div class="blog__item-thumb wpr-postbox-thumb postbox__thumb">
            <?php if ($is_single && $blog_single_layout == 'blog_single_classic'): ?>
                <?php the_post_thumbnail('full', ['class' => 'img-responsive', 'data-speed' => '.8']); ?>
            <?php elseif ($is_single): ?>
                <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
            <?php else: ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                </a>
            <?php endif; ?>
        </div>

    <?php endif; ?>

    <!-- if post has video -->
<?php elseif ( has_post_format('video') ): ?>
    <?php if ( has_post_thumbnail() ): ?>
        <div class="wpr-postbox-thumb postbox__thumb wpr-postbox-video p-relative">

            <?php if ($is_single && $blog_single_layout == 'blog_single_classic'): ?>
                <?php the_post_thumbnail('full', ['class' => 'img-responsive', 'data-speed' => '.8']); ?>
            <?php elseif ($is_single): ?>
                <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
            <?php else: ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                </a>
            <?php endif; ?>

            <?php if (!empty($unikon_video_url)): ?>
                <div class="postbox__play-btn">
                    <a class="popup-video" href="<?php print esc_url($unikon_video_url); ?>"><i
                            class="fa-sharp fa-solid fa-play"></i></a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- if post has audio -->
<?php elseif ( has_post_format('audio') ): ?>

    <?php if ( !empty($unikon_audio_url) ): ?>
        <div class="wpr-postbox-thumb postbox__thumb wpr-postbox-audio p-relative">
            <?php echo wp_oembed_get($unikon_audio_url); ?>
        </div>
    <?php endif; ?>

    <!-- if post has gallery -->
<?php elseif ( has_post_format('gallery') ): ?>
    <?php if ( !empty($gallery_images) ): ?>
        <div class="wpr-postbox-thumb postbox__thumb p-relative">
            <div class="postbox__thumb-slider p-relative">
                <div class="swiper postbox_gallery-slider-active">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $key => $image): ?>
                        <div class="wpr-postbox-slider-item swiper-slide">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="wpr-postbox-gallery-pagination"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <?php if ( has_post_thumbnail() ): ?>
        <div class="wpr-postbox-thumb postbox__thumb">
            <?php if ($is_single && $blog_single_layout == 'blog_single_classic'): ?>
                <?php the_post_thumbnail('full', ['class' => 'img-responsive', 'data-speed' => '.8']); ?>
            <?php elseif ($is_single): ?>
                <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
            <?php else: ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>