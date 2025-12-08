<?php

/**
 * unikon_scripts description
 * @return [type] [description]
 */
function unikon_scripts()
{

    /**
     * all css files
    */

    wp_enqueue_style('unikon-fonts', unikon_fonts_url(), array(), time());
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', UNIKON_THEME_CSS_DIR . 'bootstrap-rtl.css', array());
    } else {
        wp_enqueue_style('bootstrap', UNIKON_THEME_CSS_DIR . 'bootstrap.min.css', array());
    }
    wp_enqueue_style('meanmenu', UNIKON_THEME_CSS_DIR . 'meanmenu.min.css', []);
    wp_enqueue_style('animate', UNIKON_THEME_CSS_DIR . 'animate.min.css', []);
    wp_enqueue_style('select2', UNIKON_THEME_CSS_DIR . 'select2.css', []);
    wp_enqueue_style('odometer', UNIKON_THEME_CSS_DIR . 'odometer.css', []);
    wp_enqueue_style('nice-select', UNIKON_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('fontawesome', UNIKON_THEME_CSS_DIR . 'all.css', []);
    wp_enqueue_style('bootstrap-icons', UNIKON_THEME_CSS_DIR . 'bootstrap-icons.css', []);
    wp_enqueue_style('magnific-popup', UNIKON_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('YouTubePopUp', UNIKON_THEME_CSS_DIR . 'YouTubePopUp.css', []);
    wp_enqueue_style('swiper-bundle', UNIKON_THEME_CSS_DIR . 'swiper-bundle.min.css', []);
    wp_enqueue_style('unikon-unit', UNIKON_THEME_CSS_DIR . 'unikon-unit.css', [], time());
    wp_enqueue_style('unikon-custom', UNIKON_THEME_CSS_DIR . 'unikon-custom.css', [], time());
    wp_enqueue_style('unikon-core', UNIKON_THEME_CSS_DIR . 'unikon-core.css', [], time());
    wp_enqueue_style('unikon-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle', UNIKON_THEME_JS_DIR . 'bootstrap.bundle.min.js', ['jquery'], '', true);
    wp_enqueue_script('fontawesome', UNIKON_THEME_JS_DIR . 'all.js', ['jquery'], '', true);
    wp_enqueue_script('circletype', UNIKON_THEME_JS_DIR . 'circletype.min.js', ['jquery'], false, true);
    wp_enqueue_script('magnific-popup', UNIKON_THEME_JS_DIR . 'jquery.magnific-popup.min.js', ['jquery'], '', true);
    wp_enqueue_script('meanmenu', UNIKON_THEME_JS_DIR . 'jquery.meanmenu.min.js', ['jquery'], '', true);
    wp_enqueue_script('mixitup', UNIKON_THEME_JS_DIR . 'jquery.mixitup.min.js', ['jquery'], '', true);
    wp_enqueue_script('nice-select', UNIKON_THEME_JS_DIR . 'jquery.nice-select.min.js', ['jquery'], '', true);
    wp_enqueue_script('odometer', UNIKON_THEME_JS_DIR . 'odometer.min.js', ['jquery'], '', true);
    wp_enqueue_script('select2', UNIKON_THEME_JS_DIR . 'select2.js', ['jquery'], false, true);
    wp_enqueue_script('viewport', UNIKON_THEME_JS_DIR . 'viewport.jquery.js', ['jquery'], false, true);
    wp_enqueue_script('YouTubePopUp', UNIKON_THEME_JS_DIR . 'YouTubePopUp.js', ['jquery'], false, true);
    wp_enqueue_script('wow', UNIKON_THEME_JS_DIR . 'wow.min.js', ['jquery'], false, true);
    wp_enqueue_script('swiper-bundle', UNIKON_THEME_JS_DIR . 'swiper-bundle.min.js', ['jquery'], false, true);
    wp_enqueue_script('gsap', UNIKON_THEME_JS_DIR . 'gsap.min.js', ['jquery'], false, true);
    wp_enqueue_script('gsap-scroll-smoother', UNIKON_THEME_JS_DIR . 'gsap-scroll-smoother.js', ['jquery'], false, true);
    wp_enqueue_script('ScrollToPlugin', UNIKON_THEME_JS_DIR . 'ScrollToPlugin.min.js', ['jquery'], false, true);
    wp_enqueue_script('unikon-main', UNIKON_THEME_JS_DIR . 'main.js', ['jquery'], false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'unikon_scripts');

/*
Register Fonts
 */
function unikon_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
    if ('off' !== _x('on', 'Google font: on or off', 'unikon')) {
        $font_url = 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Metal&display=swap';
    }
    
    return $font_url;
}
