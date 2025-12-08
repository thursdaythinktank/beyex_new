<?php

namespace WPRCore\Widgets;

use Elementor\Controls_Manager;



trait WPR_Query_Trait
{
    protected function tp_query_controls($control_id = null, $control_name = null, $post_type = 'any', $taxonomy = 'category', $default_title_num = 6, $default_content_limit = '10', $posts_per_page = '6', $offset = '0', $orderby = 'date', $order = 'desc', $date_format = false, $has_content = false, $view_pagination = false, $post_read_more = false)
    {

        $this->start_controls_section(
            'tp' . $control_id . '_query',
            [
                'label' => sprintf(esc_html__('%s Query', 'wprealizer'), $control_name),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'wprealizer'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'wprealizer'),
                'type' => Controls_Manager::NUMBER,
                'default' => $posts_per_page,
            ]
        );
        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'wprealizer'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'wprealizer'),
                'description' => esc_html__('Select a category to exclude', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true
            ]
        );
        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'options' => tp_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__in',
            [
                'label' => esc_html__('Include Item', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'options' => tp_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );


        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'wprealizer'),
                'type' => Controls_Manager::NUMBER,
                'default' => $offset,
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => tp_get_orderby_options(),
                'default' => $orderby,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => esc_html__('Ascending', 'wprealizer'),
                    'desc' => esc_html__('Descending', 'wprealizer')
                ],
                'default' => $order,

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__('Ignore Sticky Posts', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_post_title_word',
            [
                'label' => esc_html__('Title Word Count', 'wprealizer'),
                'description' => esc_html__('Set how many word you want to displa!', 'wprealizer'),
                'type' => Controls_Manager::NUMBER,
                'default' => $default_title_num,
            ]
        );

        if ($date_format) {
            $this->add_control(
                'tp_post_date_format',
                [
                    'label' => esc_html__('Date Format', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'default' => esc_html__('Default', 'wprealizer'),
                        'd-m-Y' => esc_html__('d-m-Y', 'wprealizer'),
                        'd/m/Y' => esc_html__('d/m/Y', 'wprealizer'),
                        'm-d-Y' => esc_html__('m-d-Y', 'wprealizer'),
                        'm/d/Y' => esc_html__('m/d/Y', 'wprealizer'),
                        'Y-m-d' => esc_html__('Y-m-d', 'wprealizer'),
                        'custom' => esc_html__('Custom', 'wprealizer'),

                    ],
                    'default' => 'default',
                ]
            );

            $this->add_control(
                'tp_post_date_custom_format',
                [
                    'label' => esc_html__('Custom Date Format', 'wprealizer'),
                    'description' => esc_html__('Enter your custom date format.', 'wprealizer'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'F j, Y',
                    'condition' => [
                        'tp_post_date_format' => 'custom',
                    ]
                ]
            );
        }

        if ($post_type == 'post' && $has_content) {
            $this->add_control(
                'tp_post_content',
                [
                    'label' => __('Content', 'wprealizer'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'wprealizer'),
                    'label_off' => __('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'tp_post_content_limit',
                [
                    'label' => __('Content Limit', 'wprealizer'),
                    'type' => Controls_Manager::TEXT,
                    'default' => $default_content_limit,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'tp_post_content' => 'yes',

                    ]
                ]
            );
        }

        if ($post_read_more) {
            $this->add_control(
                'post_read_more_btn_text',
                [
                    'label' => esc_html__('Read More Button', 'wprealizer'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Read More', 'wprealizer'),
                    'placeholder' => esc_html__('Your Text', 'wprealizer'),
                    'label_block' => true,
                ]
            );
        }

        if ($view_pagination) {
            $this->add_control(
                'tp_post_pagination',
                [
                    'label' => esc_html__('Pagination On/Off', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'wprealizer'),
                    'label_off' => esc_html__('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_responsive_control(
                'tp_post_pagination_alignment',
                [
                    'label' => esc_html__('Pagination Alignment', 'wprealizer'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .tp-el-pagination-alignment' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'tp_post_pagination' => 'yes',
                    ],
                ]
            );
        }


        $this->end_controls_section();
    }

    protected function tp_query_meta_controls($control_id = null, $control_name = null, $show_category = true, $show_date = true, $show_author = false, $show_comment = false)
    {
        $this->start_controls_section(
            'tp' . $control_id . '_meta',
            [
                'label' => sprintf(esc_html__('%s Meta', 'wprealizer'), $control_name),
            ]
        );

        if ($show_category) {
            $this->add_control(
                'tp_post_category',
                [
                    'label' => esc_html__('Category', 'wprealizer'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'wprealizer'),
                    'label_off' => esc_html__('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        }

        if ($show_date) {
            $this->add_control(
                'tp_post_date',
                [
                    'label' => esc_html__('Date', 'wprealizer'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'wprealizer'),
                    'label_off' => esc_html__('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
        }

        if ($show_author) {
            $this->add_control(
                'tp_post_author',
                [
                    'label' => esc_html__('Author', 'wprealizer'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'wprealizer'),
                    'label_off' => esc_html__('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        }

        if ($show_comment) {
            $this->add_control(
                'tp_post_comment',
                [
                    'label' => esc_html__('Comment', 'wprealizer'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'wprealizer'),
                    'label_off' => esc_html__('Hide', 'wprealizer'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        }

        $this->end_controls_section();
    }
}
