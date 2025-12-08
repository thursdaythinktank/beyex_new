<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use WPRCore\Elementor\Controls\Group_Control_WPRGradient;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Link_Text extends Widget_Base
{

    use WPR_Style_Trait, WPR_Animation_Trait, WPR_Icon_Trait;

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
        return 'wpr-link-text';
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
        return __(WPRCORE_THEME_NAME . ' - Link Text', 'wprealizer');
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
                    // 'layout-2' => esc_html__('Layout 2', 'wprealizer'),
                    // 'layout-3' => esc_html__('Layout 3', 'wprealizer'),
                    // 'layout-4' => esc_html__('Layout 4', 'wprealizer'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // title/content
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Title & Description', 'wprealizer'),
            ]
        );

        $this->add_control(
            'wpr_link_text_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('let’s start with us', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_link_text_icon_show',
            [
                'label' => esc_html__('Add Icon ?', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->tp_single_icon_control('linK_btn', 'wpr_link_text_icon_show', 'yes');

        $this->add_control(
            'wpr_link_text_icon_position',
            [
                'label' => esc_html__('Choose Icon Position', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'wprealizer'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'wprealizer'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
                'condition' => [
                    'wpr_link_text_icon_show' => 'yes'
                ],
            ]
        );

        tp_render_links_controls($this, 'link_text');

        $this->end_controls_section();

        // animation
        $this->tp_creative_animation();
    }

    protected function style_tab_content()
    {
        $this->start_controls_section(
            'wpr_link_text_style_sec',
            [
                'label' => esc_html__('Text Style', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpr_link_text_typography',
                'label' => esc_html__('Typhography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .wpr-el-link-text',
            ]
        );

        $this->add_control(
            'wpr_link_text_icon_image_size',
            [
                'label' => esc_html__('Icon Image Size', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100000,
                        'step' => 10,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-link-text .link-text-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'wpr_link_text_icon_show' => 'yes',
                    'wpr_link_text_icon_type' => 'image'
                ],
            ]
        );

        $this->add_control(
            'wpr_link_text_icon_size',
            [
                'label' => esc_html__('Icon Size', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-link-text .link-text-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'wpr_link_text_icon_show' => 'yes',
                    'wpr_link_text_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'wpr_link_text_icon_svg_size',
            [
                'label' => esc_html__('Icon SVG Size', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-link-text .link-text-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'wpr_link_text_icon_show' => 'yes',
                    'wpr_link_text_icon_type' => 'svg'
                ],
            ]
        );


        $this->start_controls_tabs(
            'wpr_link_text_state_tabs',
        );

        // button normal state
        $this->start_controls_tab(
            'wpr_link_text_normal_tab',
            [
                'label' => esc_html__('Normal', 'wprealizer'),
            ]
        );

        $this->add_control(
            'wpr_link_text_color',
            [
                'label' => esc_html__('Text Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-link-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_link_icon_color',
            [
                'label' => esc_html__('Icon Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-mar__area .text-slide h2.h2 i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_link_Border_color',
            [
                'label' => esc_html__('Content Border Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-mar__area .text-slide h2.h2' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_link_text_icon_color',
            [
                'label' => esc_html__('Icon Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-link-text .link-text-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'wpr_link_text_icon_show' => 'yes',
                    'wpr_link_text_icon_type' => 'icon'
                ],
            ]
        );


        $this->end_controls_tab();
        // end normal state


        $this->end_controls_tabs();
        // end button state tabs

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

        <?php if ($settings['wpr_design_style'] == 'layout-2'):
            $animation = $this->tp_animation_show($settings);
        ?>



        <?php else:
            $animation = $this->tp_animation_show($settings);

            $attrs = [];

            $attrs = tp_get_repeater_links_attr($settings, 'link_text');
            extract($attrs);

            $links_attrs = [
                'href' => $link,
                'rel' => $rel,
                'class' => 'wpr-el-link-text'
            ];
        ?>

            <!-- cta-mar__area end  -->
            <div class="cta-mar__area <?php echo esc_attr($animation['animation']) ?>">
                <div class="text-slide">
                    <h2 class="h2">
                        <span>
                            <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                <?php echo $settings['wpr_link_text_title']; ?>
                                <?php if (($settings['wpr_link_text_icon_position'] == 'left')): ?>
                                    <?php tp_render_signle_icon_html($settings, 'linK_btn', 'link-text-icon on-left'); ?>
                                <?php endif; ?>

                                <?php if (($settings['wpr_link_text_icon_position'] == 'right')): ?>
                                    <?php tp_render_signle_icon_html($settings, 'linK_btn', 'link-text-icon on-right'); ?>
                                <?php endif; ?>
                            </a>
                        </span>
                        <i class="bi bi-arrow-up-right"></i>
                    </h2>
                </div>
            </div>
            <!-- cta-mar__area end  -->

<?php endif;
    }
}

$widgets_manager->register(new WPR_Link_Text());
