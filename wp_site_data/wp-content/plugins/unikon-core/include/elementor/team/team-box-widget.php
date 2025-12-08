<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Team extends Widget_Base
{

    use WPR_Style_Trait, WPR_Column_Trait, WPR_Animation_Trait;

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
        return 'wpr-team';
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
        return __(WPRCORE_THEME_NAME . ' :: Team', 'wprcore');
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
        return ['wprcore'];
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
        return ['wprcore'];
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __('Members', 'wprcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'navigation_arrow_swich',
            [
                'label' => esc_html__('Enable Navigation Arrow ?', 'wprcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprcore'),
                'label_off' => esc_html__('Hide', 'wprcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'wprcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'wprcore'),
                    'style_2' => __('Style 2', 'wprcore'),
                    'style_3' => __('Style 3', 'wprcore'),
                    'style_4' => __('Style 4', 'wprcore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __('Information', 'wprcore'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'wprcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'bg_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('BG Image', 'wprcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => ['style_3']
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'wprcore'),
                'default' => __('WPR Member Name', 'wprcore'),
                'placeholder' => __('Type title here', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __('Job Title', 'wprcore'),
                'default' => __('TP Officer', 'wprcore'),
                'placeholder' => __('Type designation here', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'wpr_title_link_type',
            [
                'label' => esc_html__('Title Link Type', 'wprcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
            ]
        );

        $repeater->add_control(
            'wpr_title_custome_link',
            [
                'label' => esc_html__('Custome Url', 'wprcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'wprcore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'wpr_title_link_type' => '1',
                ]
            ]
        );
        $repeater->add_control(
            'wpr_title_page_link',
            [
                'label' => esc_html__('Internal Page', 'wprcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'wpr_title_link_type' => '2',
                ]
            ]
        );

        $repeater->add_control(
            'content',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'label' => __('Content', 'wprcore'),
                'default' => __(' A graduate of Harvard Law School, he is renowned for  his meticulous approach and unwavering dedication.', 'wprcore'),
                'placeholder' => __('Type designation here', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => ['style_3']
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'single_service_icon_bgcolor',
                'label' => esc_html__('Background Color', 'wprcore'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .wpr-el-team-bg-color',
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __('Links', 'wprcore'),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __('Show Social Links?', 'wprcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'wprcore'),
                'label_off' => __('No', 'wprcore'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Website Address', 'wprcore'),
                'placeholder' => __('Add your profile link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Email', 'wprcore'),
                'placeholder' => __('Add your email link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Phone', 'wprcore'),
                'placeholder' => __('Add your phone link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Facebook', 'wprcore'),
                'default' => __('#', 'wprcore'),
                'placeholder' => __('Add your facebook link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Twitter', 'wprcore'),
                'default' => __('#', 'wprcore'),
                'placeholder' => __('Add your twitter link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Instagram', 'wprcore'),
                'default' => __('#', 'wprcore'),
                'placeholder' => __('Add your instagram link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('LinkedIn', 'wprcore'),
                'placeholder' => __('Add your linkedin link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Youtube', 'wprcore'),
                'placeholder' => __('Add your youtube link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Google Plus', 'wprcore'),
                'placeholder' => __('Add your Google Plus link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Flickr', 'wprcore'),
                'placeholder' => __('Add your flickr link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Vimeo', 'wprcore'),
                'placeholder' => __('Add your vimeo link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Behance', 'wprcore'),
                'placeholder' => __('Add your hehance link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Dribbble', 'wprcore'),
                'placeholder' => __('Add your dribbble link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Pinterest', 'wprcore'),
                'placeholder' => __('Add your pinterest link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Github', 'wprcore'),
                'placeholder' => __('Add your github link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'wpr_title_tag',
            [
                'label' => __('Title HTML Tag', 'wprcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'wprcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'wprcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'wprcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'wprcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'wprcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'wprcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'wprcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'wprcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'wprcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'wprcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // colum controls
        $this->tp_columns('col', 'layout-2');

        // animation
        $this->tp_creative_animation('');
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('team_section', 'Section - Style', '.wpr-el-section');
        $this->tp_basic_style_controls('team_name', 'Member Name', '.wpr-el-team-name');
        $this->tp_basic_style_controls('team_designation', 'Member Designation', '.wpr-el-team-desi');
        $this->tp_basic_style_controls('team_content', 'Member Content', '.wpr-el-team-content');
        $this->tp_link_controls_style('', 'team_social', 'Member Social Icon', '.wpr-el-team-social');


        $this->start_controls_section(
            '_section_style_arrow',
            [
                'label' => __('Arrow Style', 'wprcore'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation_arrow_swich' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'wpr_arrow_margin',
            [
                'label' => __('Margin', 'wprcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-nav-arrow-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );


        $this->add_control(
            'arrow_width',
            [
                'label' => esc_html__('Width', 'wprcore'),
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
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .wpr-el-nav-arrow' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_height',
            [
                'label' => esc_html__('Height', 'wprcore'),
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
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .wpr-el-nav-arrow' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __('Border Radius', 'wprcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .wpr-el-nav-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_arrow');

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'wprcore'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Color', 'wprcore'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .wpr-el-nav-arrow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .slick-arrow::after, {{WRAPPER}} .wpr-el-nav-arrow',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'wprcore'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Text Color', 'wprcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:hover, {{WRAPPER}} .wpr-el-nav-arrow:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_hover_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .slick-arrow:hover::after, {{WRAPPER}} .wpr-el-nav-arrow:hover',
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label' => __('Border Color', 'wprcore'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow, {{WRAPPER}} .wpr-el-nav-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'wpr_team-img_section',
            [
                'label' => esc_html__('Team Image Style', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_team-img_w',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Width', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-team-img img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpr_team-img_h',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Height', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-team-img img' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_image_object_style',
            [
                'label' => esc_html__('Object Fit', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'none' => esc_html__('None', 'wprealizer'),
                    'contain'  => esc_html__('Contain', 'wprealizer'),
                    'cover' => esc_html__('Cover', 'wprealizer'),
                    'fill' => esc_html__('fill', 'wprealizer'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-team-img img' => 'object-fit: {{VALUE}};',
                ],
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

        ?>

        <?php if ($settings['wpr_design_style'] === 'layout-2'):
            $animation = $this->tp_animation_show($settings);
            $attrs = [
                'class' => "row gy-5 g-xxl-5" . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
            ?>

<div <?php echo tp_implode_html_attributes($attrs); ?>>
    <?php foreach ($settings['teams'] as $key => $item):

        $title = tp_kses($item['title']);
        $key = $key + 1;

        // Handle image URL and alt text
        if (!empty($item['image']['url'])) {
            $wpr_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
            $wpr_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
        }

        // Reset render attributes for each iteration
        $this->add_render_attribute('title_args', 'class', 'h6 wpr-el-team-name');

        // Determine link details
        if ('2' == $item['wpr_title_link_type']) {
            $link = get_permalink($item['wpr_title_page_link']);
            $target = '_self';
            $rel = 'nofollow';
        } else {
            $link = !empty($item['wpr_title_custome_link']['url']) ? $item['wpr_title_custome_link']['url'] : '';
            $target = !empty($item['wpr_title_custome_link']['is_external']) ? '_blank' : '';
            $rel = !empty($item['wpr_title_custome_link']['nofollow']) ? 'nofollow' : '';
        }
    ?>
    <div class="<?php echo esc_attr($this->col_show($settings)); ?> fade_up_anim elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
        <div class="team__card">
            <div class="team__card-thumb wpr-el-team-img">
                <?php if (!empty($wpr_team_image_url)): ?>
                <img src="<?php echo esc_url($wpr_team_image_url); ?>" alt="<?php echo esc_attr($wpr_team_image_alt); ?>">
                <?php endif; ?>

                <?php if (!empty($item['show_social'])): ?>
                <ul class="custom-ul social-link">
                    <?php if (!empty($item['web_title'])): ?>
                    <li>   
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['web_title']); ?>">
                            <i class="fas fa-globe"></i>
                        </a>
                    </li> 
                    <?php endif; ?>
                    <?php if (!empty($item['phone_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['phone_title']); ?>"><i class="fas fa-phone"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['facebook_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['facebook_title']); ?>"><i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['twitter_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['twitter_title']); ?>"><i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['linkedin_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['linkedin_title']); ?>"><i class="fab fa-linkedin"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['instagram_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['instagram_title']); ?>"><i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['youtube_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['youtube_title']); ?>"><i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['googleplus_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['googleplus_title']); ?>"><i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['flickr_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['flickr_title']); ?>"><i class="fab fa-flickr"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['vimeo_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['vimeo_title']); ?>"><i class="fab fa-vimeo-v"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['behance_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['behance_title']); ?>"><i class="fab fa-behance"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['dribble_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['dribble_title']); ?>"><i class="fab fa-dribbble"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['pinterest_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['pinterest_title']); ?>"><i class="fab fa-pinterest-p"></i></a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['gitub_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['gitub_title']); ?>"><i class="fab fa-github"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="team__card-content">
                <?php
                if (!empty($link)) {
                    $t_link = esc_attr($link);
                    $t_target = esc_attr($target);
                    $t_rel = esc_attr($rel);
                    if (!empty($title)):
                        printf(
                            '<%1$s %2$s><a class="wpr-el-team-name" href="%3$s" target="%4$s" rel="%5$s">%6$s</a></%1$s>',
                            tag_escape($settings['wpr_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            $t_link,
                            $t_target,
                            $t_rel,
                            $title
                        );
                    endif;
                } else {
                    if (!empty($title)):
                        printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['wpr_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            $title
                        );
                    endif;
                }
                ?>

                <?php if (!empty($item['designation'])): ?>
                <span class="wpr-el-team-desi">
                   <?php echo tp_kses($item['designation']); ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>


<?php elseif ($settings['wpr_design_style'] == 'layout-3'): ?>


<div class="swiper team-la__slider">
    <div class="swiper-wrapper">
        <?php foreach ($settings['teams'] as $key => $item):

            $title = tp_kses($item['title']);
            $key = $key + 1;

            // Handle image URL and alt text
            if (!empty($item['image']['url'])) {
                $wpr_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                $wpr_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Handle bg-image URL and alt text
            if (!empty($item['bg_image']['url'])) {
                $wpr_team_bg_image_url = !empty($item['bg_image']['id']) ? wp_get_attachment_image_url($item['bg_image']['id'], $settings['thumbnail_size']) : $item['bg_image']['url'];
            }

            // Reset render attributes for each iteration
            $this->add_render_attribute('title_args', 'class', 'h5 author__title');

            // Determine link details
            if ('2' == $item['wpr_title_link_type']) {
                $link = get_permalink($item['wpr_title_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($item['wpr_title_custome_link']['url']) ? $item['wpr_title_custome_link']['url'] : '';
                $target = !empty($item['wpr_title_custome_link']['is_external']) ? '_blank' : '';
                $rel = !empty($item['wpr_title_custome_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>
        <div class="swiper-slide team-la__item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
            <div class="team-la__item-before"></div>
            <span class="team-la__item-after"  style=" background-image: url('<?php echo esc_url($wpr_team_bg_image_url); ?>');">
            </span>
            <div class="author">
                <?php if (!empty($wpr_team_image_url)): ?>
                <figure class="author__avatar wpr-el-team-img">
                    <img src="<?php echo esc_url($wpr_team_image_url); ?>" alt="<?php echo esc_attr($wpr_team_image_alt); ?>">
                </figure>
                <?php endif; ?>

                <div class="author__info">
                    <?php
                    if (!empty($link)) {
                        $t_link = esc_attr($link);
                        $t_target = esc_attr($target);
                        $t_rel = esc_attr($rel);
                        if (!empty($title)):
                            printf(
                                '<%1$s %2$s><a class="wpr-el-team-name" href="%3$s" target="%4$s" rel="%5$s">%6$s</a></%1$s>',
                                tag_escape($settings['wpr_title_tag']),
                                $this->get_render_attribute_string('title_args'),
                                $t_link,
                                $t_target,
                                $t_rel,
                                $title
                            );
                        endif;
                    } else {
                        if (!empty($title)):
                            printf(
                                '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['wpr_title_tag']),
                                $this->get_render_attribute_string('title_args'),
                                $title
                            );
                        endif;
                    }
                    ?>

                    <?php if (!empty($item['designation'])): ?>
                    <p class="author__designation wpr-el-team-desi">
                        <?php echo tp_kses($item['designation']); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="team-la__item-content">
                <?php if (!empty($item['content'])): ?>
                <p class="wpr-el-team-content">
                    <?php echo tp_kses($item['content']); ?>
                </p>
                <?php endif; ?>

                <?php if (!empty($item['show_social'])): ?>
                <ul class="custom-ul team-la__item-social">
                    <?php if (!empty($item['web_title'])): ?>
                    <li>   
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['web_title']); ?>">
                            <i class="fas fa-globe"></i>
                        </a>
                    </li> 
                    <?php endif; ?>
                    <?php if (!empty($item['phone_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['phone_title']); ?>"><i class="fas fa-phone"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['facebook_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['facebook_title']); ?>"><i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['twitter_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['twitter_title']); ?>"><i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['linkedin_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['linkedin_title']); ?>"><i class="fab fa-linkedin"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['instagram_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['instagram_title']); ?>"><i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['youtube_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['youtube_title']); ?>"><i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['googleplus_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['googleplus_title']); ?>"><i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['flickr_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['flickr_title']); ?>"><i class="fab fa-flickr"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['vimeo_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['vimeo_title']); ?>"><i class="fab fa-vimeo-v"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['behance_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['behance_title']); ?>"><i class="fab fa-behance"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['dribble_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['dribble_title']); ?>"><i class="fab fa-dribbble"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['pinterest_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['pinterest_title']); ?>"><i class="fab fa-pinterest-p"></i></a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['gitub_title'])): ?>
                    <li>
                        <a class="wpr-el-team-social" href="<?php echo esc_url($item['gitub_title']); ?>"><i class="fab fa-github"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<?php elseif ($settings['wpr_design_style'] == 'layout-4'): ?>


<div class="swiper team-fin__slider">
    <div class="swiper-wrapper">
        <?php foreach ($settings['teams'] as $key => $item):

            $title = tp_kses($item['title']);
            $key = $key + 1;

            // Handle image URL and alt text
            if (!empty($item['image']['url'])) {
                $wpr_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                $wpr_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
            }

            // Reset render attributes for each iteration
            $this->add_render_attribute('title_args', 'class', 'h6 team-fin__slider-title');

            // Determine link details
            if ('2' == $item['wpr_title_link_type']) {
                $link = get_permalink($item['wpr_title_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($item['wpr_title_custome_link']['url']) ? $item['wpr_title_custome_link']['url'] : '';
                $target = !empty($item['wpr_title_custome_link']['is_external']) ? '_blank' : '';
                $rel = !empty($item['wpr_title_custome_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>
        <div class="swiper-slide team-fin__slider-item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
            <?php if (!empty($item['show_social'])): ?>
            <ul class="custom-ul team-fin__slider-social">
                <?php if (!empty($item['web_title'])): ?>
                <li>   
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['web_title']); ?>">
                        <i class="fas fa-globe"></i>
                    </a>
                </li> 
                <?php endif; ?>
                <?php if (!empty($item['phone_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['phone_title']); ?>"><i class="fas fa-phone"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['facebook_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['facebook_title']); ?>"><i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['twitter_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['twitter_title']); ?>"><i class="fab fa-twitter"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['linkedin_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['linkedin_title']); ?>"><i class="fab fa-linkedin"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['instagram_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['instagram_title']); ?>"><i class="fab fa-instagram"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['youtube_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['youtube_title']); ?>"><i class="fab fa-youtube"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['googleplus_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['googleplus_title']); ?>"><i class="fab fa-google-plus-g"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['flickr_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['flickr_title']); ?>"><i class="fab fa-flickr"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['vimeo_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['vimeo_title']); ?>"><i class="fab fa-vimeo-v"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['behance_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['behance_title']); ?>"><i class="fab fa-behance"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['dribble_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['dribble_title']); ?>"><i class="fab fa-dribbble"></i>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['pinterest_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['pinterest_title']); ?>"><i class="fab fa-pinterest-p"></i></a>
                </li>
                <?php endif; ?>
                <?php if (!empty($item['gitub_title'])): ?>
                <li>
                    <a class="wpr-el-team-social" href="<?php echo esc_url($item['gitub_title']); ?>"><i class="fab fa-github"></i>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>

            <?php if (!empty($wpr_team_image_url)): ?>
            <figure class="team-fin__slider-thumb wpr-el-team-img">
                <img class="img-move" src="<?php echo esc_url($wpr_team_image_url); ?>" alt="<?php echo esc_attr($wpr_team_image_alt); ?>">
            </figure>
            <?php endif; ?>

            <div class="team-fin__slider-content">
                <?php if (!empty($item['designation'])): ?>
                <p class="wpr-el-team-desi">
                    <?php echo tp_kses($item['designation']); ?>
                </p>
                <?php endif; ?>

                <?php
                if (!empty($link)) {
                    $t_link = esc_attr($link);
                    $t_target = esc_attr($target);
                    $t_rel = esc_attr($rel);
                    if (!empty($title)):
                        printf(
                            '<%1$s %2$s><a class="wpr-el-team-name" href="%3$s" target="%4$s" rel="%5$s">%6$s</a></%1$s>',
                            tag_escape($settings['wpr_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            $t_link,
                            $t_target,
                            $t_rel,
                            $title
                        );
                    endif;
                } else {
                    if (!empty($title)):
                        printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['wpr_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            $title
                        );
                    endif;
                }
                ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


        <?php else:
            $animation = $this->tp_animation_show($settings);
            ?>

        <!-- Team Start -->
        <div class="team-digital wpr-el-section">
            <div class="container container-fitness">
                <div class="row">
                    <div class="col-12">
                        <div class="team-digital__slider-wrapper">
                            <div class="swiper team-digital__slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['teams'] as $key => $item):

                                        $title = tp_kses($item['title']);
                                        $key = $key + 1;

                                        // Handle image URL and alt text
                                        if (!empty($item['image']['url'])) {
                                            $wpr_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                            $wpr_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                        }

                                        // Reset render attributes for each iteration
                                        $this->add_render_attribute('title_args', 'class', 'h5 team-digital__item-name');

                                        // Determine link details
                                        if ('2' == $item['wpr_title_link_type']) {
                                            $link = get_permalink($item['wpr_title_page_link']);
                                            $target = '_self';
                                            $rel = 'nofollow';
                                        } else {
                                            $link = !empty($item['wpr_title_custome_link']['url']) ? $item['wpr_title_custome_link']['url'] : '';
                                            $target = !empty($item['wpr_title_custome_link']['is_external']) ? '_blank' : '';
                                            $rel = !empty($item['wpr_title_custome_link']['nofollow']) ? 'nofollow' : '';
                                        }
                                    ?>
                                    <div class="swiper-slide team-digital__item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                        <?php if (!empty($wpr_team_image_url)): ?>
                                        <div class="team-digital__item-thumb wpr-el-team-img">
                                            <img class="img-move" src="<?php echo esc_url($wpr_team_image_url); ?>" alt="<?php echo esc_attr($wpr_team_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>

                                        <div class="team-digital__item-content">
                                            <?php
                                            if (!empty($link)) {
                                                $t_link = esc_attr($link);
                                                $t_target = esc_attr($target);
                                                $t_rel = esc_attr($rel);
                                                if (!empty($title)):
                                                    printf(
                                                        '<%1$s %2$s><a class="wpr-el-team-name" href="%3$s" target="%4$s" rel="%5$s">%6$s</a></%1$s>',
                                                        tag_escape($settings['wpr_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        $t_link,
                                                        $t_target,
                                                        $t_rel,
                                                        $title
                                                    );
                                                endif;
                                            } else {
                                                if (!empty($title)):
                                                    printf(
                                                        '<%1$s %2$s>%3$s</%1$s>',
                                                        tag_escape($settings['wpr_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        $title
                                                    );
                                                endif;
                                            }
                                            ?>

                                            <?php if (!empty($item['designation'])): ?>
                                            <p class="team-digital__item-position wpr-el-team-desi">
                                               <?php echo tp_kses($item['designation']); ?>
                                            </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php if (!empty($settings['navigation_arrow_swich'])): ?>
                                <div class="team-digital__slider-navigation">
                                    <div class="team-digital__slider-prev">
                                        <img
                                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon/arrow-left.png"
                                        alt="arrow"
                                        />
                                    </div>
                                    <div class="team-digital__slider-next">
                                        <img
                                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon/arrow-right.png"
                                        alt="arrow"
                                        />
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->

        <?php endif;
    }
}

$widgets_manager->register(new WPR_Team());
