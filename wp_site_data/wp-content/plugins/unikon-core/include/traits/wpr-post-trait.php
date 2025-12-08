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

trait TP_Post_Trait
{

    protected function tp_post_result_count($query, $settings = null)
    {


        $total      = $query->found_posts;
        $per_page   = $settings['posts_per_page'];

        if (get_query_var('paged')) {
            $current = get_query_var('paged');
        } else if (get_query_var('page')) {
            $current = get_query_var('page');
        } else {
            $current = 1;
        }


        if (1 === intval($total)) {
            _e('Showing the single result', 'wprealizer');
        } elseif ($total <= $per_page || -1 === $per_page) {

            printf(_n('Showing all %d result', 'Showing all %d results', $total, 'wprealizer'), $total);
        } else {
            $first = ($per_page * $current) - $per_page + 1;
            $last  = min($total, $per_page * $current);

            printf(_nx('Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'wprealizer'), $first, $last, $total);
        }
    }

    protected function tp_post_layout($control_id = null, $control_name = null)
    {
        $this->start_controls_section(
            'tp_' . $control_id . '_',
            [
                'label' => sprintf(esc_html__('%s - Layout', 'wprealizer'), $control_name),
            ]
        );
        $this->add_control(
            'wpr_design_style',
            [
                'label' => esc_html__('Select Layout', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Blog 1', 'wprealizer'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
    }
}
