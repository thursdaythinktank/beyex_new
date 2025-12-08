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
class WPR_Repeater_Box extends Widget_Base
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
        return 'wpr-repeater-box';
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
        return __(WPRCORE_THEME_NAME . ' - Repeater Box', 'wprealizer');
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
            'wpr_icon_box_section',
            [
                'label' => esc_html__('Box Contents', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        tp_render_icon_controls($repeater, 'icon_box', );

        $repeater->add_control(
            'wpr_rep_animation_delay',
            [
                'label' => esc_html__('Repeater Animation Delay', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('.2s', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_10', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'wpr_rep_title',
            [
                'label' => esc_html__('Repeater Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Repeater Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'wpr_rep_desc',
            [
                'label' => esc_html__('Repeater Decription', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Repeater Decription', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );

        $repeater->add_control(
            'wpr_rep_style_options',
            [
                'label' => esc_html__('Enable Style Option', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'wpr_rep_title_color',
            [
                'label' => esc_html__('Repeater Title Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .wpr-el-title' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
                'condition' => [
                    'wpr_rep_style_options' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'wpr_number_box_bg_color',
            [
                'label' => esc_html__('Number Box Bg Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'wpr_rep_style_options' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'wpr_number_box_bg_hv_color',
            [
                'label' => esc_html__('Number Box Bg Hover Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover::before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'wpr_rep_style_options' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'wpr_number_color',
            [
                'label' => esc_html__('Number Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}::before' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'wpr_rep_style_options' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'wpr_number_hv_color',
            [
                'label' => esc_html__('Number Hover Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover::before' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'wpr_rep_style_options' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'wpr_slider_list',
            [
                'label' => esc_html__('Text List', 'wprealizer'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'wpr_rep_title' => esc_html__('Needs Assessment', 'wprealizer'),
                    ],
                    [
                        'wpr_rep_title' => esc_html__('Strategy Development', 'wprealizer'),
                    ],
                    [
                        'wpr_rep_title' => esc_html__('Consultation Solution', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ wpr_rep_title }}}',
            ]
        );

        $this->add_responsive_control(
            'wpr_align',
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

        $this->end_controls_section();

        // animation
        $this->tp_creative_animation();
    }


    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('wpr-repeater_section', 'Section - Style', '.wpr-el-section');
        $this->tp_basic_style_controls('wpr_repeater_title', 'Repeater Title', '.wpr-el-rep-title');
        $this->tp_basic_style_controls('wpr_repeater_description', 'Repeater Description', '.wpr-el-rep-desc');
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

        <?php if ($settings['wpr_design_style'] == 'layout-2'):
            $animation = $this->tp_animation_show($settings);
            $attrs = [
                'class' => "tp-awards-item tp-hover-reveal-item p-relative " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
        ?>

<div class="contact-us-fin__info-cards wpr-el-section elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
    <?php foreach ($settings['wpr_slider_list'] as $key => $item): ?>
    <div class="contact-us-fin__info-card fade_up_anim" data-delay="<?php esc_attr($item['wpr_rep_animation_delay']); ?>">
        <figure class="card-icon">
            <?php tp_render_signle_icon_html($item, 'icon_box'); ?>
        </figure>
        <div class="card-content">
            <?php if (!empty($item['wpr_rep_title'])): ?>
            <h6 class="h6 wpr-el-rep-title">
                 <?php echo $item['wpr_rep_title']; ?>
            </h6>
            <?php endif; ?>

            <?php if (!empty($item['wpr_rep_title'])): ?>
            <span class="card-info wpr-el-rep-desc">
                 <?php echo $item['wpr_rep_desc']; ?>
            </span>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>



        <?php else:
            $animation = $this->tp_animation_show($settings);
            $attrs = [
                'class' => "about-ca__content " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
        ?>

            <div <?php echo tp_implode_html_attributes($attrs); ?>>
                <?php foreach ($settings['wpr_slider_list'] as $key => $item): ?>
                <div class="about-list elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                    <div class="list-wrapper">
                        <?php if (!empty($item['wpr_rep_title'])): ?>
                        <h5 class="h5 wpr-el-rep-title">
                            <?php echo $item['wpr_rep_title']; ?>
                        </h5>
                        <?php endif; ?>

                        <?php if (!empty($item['wpr_rep_desc'])): ?>
                        <p class="wpr-el-rep-desc">
                           <?php echo $item['wpr_rep_desc']; ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new WPR_Repeater_Box());
