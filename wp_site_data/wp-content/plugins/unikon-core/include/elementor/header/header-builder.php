<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use WPRCore\Elementor\Controls\Group_Control_WPRGradient;
use \Elementor\Repeater;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Header_01 extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Column_Trait, WPR_Query_Trait;

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
        return 'wpr-header';
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
        return __(WPRCORE_THEME_NAME . ' - Header Builder', 'wprealizer');
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
          'wpr_layout',
          [
            'label' => esc_html__('Design Layout', 'wprealizer'),
          ]
        );

        $this->add_control(
          'wpr_design_style',
          [
            'label' => esc_html__('Select Layout', 'wprealizer'),
            'type' => Controls_Manager::SELECT,
            'options' => [
              'layout-1' => esc_html__('Layout 1', 'wprealizer'),
              'layout-2' => esc_html__('Layout 2', 'wprealizer'),
              'layout-3' => esc_html__('Layout 3', 'wprealizer'),
              'layout-4' => esc_html__('Layout 4', 'wprealizer'),
              'layout-5' => esc_html__('Layout 5', 'wprealizer'),
              'layout-6' => esc_html__('Layout 6', 'wprealizer'),
              'layout-7' => esc_html__('Layout 7', 'wprealizer'),
              'layout-8' => esc_html__('Layout 8', 'wprealizer'),
              'layout-9' => esc_html__('Layout 9', 'wprealizer'),
              'layout-10' => esc_html__('Layout 10', 'wprealizer'),
            ],
            'default' => 'layout-1',
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wpr_header_top',
            [
                'label' => esc_html__('Header Info', 'wprealizer'),
            ]
        );

        $this->add_control(
            'wpr_header_sticky',
            [
                'label' => esc_html__('Enable Sticky', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // _wpr_image
        $this->start_controls_section(
            '_wpr_image',
            [
                'label' => esc_html__('Site Logo', 'wprealizer'),
            ]
        );

        $this->add_control(
            'wpr_logo_black',
            [
                'label' => esc_html__('Choose Black Logo', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_logo_white',
            [
                'label' => esc_html__('Choose White Logo', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_logo_width',
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

        // Header Right
        $this->start_controls_section(
            'wpr_header_right',
            [
                'label' => esc_html__('Header Right', 'wprealizer'),
            ]
        );

        $this->add_control(
            'wpr_header_right_switch',
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
            'wpr_header_search_switch',
            [
                'label' => esc_html__('Header Search Switch', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 0,
            ]
        );

        $this->add_control(
            'wpr_theme_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Lets Talk', 'wprealizer'),
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

        // Offcanvas Controls
        $this->start_controls_section(
            'wpr_offcanvas_section',
            [
                'label' => esc_html__('Offcanvas', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wpr_offcanvas_logo',
            [
                'label' => esc_html__('Choose Logo', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'wpr_offcanvas_logo_size',
                'label' => __('Image Size', 'wprealizer'),
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'offcanvas_description',
            [
                'label' => esc_html__('Offcanvas Description', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'copyright_text',
            [
                'label' => esc_html__('Copyright text', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('@Unikon. Copyright © 2024', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'wpr_offcanvas_type',
            [
                'label' => esc_html__('Select Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'wprealizer'),
                ],
                'default' => 'default',
            ]
        );

        $offcanvas = array(
            'post_type' => 'wpr-offcanvas',
            'posts_per_page' => -1,
        );
        $offcanvas_loop = get_posts($offcanvas);

        $offcanvas_obj = array();
        foreach ($offcanvas_loop as $post) {
            $offcanvas_obj[$post->ID] = $post->post_title;
        }

        $this->add_control(
            'wpr_offcanvas_template',
            [
                'label' => esc_html__('Select Template', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => $offcanvas_obj,
                'default' => 'default',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'wpr_contact_box_section',
            [
                'label' => esc_html__('Contact Repeater', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        tp_render_icon_controls($repeater, 'icon_box', );

        $repeater->add_control(
            'wpr_contact_label',
            [
                'label' => esc_html__('Contact Label', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Contact Label', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'wpr_contact_value',
            [
                'label' => esc_html__('Contact Value', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Contact Value', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'wpr_rep_style_options',
            [
                'label' => esc_html__('Enable Style Option', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'wpr_icon_box_bg',
            [
                'label' => esc_html__('Repeater Title Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .contact-thumb' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
                'condition' => [
                    'wpr_rep_style_options' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'wpr_contact_list',
            [
                'label' => esc_html__('Text List', 'wprealizer'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'wpr_contact_label' => esc_html__('Contact Us 24/7', 'wprealizer'),
                    ],
                    [
                        'wpr_contact_label' => esc_html__('Contact Mail', 'wprealizer'),
                    ],
                    [
                        'wpr_contact_label' => esc_html__('Contact Location', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ wpr_contact_label }}}',
            ]
        );


        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->start_controls_section(
            'wpr_menu_style_section',
            [
                'label' => esc_html__('Mega Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpr_menus_title_typography',
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
            'wpr_menu_title_color',
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
            'wpr_menu_title_hvr_color',
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
            'wpr_main_menu_style_section',
            [
                'label' => esc_html__('Main Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpr_main_menu_title_typography',
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
            'wpr_main_menu_title_color',
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
            'wpr_main_menu_title_hvr_color',
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
            'wpr_mobile_link_menu_style_section',
            [
                'label' => esc_html__('Link Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpr_mobile_link_menu_title_typography',
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
            'wpr_mobile_link_menu_title_color',
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
            'wpr_mobile_link_menu_toggle_color',
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
            'wpr_mobile_link_menu_title_hvr_color',
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
            'wpr_mobile_main_menu_style_section',
            [
                'label' => esc_html__('Mobile Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpr_mobile_main_menu_title_typography',
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
            'wpr_mobile_main_menu_title_color',
            [
                'label' => esc_html__('Menu Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-main-menu-mobile ul li > a' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'wpr_mobile_main_menu_toggle_color',
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
            'wpr_mobile_main_menu_title_hvr_color',
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
            'wpr_mobile_main_menu_toggle_hvr_color',
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
            'wpr_mobile_close_btn_style_section',
            [
                'label' => esc_html__('Close Button', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpr_mobile_close_btn_typography',
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
            'wpr_close_button_menu_title_color',
            [
                'label' => esc_html__('Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas__close-btn' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'wpr_close_button_menu_toggle_color',
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
            'wpr_close_button_menu_title_hvr_color',
            [
                'label' => esc_html__('Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas__close-btn:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'wpr_close_button_menu_title_hvrbg_color',
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

        $thisSettings = $this->get_settings();

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

        $offcanvas_image_size = tp_get_img_size($settings, 'wpr_offcanvas_logo_size');

        if (!empty($settings['wpr_logo_black']['url'])) {
            $logo_black = !empty($settings['wpr_logo_black']['id']) ? wp_get_attachment_image_url($settings['wpr_logo_black']['id'], true) : $settings['wpr_logo_black']['url'];
            $logo_black_alt = get_post_meta($settings["wpr_logo_black"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['wpr_logo_white']['url'])) {
            $logo_white = !empty($settings['wpr_logo_white']['id']) ? wp_get_attachment_image_url($settings['wpr_logo_white']['id'], true) : $settings['wpr_logo_white']['url'];
            $logo_white_alt = get_post_meta($settings["wpr_logo_white"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['wpr_offcanvas_logo']['url'])) {
            $offcanvas_logo = !empty($settings['wpr_offcanvas_logo']['id']) ? wp_get_attachment_image_url($settings['wpr_offcanvas_logo']['id'], true) : $settings['wpr_offcanvas_logo']['url'];
            $offcanvas_logo_alt = get_post_meta($settings["wpr_offcanvas_logo"]["id"], "_wp_attachment_image_alt", true);
        }

        $is_sticky = $settings['wpr_header_sticky'] == 'yes' ? 'sticky' : '';
        $edit_class = tp_is_elementor_edit_mode() ? 'wprealizer-elementor-header-edit-mode' : '';
?>


<?php if ($settings['wpr_design_style'] == 'layout-10') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn outline-white', $this->get_settings());

    ?>

<!-- Header area -->
<header>
    <!-- Menu -->
    <div class="menu-area menu-area--fixed menu-area__showcase">
        <div class="container-fluid">
            <div class="row align-items-center position-relative">
                <div class="col-lg-12 hamburger-menu position-relative">
                    <div class="nav-wrap d-flex justify-content-between align-items-center">
                        <div class="menu-logo-wrap wpr-el-logo">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_white); ?>" alt="<?php echo esc_attr($logo_white_alt); ?>" />
                            </a>
                        </div>
                        <div class="mainmenu text-right">
                            <div class="home-menu">
                                <?php echo $menu_html; ?>
                            </div>
                            <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                        <div class="nav-wrap nav-wrap--extend d-flex justify-content-between align-items-center">
                            <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                <div class="menu-btn-hidden">
                                    <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                    <?php endif; ?>
                                </div>

                                <button class="side-panel__activator">
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu end -->
</header>


<!-- Unikon Header sidebar -->
<?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

<?php elseif ($settings['wpr_design_style'] == 'layout-9') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn__variation10', $this->get_settings());
    ?>

<header>
    <!-- Menu -->
    <div class="menu-area menu-fit <?php echo esc_attr($is_sticky); ?>">
        <div class="container container-fitness">
            <div class="row align-items-center position-relative">
                <div class="col-lg-12 hamburger-menu position-relative">
                    <div class="nav-wrap d-flex justify-content-between align-items-center">
                        <div class="menu-logo-wrap wpr-el-logo">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                            </a>
                        </div>

                        <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                        <div class="nav-wrap nav-wrap--extend d-flex justify-content-between align-items-center">
                            <div class="mainmenu text-right">
                                <div class="home-menu">
                                    <?php echo $menu_html; ?>
                                </div>
                                <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                    <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                <div class="menu-btn-hidden">
                                    <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                    <?php endif; ?>
                                </div>

                                <button class="side-panel__activator">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu end -->
</header>

<!-- Unikon Header sidebar -->
<?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>


<?php elseif ($settings['wpr_design_style'] == 'layout-8') : 

    ?>

<header>
    <!-- Menu -->
    <div class="menu-area menu-area__fin menu-area--fixed-dark <?php echo esc_attr($is_sticky); ?>">
        <div class="container container-2xl">
            <div class="row align-items-center position-relative">
                <div class="col-lg-12 hamburger-menu position-relative">
                    <div class="nav-wrap d-flex justify-content-between align-items-center">
                        <div class="menu-logo-wrap wpr-el-logo">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                            </a>
                        </div>
                        <div class="mainmenu text-right">
                            <div class="home-menu">
                                <?php echo $menu_html; ?>
                            </div>
                            
                            <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                <div class="d-flex justify-content-between"></div>
                            </div>
                        </div>
                        <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                        <div class="nav-wrap nav-wrap--extend d-flex justify-content-between align-items-center">
                            <div class="menu-btn-wrap menu-btn-wrap__desktop gap-4">
                                <?php if (!empty($settings['wpr_header_search_switch'])): ?>
                                <button class="search__btn">
                                    <i class="bi bi-search"></i>
                                </button>
                                <?php endif; ?>

                                <button class="side-panel__activator">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu end -->
</header>

<!-- Unikon Header sidebar -->
<?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>


<?php elseif ($settings['wpr_design_style'] == 'layout-7') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn__variation8', $this->get_settings());
    ?>


<header>
    <!-- Menu -->
    <div class="menu-area health <?php echo esc_attr($is_sticky); ?>">
        <div class="container container-4xl">
            <div class="row align-items-center position-relative">
                <div class="col-lg-12 hamburger-menu position-relative">
                    <div class="nav-wrap d-flex justify-content-between align-items-center">
                        <div class="menu-logo-wrap wpr-el-logo">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                            </a>
                        </div>
                        <div class="mainmenu text-right">
                            <div class="home-menu">
                                <?php echo $menu_html; ?>
                            </div>

                            <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>
                                    <?php echo tp_kses($settings['wpr_theme_btn_text']); ?>
                                    <div class="icon-container">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                        <div class="nav-wrap nav-wrap--extend d-flex justify-content-between align-items-center">
                            <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                <div class="menu-btn-hidden">
                                    <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>
                                        <?php echo tp_kses($settings['wpr_theme_btn_text']); ?>
                                        <div class="icon-container">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </a>
                                    <?php endif; ?>
                                </div>

                                <button class="side-panel__activator">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>

                                <?php if (!empty($settings['wpr_header_search_switch'])): ?>
                                <button class="search__btn search__btn-v2 align-items-center">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu end -->
</header>

<!-- Unikon Header sidebar -->
<?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>


<?php elseif ($settings['wpr_design_style'] == 'layout-6') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn common-btn__variation5', $this->get_settings());
    ?>

<header>
    <!-- Menu -->
    <div class="menu-area menu-area--fixed menu-area--fixed-light <?php echo esc_attr($is_sticky); ?>">
        <div class="container container-4xl">
            <div class="row align-items-center position-relative">
                <div class="col-lg-12 hamburger-menu position-relative">
                    <div class="nav-wrap d-flex justify-content-between align-items-center">
                        <div class="menu-logo-wrap flex-none wpr-el-logo">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                            </a>
                        </div>
                        <div class="mainmenu text-right">
                            <div class="home-menu">
                                <?php echo $menu_html; ?>
                            </div>

                            <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                        <div class="nav-wrap nav-wrap--extend d-flex justify-content-between align-items-center">
                            <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                <div class="menu-btn-hidden">
                                    <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                    <?php endif; ?>
                                </div>

                                <button class="side-panel__activator">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu end -->
</header>

<!-- Unikon Header sidebar -->
<?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

<?php elseif ($settings['wpr_design_style'] == 'layout-5') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn__variation4 common-btn__variation4--extend common-btn__variation4--header', $this->get_settings());
    ?>


<header>
    <!-- Menu -->
    <div class="menu-area menu-area--fixed <?php echo esc_attr($is_sticky); ?>">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-lg-12 hamburger-menu position-relative">
                    <div class="nav-wrap d-flex justify-content-between align-items-center">
                        <div class="menu-logo-wrap wpr-el-logo">
                            <a href="<?php print esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_white); ?>" alt="<?php echo esc_attr($logo_white_alt); ?>" />
                            </a>
                        </div>
                        <div class="mainmenu text-right">
                            <div class="home-menu">
                                <?php echo $menu_html; ?>
                            </div>

                            <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                        <div class="nav-wrap nav-wrap--extend d-flex justify-content-between align-items-center">
                            <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                <div class="menu-btn-hidden">
                                    <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                    <?php endif; ?>
                                </div>

                                <button class="side-panel__activator">
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                    <span class="bg-white"></span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu end -->
</header>


    <!-- Unikon Header sidebar -->
    <?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

<?php elseif ($settings['wpr_design_style'] == 'layout-4') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn__variation2', $this->get_settings());

    ?>

    <header>
        <!-- Menu -->
        <div class="menu-area menu-area__ca <?php echo esc_attr($is_sticky); ?>">
            <div class="container container-4xl border-grid-px">
                <div class="row align-items-center position-relative">
                    <div class="col-lg-12 hamburger-menu position-relative">
                        <div class="nav-wrap d-flex justify-content-between align-items-center">
                            <div class="menu-logo-wrap wpr-el-logo">
                                <a href="<?php print esc_url(home_url('/')); ?>">
                                    <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                                </a>
                            </div>
                            <div class="nav-wrap nav-wrap--extend d-flex justify-content-between align-items-center">
                                <div class="mainmenu text-right">
                                    <div class="home-menu">
                                        <?php echo $menu_html; ?>
                                    </div>
                                    <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                        <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                                <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                    <?php if (!empty($settings['wpr_header_search_switch'])): ?>
                                    <span class="search__btn">
                                        <i class="bi bi-search"></i>
                                        <span><?php echo esc_html__('Search', 'wprealizer'); ?> </span>
                                    </span>
                                    <?php endif; ?>

                                    <div class="menu-btn-hidden">
                                        <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                        <?php endif; ?>
                                    </div>

                                    <button class="side-panel__activator d-lg-none">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button> 
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu end -->
    </header>


        <!-- Unikon Header sidebar -->
        <?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

<?php elseif ($settings['wpr_design_style'] == 'layout-3') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn', $this->get_settings());

    ?>

        <!-- header area start -->
        <header>
            <div id="<?php echo esc_attr($is_sticky); ?>" class="wpr_el_header wpr-header-3 <?php echo esc_attr($edit_class); ?>">
                <!-- Menu -->
                <div class="menu-area">
                    <div class="container container-3xl header-border-bottom">
                        <div class="row align-items-center position-relative">
                            <div class="col-lg-12 hamburger-menu position-relative">
                                <div class="nav-wrap d-flex justify-content-between align-items-center">
                                    <div class="menu-logo-wrap wpr-el-logo">
                                        <a href="<?php print esc_url(home_url('/')); ?>">
                                            <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                                        </a>
                                    </div>

                                    <div class="nav-wrap d-flex justify-content-between align-items-center">
                                        <div class="mainmenu text-right">
                                            <div class="home-menu">
                                                <?php echo $menu_html; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right  -->
                                    <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                                        <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                            <div class="menu-btn-hidden">
                                                <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                                <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                                <?php endif; ?>
                                            </div>

                                            <button class="side-panel__activator d-lg-none">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>  
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu end -->
            </div>
        </header>
        <!-- header area end -->


        <!-- Unikon Header sidebar -->
        <?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

<?php elseif ($settings['wpr_design_style'] == 'layout-2') : 

    $this->tp_link_attributes_render('theme_btn', 'common-btn square-btn', $this->get_settings());

    ?>

        <!-- header-area-start -->
        <header>
            <div id="<?php echo esc_attr($is_sticky); ?>" class="wpr_el_header wpr-header-2 <?php echo esc_attr($edit_class); ?>">
                <!-- Menu -->
                <div class="menu-area">
                    <div class="container container-4xl border-grid-px">
                        <div class="row align-items-center position-relative">
                            <div class="col-lg-12 hamburger-menu position-relative">
                                <div class="nav-wrap d-flex justify-content-between align-items-center">
                                    <!-- Logo -->
                                    <div class="menu-logo-wrap wpr-el-logo">
                                        <a href="<?php print esc_url(home_url('/')); ?>">
                                            <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                                        </a>
                                    </div>


                                    <div class="nav-wrap d-flex justify-content-end align-items-center">
                                        <div class="mainmenu text-right">
                                            <div class="home-menu">
                                                <?php echo $menu_html; ?>
                                            </div>
                                            <div class="menu-btn-wrap menu-btn-wrap__mobile">
                                                <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                                <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Right  -->
                                        <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                                            <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                                <div class="menu-btn-hidden">
                                                    <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                                    <?php endif; ?>
                                                </div>

                                                <button class="side-panel__activator d-lg-none">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu end -->
            </div>
        </header>
        <!-- header-area-end -->

        <!-- Unikon Header sidebar -->
        <?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

    <?php else : 

        $this->tp_link_attributes_render('theme_btn', 'common-btn', $this->get_settings());

        ?>


        <header>
            <!-- Menu -->
            <div class="menu-area menu-area--fixed-light <?php echo esc_attr($is_sticky); ?>">
                <div class="container container-fitness">
                    <div class="row align-items-center position-relative">
                        <div class="col-lg-12 hamburger-menu position-relative">
                            <div class="nav-wrap d-flex justify-content-between align-items-center">
                                <!-- logo -->
                                <div class="menu-logo-wrap flex-none wpr-el-logo">
                                    <!-- Light  -->
                                    <a href="<?php print esc_url(home_url('/')); ?>">
                                        <img src="<?php echo esc_url($logo_black); ?>" alt="<?php echo esc_attr($logo_black_alt); ?>" />
                                    </a>
                                </div>
                                <div class="mainmenu text-right">
                                    <div class="home-menu">
                                        <?php echo $menu_html; ?>
                                    </div>
                                </div>

                                <!-- Right  -->
                                <?php if (!empty($settings['wpr_header_right_switch'])): ?>
                                <div class="nav-wrap d-flex justify-content-end align-items-center">
                                    <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                        <div class="menu-btn-hidden">
                                            <?php if (!empty($settings['wpr_theme_btn_text'])): ?>
                                            <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>><?php echo tp_kses($settings['wpr_theme_btn_text']); ?></a>
                                            <?php endif; ?>
                                        </div>

                                        <button class="side-panel__activator">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menu end -->
        </header>

        <!-- Unikon Header sidebar -->
        <?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

    <?php endif; ?>
<?php

    }
}

$widgets_manager->register(new WPR_Header_01());
