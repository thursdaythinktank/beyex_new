<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Header_05 extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait;

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'wpr-header-05';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __(WPRCORE_THEME_NAME . ' :: Header 5', 'wprealizer');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'wpr-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['wprealizer'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['wprealizer'];
    }


    /**
     * Menu index.
     *
     * @access protected
     * @var $nav_menu_index
     */
    protected $nav_menu_index = 1;

    /**
     * Retrieve the menu index.
     *
     * Used to get index of nav menu.
     *
     * @since 1.3.0
     * @access protected
     *
     * @return string nav index.
     */
    protected function get_nav_menu_index()
    {
        return $this->nav_menu_index++;
    }

    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.3.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus()
    {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }


    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    protected function register_controls_section()
    {

        // layout Panel
        $this->start_controls_section(
            'tp_header_top',
            [
                'label' => esc_html__('Header Info', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_header_sticky',
            [
                'label' => esc_html__('Enable Sticky', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        // tp_header_right_switch
        $this->add_control(
            'tp_header_right_switch',
            [
                'label' => esc_html__('Header Right On/Off', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // tp_header_cart_switch
        $this->add_control(
            'tp_header_cart_switch',
            [
                'label' => esc_html__('Enable Cart?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->tp_single_icon_control('header_cart', 'tp_header_cart_switch', 'yes');

        $this->end_controls_section();

        // _tp_image
        $this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Site Logo', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_logo_black',
            [
                'label' => esc_html__('Choose Logo Black', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_logo_white',
            [
                'label' => esc_html__('Choose Logo White', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_logo_width',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Logo Width', 'wprealizer'),
                'description' => esc_html__('This number will count by "PX" and maximum number is 1000', 'wprealizer'),
                'placeholder' => '0',
                'min' => 10,
                'max' => 1000,
                'step' => 1,
                'default' => 125,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-logo img' => 'width: {{VALUE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        // menu
        $this->start_controls_section(
            'section_menu',
            [
                'label' => __('Menu', 'wprealizer'),
            ]
        );

        $menus = $this->get_available_menus();

        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label' => __('Menu', 'wprealizer'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    /* translators: %s Nav menu URL */
                    'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'wprealizer'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw' => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'wprealizer'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'menu_last_item',
            [
                'label' => __('Last Menu Item', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __('Default', 'wprealizer'),
                    'cta' => __('Button', 'wprealizer'),
                ],
                'default' => 'none',
                'condition' => [
                    'layout!' => 'expandible',
                ],
            ]
        );

        $this->end_controls_section();

        // offcanvas
        $this->tp_offcanvas_controls('offcanvas', 'Offcanvas');

        $this->tp_link_render_controls('header_btn', 'Button');
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->start_controls_section(
            'tp_menu_style_section',
            [
                'label' => esc_html__('Mega Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_menu_title_typography',
                'label' => esc_html__('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .tp-megamenu-home-item a',
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__('Normal', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_menu_title_color',
            [
                'label' => esc_html__('Menu Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-megamenu-home-item a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__('Hover', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_menu_title_hvr_color',
            [
                'label' => esc_html__('Menu Hover Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-megamenu-home-item:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // main Menu style
        $this->start_controls_section(
            'tp_main_menu_style_section',
            [
                'label' => esc_html__('Main Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_main_menu_title_typography',
                'label' => esc_html__('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .main-menu > nav > ul > li > a',
            ]
        );

        $this->start_controls_tabs(
            'main_style_tabs'
        );

        $this->start_controls_tab(
            'main_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_main_menu_title_color',
            [
                'label' => esc_html__('Menu Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu > nav > ul > li > a,
                    {{WRAPPER}} .main-menu > nav > ul > li.has-dropdown > a::after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'main_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_main_menu_title_hvr_color',
            [
                'label' => esc_html__('Menu Hover Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu > nav > ul > li:hover > a,
                    {{WRAPPER}} .main-menu > nav > ul > li:hover > a:after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // Link Menu style
        $this->start_controls_section(
            'tp_mobile_link_menu_style_section',
            [
                'label' => esc_html__('Link Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_mobile_link_menu_title_typography',
                'label' => esc_html__('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .tp-megamenu-small-content .tp-megamenu-list a,
                {{WRAPPER}} .main-menu > nav > ul > li > .tp-submenu li > a,
                {{WRAPPER}} .tp-megamenu-fullwidth-list ul li a',
            ]
        );

        $this->start_controls_tabs(
            'mobile_link_style_tabs'
        );

        $this->start_controls_tab(
            'mobile_link_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_mobile_link_menu_title_color',
            [
                'label' => esc_html__('Menu Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-megamenu-small-content .tp-megamenu-list a,
                {{WRAPPER}} .main-menu > nav > ul > li > .tp-submenu li > a,
                {{WRAPPER}} .tp-megamenu-fullwidth-list ul li a' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'tp_mobile_link_menu_toggle_color',
            [
                'label' => esc_html__('Menu Bar Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-megamenu-small-content .tp-megamenu-list a::before,
                    {{WRAPPER}} .main-menu > nav > ul > li > .tp-submenu li > a::before,
                    {{WRAPPER}} .tp-megamenu-fullwidth-list ul li a:before' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'mobile_link_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_mobile_link_menu_title_hvr_color',
            [
                'label' => esc_html__('Menu Hover Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-megamenu-small-content .tp-megamenu-list a:hover,
                {{WRAPPER}} .main-menu > nav > ul > li > .tp-submenu li > a:hover,
                {{WRAPPER}} .tp-megamenu-fullwidth-list ul li a:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Mobile Menu style
        $this->start_controls_section(
            'tp_mobile_main_menu_style_section',
            [
                'label' => esc_html__('Mobile Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_mobile_main_menu_title_typography',
                'label' => esc_html__('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .tp-main-menu-mobile ul li > a',
            ]
        );

        $this->start_controls_tabs(
            'mobile_main_style_tabs'
        );

        $this->start_controls_tab(
            'mobile_main_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_mobile_main_menu_title_color',
            [
                'label' => esc_html__('Menu Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-main-menu-mobile ul li > a' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'tp_mobile_main_menu_toggle_color',
            [
                'label' => esc_html__('Menu Toggle Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-main-menu-mobile ul li.has-dropdown > a .dropdown-toggle-btn::after' => 'background-color: {{VALUE}} !important',
                    '{{WRAPPER}} .tp-main-menu-mobile ul li.has-dropdown > a .dropdown-toggle-btn::before' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'mobile_main_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_mobile_main_menu_title_hvr_color',
            [
                'label' => esc_html__('Menu Hover Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-main-menu-mobile ul li > a.expanded, 
                    {{WRAPPER}} .tp-main-menu-mobile ul li:hover > a' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'tp_mobile_main_menu_toggle_hvr_color',
            [
                'label' => esc_html__('Menu Toggle Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-main-menu-mobile ul li.has-dropdown > a.expanded .dropdown-toggle-btn::after,
                    {{WRAPPER}} .offcanvas__2 .tp-main-menu-mobile ul li:hover > a .dropdown-toggle-btn::before,
                    {{WRAPPER}} .offcanvas__2 .tp-main-menu-mobile ul li:hover > a .dropdown-toggle-btn::after' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Close Btn style
        $this->start_controls_section(
            'tp_mobile_close_btn_style_section',
            [
                'label' => esc_html__('Close Button', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_mobile_close_btn_typography',
                'label' => esc_html__('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .offcanvas__close-btn',
            ]
        );

        $this->start_controls_tabs(
            'close_button_style_tabs'
        );

        $this->start_controls_tab(
            'close_button_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_close_button_menu_title_color',
            [
                'label' => esc_html__('Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas__close-btn' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'tp_close_button_menu_toggle_color',
            [
                'label' => esc_html__('Bg Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas__close-btn' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'close_button_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_close_button_menu_title_hvr_color',
            [
                'label' => esc_html__('Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas__close-btn:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'tp_close_button_menu_title_hvrbg_color',
            [
                'label' => esc_html__('Bg Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas__close-btn:hover' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $control_id = 'header_btn';

        if (!empty($settings['menu'])):
            $menu = $settings['menu'];
        else:
            $menu = '';
        endif;


        $menus = $this->get_available_menus();
        require_once get_parent_theme_file_path() . '/inc/class-navwalker.php';

        $args = [
            'echo' => false,
            'menu' => $menu,
            'menu_class' => 'tp-nav-menu ',
            'menu_id' => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => 'unikon_Navwalker_Class::fallback',
            'container' => '',
            'walker' => new unikon_Navwalker_Class,
        ];

        $menu_html = wp_nav_menu($args);

        $offcanvas_image_size = tp_get_img_size($settings, 'tp_offcanvas_logo_size');
        $logo_image_size = tp_get_img_size($settings, 'tp_image_size');


        if (!empty($settings['tp_logo_black']['url'])) {
            $logo_black = !empty($settings['tp_logo_black']['id']) ? wp_get_attachment_image_url($settings['tp_logo_black']['id'], $logo_image_size, true) : $settings['tp_logo_black']['url'];
            $logo_black_alt = get_post_meta($settings["tp_logo_black"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['tp_logo_white']['url'])) {
            $tp_logo_white = !empty($settings['tp_logo_white']['id']) ? wp_get_attachment_image_url($settings['tp_logo_white']['id'], $logo_image_size, true) : $settings['tp_logo_white']['url'];
            $tp_logo_white_alt = get_post_meta($settings["tp_logo_white"]["id"], "_wp_attachment_image_alt", true);
        }

        $is_sticky = $settings['tp_header_sticky'] == 'yes' ? 'header-sticky' : 'no-sticky';

        $edit_class = tp_is_elementor_edit_mode() ? 'wprealizer-elementor-header-edit-mode add-black-bg' : '';

        $this->tp_link_attributes_render('header_btn', 'tp-btn-border-sm d-none d-sm-block tp-el-header-btn', $this->get_settings());

?>

        <!-- header-area-start -->
        <header class="header-area p-relative wpr-header-4">
            <div id="<?php echo esc_attr($is_sticky); ?>" class="wpr-header-4-main <?php echo esc_attr($edit_class); ?>">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-2 col-xl-2 col-lg-6 col-md-6 col-6">
                            <div class="wpr-header-4-logo wpr-el-logo">
                                <a href="<?php print esc_url(home_url('/')); ?>">
                                    <img class="logo-1" src="<?php echo esc_url($tp_logo_white); ?>"
                                        alt="<?php echo esc_attr($tp_logo_white_alt); ?>">

                                    <img class="logo-2" src="<?php echo esc_url($logo_black); ?>"
                                        alt="<?php echo esc_attr($logo_black_alt); ?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-xxl-7 col-xl-7 d-none d-xl-block">
                            <div class="main-menu main-menu-4">
                                <nav class="tp-main-menu-content">
                                    <?php echo $menu_html; ?>
                                </nav>
                            </div>
                        </div>

                        <?php if (!empty($settings['tp_header_right_switch'])): ?>
                            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-6">
                                <div class="wpr-header-contact d-flex align-items-center justify-content-end">
                                    <?php if ($settings['tp_header_cart_switch'] == 'yes' && class_exists('WooCommerce')): ?>
                                        <div class="wpr-header-2-cart cart-4 d-none d-md-block">
                                            <button class="cartmini-open-btn">
                                                <span class="d-none">
                                                    <?php echo esc_html__('Cart', 'wprealizer'); ?>
                                                </span>
                                                <?php tp_render_signle_icon_html($settings, 'header_cart'); ?>

                                                <?php
                                                $cart_count = !is_null(WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
                                                ?>
                                                <i><?php echo esc_html($cart_count); ?></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                        <div class="wpr-header-4-btn d-none d-md-block ml-30">
                                            <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>><?php echo $settings['tp_' . $control_id . '_text']; ?></a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="wpr-header-bar d-xl-none ml-30">
                                        <button class="offcanvas-open-btn"><i class="fa-solid fa-bars"></i></button>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php endif; ?>

                </div>
            </div>
            </div>
        </header>
        <!-- header-area-end -->


        <?php if (class_exists('WooCommerce') && $settings['tp_header_cart_switch'] == 'yes'): ?>
            <?php print wprealizer_shopping_cart(); ?>
            <div class="body-overlay"></div>
        <?php endif; ?>

        <?php include(WPRCORE_ELEMENTS_PATH . '/header/header-offcanvas.php'); ?>

<?php

    }
}

$widgets_manager->register(new TP_Header_05());
