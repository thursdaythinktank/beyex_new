<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */

$unikon_blog_btn = get_theme_mod('unikon_blog_btn', 'Read More');
$unikon_blog_btn_switch = get_theme_mod('unikon_blog_btn_switch', true);

?>

<?php if (!empty($unikon_blog_btn_switch)) : ?>
    <div class="postbox__read-more wpr-postbox-btn">
        <a href="<?php the_permalink(); ?>" class="common-btn">
            <?php print esc_html($unikon_blog_btn); ?>
        </a>
    </div>

<?php endif; ?>