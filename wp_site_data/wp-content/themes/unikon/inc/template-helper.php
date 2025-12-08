<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package unikon
 */

/** 
 *
 * unikon header
 */
function get_header_style($style)
{
    if ($style == 'header_2') {
        get_template_part('template-parts/header/header-2');
    } else {
        get_template_part('template-parts/header/header-1');
    }
}



function unikon_check_header()
{

$wpr_header_tabs = function_exists('get_field') ? get_field('header_settings_unikon_header_tabs') : false;
$wpr_header_style_meta = function_exists('get_field') ? get_field('header_settings_unikon_header_style') : '';
$elementor_header_template_meta = function_exists('get_field') ? get_field('header_settings_unikon_header_templates') : false;

    $unikon_header_option_switch = get_theme_mod('unikon_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod('header_layout_custom', 'header_1');
    $elementor_header_templates_kirki = get_theme_mod('unikon_header_templates');

    if ($wpr_header_tabs == 'default') {
        if ($unikon_header_option_switch) {
            if ($elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        } else {
            if ($header_default_style_kirki) {
                get_header_style($header_default_style_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        }
    } elseif ($wpr_header_tabs == 'custom') {
        if ($wpr_header_style_meta) {
            get_header_style($wpr_header_style_meta);
        } else {
            get_header_style($header_default_style_kirki);
        }
    } elseif ($wpr_header_tabs == 'elementor') {
        if ($elementor_header_template_meta) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        } else {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    } else {
        if ($unikon_header_option_switch) {

            if ($elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        } else {
            get_header_style($header_default_style_kirki);
        }
    }
}
add_action('unikon_header_style', 'unikon_check_header', 10);


/* unikon offcanvas */

function unikon_check_offcanvas()
{
    $unikon_offcanvas_style = function_exists('get_field') ? get_field('unikon_offcanvas_style') : NULL;
    $unikon_default_offcanvas_style = get_theme_mod('choose_default_offcanvas', 'offcanvas-style-1');

    if ($unikon_offcanvas_style == 'offcanvas-style-1') {
        get_template_part('template-parts/offcanvas/offcanvas-1');
    } elseif ($unikon_offcanvas_style == 'offcanvas-style-2') {
        get_template_part('template-parts/offcanvas/offcanvas-2');
    } else {
        if ($unikon_default_offcanvas_style == 'offcanvas-style-2') {
            get_template_part('template-parts/offcanvas/offcanvas-2');
        } else {
            get_template_part('template-parts/offcanvas/offcanvas-1');
        }
    }
}

add_action('unikon_offcanvas_style', 'unikon_check_offcanvas', 10);

// unikon_header_lang_defualt
function unikon_header_lang_defualt()
{
    ?>
    <ul>
        <li>

            <a id="header-bottom__lang-toggle" href="javascript:void(0)">
                <span>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/flag/flag-1.png" alt="img">
                    <?php echo esc_html__('English', 'unikon'); ?>
                </span>

                <span>
                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.15067 0.653687C1.33329 0.4674 1.61907 0.450465 1.82045 0.602881L1.87814 0.653687L6 4.85839L10.1219 0.653687C10.3045 0.4674 10.5903 0.450465 10.7916 0.602881L10.8493 0.653687C11.032 0.839974 11.0486 1.13148 10.8991 1.3369L10.8493 1.39575L6.36374 5.97131C6.18111 6.1576 5.89534 6.17454 5.69396 6.02212L5.63626 5.97131L1.15067 1.39575C0.949778 1.19084 0.949778 0.858603 1.15067 0.653687Z"
                            fill="white" stroke="white" stroke-width="0.5"></path>
                    </svg>
                </span>
            </a>
            <?php do_action('unikon_header_language'); ?>
            <?php
}

/**
 * [unikon_language_list description]
 * @return [type] [description]
 */
function _unikon_header_language($mar)
{
    return $mar;
}
function unikon_header_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    }
    print _unikon_header_language($mar);
}
add_action('unikon_header_language', 'unikon_header_language_list');


// unikon_footer_lang_defualt
function unikon_footer_lang_defualt()
{
    ?>
            <ul>
                <li>

                    <a id="header-bottom__lang-toggle" href="javascript:void(0)">
                        <span><?php echo esc_html__('EN', 'unikon'); ?></span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 1L5 5L9 1" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>

                    <?php do_action('unikon_language'); ?>

                    <?php
}

/**
 * [unikon_language_list description]
 * @return [type] [description]
 */
function _unikon_language($mar)
{
    return $mar;
}
function unikon_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    }
    print _unikon_language($mar);
}
add_action('unikon_language', 'unikon_language_list');


/**
 * [unikon_offcanvas_language description]
 * @return [type] [description]
 */


/**
 * [unikon_header_lang description]
 * @return [type] [description]
 */
function unikon_offcanvas_lang_defualt()
{
    ?>
        <div class="offcanvas__select language">
            <div class="offcanvas__lang d-flex align-items-center justify-content-md-end">
                <div class="offcanvas__lang-img mr-15">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon/language-flag.png"
                        alt="<?php echo esc_attr__('language', 'unikon'); ?>">
                </div>

                <div class="offcanvas__lang-wrapper">
                    <span class="offcanvas__lang-selected-lang tp-lang-toggle"
                        id="tp-offcanvas-lang-toggle"><?php echo esc_html__('English', 'unikon'); ?></span>
                    <?php do_action('unikon_offcanvas_language'); ?>
                </div>
            </div>
        </div>
    <?php
}
function _unikon_offcanvas_language($mar)
{
    return $mar;
}
function unikon_offcanvas_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="offcanvas__lang-list tp-lang-list">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    }
    print _unikon_language($mar);
}
add_action('unikon_offcanvas_language', 'unikon_offcanvas_language_list');



/**
 * [unikon_language_list description]
 * @return [type] [description]
 */
function _unikon_footer_language($mar)
{
    return $mar;
}
function unikon_footer_language_list()
{
    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="footer__lang-list tp-lang-list-2">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    }
    print _unikon_footer_language($mar);
}
add_action('unikon_footer_language', 'unikon_footer_language_list');



// header logo
function unikon_header_logo()
{ ?>
    <?php

        $unikon_logo_black_dir = get_template_directory_uri() . '/assets/img/logo.svg';
        $unikon_logo_white_dir = get_template_directory_uri() . '/assets/img/logo-light.svg';

        // logo from customizer
        $unikon_logo_white = get_theme_mod('header_logo_white', $unikon_logo_white_dir);
        $unikon_logo_black = get_theme_mod('header_logo_black', $unikon_logo_black_dir);


        // logo settings from meta
        $logo_black_from_page = function_exists('get_field') ? get_field('unikon_logo_black') : NULL;
        $logo_white_from_page = function_exists('get_field') ? get_field('unikon_logo_white') : NULL;


        $logo_white = !empty($logo_white_from_page) ? $logo_white_from_page['url'] : $unikon_logo_white;
        $logo_black = !empty($logo_black_from_page) ? $logo_black_from_page['url'] : $unikon_logo_black;

        ?>

        <a class="logo-1 unikon-logo-black unikon-site-logo" href="<?php print esc_url(home_url('/')); ?>">
            <img src="<?php print esc_url($logo_black); ?>"
                alt="<?php print esc_attr__('unikon Logo', 'unikon'); ?>">
        </a>
        <?php
}



/**
 * [unikon_header_menu description]
 * @return [type] [description]
 */
function unikon_header_menu()
{
    ?>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'main-menu',
                        'menu_class' => '',
                        'container' => '',
                        'fallback_cb' => 'unikon_Navwalker_Class::fallback',
                        'walker' => new \WPRCore\Widgets\unikon_Navwalker_Class,
                    ]);
                    ?>
                    <?php
}


/**
 *
 * unikon footer
 */
add_action('unikon_footer_style', 'unikon_check_footer', 10);

function get_footer_style($style)
{
    if ($style == 'footer_2') {
        get_template_part('template-parts/footer/footer-2');
    } else {
        get_template_part('template-parts/footer/footer-1');
    }
}

function unikon_check_footer()
{
    global $post;

    $_id = get_the_ID() ?? NULL;

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $tp_footer_tabs = function_exists('get_field') ? get_field('footer_settings_unikon_footer_tabs', $_id ? $_id : NULL) : false;
    $tp_footer_style_meta = function_exists('get_field') ? get_field('footer_settings_unikon_footer_style', $_id ? $_id : NULL) : '';
    $elementor_footer_template_meta = function_exists('get_field') ? get_field('footer_settings_unikon_footer_templates', $_id ? $_id : NULL) : false;

    $unikon_footer_option_switch = get_theme_mod('unikon_footer_elementor_switch', false);
    $footer_default_style_kirki = get_theme_mod('footer_layout_custom', 'footer_1');
    $elementor_footer_templates_kirki = get_theme_mod('unikon_footer_templates');

    if ($tp_footer_tabs == 'default') {
        if ($unikon_footer_option_switch) {
            if ($elementor_footer_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }
        } else {
            if ($footer_default_style_kirki) {
                get_footer_style($footer_default_style_kirki);
            } else {
                get_template_part('template-parts/footer/footer-1');
            }
        }
    } elseif ($tp_footer_tabs == 'custom') {
        if ($tp_footer_style_meta) {
            get_footer_style($tp_footer_style_meta);
        } else {
            get_footer_style($footer_default_style_kirki);
        }
    } elseif ($tp_footer_tabs == 'elementor') {
        if ($elementor_footer_template_meta) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template_meta);
        } else {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }
    } else {
        if ($unikon_footer_option_switch) {

            if ($elementor_footer_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            } else {
                get_template_part('template-parts/footer/footer-1');
            }
        } else {
            get_footer_style($footer_default_style_kirki);
        }
    }
}

// unikon_copyright_text
function unikon_copyright_text()
{
    print get_theme_mod('unikon_copyright', esc_html__('Copyright 2024 Unikon. Inc.', 'unikon'));
}


/**
 *
 * pagination
 */
if (!function_exists('unikon_pagination')) {

    function _unikon_pagi_callback($pagination)
    {
        return $pagination;
    }

    //page navegation
    function unikon_pagination($prev, $next, $pages, $args)
    {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        $pagination = [
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'total' => $pages,
            'current' => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'array',
        ];

        //rewrite permalinks
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = '';
        if (paginate_links($pagination) != '') {
            $paginations = paginate_links($pagination);
            $pagi .= '<ul>';
            foreach ($paginations as $key => $pg) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _unikon_pagi_callback($pagi);
    }
}

function unikon_arr_to_string(array $array = [])
{
    $result = "";
    foreach ($array as $key => $value) {
        $result .= $key . ": " . $value . "; ";
    }
    return $result;
}

function unikon_breadcrumb_typography()
{
    $typo_for_desktop = get_theme_mod('breadcrumb_typography_desktop');
    $typo_for_tablet = get_theme_mod('breadcrumb_typography_tablet');
    $typo_for_mobile = get_theme_mod('breadcrumb_typography_mobile');

    wp_enqueue_style('unikon-breadcrumb-typo', UNIKON_THEME_CSS_DIR . 'unikon-custom.css', []);

    if ($typo_for_desktop) {
        $typo = '';
        $typo .= '.breadcrumb__title{' . unikon_arr_to_string($typo_for_desktop) . '}';
        if (array_key_exists('text-align', $typo_for_desktop)) {
            $typo .= '.breadcrumb_content{text-align : ' . $typo_for_desktop['text-align'] . '}';
        }
        wp_add_inline_style('unikon-breadcrumb-typo', $typo);
    }
    if ($typo_for_tablet) {
        $typo = '';
        $typo .= '@media (max-width: 991px){.breadcrumb__title{' . unikon_arr_to_string($typo_for_tablet) . '}}';
        if (array_key_exists('text-align', $typo_for_mobile)) {
            $typo .= '@media (max-width: 991px){.breadcrumb_content{text-align : ' . $typo_for_tablet['text-align'] . '}}';
        }
        wp_add_inline_style('unikon-breadcrumb-typo', $typo);
    }
    if ($typo_for_mobile) {
        $typo = '';
        $typo .= '@media (max-width: 767px){.breadcrumb__title{' . unikon_arr_to_string($typo_for_mobile) . '}}';
        if (array_key_exists('text-align', $typo_for_mobile)) {
            $typo .= '@media (max-width: 767px){.breadcrumb_content{text-align : ' . $typo_for_mobile['text-align'] . '}}';
        }
        wp_add_inline_style('unikon-breadcrumb-typo', $typo);
    }
}
add_action('wp_enqueue_scripts', 'unikon_breadcrumb_typography');


// unikon_breadcrumb_bg_settings
function unikon_breadcrumb_bg_settings()
{
    global $post;
    $_id = get_the_ID();
    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $bg_color = function_exists('get_field') ? get_field('unikon_breadcrumb_bg_color', $_id ? $_id : NULL) : '';
    $bg_img = function_exists('tpmeta_image_field') ? tpmeta_image_field('unikon_breadcrumb_bg', $_id ? $_id : NULL) : '';
    wp_enqueue_style('unikon-breadcrumb-bg-settings', UNIKON_THEME_CSS_DIR . 'unikon-custom.css', []);

    if ($bg_color != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb__area.unikon-breadcrumb-padding { background-color: " . $bg_color . " ; background-image: url(" . $bg_img['url'] . ")}";

        wp_add_inline_style('unikon-breadcrumb-bg-settings', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'unikon_breadcrumb_bg_settings');


// unikon_footer_bg_settings
function unikon_footer_bg_settings()
{
    global $post;
    $_id = get_the_ID();
    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $bg_color = function_exists('get_field') ? get_field('unikon_footer_bg_color', $_id ? $_id : NULL) : '';
    $bg_img = function_exists('tpmeta_image_field') ? tpmeta_image_field('unikon_footer_bg', $_id ? $_id : NULL) : '';
    $bg_img = !empty($bg_img['url']) ? $bg_img['url'] : '';
    wp_enqueue_style('unikon-footer-bg-settings', UNIKON_THEME_CSS_DIR . 'unikon-custom.css', []);

    if ($bg_color != '') {
        $custom_css = '';
        $custom_css .= "div.unikon-footer-settings { background-color: " . $bg_color . " ; background-image: url(" . $bg_img . "); background-size: cover; background-position: center; background-repeat: no-repeat;}";

        wp_add_inline_style('unikon-footer-bg-settings', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'unikon_footer_bg_settings');


// theme color
function unikon_custom_color()
{
    $unikon_color_1 = get_theme_mod('unikon_color_1', '#0f0f0f');
    $unikon_color_2 = get_theme_mod('unikon_color_2', '#ffbb7b');
    $unikon_color_3 = get_theme_mod('unikon_color_3', '#c89b51');
    $unikon_color_33 = get_theme_mod('unikon_color_33', '#f0f1e7');
    $unikon_color_4 = get_theme_mod('unikon_color_4', '#f0b64b');
    $unikon_color_5 = get_theme_mod('unikon_color_5', '#f5f5f5');
    $unikon_color_6 = get_theme_mod('unikon_color_6', '#fcfcfc');
    $unikon_color_7 = get_theme_mod('unikon_color_7', '#fffdfc');
    $unikon_color_8 = get_theme_mod('unikon_color_8', '#c9f31d');
    $unikon_color_9 = get_theme_mod('unikon_color_9', '#f0a362');
    $unikon_color_10 = get_theme_mod('unikon_color_10', '#f5ca78');
    $unikon_color_11 = get_theme_mod('unikon_color_11', 'linear-gradient(90deg, #3a9fd8 0%, #8363de 100%)');


    wp_enqueue_style('unikon-custom', UNIKON_THEME_CSS_DIR . 'unikon-custom.css', []);

    if (!empty($unikon_color_1 || $unikon_color_2 || $unikon_color_3 || $unikon_color_33 || $unikon_color_4 || $unikon_color_5 || $unikon_color_6 || $unikon_color_7 || $unikon_color_8 || $unikon_color_9 || $unikon_color_10 || $unikon_color_11)) {
        $custom_css = '';
        $custom_css .= "html:root{
            --primary-theme-color: " . $unikon_color_1 . ";
            --color-theme-1: " . $unikon_color_2 . ";
            --color-tan: " . $unikon_color_3 . ";
            --color-tan-light: " . $unikon_color_33 . ";
            --color-yellow: " . $unikon_color_4 . ";
            --color-cultured: " . $unikon_color_5 . ";
            --color-lotion: " . $unikon_color_6 . ";
            --color-lotion-light: " . $unikon_color_7 . ";
            --color-arctic-lime: " . $unikon_color_8 . ";
            --color-sandy-brown: " . $unikon_color_9 . ";
            --color-topaz: " . $unikon_color_10 . ";
            --color-health-gradient: " . $unikon_color_11 . ";
        }";

        wp_add_inline_style('unikon-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'unikon_custom_color');





// unikon_kses_intermediate
function unikon_kses_intermediate($string = '')
{
    return wp_kses($string, unikon_get_allowed_html_tags('intermediate'));
}

function unikon_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
        'a' => [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function unikon_kses($raw)
{

    $allowed_tags = array(
        'a' => array(
            'class' => array(),
            'href' => array(),
            'rel' => array(),
            'title' => array(),
            'target' => array(),
            'aria-label' => array(),
            'data-course-id' => array(),
            'data-*' => array(),
            'data-quantity' => array(),
            'data-product_sku' => array(),
        ),
        'abbr' => array(
            'title' => array(),
        ),
        'b' => array(),
        'blockquote' => array(
            'cite' => array(),
        ),
        'cite' => array(
            'title' => array(),
        ),
        'code' => array(),
        'del' => array(
            'datetime' => array(),
            'title' => array(),
        ),
        'dd' => array(),
        'div' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
            'id' => array(),
            'aria-labelledby' => array(),
            'aria-hidden' => array(),
            'data-*' => array(),
            'role' => array(),
        ),
        'dl' => array(),
        'dt' => array(),
        'em' => array(),
        'h1' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h2' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h3' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h4' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h5' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'h6' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'i' => array(
            'class' => array(),
        ),
        'img' => array(
            'alt' => array(),
            'class' => array(),
            'height' => array(),
            'src' => array(),
            'width' => array(),
            'loading' => array(),
        ),
        'li' => array(
            'class' => array(),
        ),
        'ol' => array(
            'class' => array(),
        ),
        'p' => array(
            'class' => array(),
        ),
        'q' => array(
            'cite' => array(),
            'title' => array(),
        ),
        'span' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
            'data-cat-color' => array(),
            'data-rating-value' => array(),
            'area-current' => array(),
        ),
        'iframe' => array(
            'width' => array(),
            'height' => array(),
            'scrolling' => array(),
            'frameborder' => array(),
            'allow' => array(),
            'src' => array(),
        ),
        'strike' => array(),
        'br' => array(),
        'strong' => array(),
        'data-wow-duration' => array(),
        'data-wow-delay' => array(),
        'data-wallpaper-options' => array(),
        'data-stellar-background-ratio' => array(),
        'ul' => array(
            'class' => array(),
        ),
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'opacity' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'fill' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g' => array('fill' => true),
        'title' => array('title' => true),
        'path' => array(
            'd' => true,
            'fill' => true,
            'opacity' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,

        ),
        'nav' => array(
            'class' => array(),
            'id' => array(),
            'data-push_state_link' => array(),
        ),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter('get_archives_link', 'unikon_archive_count_span');
function unikon_archive_count_span($links)
{
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'unikon_cat_count_span');
function unikon_cat_count_span($links)
{
    $links = str_replace('</a> (', '<span> (', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return $links;
}


function unikon_html_attrs(array $raw_attributes)
{
    $attributes = array();
    foreach ($raw_attributes as $name => $value) {
        $attributes[] = esc_attr($name) . '="' . esc_attr($value) . '"';
    }

    printf(' %s', implode(' ', $attributes));
}


function add_unikon_post_color_category($term = null)
{


    ?>
                    <?php if (!is_object($term)): ?>
                        <div class="form-field term-color-wrap">
                            <label><?php echo esc_html__('Add Color Code', 'unikon'); ?></label>
                            <div>
                                <input type="text" name="_unikon_post_cat_color">
                            </div>
                        </div>
                    <?php else: ?>

                        <tr class="form-field term-color-wrap">
                            <th scope="row"><label><?php echo esc_html__('Color', 'unikon'); ?></label></th>
                            <td>
                                <div class="form-field term-color-wrap">
                                    <div>
                                        <input type="text" name="_unikon_post_cat_color"
                                            value="<?php echo esc_html(get_term_meta($term->term_id, '_unikon_post_cat_color', true)); ?>">
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>

                    <?php
}

add_action('category_add_form_fields', 'add_unikon_post_color_category');
add_action('category_edit_form_fields', 'add_unikon_post_color_category', 10, 1);

function save_unikon_post_color_value($term_id)
{
    if (isset($_POST['_unikon_post_cat_color']) && !empty($_POST['_unikon_post_cat_color'])) {
        update_term_meta($term_id, '_unikon_post_cat_color', $_POST['_unikon_post_cat_color']);
    }
}

add_action('create_category', 'save_unikon_post_color_value', 10, 1);
add_action('edited_category', 'save_unikon_post_color_value', 10, 1);

function add_unikon_post_color_column($columns)
{
    $new_columns = $columns;
    $new_columns['unikon_post_color'] = __('Color', 'unikon');

    return $new_columns;
}

add_filter('manage_edit-category_columns', 'add_unikon_post_color_column', 10, 1);


function display_unikon_post_color_column_value($row, $column_name, $term_id)
{
    if ($column_name == 'unikon_post_color') {
        $row .= "<div style='width: 40px; height: 40px; background-color: " . get_term_meta($term_id, '_unikon_post_cat_color', true) . "'></div>";

    }

    return $row;
}

add_filter('manage_category_custom_column', 'display_unikon_post_color_column_value', 10, 3);

function get_dashboard_title($current_slug)
{
    $titles = [
        'dashboard' => is_user_logged_in() ? esc_html__('Dashboard', 'unikon') : esc_html__('Login', 'unikon'),
        'dashboard/retrieve-password' => esc_html__('Reset Password', 'unikon'),
        'dashboard/my-profile' => esc_html__('My Profile', 'unikon'),
        'dashboard/enrolled-courses' => esc_html__('Enrolled Courses', 'unikon'),
        'dashboard/my-courses' => esc_html__('My Courses', 'unikon'),
        'dashboard/settings' => esc_html__('Settings', 'unikon'),
        'dashboard/wishlist' => esc_html__('Wishlist', 'unikon'),
        'dashboard/reviews' => esc_html__('Reviews', 'unikon'),
        'dashboard/my-quiz-attempts' => esc_html__('My quiz attempts', 'unikon'),
        'dashboard/purchase_history' => esc_html__('Purchase History', 'unikon'),
        'dashboard/question-answer' => esc_html__('Question & Answer', 'unikon'),
        'dashboard/announcements' => esc_html__('Announcements', 'unikon'),
        'dashboard/withdraw' => esc_html__('Withdraw', 'unikon'),
        'dashboard/quiz-attempts' => esc_html__('Quiz attempts', 'unikon'),
        'dashboard/settings/reset-password' => esc_html__('Reset password', 'unikon'),
        'dashboard/settings/withdraw-settings' => esc_html__('Withdraw Settings', 'unikon')
    ];


    $current_slug = rtrim($current_slug, '/');

    return $titles[$current_slug] ?? get_the_title();
}


add_filter( 'woosc_bar_bg_color_default', 'unikon_change_woosc_bar_bg_color' );

function unikon_change_woosc_bar_bg_color( $default_color ) {
    return 'transparent';
}