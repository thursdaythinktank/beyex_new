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
class TP_Header_Ecommerce extends Widget_Base
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
        return 'wpr-header-ecommerce';
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
        return __(WPRCORE_THEME_NAME . ' :: Header Ecommerce', 'wprealizer');
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

    private function get_tutor_lms_dashboard_pages()
    {
        $pages = [];
        $tutorPages = tutor_utils()->tutor_dashboard_nav_ui_items();

        foreach ($tutorPages as $key => $value) {
            if (array_key_exists('type', $value)) {
                continue;
            } else {
                $pages[$key] = $value['title'];
            }
        }

        return $pages;
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
                'default' => 'yes',
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

        $this->add_control(
            'tp_header_login_switch',
            [
                'label' => esc_html__('Enable Login?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_header_search',
            [
                'label' => esc_html__('Enable Search?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

        // _tp_top_section
        $this->start_controls_section(
            '_tp_top_section',
            [
                'label' => esc_html__('Header Top', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_header_header_top',
            [
                'label' => esc_html__('Enable Header Top', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_top_bg_image',
            [
                'label' => esc_html__('Top Bg Image', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_top_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Default title', 'wprealizer'),
                'placeholder' => esc_html__('Type your title here', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_theme_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'wprealizer'),
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_theme_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_theme_btn_link',
            [
                'label' => esc_html__('Button link', 'wprealizer'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'wprealizer'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_theme_btn_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_theme_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_types_post('page'),
                'condition' => [
                    'tp_theme_btn_link_type' => '2',
                ]
            ]
        );

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

        if (function_exists('tutor')) {
            $this->start_controls_section(
                'tp_header_user_sec',
                [
                    'label' => esc_html__('User Menu List', 'wprealizer'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );


            $this->add_control(
                'tp_header_user_list',
                [
                    'label' => esc_html__('User Menu List', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'multiple' => true,
                    'label_block' => true,
                    'options' => $this->get_tutor_lms_dashboard_pages(),
                ]
            );

            $this->end_controls_section();


            $this->start_controls_section(
                'tp_header_category_sec',
                [
                    'label' => esc_html__('Category', 'wprealizer'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'tp_header_category_switch' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'tp_header_category_text',
                [
                    'label' => esc_html__('Category Text', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Category', 'wprealizer'),
                    'placeholder' => esc_html__('Your Text', 'wprealizer'),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'tp_header_category_list',
                [
                    'label' => esc_html__('Select Cagetories', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'multiple' => true,
                    'options' => tp_get_categories('course-category'),
                    'label_block' => true,
                ]
            );


            $this->end_controls_section();
        }

        // header button controls
        $this->tp_link_render_controls('header_btn', 'Button');

        // offcanvas
        $this->tp_offcanvas_controls('offcanvas', 'Offcanvas');
    }

    // style_tab_content
    protected function style_tab_content()
    {
        // menu
        $this->start_controls_section(
            'section_header_style',
            [
                'label' => __('Header Style', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'exclude' => ['video'],
                'selector' => '{{WRAPPER}} .tp_el_header',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_box_shadow',
                'selector' => '{{WRAPPER}} .tp_el_header',
            ]
        );
        $this->add_control(
            'tp_header_padding',
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .tp_el_header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // header sticky
        $this->add_control(
            '_content_header_sticky',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Header Sticky', 'wprealizer'),
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tp_sticky_background',
                'types' => ['classic', 'gradient', 'video'],
                'exclude' => ['video'],
                'selector' => '{{WRAPPER}} .tp_el_header.wpr-header-sticky',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_sticky_box_shadow',
                'selector' => '{{WRAPPER}} .tp_el_header.wpr-header-sticky',
            ]
        );

        $this->end_controls_section();

        // menu
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

        $btn_id = 'theme_btn';

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

        if (!empty($settings['tp_top_bg_image']['url'])) {
            $tp_top_bg_image = !empty($settings['tp_top_bg_image']['id']) ? wp_get_attachment_image_url($settings['tp_top_bg_image']['id'], $logo_image_size, true) : $settings['tp_top_bg_image']['url'];
            $tp_top_bg_image_alt = get_post_meta($settings["tp_top_bg_image"]["id"], "_wp_attachment_image_alt", true);
        }

        $is_sticky = $settings['tp_header_sticky'] == 'yes' ? 'header-sticky' : 'no-sticky';
        $edit_class = tp_is_elementor_edit_mode() ? 'wprealizer-elementor-header-edit-mode' : '';

        $this->tp_link_attributes_render(
            'theme_btn',
            'tp-announcement-btn' . '',
            $this->get_settings()
        );

        $this->tp_link_attributes_render('header_btn', 'tp-btn-inner tp-btn-inner', $this->get_settings());
?>
        <!-- announcement area start -->
        <?php if (!empty($settings['tp_header_header_top'])): ?>
            <div class="tp-announcement-area p-relative" style="background-image: url(<?php echo esc_url($settings['tp_top_bg_image']['url']); ?>);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tp-announcement-wrap text-center">
                                <div class="tp-announcement-content d-flex justify-content-center">
                                    <?php if (!empty($settings['tp_top_title'])): ?>
                                        <p>
                                            <?php echo tp_kses($settings['tp_top_title']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_theme_btn_text'])): ?>
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>
                                            <?php echo tp_kses($settings['tp_theme_btn_text']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="tp-announcement-close">
                                    <button class="hide-button">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 1L1 9" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M1 1L9 9" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- announcement area end -->


        <!-- header-area-start -->
        <header class="header-area p-relative">
            <div id="<?php echo esc_attr($is_sticky); ?>" class="wpr-header-2 tp_el_header wpr-header-shop bxs-none">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-4 col-lg-6 col-6">
                            <div class="wpr-header-2-right d-flex align-items-center">
                                <div class="wpr-header-shop-logo wpr-header-logo wpr-el-logo pr-20">
                                    <a href="<?php print esc_url(home_url('/')); ?>">
                                        <img src="<?php echo esc_url($logo_black); ?>"
                                            alt="<?php echo esc_attr($logo_black_alt); ?>">
                                    </a>
                                </div>

                                <?php if (!empty($settings['tp_header_search'])): ?>
                                    <div class="wpr-header-shop-search p-relative d-none d-lg-block">
                                        <form action="<?php print esc_url(home_url('/')); ?>">
                                            <input type="search" name="s" value="<?php print esc_attr(get_search_query()) ?>"
                                                placeholder="<?php print esc_attr__('search...', 'wprealizer'); ?>">
                                            <button class="wpr-header-search-btn" type="submit">
                                                <span>
                                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.625 12.625L16 16" stroke="#8B8B8B" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M14.5 7.75C14.5 4.02208 11.4779 1 7.75 1C4.02208 1 1 4.02208 1 7.75C1 11.4779 4.02208 14.5 7.75 14.5C11.4779 14.5 14.5 11.4779 14.5 7.75Z"
                                                            stroke="#8B8B8B" stroke-width="1.5" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xxl-5 col-lg-6 d-none d-xxl-block">
                            <div class="main-menu text-xxl-end d-none d-xxl-block">
                                <nav class="tp-main-menu-content">
                                    <?php echo $menu_html; ?>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-6 col-6">
                            <div class="wpr-header-2-contact wpr-header-shop d-flex align-items-center justify-content-end">

                                <?php if ($settings['tp_header_cart_switch'] == 'yes' && class_exists('WooCommerce')): ?>
                                    <div class="wpr-header-2-cart d-none d-md-block">
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
                                    <div class="wpr-header-shop-btn d-none d-lg-block">
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                            <?php echo $settings['tp_' . $control_id . '_text']; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php
                                if (!empty($settings['tp_header_login_switch']) && function_exists('tutor')):
                                    if (is_user_logged_in()):
                                        $user_id = get_current_user_id();
                                        $user = get_user_by('ID', $user_id);

                                        $cover_placeholder = tutor()->url . 'assets/images/cover-photo.jpg';
                                        $cover_photo_src = $cover_placeholder;
                                        $cover_photo_id = get_user_meta($user->ID, '_tutor_cover_photo', true);
                                        if ($cover_photo_id) {
                                            $url = wp_get_attachment_image_url($cover_photo_id, 'full');
                                            !empty($url) ? $cover_photo_src = $url : 0;
                                        }
                                        $profile_placeholder = apply_filters('tutor_login_default_avatar', tutor()->url . 'assets/images/profile-photo.png');
                                        $profile_photo_src = $profile_placeholder;
                                        $profile_photo_id = get_user_meta($user->ID, '_tutor_profile_photo', true);
                                        if ($profile_photo_id) {
                                            $url = wp_get_attachment_image_url($profile_photo_id, 'full');
                                            !empty($url) ? $profile_photo_src = $url : 0;
                                        }
                                        $dashboard_pages = tutor_utils()->tutor_dashboard_nav_ui_items();
                                ?>
                                        <div class="wpr-header-shop-login wpr-header-user-hover">
                                            <button>
                                                <img src="<?php echo esc_url($profile_photo_src); ?>" alt="<?php echo esc_attr($user->display_name); ?>">
                                            </button>

                                            <?php if (current_user_can(tutor()->instructor_role)): ?>
                                                <div class="wpr-header-user-box">
                                                    <div class="wpr-header-user-content">
                                                        <div class="wpr-header-user-profile d-flex align-items-center">
                                                            <div class="wpr-header-user-profile-thumb">
                                                                <img src="<?php echo esc_url($profile_photo_src); ?>"
                                                                    alt="<?php echo esc_attr($user->display_name); ?>">
                                                            </div>
                                                            <div class="wpr-header-user-profile-content">
                                                                <h4><?php echo esc_html($user->display_name); ?></h4>
                                                                <span><?php echo esc_html(ucwords($user->roles[0])); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="wpr-header-user-list">
                                                            <ul>
                                                                <?php
                                                                $dashboard_pages = tutor_utils()->tutor_dashboard_nav_ui_items();
                                                                $disable = !get_tutor_option('enable_course_review');
                                                                foreach ($dashboard_pages as $dashboard_key => $dashboard_page) {
                                                                    foreach ($settings['tp_header_user_list'] as $key => $value) {
                                                                        if ($dashboard_key == $value) {
                                                                            if ($disable && 'reviews' === $dashboard_key) {
                                                                                continue;
                                                                            }

                                                                            $menu_title = $dashboard_page;
                                                                            $menu_link = tutor_utils()->get_tutor_dashboard_page_permalink($dashboard_key);
                                                                            $separator = false;
                                                                            $menu_icon = '';

                                                                            if (is_array($dashboard_page)) {
                                                                                $menu_title = tutor_utils()->array_get('title', $dashboard_page);
                                                                                $menu_icon_name = tutor_utils()->array_get('icon', $dashboard_page, (isset($dashboard_page['icon']) ? $dashboard_page['icon'] : ''));

                                                                                if (in_array($dashboard_key, get_lsm_dashboard_menu_keys())) {
                                                                                    $menu_icon = get_lsm_dashboard_menu_icon($dashboard_key);
                                                                                } else {
                                                                                    if ($menu_icon_name) {
                                                                                        $menu_icon = "<span class='{$menu_icon_name} tutor-dashboard-menu-item-icon'></span>";
                                                                                    }
                                                                                }

                                                                                if (isset($dashboard_page['url'])) {
                                                                                    $menu_link = $dashboard_page['url'];
                                                                                }
                                                                                if (isset($dashboard_page['type']) && $dashboard_page['type'] == 'separator') {
                                                                                    $separator = true;
                                                                                }
                                                                            }
                                                                            if ($separator) {
                                                                                // Optionally, add code to handle separators
                                                                            } else {
                                                                                $li_class = "wprealizer-dashboard-menu-{$dashboard_key}";
                                                                                if ('index' === $dashboard_key) {
                                                                                    $dashboard_key = '';
                                                                                }

                                                                                $data_no_instant = 'logout' == $dashboard_key ? 'data-no-instant' : '';
                                                                                $menu_link = apply_filters('tutor_dashboard_menu_link', $menu_link, $menu_title);
                                                                ?>
                                                                                <?php if ($dashboard_key == 'settings'): ?>
                                                                                    <li class="hr-border"></li>
                                                                                <?php endif; ?>
                                                                                <li class='wprealizer-dashboard-menu-item <?php echo esc_attr($li_class); ?>'>
                                                                                    <a <?php echo esc_html($data_no_instant); ?> href="<?php echo esc_url($menu_link); ?>">
                                                                                        <span>
                                                                                            <?php echo tp_kses($menu_icon); ?>
                                                                                        </span>
                                                                                        <?php echo esc_html($menu_title); ?>
                                                                                    </a>
                                                                                </li>
                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <!-- User is not logged in -->
                                        <div class="wpr-header-inner-login wpr-header-login-guest wpr-header-shop-login wpr-header-user-hover">
                                            <a href="<?php echo esc_url(tutor_utils()->tutor_dashboard_url()); ?>">
                                                <img src="<?php echo esc_url(tutor()->url . 'assets/images/profile-photo.png'); ?>" alt="<?php echo esc_attr__('Login', 'wprealizer') ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="offcanvas-btn d-xxl-none ml-30">
                                    <button class="offcanvas-open-btn"><i class="fa-solid fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
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

$widgets_manager->register(new TP_Header_Ecommerce());
