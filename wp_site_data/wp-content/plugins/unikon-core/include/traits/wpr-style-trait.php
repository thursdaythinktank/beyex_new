<?php

namespace WPRCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use Elementor\REPEA;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use WPRCore\Elementor\Controls\Group_Control_WPRBGGradient;
use WPRCore\Elementor\Controls\Group_Control_WPRGradient;

trait WPR_Style_Trait
{

    protected function wpr_design_layout($control_name = null, $item = 1, $control_id = 'design')
    {

        $layout_arr = [];

        foreach (range(1, $item) as $i) {
            $layout_arr['layout-' . $i] = esc_html__('Layout ' . $i, 'wprealizer');
        }

        $this->start_controls_section(
            'wpr_design_layout_select_section',
            [
                'label' => esc_html__('Select Layout', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_style',
            [
                'label' => esc_html__($control_name, 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => $layout_arr,
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
    }

    // icon style
    protected function tp_icon_style($condition = null, $control_id = 'sec_icon', $control_class = '.wpr-icon-style', $control_name = 'Icon/Image/SVG', $span_icon_control = false)
    {

        $section_args = [
            'label' => esc_html__($control_name, 'wprealizer'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ];

        if ($condition) {
            $section_args['condition'] = [
                'wpr_design_style' => $condition
            ];
        };
        $this->start_controls_section(
            'icon_style_sec' . $control_id,
            $section_args
        );

        $this->start_controls_tabs(
            'icon_img_svb_tabs' . $control_id
        );

        // icon tab
        $this->start_controls_tab(
            'style_icon_tab' . $control_id,
            [
                'label' => esc_html__('Icon', 'wprealizer'),
            ]
        );

        $this->add_responsive_control(
            'style_icon_color' . $control_id,
            [
                'label' => esc_html__('Icon Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_class . ' i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'style_icon_size' . $control_id,
            [
                'label' => esc_html__('Font Size', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_class . ' i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // image tab
        $this->start_controls_tab(
            'style_image_tab' . $control_id,
            [
                'label' => esc_html__('Image', 'wprealizer'),
            ]
        );

        $this->add_responsive_control(
            'style_image_w' . $control_id,
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
                    '{{WRAPPER}} ' . $control_class . ' img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'style_image_h' . $control_id,
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
                    '{{WRAPPER}} ' . $control_class . ' img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // svg tab
        $this->start_controls_tab(
            'style_svg_tab' . $control_id,
            [
                'label' => esc_html__('SVG', 'wprealizer'),
            ]
        );

        $this->add_responsive_control(
            'style_svg_w' . $control_id,
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('SVG Width', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_class . ' svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        if ($span_icon_control) {
            // background 
            $this->add_responsive_control(
                'style_icon_bg_span' . $control_id,
                [
                    'label' => esc_html__('Background Color', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $control_class . ' span' => 'background: {{VALUE}}',
                    ],
                ]
            );

            //border 
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'style_icon_border_span' . $control_id,
                    'selector' => '{{WRAPPER}} ' . $control_class . ' span',
                ]
            );
        } else {

            $this->add_responsive_control(
                'style_icon_bg' . $control_id,
                [
                    'label' => esc_html__('Background Color', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $control_class . ' i,{{WRAPPER}} ' . $control_class . ' img,{{WRAPPER}} ' . $control_class . ' svg' => 'background: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'style_icon_border' . $control_id,
                    'selector' => '{{WRAPPER}} ' . $control_class . ' i,{{WRAPPER}} ' . $control_class . ' img,{{WRAPPER}} ' . $control_class . ' svg',
                ]
            );
        }




        $this->add_responsive_control(
            'style_icon_margin' . $control_id,
            [
                'label' => esc_html__('Margin', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_class . ' i,{{WRAPPER}} ' . $control_class . ' img,{{WRAPPER}} ' . $control_class . ' svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'style_icon_padding' . $control_id,
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_class . ' i,{{WRAPPER}} ' . $control_class . ' img,{{WRAPPER}} ' . $control_class . ' svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // image style
    protected function tp_image_style($control_id = null, $control_name = 'Image Style', $selector = '.single-service .icon')
    {
        $this->start_controls_section(
            'tp_' . $control_id . '_media_style',
            [
                'label' => esc_html__($control_name, 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'tp_' . $control_id . '_image_width',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ' img, {{WRAPPER}} ' . $selector . ' svg' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_image_height',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ' img' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );


        $this->add_responsive_control(
            'tp_' . $control_id . '_image_radius',
            [
                'label' => esc_html__('Radius', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ' img ' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_' . $control_id . '_image_margin',
            [
                'label' => esc_html__('Margin', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ' img ' => 'margin: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_image_padding',
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ' img ' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }


    // basic text controls style
    protected function tp_basic_style_controls($control_id = null, $control_name = null, $control_selector = null, $condition = null)
    {

        $section_args = [
            'label' => esc_html__($control_name, 'wprealizer'),
            'tab' => Controls_Manager::TAB_STYLE,
        ];

        if ($condition) {
            $section_args['condition'] = [
                'wpr_design_style' => $condition
            ];
        }

        $this->start_controls_section(
            'tp_' . $control_id . '_styling',
            $section_args
        );



        $this->start_controls_tabs(
            'tp_' . $control_id . '_tabs_style',
        );
        //  normal 

        $this->start_controls_tab(
            'tp_' . $control_id . '_tab_style',
            [
                'label' => esc_html__('Normal', 'wprealizer'),
            ]
        );

        $this->add_group_control(
            Group_Control_WPRGradient::get_type(),
            [
                'name' => 'tp_' . $control_id . '_normal_color',
                'label' => esc_html__('Color', 'wprealizer'),
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );

        $this->end_controls_tab();

        // hover 

        $this->start_controls_tab(
            'tp_' . $control_id . '_tab_hover_style',
            [
                'label' => esc_html__('Hover', 'wprealizer'),
            ]
        );


        $this->add_control(
            'tp_' . $control_id . '_hover_color',
            [
                'label' => esc_html__('Hover Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'tp_' . $control_id . '_tab_hover_transition',
            [
                'label' => esc_html__('Transition Duration', 'elementor') . ' (s)',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '' => [ // Use empty string for units like seconds
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'transition: all {{SIZE}}s ease-in-out; -webkit-transition: all {{SIZE}}s ease-in-out;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_' . $control_id . '_typography',
                'label' => esc_html__('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    // section controls style
    protected function tp_section_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'tp_' . $control_id . '_area_styling',
            [
                'label' => esc_html__($control_name, 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tp_' . $control_id . 'area_background',
                'label' => esc_html__('Background', 'wprealizer'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_area_padding',
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_area_margin',
            [
                'label' => esc_html__('Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_area_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'name',
                'label' => esc_html__('label', 'wprealizer'),
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );
        $this->end_controls_section();
    }

    // input controles

    protected function tp_input_controls_style($control_id = null, $control_name = null, $control_selector = '.tp-input', $control_selector2 = '.tp-textarea')
    {
        /**
         * Button One
         */
        $this->start_controls_section(
            'tp_' . $control_id . '_button',
            [
                'label' => esc_html__($control_name, 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_' . $control_id . '_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '',
            ]
        );


        $this->start_controls_tabs('tp_' . $control_id . '_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('tp_' . $control_id . '_btn_normal', ['label' => esc_html__('Normal', 'wprealizer')]);

        $this->add_control(
            'tp_' . $control_id . '_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_normal_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '::placeholder, {{WRAPPER}} ' . $control_selector2 . '::placeholder' => 'color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->add_control(
            'tp_' . $control_id . '_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_' . $control_id . '_btn_box_shadow',
                'label' => esc_html__('Box Shadow', 'wprealizer'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '',
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        // Focus State Tab
        $this->start_controls_tab('tp_' . $control_id . '_btn_hover', ['label' => esc_html__('Focus', 'wprealizer')]);

        $this->add_control(
            'tp_' . $control_id . '_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_' . $control_id . '_btn_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'wprealizer'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'tp_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ',{{WRAPPER}} ' . $control_selector2 . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ',{{WRAPPER}} ' . $control_selector2 . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // section title controls

    protected function tp_section_title_render_controls($control_id = null, $section_name = 'Section Title', $condition = null, $sub_title = 'Sub Title', $default_title = 'Your Section Title', $default_description = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.', $default_title_tag = 'h2', $default_align = 'text-left', $enable_section_title_show_hide = true, $default_section_title_enable = 'yes')
    {
        $section_args = [
            'label' => esc_html__($section_name, 'wprealizer'),
        ];

        if ($condition) {
            $section_args['condition'] = [
                'wpr_design_style' => $condition
            ];
        }

        $this->start_controls_section(
            'tp_' . $control_id . '_section_title',
            $section_args
        );


        if ($enable_section_title_show_hide) {
            $this->add_control(
                'tp_' . $control_id . '_section_title_show',
                [
                    'label' => esc_html__('Section Title & Content', 'wprealizer'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'wprealizer'),
                    'label_off' => esc_html__('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => $default_section_title_enable,
                ]
            );
        }

        $this->add_control(
            'tp_' . $control_id . '_sub_title',
            [
                'label' => esc_html__('Sub Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => $sub_title,
                'placeholder' => esc_html__('Type Before Heading Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'tp_' . $control_id . '_section_title_show' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $default_title,
                'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'tp_' . $control_id . '_section_title_show' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_title_tag',
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
                'default' => $default_title_tag,
                'toggle' => false,
                'condition' => [
                    'tp_' . $control_id . '_section_title_show' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $default_description,
                'placeholder' => esc_html__('Type section description here', 'wprealizer'),
                'condition' => [
                    'tp_' . $control_id . '_section_title_show' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_align',
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
                'default' => $default_align,
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .align-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }


    protected function tp_section_title_full_render_controls($control_id = null, $section_name = 'Section Title', $condition = ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8', 'layout-9', 'layout-10'], $sub_title = 'Sub Title', $default_title = 'Your Section Title', $default_description = 'There are many variations of passages of Lorem Ipsum available, <br /> but the majority have suffered alteration.', $default_title_tag = 'h2', $default_align = 'text-left', $enable_section_title_show_hide = true, $default_section_title_enable = 'yes')
    {
        $this->start_controls_section(
            'tp_' . $control_id . '_section_title',
            [
                'label' => esc_html__($section_name, 'wprealizer'),
                'condition' => [
                    'wpr_design_style' => $condition
                ]
            ]
        );
        if ($enable_section_title_show_hide) {
            $this->add_control(
                'tp_' . $control_id . '_section_title_show',
                [
                    'label' => esc_html__('Section Title & Content', 'wprealizer'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'wprealizer'),
                    'label_off' => esc_html__('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => $default_section_title_enable,
                ]
            );
        }

        $this->add_control(
            'tp_' . $control_id . '_sub_title',
            [
                'label' => esc_html__('Sub Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => $sub_title,
                'placeholder' => esc_html__('Type Before Heading Text', 'wprealizer'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $default_title,
                'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_title_tag',
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
                'default' => $default_title_tag,
                'toggle' => false,
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $default_description,
                'placeholder' => esc_html__('Type section description here', 'wprealizer'),
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_align',
            [
                'label' => esc_html__('Alignment', 'tp-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-start' => [
                        'title' => esc_html__('Left', 'tp-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tp-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-end' => [
                        'title' => esc_html__('Right', 'tp-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => $default_align,
                'toggle' => false,
            ]
        );
        $this->end_controls_section();
    }

    // button controls

    protected function tp_link_render_controls($control_id = 'button', $control_name = 'Button', $control_condition = null, $default_btn_text = 'Read More', $default_btn_enable = 'yes')
    {

        if ($control_condition) {
            $this->start_controls_section(
                'tp_' . $control_id . '_button_group',
                [
                    'label' => esc_html__($control_name, 'wprealizer'),
                    'condition' => [
                        'wpr_design_style' => $control_condition
                    ],
                ]
            );
        } else {
            $this->start_controls_section(
                'tp_' . $control_id . '_button_group',
                [
                    'label' => esc_html__($control_name, 'wprealizer'),
                ]
            );
        }


        $this->add_control(
            'tp_' . $control_id . '_button_show',
            [
                'label' => esc_html__('Show Button', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => $default_btn_enable,
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_text',
            [
                'label' => esc_html__($control_name . ' Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => $default_btn_text,
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'tp_' . $control_id . '_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_link_type',
            [
                'label' => esc_html__($control_name . ' Link Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_' . $control_id . '_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_link',
            [
                'label' => esc_html__($control_name . ' link', 'wprealizer'),
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
                    'tp_' . $control_id . '_link_type' => '1',
                    'tp_' . $control_id . '_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_page_link',
            [
                'label' => esc_html__('Select ' . $control_name . ' Page', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_types_post('page'),
                'condition' => [
                    'tp_' . $control_id . '_link_type' => '2',
                    'tp_' . $control_id . '_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function tp_link_attributes_render($control_id = null, $control_name = 'tp-btn', $settings = null)
    {

        if ('2' == $settings['tp_' . $control_id . '_link_type']) {
            $this->add_render_attribute('tp-button-arg' . $control_id . '', 'href', get_permalink($settings['tp_' . $control_id . '_page_link']));
            $this->add_render_attribute('tp-button-arg' . $control_id . '', 'target', '_self');
            $this->add_render_attribute('tp-button-arg' . $control_id . '', 'rel', 'nofollow');
            $this->add_render_attribute('tp-button-arg' . $control_id . '', 'class', '' . $control_name . ' tp-el-btn');
        } else {
            if (!empty($settings['tp_' . $control_id . '_link']['url'])) {
                $this->add_link_attributes('tp-button-arg' . $control_id . '', $settings['tp_' . $control_id . '_link']);
                $this->add_render_attribute('tp-button-arg' . $control_id . '', 'class', '' . $control_name . ' tp-el-btn');
            }
        }
    }

    protected function tp_link_controls_style($condition = null, $control_id = 'sec', $control_name = 'Button', $control_selector = '.tp-btn')
    {

        $section_args = [
            'label' => esc_html__($control_name, 'wprealizer'),
            'tab' => Controls_Manager::TAB_STYLE,
        ];

        if ($condition) {
            $section_args['condition'] = [
                'wpr_design_style' => $condition
            ];
        };
        $this->start_controls_section(
            'tp_' . $control_id . '_button',
            $section_args
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tp_' . $control_id . '_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );


        $this->start_controls_tabs('tp_' . $control_id . '_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('tp_' . $control_id . '_btn_normal', ['label' => esc_html__('Normal', 'wprealizer')]);

        $this->add_control(
            'tp_' . $control_id . '_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_' . $control_id . '_btn_box_shadow',
                'label' => esc_html__('Box Shadow', 'wprealizer'),
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tp_' . $control_id . '_btn_normal_border_style',
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_normal_border_radius',
            [
                'label' => esc_html__('Border Redius', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('tp_' . $control_id . '_btn_hover', ['label' => esc_html__('Hover', 'wprealizer')]);

        $this->add_control(
            'tp_' . $control_id . '_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tp_' . $control_id . '_btn_box_shadow_hover',
                'label' => esc_html__('Box Shadow', 'wprealizer'),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tp_' . $control_id . '_btn_hover_border_style',
                'selector' => '{{WRAPPER}} ' . $control_selector . ':hover',
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_btn_hover_border_radius',
            [
                'label' => esc_html__('Border Redius', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'tp_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tp_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
}
