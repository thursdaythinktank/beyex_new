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
class TP_Kindergarten extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait;
    use \WPRCore\Widgets\WPR_Animation_Trait;

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
        return 'tp-shape';
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
        return __(WPRCORE_THEME_NAME . ' :: Kindergarten', 'wprealizer');
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
        $this->wpr_design_layout('Select Layout', 1);

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', ['layout-1']);


        $this->start_controls_section(
            'tp_list_sec',
            [
                'label' => esc_html__('List Items', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_shape_enable',
            [
                'label' => esc_html__('Enable Shape Line?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_shape_line_image',
            [
                'label' => esc_html__('Shape Line Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_enable' => 'yes',
                ],
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
                    //'style_2' => __('Style 2', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_tag_icon_type',
            [
                'label' => esc_html__('Icon Type', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'wprealizer'),
                        'icon' => 'eicon-nerd-wink',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'wprealizer'),
                        'icon' => 'fa fa-image',
                    ],
                    'svg' => [
                        'title' => esc_html__('Svg', 'wprealizer'),
                        'icon' => 'fas fa-code',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_tag_icon_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',

                ],
                'condition' => [
                    'tp_tag_icon_type' => 'icon',
                ]
            ]
        );

        $repeater->add_control(
            'svg',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __('Svg Code', 'wprealizer'),
                'default' => __('Svg Code Here', 'wprealizer'),
                'placeholder' => __('Type Svg Code here', 'wprealizer'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tp_tag_icon_type' => 'svg',
                ],
            ]
        );

        $repeater->add_control(
            'tp_text_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tp Slide Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_title_tag',
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
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $repeater->add_control(
            'tp_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is description text here.', 'wprealizer'),
                'placeholder' => esc_html__('Type section description here', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_responsive_control(
            'tp_single_icon_border_radius',
            [
                'label' => esc_html__('Icon Border Radius', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-process-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'single_service_icon_bgcolor',
                'label' => esc_html__('Icon Bg Color', 'wprealizer'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-process-icon',

            ]
        );

        $repeater->add_responsive_control(
            'tp_align',
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

        $repeater->add_responsive_control(
            'tp_section_margin',
            [
                'label' => esc_html__('Iteam Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .tp-el-process-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tp_slider_list',
            [
                'label' => esc_html__('Text List', 'wprealizer'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_text_title' => esc_html__('Art Direction', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Branding', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Content Production', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Animation', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ tp_text_title }}}',
            ]
        );

        $this->end_controls_section();

        // shape image controls
        $this->start_controls_section(
            'tp_shape_sec',
            [
                'label' => esc_html__('Shape Image Controls', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_theme_shape_switch',
            [
                'label' => esc_html__('Shape Switch', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_shape_image',
            [
                'label' => esc_html__('Shape Image 1', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image2',
            [
                'label' => esc_html__('Shape Image 2', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image3',
            [
                'label' => esc_html__('Shape Image 3', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image4',
            [
                'label' => esc_html__('Shape Image 4', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image5',
            [
                'label' => esc_html__('Shape Image 5', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image6',
            [
                'label' => esc_html__('Shape Image 6', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image7',
            [
                'label' => esc_html__('Shape Image 7', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image8',
            [
                'label' => esc_html__('Shape Image 8', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image9',
            [
                'label' => esc_html__('Shape Image 9', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_shape_image10',
            [
                'label' => esc_html__('Shape Image 10', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();


        // button controls
        $this->start_controls_section(
            'tp_theme_btn_button_group',
            [
                'label' => esc_html__('Button', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_theme_btn_button_show',
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
            'tp_theme_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'wprealizer'),
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'tp_theme_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_theme_btn_line_effect',
            [
                'label' => esc_html__('Line Effect', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'tp_theme_btn_button_show' => 'yes',
                    'wpr_design_style!' => ['layout-1', 'layout-2', 'layout-3']
                ],
            ]
        );

        $this->add_control(
            'tp_theme_btn_icon_show',
            [
                'label' => esc_html__('Add Icon ?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->tp_single_icon_control('theme_btn', 'tp_theme_btn_icon_show', 'yes');

        $this->add_control(
            'tp_theme_btn_icon_position',
            [
                'label' => esc_html__('Choose Icon Position', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
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
                    'tp_theme_btn_icon_show' => 'yes',
                    'wpr_design_style' => ['layout-1', 'layout-4']
                ],
            ]
        );

        $this->add_control(
            'tp_theme_btn_link_type',
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
                    'tp_theme_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_theme_btn_link',
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
                    'tp_theme_btn_link_type' => '1',
                    'tp_theme_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_theme_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_types_post('page'),
                'condition' => [
                    'tp_theme_btn_link_type' => '2',
                    'tp_theme_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // animation
        $this->tp_creative_animation(['layout-1']);
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-content');

        // section btn 
        $this->start_controls_section(
            'tp_kindergarten_btn_sec',
            [
                'label' => esc_html__('Section Button', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tp_kindergarten_btn_typo',
                'label'   => esc_html__('Section Label', 'textdomain'),
                'selector' => '{{WRAPPER}} .item_class',
            ]
        );


        $this->end_controls_section();

        $this->tp_basic_style_controls('item_title', 'Item Title', '.tp-el-item-title');
        $this->tp_basic_style_controls('item_desc', 'Item Description', '.tp-el-item-desc');
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
        $btn_id = 'theme_btn';
?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'):
            $bg = !empty($settings['tp_shape_custom_bg_code']) ? $settings['tp_shape_custom_bg_code'] : NULL;

            $attrs = [
                'class' => 'tp-theme-shape-custom d-inline-block tp-el-shape-custom',
            ];

            if (!is_null($bg)) {
                $attrs['style'] = 'background: ' . $bg;
            }
        ?>

            <div <?php echo tp_implode_html_attributes($attrs); ?>></div>

        <?php else:
            $img = tp_get_img($settings, 'tp_shape_image', 'tp_image_size');
            $img2 = tp_get_img($settings, 'tp_shape_image2', 'tp_image_size');
            $img3 = tp_get_img($settings, 'tp_shape_image3', 'tp_image_size');
            $img4 = tp_get_img($settings, 'tp_shape_image4', 'tp_image_size');
            $img5 = tp_get_img($settings, 'tp_shape_image5', 'tp_image_size');
            $img6 = tp_get_img($settings, 'tp_shape_image6', 'tp_image_size');
            $img7 = tp_get_img($settings, 'tp_shape_image7', 'tp_image_size');
            $img8 = tp_get_img($settings, 'tp_shape_image8', 'tp_image_size');
            $img9 = tp_get_img($settings, 'tp_shape_image9', 'tp_image_size');
            $img10 = tp_get_img($settings, 'tp_shape_image10', 'tp_image_size');
            $tp_shape_line_image = tp_get_img($settings, 'tp_shape_line_image', 'tp_image_size');


            $animation = $this->tp_animation_show($settings);

            $attrs = [
                'class' => "tp-process-3-shape-1 " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];

            $attrs_row = [
                'class' => "row " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];

            $this->add_render_attribute('title_args', 'class', 'tp-section-2-title tp-el-title');

            $line_effect = $settings['tp_theme_btn_line_effect'] == 'yes' ? ' themepure-theme-btn-line-effect' : '';
            $this->tp_link_attributes_render('theme_btn', 'tp-el-theme-btn tp-process-3-btn' . $line_effect, $this->get_settings());
        ?>

            <!-- process-area-start -->
            <section class="process-area tp-process-3-bg fix">
                <div class="container">
                    <div <?php echo tp_implode_html_attributes($attrs_row); ?>>
                        <div class="col-xxl-6 col-lg-8">
                            <div class="tp-process-3-wrap">
                                <div class="tp-section-2">
                                    <?php
                                    if (!empty($settings['tp_section_title'])):
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_section_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($settings['tp_section_title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($settings['tp_section_description'])): ?>
                                        <p class="tp-el-content">
                                            <?php echo tp_kses($settings['tp_section_description']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
                                    <div class="tp-process-3-btn">
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

                                            <?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
                                                <?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
                                            <?php endif; ?>


                                            <?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
                                                <span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
                                            <?php endif; ?>


                                            <?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
                                                <?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="tp-process-3-wrapper">
                        <div <?php echo tp_implode_html_attributes($attrs_row); ?>>
                            <?php foreach ($settings['tp_slider_list'] as $key => $item):
                                $this->add_render_attribute('item_title_args', 'class', 'tp-process-3-title tp-el-item-title');
                            ?>
                                <div class="col-lg-4 col-sm-6 elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                    <div class="tp-process-3-item tp-process-3-item-1 tp-align tp-el-process-items">
                                        <div class="tp-process-3-icon">
                                            <span class="pink-border tp-el-process-icon">
                                                <?php if ($item['tp_tag_icon_type'] === 'image' && ($item['image']['url'] || $item['image']['id'])):
                                                    $this->get_render_attribute_string('image');
                                                    $item['hover_animation'] = 'disable-animation';
                                                ?>
                                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'image'); ?>
                                                <?php elseif (!empty($item['icon'])): ?>
                                                    <?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
                                                <?php elseif (!empty($item['svg'])): ?>
                                                    <?php echo $item['svg']; ?>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div class="tp-process-3-content">

                                            <?php
                                            if (!empty($item['tp_text_title'])):
                                                printf(
                                                    '<%1$s %2$s><a %4$s>%3$s</a></%1$s>',
                                                    tag_escape($item['tp_title_tag']),
                                                    $this->get_render_attribute_string('item_title_args'),
                                                    tp_kses($item['tp_text_title']),
                                                    $this->get_render_attribute_string('tp-button-arg')
                                                );
                                            endif;
                                            ?>

                                            <?php if (!empty($item['tp_description'])): ?>
                                                <p class="tp-el-item-desc">
                                                    <?php echo tp_kses($item['tp_description']); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if (!empty($settings['tp_shape_enable'])): ?>
                            <div <?php echo tp_implode_html_attributes($attrs); ?>>
                                <span>
                                    <img src="<?php echo esc_url($tp_shape_line_image['tp_shape_line_image']) ?>"
                                        alt="<?php echo esc_url($tp_shape_line_image['tp_shape_line_image_alt']) ?>">
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="tp-process-3-shape">

                    <?php if (!empty($img['tp_shape_image'])): ?>
                        <div class="tp-process-3-shape-2">
                            <img src="<?php echo esc_url($img['tp_shape_image']) ?>"
                                alt="<?php echo esc_url($img['tp_shape_image_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img2['tp_shape_image2'])): ?>
                        <div class="tp-process-3-shape-3">
                            <img src="<?php echo esc_url($img2['tp_shape_image2']) ?>"
                                alt="<?php echo esc_url($img2['tp_shape_image2_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img3['tp_shape_image3'])): ?>
                        <div class="tp-process-3-shape-4">
                            <img src="<?php echo esc_url($img3['tp_shape_image3']) ?>"
                                alt="<?php echo esc_url($img3['tp_shape_image3_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img4['tp_shape_image4'])): ?>
                        <div class="tp-process-3-shape-5">
                            <img src="<?php echo esc_url($img4['tp_shape_image4']) ?>"
                                alt="<?php echo esc_url($img4['tp_shape_image4_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img5['tp_shape_image5'])): ?>
                        <div class="tp-process-3-shape-6">
                            <img src="<?php echo esc_url($img5['tp_shape_image5']) ?>"
                                alt="<?php echo esc_url($img5['tp_shape_image5_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img6['tp_shape_image6'])): ?>
                        <div class="tp-process-3-shape-7">
                            <img src="<?php echo esc_url($img6['tp_shape_image6']) ?>"
                                alt="<?php echo esc_url($img6['tp_shape_image6_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img7['tp_shape_image7'])): ?>
                        <div class="tp-process-3-shape-8">
                            <img src="<?php echo esc_url($img7['tp_shape_image7']) ?>"
                                alt="<?php echo esc_url($img7['tp_shape_image7_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img8['tp_shape_image8'])): ?>
                        <div class="tp-process-3-shape-9">
                            <img src="<?php echo esc_url($img8['tp_shape_image8']) ?>"
                                alt="<?php echo esc_url($img8['tp_shape_image8_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img9['tp_shape_image9'])): ?>
                        <div class="tp-process-3-shape-10">
                            <img src="<?php echo esc_url($img9['tp_shape_image9']) ?>"
                                alt="<?php echo esc_url($img9['tp_shape_image9_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img10['tp_shape_image10'])): ?>
                        <div class="tp-process-3-shape-11">
                            <img src="<?php echo esc_url($img10['tp_shape_image10']) ?>"
                                alt="<?php echo esc_url($img10['tp_shape_image10_alt']) ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_theme_shape_switch'])): ?>
                        <div class="tp-process-3-shape-12"></div>
                        <div class="tp-process-3-shape-13"></div>
                        <div class="tp-process-3-shape-14"></div>
                        <div class="tp-process-3-shape-15"></div>
                        <div class="tp-process-3-shape-16"></div>
                        <div class="tp-process-3-shape-17"></div>
                    <?php endif; ?>
                </div>
            </section>
            <!-- process-area-end -->

<?php endif;
    }
}

$widgets_manager->register(new TP_Kindergarten());
