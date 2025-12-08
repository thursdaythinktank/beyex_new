<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Home_Demo extends Widget_Base
{

    use WPR_Style_Trait, WPR_Column_Trait;

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
        return 'wpr-home-demo';
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
        return __(WPRCORE_THEME_NAME . ' :: Menu (Home)', 'wprealizer');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wpr_home_demo_section',
            [
                'label' => esc_html__('Content Controls', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'wprealizer'),
                    'style_2' => __('Style 2', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'wpr_menu_active',
            [
                'label' => esc_html__('Active This?', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 0,
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
            ]
        );

        $repeater->add_control(
            'wpr_home_demo_thumb',
            [
                'label'   => esc_html__('Thumbnail', 'wprealizer'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
            ]
        );

        $repeater->add_control(
            'wpr_home_demo_title',
            [
                'label'   => esc_html__('Title', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Home Demo', 'wprealizer'),
                'label_block' => true,
            ]
        );

        tp_render_links_controls($repeater, 'home_demo');

        $this->add_control(
            'wpr_home_demo_list',
            [
                'label'       => esc_html__('Section Label', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'wpr_home_demo_title'   => esc_html__('Home 1', 'wprealizer'),
                    ],
                    [
                        'wpr_home_demo_title'   => esc_html__('Home 2', 'wprealizer'),
                    ],
                    [
                        'wpr_home_demo_title'   => esc_html__('Home 3', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ wpr_home_demo_title }}}',
            ]
        );


        $this->end_controls_section();

        // content 2
        $this->start_controls_section(
            'wpr_home_demo_section_2',
            [
                'label' => esc_html__('Content Controls 2', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => 'layout-2'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'wprealizer'),
                    'style_2' => __('Style 2', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'wpr_home_demo_title_2',
            [
                'label'   => esc_html__('Title', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Home Demo', 'wprealizer'),
                'label_block' => true,
            ]
        );

        tp_render_links_controls($repeater, 'home_demo_2');

        $this->add_control(
            'wpr_home_demo_list_2',
            [
                'label'       => esc_html__('Section Label', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'wpr_home_demo_title_2'   => esc_html__('Home 1', 'wprealizer'),
                    ],
                    [
                        'wpr_home_demo_title_2'   => esc_html__('Home 2', 'wprealizer'),
                    ],
                    [
                        'wpr_home_demo_title_2'   => esc_html__('Home 3', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ wpr_home_demo_title_2 }}}',
            ]
        );


        $this->end_controls_section();

        $this->tp_columns('col', 'layout-1');

        $this->start_controls_section(
            'wpr_mega_banner_section',
            [
                'label' => esc_html__('Banner', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'wpr_home_banner_thumb',
            [
                'label'   => esc_html__('Thumbnail', 'wprealizer'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_home_banner_title',
            [
                'label'   => esc_html__('Title', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Banner Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_theme_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'wpr_theme_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'wprealizer'),
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_theme_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'wpr_theme_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'wpr_theme_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'wpr_theme_btn_link',
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
                    'wpr_theme_btn_link_type' => '1',
                    'wpr_theme_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'wpr_theme_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_types_post('page'),
                'condition' => [
                    'wpr_theme_btn_link_type' => '2',
                    'wpr_theme_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');

        // Start Style Tab
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __('Title Style', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Start Normal Tab
        $this->start_controls_tabs('title_style_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __('Normal', 'wprealizer'),
            ]
        );

        // Typography Control (Normal)
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .wpr-title',
            ]
        );

        // Text Color Control (Normal)
        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Background Color Control (Normal)
        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // Border Control (Normal)
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => __('Border', 'wprealizer'),
                'selector' => '{{WRAPPER}} .wpr-title',
            ]
        );

        // Padding Control (Normal)
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Padding', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control (Normal)
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('Margin', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // End Normal Tab

        // Start Hover Tab
        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __('Hover', 'wprealizer'),
            ]
        );

        // Text Color Control (Hover)
        $this->add_control(
            'text_color_hover',
            [
                'label' => __('Text Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-megamenu-home-item:hover .tp-megamenu-home-title .red.wpr-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Background Color Control (Hover)
        $this->add_control(
            'background_color_hover',
            [
                'label' => __('Background Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-title:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // Border Control (Hover)
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border_hover',
                'label' => __('Border', 'wprealizer'),
                'selector' => '{{WRAPPER}} .wpr-title:hover',
            ]
        );

        // Padding Control (Hover)
        $this->add_responsive_control(
            'content_padding_hover',
            [
                'label' => __('Padding', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-title:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control (Hover)
        $this->add_responsive_control(
            'content_margin_hover',
            [
                'label' => __('Margin', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-title:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // End Hover Tab

        $this->end_controls_tabs();
        $this->end_controls_section();
        // End Style Tab
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

        <?php if ($settings['wpr_design_style']  == 'layout-2') :
            $img = tp_get_img($settings, 'wpr_home_banner_thumb', 'full', false);
            $btn_id = 'theme_btn';
            $this->tp_link_attributes_render('theme_btn', 'tp-btn' . '', $this->get_settings());
        ?>

            <div class="el-wprealizer-megamenu-2">
                <div class="megamenu-demo-small p-relative">
                    <div class="tp-megamenu-small-content">
                        <div class="row tp-gx-50">

                            <div class="col-xl-6">
                                <div class="tp-megamenu-list">

                                    <?php foreach ($settings['wpr_home_demo_list'] as $item) :
                                        $attrs = tp_get_repeater_links_attr($item, 'home_demo');
                                        extract($attrs);

                                        $links_attrs = [
                                            'href' => $link,
                                            'target' => $target,
                                            'rel' => $rel,
                                        ]
                                    ?>
                                        <a <?php echo tp_implode_html_attributes($links_attrs); ?>><?php echo tp_kses($item['wpr_home_demo_title']) ?></a>
                                    <?php endforeach; ?>

                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="tp-megamenu-list">
                                    <?php foreach ($settings['wpr_home_demo_list_2'] as $item) :
                                        $attrs = tp_get_repeater_links_attr($item, 'home_demo_2');
                                        extract($attrs);

                                        $links_attrs = [
                                            'href' => $link,
                                            'target' => $target,
                                            'rel' => $rel,
                                        ]
                                    ?>
                                        <a <?php echo tp_implode_html_attributes($links_attrs); ?>><?php echo tp_kses($item['wpr_home_demo_title_2']) ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp-megamenu-small-cta-wrap d-none d-xl-block">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="tp-megamenu-small-cta d-flex">
                                    <?php if (!empty($img)) : ?>
                                        <div class="tp-megamenu-small-cta-thumb">
                                            <img src="<?php echo esc_url($img['wpr_home_banner_thumb']) ?>" alt="<?php echo esc_attr($img['wpr_home_banner_thumb_alt']); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['wpr_home_banner_title'])) : ?>
                                        <h4 class="tp-megamenu-small-cta-title"><?php echo tp_kses($settings['wpr_home_banner_title']); ?></h4>
                                    <?php endif; ?>
                                    <div class="tp-megamenu-small-cta-btn">
                                        <?php if (!empty($settings['wpr_' . $btn_id . '_text'])): ?>
                                            <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>
                                                <?php echo $settings['wpr_' . $btn_id . '_text']; ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else : ?>



        <div class="nav-item-wrapper el-wprealizer-megamenu">
            <?php foreach ($settings['wpr_home_demo_list'] as $item) :
                $img = tp_get_img($item, 'wpr_home_demo_thumb', 'full', false);
                $attrs = tp_get_repeater_links_attr($item, 'home_demo');
                extract($attrs);

                $links_attrs = [
                    'href' => $link,
                    'target' => $target,
                    'rel' => $rel,
                ];

                $active_class = $item['wpr_menu_active'] ? 'active' : NULL;
            ?>
            <div class="nav-item text-center position-relative <?php echo esc_attr($active_class); ?>">
                <div class="nav-item-img overflow-hidden position-relative">
                    <img class="w-100" src="<?php echo esc_url($img['wpr_home_demo_thumb']) ?>" alt="<?php echo esc_attr($img['wpr_home_demo_thumb_alt']); ?>">
                </div>
                <h6 class="h6 wpr-title"><?php echo tp_kses($item['wpr_home_demo_title']) ?></h6>
                <a class="position-absolute h-100 w-100 start-0 top-0 z-index-one"
                    <?php echo tp_implode_html_attributes($links_attrs); ?>></a>
            </div>
            <?php endforeach; ?>
        </div>



<?php endif;
    }
}

$widgets_manager->register(new WPR_Home_Demo());
