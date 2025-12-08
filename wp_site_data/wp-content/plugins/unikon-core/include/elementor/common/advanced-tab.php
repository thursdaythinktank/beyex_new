<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
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
class TP_Advanced_Tab extends Widget_Base
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
        return 'tp-advanced-tab';
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
        return __(WPRCORE_THEME_NAME . ' :: Advanced Tab', 'wprealizer');
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
            '_section_price_tabs',
            [
                'label' => __('Advanced Tabs', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_tab_shape',
            [
                'label' => esc_html__('Upload Shape Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_tab_alignment',
            [
                'label' => esc_html__('Tab Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'condition' => [
                    'wpr_design_style' => 'layout-1'
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'wprealizer'),
                'default' => __('Tab Title', 'wprealizer'),
                'placeholder' => __('Type Tab Title', 'wprealizer'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'wprealizer'),
                'placeholder' => __('Select a section template for as tab content', 'wprealizer'),

                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'thumbnail',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'wpr_design_style' => 'layout-1'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->start_controls_section(
            'tp_ad_t_filter_title_section',
            [
                'label' => esc_html__('Tab Title', 'textdomain'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tp_ad_t_filter_title_typo',
                'label'   => esc_html__('Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .tp-el-f-btn',
            ]
        );

        $this->start_controls_tabs(
            'tp_ad_t_filter_title_color_tabs',
        );

        $this->start_controls_tab(
            'tp_ad_t_filter_title_color_tab',
            [
                'label'   => esc_html__('Normal', 'textdomain'),
            ]
        );
        $this->add_control(
            'tp_ad_t_filter_title_color_normal',
            [
                'label'       => esc_html__('Normal Color', 'textdomain'),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-f-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tp_ad_t_filter_title_color_tab_active',
            [
                'label'   => esc_html__('Active', 'textdomain'),
            ]
        );
        $this->add_control(
            'tp_ad_t_filter_title_color_active',
            [
                'label'       => esc_html__('Active Color', 'textdomain'),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-f-btn.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->tp_basic_style_controls('ad_t_title', 'Title', '.tp-el-title');
        $this->tp_basic_style_controls('ad_t_p_price', 'Old price', '.tp-el-price .price del span, .tp-el-price .price del');
        $this->tp_basic_style_controls('ad_t_n_price', 'New price', '.tp-el-price .price ins span');
        $this->tp_link_controls_style('', 'ad_t_n_percentage', 'Percentage', '.tp-el-percentage span');
        $this->tp_link_controls_style('', 'ad_t_btn', 'Button', '.tp-el-btn');
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
        $settings = $this->get_settings_for_display(); ?>

        <?php if ($settings['wpr_design_style'] == 'layout-3'): ?>

            <div class="tp-instructor-become-tab">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">

                    <?php foreach ($settings['tabs'] as $key => $item):

                        $array_el = count($settings['tabs']) - 1;
                        $active = ($key == 0) ? 'active' : '';
                        $display_none = ($key == $array_el) ? ' d-none' : '';
                    ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo esc_attr($active); ?>" id="home-<?php echo esc_attr($item['_id']); ?>tab"
                                data-bs-toggle="tab" data-bs-target="#home-<?php echo esc_attr($item['_id']); ?>" type="button"
                                role="tab" aria-controls="home-<?php echo esc_attr($item['_id']); ?>" aria-selected="true">
                                <?php echo tp_kses($item['title']); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <?php foreach ($settings['tabs'] as $key => $item):
                        $active = ($key == 0) ? ' show active' : '';
                    ?>
                        <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="home-<?php echo esc_attr($item['_id']); ?>"
                            role="tabpanel" aria-labelledby="home-<?php echo esc_attr($item['_id']); ?>tab">
                            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-2'): ?>

            <div class="tp-instructor-become-tab pb-80 wow fadeInUp" data-wow-delay=".5s">
                <ul class="nav nav-tabs justify-content-center" id="myTab-<?php echo esc_attr($this->get_id()); ?>" role="tablist">

                    <?php foreach ($settings['tabs'] as $key => $item):

                        $array_el = count($settings['tabs']) - 1;
                        $active = ($key == 0) ? 'active' : '';
                        $display_none = ($key == $array_el) ? ' d-none' : '';
                    ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo esc_attr($active); ?>" id="home-<?php echo esc_attr($item['_id']); ?>tab"
                                data-bs-toggle="tab" data-bs-target="#home-<?php echo esc_attr($item['_id']); ?>" type="button"
                                role="tab" aria-controls="home-<?php echo esc_attr($item['_id']); ?>" aria-selected="true">
                                <?php echo tp_kses($item['title']); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-content" id="myTabContent-<?php echo esc_attr($this->get_id()); ?>">
                        <?php foreach ($settings['tabs'] as $key => $item):
                            $active = ($key == 0) ? ' show active' : '';
                        ?>
                            <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="home-<?php echo esc_attr($item['_id']); ?>"
                                role="tabpanel" aria-labelledby="home-<?php echo esc_attr($item['_id']); ?>tab">
                                <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


        <?php else:
            $shape = tp_get_img($settings, 'tp_tab_shape', 'tp_image_size');

        ?>
            <!-- shop product area start -->
            <div class="tp-shop-product-tab mb-60">
                <ul class="nav nav-pills mb-3 justify-content-<?php echo esc_attr($settings['tp_tab_alignment']); ?>"
                    id="pills-<?php echo esc_attr($this->get_id()); ?>" role="tablist">
                    <?php foreach ($settings['tabs'] as $key => $item):

                        $array_el = count($settings['tabs']) - 1;
                        $active = ($key == 0) ? 'active' : '';
                        $display_none = ($key == $array_el) ? ' d-none' : '';
                    ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tp-el-f-btn <?php echo esc_attr($active); ?>"
                                id="pills-<?php echo esc_attr($item['_id']); ?>-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-<?php echo esc_attr($item['_id']); ?>" type="button" role="tab"
                                aria-controls="pills-<?php echo esc_attr($item['_id']); ?>" aria-selected="false">
                                <?php echo tp_kses($item['title']); ?>
                                <span class="<?php echo esc_attr($display_none); ?>">
                                    <img src="<?php echo esc_url($shape['tp_tab_shape']); ?>"
                                        alt="<?php echo esc_url($shape['tp_tab_shape_alt']); ?>">
                                </span>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="tab-content" id="pills-<?php echo esc_attr($this->get_id()); ?>">
                <?php foreach ($settings['tabs'] as $key => $item):
                    $active = ($key == 0) ? ' show active' : '';
                ?>
                    <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="pills-<?php echo esc_attr($item['_id']); ?>"
                        role="tabpanel" aria-labelledby="pills-<?php echo esc_attr($item['_id']); ?>-tab">
                        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['template'], true); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- shop product area end -->


<?php endif;
    }
}

$widgets_manager->register(new TP_Advanced_Tab());
