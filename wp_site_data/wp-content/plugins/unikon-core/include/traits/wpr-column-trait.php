<?php

namespace WPRCore\Widgets;

use Elementor\Controls_Manager;

trait WPR_Column_Trait
{

    protected function tp_columns($control_id = 'columns_options', $condition = null, $control_name = 'Select Columns', $default_for_lg = '4', $default_for_md = '6', $default_for_sm = '6', $default_for_all = '12')
    {

        $section_args = [
            'label' => esc_html__($control_name, 'tp-core'),
        ];

        if ($condition) {
            $section_args['condition'] = [
                'wpr_design_style' => $condition
            ];
        };
        $this->start_controls_section(
            'tp_' . $control_id . 'columns_section',
            $section_args
        );

        $this->add_control(
            'tp_' . $control_id . '_for_desktop',
            [
                'label' => esc_html__('Columns for Desktop', 'wprealizer'),
                'description' => esc_html__('Screen width equal to or greater than 1200px', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'wprealizer'),
                    6 => esc_html__('2 Columns', 'wprealizer'),
                    4 => esc_html__('3 Columns', 'wprealizer'),
                    3 => esc_html__('4 Columns', 'wprealizer'),
                    2 => esc_html__('6 Columns', 'wprealizer'),
                ],
                'separator' => 'before',
                'default' => $default_for_lg,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_for_laptop',
            [
                'label' => esc_html__('Columns for Large', 'wprealizer'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'wprealizer'),
                    6 => esc_html__('2 Columns', 'wprealizer'),
                    4 => esc_html__('3 Columns', 'wprealizer'),
                    3 => esc_html__('4 Columns', 'wprealizer'),
                    2 => esc_html__('6 Columns', 'wprealizer'),
                ],
                'separator' => 'before',
                'default' => $default_for_md,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_for_tablet',
            [
                'label' => esc_html__('Columns for Tablet', 'wprealizer'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'wprealizer'),
                    6 => esc_html__('2 Columns', 'wprealizer'),
                    4 => esc_html__('3 Columns', 'wprealizer'),
                    3 => esc_html__('4 Columns', 'wprealizer'),
                    2 => esc_html__('6 Columns', 'wprealizer'),
                ],
                'separator' => 'before',
                'default' => $default_for_sm,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_for_mobile',
            [
                'label' => esc_html__('Columns for Mobile', 'wprealizer'),
                'description' => esc_html__('Screen width less than 767px', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'wprealizer'),
                    6 => esc_html__('2 Columns', 'wprealizer'),
                    4 => esc_html__('3 Columns', 'wprealizer'),
                    3 => esc_html__('4 Columns', 'wprealizer'),
                    2 => esc_html__('6 Columns', 'wprealizer'),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_' . $control_id . '_for_xs',
            [
                'label' => esc_html__('Columns for XS Devices', 'wprealizer'),
                'description' => esc_html__('Screen width less than 767px', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'wprealizer'),
                    6 => esc_html__('2 Columns', 'wprealizer'),
                    4 => esc_html__('3 Columns', 'wprealizer'),
                    3 => esc_html__('4 Columns', 'wprealizer'),
                    2 => esc_html__('6 Columns', 'wprealizer'),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }


    // colum show
    protected function col_show($data, $key = 'col')
    {
        $desktop = "col-xl-" . esc_attr($data['tp_' . $key . '_for_desktop']);
        $laptop = "col-lg-" . esc_attr($data['tp_' . $key . '_for_laptop']);
        $tablet = "col-md-" . esc_attr($data['tp_' . $key . '_for_tablet']);
        $tablet = "col-md-" . esc_attr($data['tp_' . $key . '_for_tablet']);
        $mobile = "col-sm-" . esc_attr($data['tp_' . $key . '_for_mobile']);
        $xs = "col-" . esc_attr($data['tp_' . $key . '_for_xs']);

        $total_col = $desktop . " " . $laptop . " " . $tablet . " " . $mobile . " " . $xs;

        return $total_col;
    }

    // colum show
    protected function row_cols_show($data, $key = 'col')
    {
        $desktop = "row-cols-xl-" . esc_attr($data['tp_' . $key . '_for_desktop']);
        $laptop = "row-cols-lg-" . esc_attr($data['tp_' . $key . '_for_laptop']);
        $tablet = "row-cols-md-" . esc_attr($data['tp_' . $key . '_for_tablet']);
        $tablet = "row-cols-md-" . esc_attr($data['tp_' . $key . '_for_tablet']);
        $mobile = "row-cols-sm-" . esc_attr($data['tp_' . $key . '_for_mobile']);
        $xs = "row-cols-" . esc_attr($data['tp_' . $key . '_for_xs']);

        $total_col = $desktop . " " . $laptop . " " . $tablet . " " . $mobile . " " . $xs;

        return $total_col;
    }
}
