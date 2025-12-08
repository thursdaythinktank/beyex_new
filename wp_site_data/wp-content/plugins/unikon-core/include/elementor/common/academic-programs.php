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
class TP_Academic_Programs extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait, WPR_Animation_Trait;

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
        return 'tp-academic-programs';
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
        return __(WPRCORE_THEME_NAME . ' :: Academic Programs', 'wprealizer');
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

        $this->wpr_design_layout('Select Layout', 3);

        $this->start_controls_section(
            'tp_list_sec',
            [
                'label' => esc_html__('List Items', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_slider_dots_enable',
            [
                'label' => esc_html__('Enable Dots Navigation?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'navigation_arrow_swich',
            [
                'label' => esc_html__('Enable Arrow Navigation?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => 'layout-2'
                ]
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'wprealizer'),
                    'style_2' => __('Style 2', 'wprealizer'),
                    'style_3' => __('Style 3', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'tp_text_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tp Slide Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'wprealizer'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'wprealizer'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'wprealizer'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'wprealizer'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'wprealizer'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'wprealizer'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $repeater->add_control(
            'tp_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is description text here.', 'wprealizer'),
                'placeholder' => esc_html__('Type section description here', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_3'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_tag_name',
            [
                'label' => esc_html__('Tag Name', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('This is Tag text here.', 'wprealizer'),
                'placeholder' => esc_html__('Type section Tag here', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition!' => 'style_3',
                ]
            ]
        );

        $repeater->add_control(
            'tp_tag_icon_type',
            [
                'label' => esc_html__('Tag Icon Type', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'wprealizer'),
                        'icon' => 'eicon-nerd-wink',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'wprealizer'),
                        'icon' => 'fa fa-image',
                    ],
                    'svg' => [
                        'title' => esc_html__('Svg', 'wprealizer'),
                        'icon' => 'fas fa-code',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
                'condition' => [
                    'repeater_condition' => 'style_1',
                ]

            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_tag_icon_type' => 'image',
                    'repeater_condition' => 'style_1',
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',

                ],
                'condition' => [
                    'tp_tag_icon_type' => 'icon',
                    'repeater_condition' => 'style_1',
                ]
            ]
        );

        $repeater->add_control(
            'svg',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __('Svg Code', 'wprealizer'),
                'default' => __('Svg Code Here', 'wprealizer'),
                'placeholder' => __('Type Svg Code here', 'wprealizer'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tp_tag_icon_type' => 'svg',
                    'repeater_condition' => 'style_1',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'wprealizer'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'wprealizer'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'wprealizer'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .tp-align' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'tp_age',
            [
                'label' => esc_html__('Age', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('4 age', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_time',
            [
                'label' => esc_html__('Time', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('9 am - 5 pm', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_size',
            [
                'label' => esc_html__('Size', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('10 Seats', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3'],
                ]
            ]
        );

        // button
        $repeater->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'tp_btn_title',
            [
                'label' => esc_html__('Button Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tp Button Title', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes',
                    'repeater_condition' => ['style_1', 'style_3'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_button_icon_type',
            [
                'label' => esc_html__('Icon Type', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'btn_icon' => [
                        'title' => esc_html__('Icon', 'wprealizer'),
                        'icon' => 'eicon-nerd-wink',
                    ],
                    'btn_image' => [
                        'title' => esc_html__('Image', 'wprealizer'),
                        'icon' => 'fa fa-image',
                    ],
                    'btn_svg' => [
                        'title' => esc_html__('Svg', 'wprealizer'),
                        'icon' => 'fas fa-code',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes',
                    'repeater_condition' => 'style_2',
                ]
            ]
        );

        $repeater->add_control(
            'btn_image',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_button_icon_type' => 'btn_image',
                    'tp_btn_button_show' => 'yes',
                    'repeater_condition' => 'style_2',
                ],
            ]
        );

        $repeater->add_control(
            'btn_icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',

                ],
                'condition' => [
                    'tp_button_icon_type' => 'btn_icon',
                    'tp_btn_button_show' => 'yes',
                    'repeater_condition' => 'style_2',
                ]
            ]
        );

        $repeater->add_control(
            'btn_svg',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __('Svg Code', 'wprealizer'),
                'default' => __('Svg Code Here', 'wprealizer'),
                'placeholder' => __('Type Svg Code here', 'wprealizer'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tp_button_icon_type' => 'btn_svg',
                    'tp_btn_button_show' => 'yes',
                    'repeater_condition' => 'style_2',
                ],
            ]
        );

        $repeater->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Link Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('link', 'wprealizer'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'wprealizer'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Page', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tp_slider_list',
            [
                'label' => esc_html__('Text List', 'wprealizer'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_text_title' => esc_html__('Art Direction', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Branding', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Content Production', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Animation', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ tp_text_title }}}',
            ]
        );

        $this->end_controls_section();

        // animation
        $this->tp_creative_animation();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('title_style', 'Title', '.tp-el-academic-title');
        $this->tp_basic_style_controls('content_style', 'Description', '.tp-el-academic-content');
        $this->tp_basic_style_controls('tag_style', 'Tag', '.tp-el-academic-tag', ['layout-1', 'layout-2']);
        $this->tp_link_controls_style('layout-1', 'academic_btn', 'Button', '.tp-el-academic-btn');

        $this->tp_basic_style_controls('meta_title', 'Meta Title', '.tp-el-meta span');
        $this->tp_basic_style_controls('meta_content', 'Meta Content', '.tp-el-meta p');

        // Arrow Style
        $this->start_controls_section(
            '_section_style_arrow',
            [
                'label' => __('Arrow Style', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation_arrow_swich' => 'yes',
                    'wpr_design_style' => 'layout-2'
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_arrow_margin',
            [
                'label' => __('Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .el-nav-arrow-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'selector' => '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow',
            ]
        );

        $this->add_control(
            'arrow_width',
            [
                'label' => esc_html__('Width', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_height',
            [
                'label' => esc_html__('Height', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __('Border Radius', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_arrow');

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'wprealizer'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .slick-arrow::after, {{WRAPPER}} .el-nav-arrow',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'wprealizer'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Text Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover, {{WRAPPER}} .el-nav-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_hover_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .slick-arrow:hover::after, {{WRAPPER}} .el-nav-arrow:hover',
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label' => __('Border Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .el-nav-arrow:hover' => 'border-color: {{VALUE}};',
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
?>

        <?php if ($settings['wpr_design_style'] == 'layout-3'):
            $animation = $this->tp_animation_show($settings);

            $attrs = [
                'class' => "row " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
        ?>

            <div <?php echo tp_implode_html_attributes($attrs) ?>>

                <?php foreach ($settings['tp_slider_list'] as $key => $item):
                    $this->add_render_attribute('title_args', 'class', 'tp-program-3-title tp-el-academic-title');
                    $img = tp_get_img($item, 'tp_slider_image', 'tp_image');

                    $attrs = tp_get_repeater_links_attr($item, 'btn');
                    extract($attrs);

                    $links_attrs = [
                        'href' => $link,
                        'target' => $target,
                        'rel' => $rel,
                    ];

                ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="tp-program-3-item mb-40">

                            <?php if (!empty($img['tp_slider_image'])): ?>
                                <div class="tp-program-3-thumb">
                                    <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                        <img src="<?php echo esc_url($img['tp_slider_image']); ?>" alt="<?php the_title(); ?>">
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="tp-program-3-content">

                                <?php
                                if (!empty($item['tp_text_title'])):
                                    printf(
                                        '<%1$s %2$s><a %4$s>%3$s</a></%1$s>',
                                        tag_escape($item['tp_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        tp_kses($item['tp_text_title']),
                                        tp_implode_html_attributes($links_attrs),
                                    );
                                endif;
                                ?>

                                <?php if (!empty($item['tp_description'])): ?>
                                    <p class="tp-el-academic-content">
                                        <?php echo tp_kses($item['tp_description']); ?>
                                    </p>
                                <?php endif; ?>

                                <div class="tp-program-3-schedule d-flex align-items-center">

                                    <?php if (!empty($item['tp_age'])): ?>
                                        <div class="tp-program-3-schedule-item tp-el-meta">
                                            <?php echo tp_kses($item['tp_age']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="tp-program-3-schedule-item tp-el-meta">
                                        <?php if (!empty($item['tp_time'])): ?>
                                            <?php echo tp_kses($item['tp_time']); ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($item['tp_size'])): ?>
                                        <div class="tp-program-3-schedule-item tp-el-meta">
                                            <?php echo tp_kses($item['tp_size']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($item['tp_btn_button_show'])): ?>
                                    <div class="tp-program-3-btn">
                                        <a class="tp-el-academic-btn" <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                            <?php echo tp_kses($item['tp_btn_title']); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-2'):
            $animation = $this->tp_animation_show($settings);

            $attrs = [
                'class' => "swiper " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
        ?>

            <?php if (!empty($settings['navigation_arrow_swich'])): ?>
                <div class="tp-program-4-arrow text-start text-lg-end mb-60 el-nav-arrow-item">
                    <div class="tp-program-4-prev">
                        <span class="el-nav-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none">
                                <path d="M6 11L1 6L6 1" stroke="currentColor" stroke-opacity="0.3" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <div class="tp-program-4-next">
                        <span class="el-nav-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none">
                                <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-opacity="0.3" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <div <?php echo tp_implode_html_attributes($attrs); ?>>
                <div class="tp-program-4-active">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['tp_slider_list'] as $key => $item):
                            $this->add_render_attribute('title_args', 'class', 'tp-program-4-title tp-el-academic-title');
                            $img = tp_get_img($item, 'tp_slider_image', 'tp_image');

                            // Link                            
                            if ('2' == $item['tp_btn_link_type']) {
                                $this->add_render_attribute('tp-button-arg' . $item['_id'], 'href', get_permalink($item['tp_btn_page_link']));
                                $this->add_render_attribute('tp-button-arg' . $item['_id'], 'target', '_self');
                                $this->add_render_attribute('tp-button-arg' . $item['_id'], 'rel', 'nofollow');
                            } else {
                                if (!empty($item['tp_btn_link']['url'])) {
                                    $this->add_link_attributes('tp-button-arg' . $item['_id'], $item['tp_btn_link']);
                                }
                            }
                        ?>
                            <div class="swiper-slide tp-program-4-item">

                                <?php if (!empty($img['tp_slider_image'])): ?>
                                    <div class="tp-program-4-thumb">
                                        <img src="<?php echo esc_url($img['tp_slider_image']) ?>"
                                            alt="<?php echo esc_url($img['tp_slider_image_alt']) ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="tp-program-4-content tp-align">
                                    <?php
                                    if (!empty($item['tp_text_title'])):
                                        printf(
                                            '<%1$s %2$s><a %4$s>%3$s</a></%1$s>',
                                            tag_escape($item['tp_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_text_title']),
                                            $this->get_render_attribute_string('tp-button-arg' . $item['_id'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($item['tp_tag_name'])): ?>
                                        <span class="tp-el-academic-content">
                                            <?php echo tp_kses($item['tp_tag_name']); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if (!empty($item['tp_btn_button_show'])): ?>
                                        <div class="tp-program-4-btn">
                                            <a class="tp-btn-icon" <?php echo $this->get_render_attribute_string('tp-button-arg' . $item['_id']); ?>>
                                                <span>
                                                    <?php if ($item['tp_button_icon_type'] === 'btn_image' && ($item['btn_image']['url'] || $item['btn_image']['id'])):
                                                        $this->get_render_attribute_string('btn_image');
                                                        $item['hover_animation'] = 'disable-animation';
                                                    ?>
                                                        <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'btn_image'); ?>
                                                    <?php elseif (!empty($item['btn_icon'])): ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($item['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    <?php elseif (!empty($item['btn_svg'])): ?>
                                                        <?php echo $item['btn_svg']; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        <?php else:
            $animation = $this->tp_animation_show($settings);
            $attrs = [
                'class' => "row " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
        ?>

            <div <?php echo tp_implode_html_attributes($attrs); ?>>

                <div class="col-lg-12">
                    <div class="swiper tp-program-active tp-align">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['tp_slider_list'] as $key => $item):
                                $this->add_render_attribute('title_args', 'class', 'tp-program-title tp-el-academic-title');

                                // thumbnail 
                                if (!empty($item['tp_slider_image']['url'])) {
                                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url($item['tp_slider_image']['id'], 'full') . '' : $item['tp_slider_image']['url'];
                                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                }

                                // Link                            
                                if ('2' == $item['tp_btn_link_type']) {
                                    $this->add_render_attribute('tp-button-arg' . $item['_id'], 'href', get_permalink($item['tp_btn_page_link']));
                                    $this->add_render_attribute('tp-button-arg' . $item['_id'], 'target', '_self');
                                    $this->add_render_attribute('tp-button-arg' . $item['_id'], 'rel', 'nofollow');
                                } else {
                                    if (!empty($item['tp_btn_link']['url'])) {
                                        $this->add_link_attributes('tp-button-arg' . $item['_id'], $item['tp_btn_link']);
                                    }
                                }

                            ?>
                                <div class="swiper-slide tp-program-item grey-bg mb-50 tp-el-section">

                                    <?php if (!empty($item['tp_slider_image']['url'])): ?>
                                        <div class="tp-program-thumb fix">
                                            <img src="<?php echo esc_url($tp_slider_image_url); ?>"
                                                alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div class="tp-program-content">
                                        <?php
                                        if (!empty($item['tp_text_title'])):
                                            printf(
                                                '<%1$s %2$s><a %4$s>%3$s</a></%1$s>',
                                                tag_escape($item['tp_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($item['tp_text_title']),
                                                $this->get_render_attribute_string('tp-button-arg' . $item['_id'])
                                            );
                                        endif;
                                        ?>

                                        <?php if (!empty($item['tp_description'])): ?>
                                            <p class="tp-el-academic-content">
                                                <?php echo tp_kses($item['tp_description']); ?>
                                            </p>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tp_tag_name'])): ?>
                                            <div class="tp-program-tag">
                                                <p class="tp-el-academic-tag">
                                                    <span>
                                                        <?php if ($item['tp_tag_icon_type'] === 'image' && ($item['image']['url'] || $item['image']['id'])):
                                                            $this->get_render_attribute_string('image');
                                                            $item['hover_animation'] = 'disable-animation';
                                                        ?>
                                                            <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'image'); ?>
                                                        <?php elseif (!empty($item['icon'])): ?>
                                                            <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                                        <?php elseif (!empty($item['svg'])): ?>
                                                            <?php echo $item['svg']; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                    <?php echo tp_kses($item['tp_tag_name']); ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($item['tp_btn_button_show'])): ?>
                                        <div class="tp-program-btn">
                                            <a class="tp-el-academic-btn" <?php echo $this->get_render_attribute_string('tp-button-arg' . $item['_id']); ?>>
                                                <?php echo tp_kses($item['tp_btn_title']); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($settings['tp_slider_dots_enable'])): ?>
                    <div class="col-12">
                        <div class="tp-program-dot text-center"></div>
                    </div>
                <?php endif; ?>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new TP_Academic_Programs());
