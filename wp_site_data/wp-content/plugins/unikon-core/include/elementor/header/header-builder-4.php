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
class WPR_Header_04 extends Widget_Base
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
        return 'wpr-header-04';
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
        return __(WPRCORE_THEME_NAME . ' :: Header 4', 'wprealizer');
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
                'default' => 'no',
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
                'label' => esc_html__('Header Sidebar Switch', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 0,
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
                'label' => esc_html__('Choose Logo Black', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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

        // Header Right
        $this->start_controls_section(
            'wpr_header_right',
            [
                'label' => esc_html__('Header Right', 'wprealizer'),
            ]
        );

        $this->tp_single_icon_control('theme_btn', 'wpr_header_search_switch', 'yes');

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
                'name' => 'wpr_menu_title_typography',
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


        if (!empty($settings['wpr_logo_black']['url'])) {
            $logo_black = !empty($settings['wpr_logo_black']['id']) ? wp_get_attachment_image_url($settings['wpr_logo_black']['id'], true) : $settings['wpr_logo_black']['url'];
            $logo_black_alt = get_post_meta($settings["wpr_logo_black"]["id"], "_wp_attachment_image_alt", true);
        }

        $is_sticky = $settings['wpr_header_sticky'] == 'yes' ? 'sticky' : 'no-sticky';

        $edit_class = tp_is_elementor_edit_mode() ? 'wprealizer-elementor-header-edit-mode ' : '';

        $this->tp_link_attributes_render('theme_btn', 'common-btn__variation2', $this->get_settings());
?>

<header>
    <!-- Menu -->
    <div class="menu-area menu-area__ca border-grid-lr <?php echo esc_attr($is_sticky); ?>">
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
                                    <a class="common-btn__variation2" href="contact.html">
                                        Free Consultation
                                    </a>
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


        <?php include(WPRCORE_ELEMENTS_PATH . '/header/header-offcanvas.php'); ?>


<?php

    }
}

$widgets_manager->register(new WPR_Header_04());
