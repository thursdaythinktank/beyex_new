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
class WPR_Header_03 extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait, WPR_Column_Trait, WPR_Query_Trait;

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
        return 'wpr-header-03';
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
        return __(WPRCORE_THEME_NAME . ' - Header 3', 'wprealizer');
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
                'default' => 'no',
            ]
        );

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

        $this->end_controls_section();


        // Header Right
        // $this->start_controls_section(
        //     'tp_header_right',
        //     [
        //         'label' => esc_html__('Header Right', 'wprealizer'),
        //     ]
        // );

        // // header_search_switch
        // $this->add_control(
        //     'tp_header_search_switch',
        //     [
        //         'label' => esc_html__('Header Search Switch', 'wprealizer'),
        //         'type' => Controls_Manager::SWITCHER,
        //         'label_on' => esc_html__('Show', 'wprealizer'),
        //         'label_off' => esc_html__('Hide', 'wprealizer'),
        //         'return_value' => 'yes',
        //         'default' => 0,
        //     ]
        // );

        // $this->tp_single_icon_control('theme_btn', 'tp_header_search_switch', 'yes');

        // $this->end_controls_section();


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

        // header button controls
        $this->tp_link_render_controls('header_btn', 'Button');

        // columns
        $this->tp_columns('course_card_col');

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

        $this->tp_link_controls_style('', 'btn2_style', 'Button', '.tp-el-btn2');


        $this->start_controls_section(
            'tp_menu_style_section',
            [
                'label' => esc_html__('Mega Menu', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_menuss_title_typography',
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
        // $logo_image_size = tp_get_img_size($settings, 'tp_image_size');

        if (!empty($settings['tp_logo_black']['url'])) {
            $logo_black = !empty($settings['tp_logo_black']['id']) ? wp_get_attachment_image_url($settings['tp_logo_black']['id'], true) : $settings['tp_logo_black']['url'];
            $logo_black_alt = get_post_meta($settings["tp_logo_black"]["id"], "_wp_attachment_image_alt", true);
        }

        $is_sticky = $settings['tp_header_sticky'] == 'yes' ? 'header-sticky' : 'no-sticky';

        $edit_class = tp_is_elementor_edit_mode() ? 'wprealizer-elementor-header-edit-mode' : '';

        $this->tp_link_attributes_render('header_btn', 'tp-btn-inner tp-el-btn2 common-btn', $this->get_settings());

?>

        <!-- header area start -->
        <header>
            <div id="<?php echo esc_attr($is_sticky); ?>" class="tp_el_header wpr-header-3 <?php echo esc_attr($edit_class); ?>">
                <!-- Menu -->
                <div class="menu-area">
                    <div class="container container-3xl header-border-bottom">
                        <div class="row align-items-center position-relative">
                            <div class="col-lg-12 hamburger-menu position-relative">
                                <div class="nav-wrap d-flex justify-content-between align-items-center">

                                    <div class="menu-logo-wrap">
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
                                    <?php if (!empty($settings['tp_header_right_switch'])): ?>
                                        <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                            <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                                <div class="menu-btn-hidden">
                                                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                                        <?php echo $settings['tp_' . $control_id . '_text']; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
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

        <!-- header-area-start -->
        <header>
            <div id="<?php echo esc_attr($is_sticky); ?>" class="tp_el_header wpr-header-2 d-none <?php echo esc_attr($edit_class); ?>">
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
                                                <a class="common-btn square-btn" href="contact.html">Contact Us</a>
                                            </div>
                                        </div>

                                        <!-- Right  -->
                                        <?php if (!empty($settings['tp_header_right_switch'])): ?>
                                            <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                                <div class="menu-btn-wrap menu-btn-wrap__desktop">
                                                    <div class="menu-btn-hidden">
                                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                                                            <?php echo $settings['tp_' . $control_id . '_text']; ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
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


        <?php include(WPRCORE_ELEMENTS_PATH . '/header/header-offcanvas.php'); ?>

<?php
    }
}

$widgets_manager->register(new WPR_Header_03());
