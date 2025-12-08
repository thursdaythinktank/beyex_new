<?php

namespace WPRCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;

trait WPR_Offcanvas_Trait
{

    protected function tp_offcanvas_controls($control_id = null, $control_name = null)
    {
        $this->start_controls_section(
            'tp_offcanvas_section',
            [
                'label' => esc_html__('Offcanvas', 'wprealizer'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_offcanvas_logo',
            [
                'label' => esc_html__('Choose Logo', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_offcanvas_logo_white',
            [
                'label' => esc_html__('Choose Logo White', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_offcanvas_type' => 'full_width'
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'tp_offcanvas_logo_size',
                'label'   => __('Image Size', 'wprealizer'),
                'default' => 'medium',
            ]
        );

        $this->add_control(
            'tp_offcanvas_type',
            [
                'label'   => esc_html__('Select Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default'  => esc_html__('Default', 'wprealizer'),
                    'full_width'  => esc_html__('Full Width', 'wprealizer'),
                ],
                'default' => 'default',
            ]
        );

        $offcanvas = array(
            'post_type'      => 'wpr-offcanvas',
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
                'label'   => esc_html__('Select Template', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => $offcanvas_obj,
                'default' => 'default',
            ]
        );

        $this->end_controls_section();
    }
}
