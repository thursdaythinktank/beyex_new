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
class TP_Header_Inner extends Widget_Base
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
        return 'wpr-header-inner';
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
        return __(WPRCORE_THEME_NAME . ' :: Header Inner', 'wprealizer');
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

        // tp_header_sticky
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
                'label' => esc_html__('Enable Header Right?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // tp_header_bar_switch
        $this->add_control(
            'tp_header_bar_switch',
            [
                'label' => esc_html__('Enable Offcanvas?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // tp_header_search_switch
        $this->add_control(
            'tp_header_search_switch',
            [
                'label' => esc_html__('Header Search Switch', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 0,
            ]
        );
        $this->tp_single_icon_control('theme_btn', 'tp_header_search_switch', 'yes');

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

        $this->start_controls_section(
            'tp_offcanvas_section',
            [
                'label' => esc_html__('Offcanvas', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_offcanvas_logo',
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
                'name' => 'tp_offcanvas_logo_size',
                'label' => __('Image Size', 'wprealizer'),
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'tp_offcanvas_type',
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
            'tp_offcanvas_template',
            [
                'label' => esc_html__('Select Template', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => $offcanvas_obj,
                'default' => 'default',
            ]
        );

        $this->end_controls_section();

        $this->tp_link_render_controls('header_btn', 'Button');

        $this->tp_query_controls('course_card', 'Course Controls', 'courses', 'course-category');

        // columns
        $this->tp_columns('course_card_col');
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

        $btn_id = 'theme_btn';
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


        $is_sticky = $settings['tp_header_sticky'] == 'yes' ? 'header-sticky' : 'no-sticky';

        $this->tp_link_attributes_render('header_btn', 'tp-btn-3 tp-el-header-btn', $this->get_settings());

?>

        <!-- header-area-start -->
        <header class="header-area p-relative">
            <div id="<?php echo esc_attr($is_sticky); ?>" class="wpr-header-inner <?php echo esc_attr($edit_class); ?>">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-2 col-xl-2 col-6">
                            <div class="wpr-header-logo wpr-el-logo">
                                <a href="<?php print esc_url(home_url('/')); ?>">
                                    <img src="<?php echo esc_url($logo_black); ?>"
                                        alt="<?php echo esc_attr($logo_black_alt); ?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-xxl-7 col-xl-7 d-none d-xl-block">
                            <div class="main-menu text-xl-center">
                                <nav class="tp-main-menu-content">
                                    <?php echo $menu_html; ?>
                                </nav>
                            </div>
                        </div>

                        <?php if ($settings['tp_header_right_switch'] == 'yes'): ?>
                            <div class="col-xxl-3 col-xl-3 col-6">
                                <div class="wpr-header-contact d-flex align-items-center justify-content-end">

                                    <?php if (!empty($settings['tp_header_search_switch'])): ?>
                                        <div class="wpr-header-red-search d-none d-md-block">
                                            <button class="tp-search-open-btn">
                                                <?php tp_render_signle_icon_html($settings, 'theme_btn', ''); ?>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                                        <div class="wpr-header-inner-btn d-none d-md-block">
                                            <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>><?php echo $settings['tp_' . $control_id . '_text']; ?></a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($settings['tp_header_bar_switch'] == 'yes'): ?>
                                        <div class="wpr-header-red-sidebar">
                                            <button class="offcanvas-open-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="14" viewBox="0 0 30 14"
                                                    fill="none">
                                                    <rect y="6" width="30" height="2" fill="currentColor" />
                                                    <rect class="width" width="20" height="2" fill="currentColor" />
                                                    <rect class="width" y="12" width="14" height="2" fill="currentColor" />
                                                </svg>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
        <!-- header-area-end -->


        <?php include(WPRCORE_ELEMENTS_PATH . '/header/header-offcanvas.php'); ?>
        <?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-side-1.php'); ?>

<?php

    }
}

$widgets_manager->register(new TP_Header_Inner());
