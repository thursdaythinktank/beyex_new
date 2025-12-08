<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
class TP_Breadcrumb extends Widget_Base
{

    use WPR_Style_Trait;

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
        return 'wpr-breadcrumb';
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
        return __(WPRCORE_THEME_NAME . ' :: Breadcrumb', 'wprealizer');
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

        $this->wpr_design_layout('Select Layout', 1);

        $this->start_controls_section(
            'section_breadcrumb_settings',
            [
                'label' => esc_html__('Settings', 'wprealizer'),
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label' => esc_html__('Show Nav', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'wprealizer'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'wprealizer'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'wprealizer'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'wprealizer'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'wprealizer'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'wprealizer'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h1',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'nav_pos',
            [
                'label' => __('Nav Postion', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('Default', 'wprealizer'),
                    'd-flex flex-column' => __('Top', 'wprealizer'),
                    'd-flex flex-column-reverse' => __('Bottom', 'wprealizer'),
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_wprealizer_breadcrumb_align',
            [
                'label' => esc_html__('Alignment', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'wprealizer'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'wprealizer'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'wprealizer'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'start',
                'selectors' => [
                    '{{WRAPPER}} .tpcore-page-header' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Breadcrumb', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title
        $this->add_control(
            '_breadcrumb_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'wprealizer'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'breadcrumb_title_spacing',
            [
                'label' => __('Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tpcore-el-page-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpcore-el-page-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'breadcrumb-title',
                'selector' => '{{WRAPPER}} .tpcore-el-page-title',
            ]
        );

        $this->add_control(
            'tp_icon_color',
            [
                'label' => esc_html__('Icon Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpcore-el-icon-color path' => 'fill: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tp_breadcrumb_nav_color',
            [
                'label' => esc_html__('Nav Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tpcore-el-breadcrumb-nav' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_breadcrumb_nav',
                'selector' => '{{WRAPPER}} .tpcore-el-breadcrumb-nav',
            ]
        );

        $this->add_control(
            'breadcrumb_nav_spacing',
            [
                'label' => __('Nav Spacing', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tpcore-el-breadcrumb-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tp_icon_bar_color',
            [
                'label' => esc_html__('Icon Bar Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpcore-el-icon-color:after' => 'background: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

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
        $title_tag = $settings['title_tag'];
        $nav_pos = $settings['nav_pos'];

        global $post, $wp;
        $breadcrumb_show = 1;

        $current_slug = add_query_arg(array(), $wp->request);

        if (is_front_page() && is_home()) {
            $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'wprealizer'));
            $breadcrumb_class = 'home_front_page';
        } elseif (is_front_page()) {
            $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'wprealizer'));
            $breadcrumb_show = 0;
        } elseif (is_home()) {
            if (get_option('page_for_posts')) {
                $title = get_the_title(get_option('page_for_posts'));
            }
        } elseif (is_single() && 'post' == get_post_type()) {
            $title = get_the_title();
        } elseif ('courses' == get_post_type()) {
            $title = esc_html__('All Courses', 'wprealizer');
        } elseif (is_single() && 'product' == get_post_type()) {
            $title = get_theme_mod('breadcrumb_product_details', __('Shop', 'wprealizer'));
        } elseif (is_single() && 'courses' == get_post_type()) {
            $title = esc_html__('Course Details', 'wprealizer');
        } elseif (is_search()) {
            $title = esc_html__('Search Results for : ', 'wprealizer') . get_search_query();
        } elseif (is_404()) {
            $title = esc_html__('Page not Found', 'wprealizer');
        } elseif (is_archive()) {
            $title = get_the_archive_title();
        } else {
            $title = $title = get_dashboard_title($current_slug);
        }


        $_id = get_the_ID() ?? NULL;

        if (is_single() && 'product' == get_post_type()) {
            $_id = $post->ID;
        } elseif (function_exists("is_shop") and is_shop()) {
            $_id = wc_get_page_id('shop');
        } elseif (is_home() && get_option('page_for_posts')) {
            $_id = get_option('page_for_posts');
        }
?>


        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>


        <?php else:
            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'tp-breadcrumb__title white tpcore-el-page-title');
        ?>

            <div class="default-breadcrumb">

                <div class="tp-breadcrumb__content <?php echo esc_attr($nav_pos); ?> tpcore-page-header">
                    <?php if (!empty($settings['show_nav'])): ?>
                        <div class="tp-breadcrumb__list">
                            <span class="tpcore-el-icon-color">
                                <a href="<?php echo get_home_url(); ?>">
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z"
                                            fill="currentColor">
                                        </path>
                                    </svg>
                                </a>
                            </span>
                            <span class="color tpcore-el-breadcrumb-nav">
                                <?php echo tp_kses($title); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['show_title'])): ?>
                        <?php printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            $title
                        ); ?>
                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Breadcrumb());
