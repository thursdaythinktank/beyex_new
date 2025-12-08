<?php

/**
 * Breadcrumbs for Unikon theme.
 *
 * @package     Unikon
 * @author      WPRealizer
 * @copyright   Copyright (c) 2024, WPRealizer
 * @link        https://unikon.wprealizer.com/
 * @since       unikon 1.0.0
 */

function unikon_breadcrumb_func()
{
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    global $wp;

    $current_slug = add_query_arg(array(), $wp->request);

    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'unikon'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'unikon'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
    }  elseif (is_search()) {
        $title = esc_html__('Search Results for : ', 'unikon') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'unikon');
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_dashboard_title($current_slug);
    }

    $_id = get_the_ID() ?? NULL;

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    // hide breadcrumb from page
    $check_breadcrumb_from_page = function_exists('get_field') ? get_field('breadcrumb_settings_unikon_is_breadcrumb_on', $_id ? $_id : NULL) : '';

    // hide breadcrumb from customizer globally
    $check_breadcrumb_from_customizer = get_theme_mod('breadcrumb_settings_breadcrumb_switch', true);

    // hide breadcrumb based on condition
    if ($check_breadcrumb_from_page == 'off' || $check_breadcrumb_from_customizer == false) {
        return;
    }


    if ($breadcrumb_show == 1) {
        $breadcrumb_attrs = array(
            'class' => 'breadcrumb__area include-bg grey-bg-2 pt-120 pb-120 unikon-breadcrumb-padding ' . $breadcrumb_class,
        );

        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

        $filter_styles = ['style_1', 'style_2', 'style_3'];

        {

            ?>

            <!-- breadcrumb start -->
            <section <?php unikon_html_attrs($breadcrumb_attrs) ?>>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="wpr-breadcrumb__content breadcrumb_content">
                                <div class="wpr-breadcrumb__list">
                                    <span>
                                        <a href="<?php print esc_url(home_url('/')); ?>">
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </a>
                                    </span>
                                    <span class="color">
                                        <?php echo unikon_kses($title); ?>
                                    </span>
                                </div>

                                <?php if (!empty($title)): ?>
                                    <h3 class="wpr-breadcrumb__title white wpr_unikon_breadcrumb__title breadcrumb__title">
                                        <?php echo unikon_kses($title); ?>
                                    </h3>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb end -->

            <?php
        }
    }
}

add_action('unikon_before_main_content', 'unikon_breadcrumb_func');

// unikon_search_form
function unikon_search_form()
{ ?>

    <!-- search area start -->
    <div class="wpr-search-area d-none">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wpr-search-form">
                        <div class="wpr-search-close text-center mb-20">
                            <button class="wpr-search-close-btn wpr-search-close-btn"></button>
                        </div>
                        <form action="<?php print esc_url(home_url('/shop')); ?>">
                            <div class="wpr-search-input mb-10">
                                <input class="search-input-field" type="text"
                                    placeholder="<?php print esc_attr__('Search for product...', 'unikon'); ?>" name="s"
                                    value="<?php print esc_attr(get_search_query()) ?>">
                                <button type="submit"></button>
                            </div>
                            <?php if (class_exists('WooCommerce')):
                                $categories = get_terms('product_cat');
                                ?>
                                <div class="wpr-search-category">
                                    <?php if (!empty($categories) && !is_wp_error($categories)): ?>
                                        <span><?php echo esc_html__('Search by :', 'unikon'); ?> </span>

                                        <?php foreach ($categories as $key => $category):

                                            $category_link = get_term_link($category);

                                            $comma = $key == array_key_last($categories) ? '' : ',';
                                            ?>
                                            <a
                                                href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category->name); ?></a><?php echo esc_html($comma); ?>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search area end -->


    <?php
}
