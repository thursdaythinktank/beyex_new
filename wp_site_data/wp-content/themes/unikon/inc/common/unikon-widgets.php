<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function unikon_widgets_init()
{

    /**
     * blog sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'unikon'),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__('Set Your Blog Widget', 'unikon'),
        'before_widget' => '<div id="%1$s" class="wpr-sidebar-widget widget__item sidebar__widget mb-50 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="wpr-sidebar-widget-title h6 widget__title sidebar__widget-title">',
        'after_title'   => '</h3>',
    ]);

    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    // footer default
    for ($num = 1; $num <= $footer_widgets; $num++) {
        register_sidebar([
            'name'          => sprintf(esc_html__('Footer %1$s', 'unikon'), $num),
            'id'            => 'footer-' . $num,
            'description'   => sprintf(esc_html__('Footer column %1$s', 'unikon'), $num),
            'before_widget' => '<div id="%1$s" class="custom-ul footer-common__body-nav-links wpr-footer-widget wpr-footer-2-widget mb-30 footer-col-2-' . $num . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="wpr-footer-widget-title mb-15">',
            'after_title'   => '</h4>',
        ]);
    }

    /**
    * services Widget
    */
    register_sidebar([
        'name'          => esc_html__('Services Sidebar', 'unikon'),
        'id'            => 'services-sidebar',
        'description'   => esc_html__('Set Your Services Widget', 'unikon'),
        'before_widget' => '<div id="%1$s" class="wpr-sidebar-widget widget__item sidebar__widget mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="h6 widget__title">',
        'after_title'   => '</h6>',
    ]);
}
add_action('widgets_init', 'unikon_widgets_init');
