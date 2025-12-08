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
class WPR_Testimonial_Slider extends Widget_Base
{

    use \WPRCore\Widgets\WPR_Style_Trait;
    use \WPRCore\Widgets\WPR_Animation_Trait;
    use \WPRCore\Widgets\WPR_Icon_Trait;

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
        return 'wpr-testimonial-slider';
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
        return __(WPRCORE_THEME_NAME . ' - Testimonial Slider', 'wprealizer');
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
                'layout-3' => esc_html__('Layout 3', 'wprealizer'),
                'layout-4' => esc_html__('Layout 4', 'wprealizer'),
                'layout-5' => esc_html__('Layout 5', 'wprealizer'),
                'layout-6' => esc_html__('Layout 6', 'wprealizer'),
            ],
            'default' => 'layout-1',
        ]
    );

    $this->end_controls_section();

        // testimonial content section
        $this->start_controls_section(
            'wpr_testimonial_content_section',
            [
                'label' => __('Testimonial Content', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_title',
            [
                'label' => esc_html__('Section Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Section Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_description',
            [
                'label' => esc_html__('Section Description', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // testimonial section
        $this->start_controls_section(
            'wpr_testimonial_section',
            [
                'label' => __('Testimonial Repeater Item', 'wprealizer'),
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
                    'style_3' => __('Style 3', 'wprealizer'),
                    'style_4' => __('Style 4', 'wprealizer'),
                    'style_5' => __('Style 5', 'wprealizer'),
                    'style_6' => __('Style 6', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'wpr_testi_rating',
            [
                'label' => esc_html__('Select Rating Count', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__('Single Star', 'wprealizer'),
                    '2' => esc_html__('2 Star', 'wprealizer'),
                    '3' => esc_html__('3 Star', 'wprealizer'),
                    '4' => esc_html__('4 Star', 'wprealizer'),
                    '5' => esc_html__('5 Star', 'wprealizer'),
                ],
                'default' => '5',
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_6']
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_avatar',
            [
                'label' => esc_html__('Testimonial Avatar', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_footer_logo',
            [
                'label' => esc_html__('Testimonial Footer Logo', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        ); 

        $repeater->add_control(
            'testimonial_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Testimonial Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Content', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nulla ut enim non magna placerat scelerisque sed eu dolor. Sed eu faucibus turpis. Ut bibendum tempor tempus. Ut scelerisque est posuere ex pretium laoreet.', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label' => esc_html__('Name', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('David Prutra', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'testimonial_position',
            [
                'label' => esc_html__('Position', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Designer', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_date',
            [
                'label' => esc_html__('Date', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('09/07/24', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_6']
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_shape_img',
            [
                'label' => esc_html__('Shape Image 1', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_40']
                ]
            ]
        );

        $repeater->add_control(
            'testimonial_shape_img2',
            [
                'label' => esc_html__('Shape Image 2', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_40']
                ]
            ]
        );

        $repeater->add_control(
            'wpr_testi_box_bg_color',
            [
                'label' => esc_html__('Box Bg Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'repeater_condition' => ['style_5']
                ]
            ]
        );

        $this->add_control(
            'wpr_testimonial_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Testimonial Item', 'wprealizer'),
                'default' => [
                    [
                        'testimonial_name' => __('Stifin Shkaya', 'wprealizer')
                    ],
                    [
                        'testimonial_name' => __('Jhone jaouy', 'wprealizer')
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        // wpr_testimonial_vedio_section
        $this->start_controls_section(
            'wpr_testimonial_vedio_section',
            [
                'label' => __('Vedio Content', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_vedio_title',
            [
                'label' => esc_html__('Vedio Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Vedio Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_tag_icon_type',
            [
                'label' => esc_html__('Vedio Icon Type', 'wprealizer'),
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

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_tag_icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'solid',

                ],
                'condition' => [
                    'wpr_tag_icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
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
                    'wpr_tag_icon_type' => 'svg',
                ],
            ]
        );

        $this->add_control(
            'wpr_vedio_link',
            [
                'label' => esc_html__('Vedio Link', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'wprealizer'),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();


        // image
        $this->start_controls_section(
            'wpr_image_sec',
            [
                'label' => esc_html__('Image Section', 'wprealizer'),
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_shape_image',
            [
                'label' => esc_html__('Shape Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_shape_image2',
            [
                'label' => esc_html__('Shape Image 2', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_shape_svg_code',
            [
                'label' => esc_html__('Shape SVG Code', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Default Shape SVG Code', 'wprealizer'),
                'placeholder' => esc_html__('Type your Shape SVG Code here', 'wprealizer'),
            ]
        );

        $this->end_controls_section();

        // additional info
        $this->start_controls_section(
            'wpr_add_info_sec',
            [
                'label' => esc_html__('Additional Info', 'wprealizer'),
            ]
        );

        $this->add_control(
            'wpr_shape_show',
            [
                'label' => esc_html__('Shape Image Show', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_slider_arrow',
            [
                'label' => esc_html__('Next/Prev Arrow Show', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'wpr_design_style' => ['layout-1', 'layout-3', 'layout-4', 'layout-5', 'layout-6']
                ]
            ]
        );

        $this->add_control(
            'wpr_arrow_img',
            [
                'label' => esc_html__('Arrow Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_slider_arrow' => 'yes',
                    'wpr_design_style' => ['layout-3', 'layout-5', 'layout-6']
                ]
            ]
        );

        $this->add_control(
            'wpr_arrow_img2',
            [
                'label' => esc_html__('Arrow Image 2', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_slider_arrow' => 'yes',
                    'wpr_design_style' => ['layout-3', 'layout-5', 'layout-6']
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('testimonial', 'Section - Style', '.wpr-el-section');
        $this->tp_basic_style_controls('testimonial_heading_title', 'Testimonial Heading Title', '.wpr-el-title');
        $this->tp_basic_style_controls('testimonial_heading_desc', 'Testimonial Heading Description', '.wpr-el-desc');
        $this->tp_icon_style(null, 'testimonial_avator', '.wpr-el-rep-avator', 'Avator - Icon/Image/SVG');
        $this->tp_basic_style_controls('testimonial_rep_title', 'Testimonial Title', '.wpr-el-rep-title');
        $this->tp_basic_style_controls('testimonial_rep_content', 'Testimonial Content', '.wpr-el-rep-content');
        $this->tp_basic_style_controls('testimonial_rep_name', 'Testimonial Name', '.wpr-el-testi-name');
        $this->tp_basic_style_controls('testimonial_rep_designation', 'Testimonial Designation', '.wpr-el-rep-desi');

        $this->start_controls_section(
            'wpr_testi__avator_section',
            [
                'label' => esc_html__('Avator Image', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_testi__avator_w',
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
                    '{{WRAPPER}} .wpr-el-rep-avator img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpr_testi__avator_h',
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
                    '{{WRAPPER}} .wpr-el-rep-avator img' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_image_object_style',
            [
                'label' => esc_html__('Object Fit', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'none' => esc_html__('None', 'wprealizer'),
                    'contain'  => esc_html__('Contain', 'wprealizer'),
                    'cover' => esc_html__('Cover', 'wprealizer'),
                    'fill' => esc_html__('fill', 'wprealizer'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-rep-avator img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

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

        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

        <!-- testimonial-mar__area start  -->
        <div class="testimonial-mar__area">
            <div class="container container-left-auto">
                <div class="row">
                    <div class="col-12">
                        <div class="swiper testimonial-mar__slider">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['wpr_testimonial_slides'] as $key => $item):
                                    // avata img
                                    $testi_avatar = tp_get_img($item, 'testimonial_avatar', 'full', false);
                                    $testi_avatar_alt = get_post_meta($item["testimonial_avatar"]["id"], "_wp_attachment_image_alt", true);

                                    // footer logo
                                    $testi_foot_logo = tp_get_img($item, 'testimonial_footer_logo', 'full', false);
                                ?>
                                <div class="swiper-slide testimonial-mar__item">
                                    <div class="testimonial-mar__item-body">
                                        <?php if (!empty($item['wpr_testi_rating'])): ?>
                                        <ul class="custom-ul testimonial-mar__item-ratings wpr-el-rep-star">
                                            <?php
                                            $wpr_rating = $item['wpr_testi_rating'];
                                            $wpr_rating_minus = 5 - $item['wpr_testi_rating'];
                                            for ($i = 1; $i <= $wpr_rating; $i++):
                                            ?>
                                                <li><i class="fas fa-star"></i></li>
                                            <?php endfor; ?>
                                            <?php
                                            for ($i = 1; $i <= $wpr_rating_minus; $i++):
                                            ?>
                                                <li><i class="fa-regular fa-star"></i></li>
                                            <?php endfor; ?>
                                        </ul>
                                        <?php endif; ?>

                                        <?php if (!empty($item['testimonial_content'])): ?>
                                        <p class="wpr-el-rep-content">
                                            <?php echo tp_kses($item['testimonial_content']); ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="testimonial-mar__item-footer">
                                        <div class="testimonial-mar__author">
                                            <?php if (!empty($item['testimonial_avatar'])): ?>
                                            <div class="author-thumb wpr-el-rep-avator">
                                                <img src="<?php echo esc_url($testi_avatar['testimonial_avatar']); ?>" alt="<?php echo esc_attr($testi_avatar_alt); ?>">
                                            </div>
                                            <?php endif; ?>
                                            <div class="author-info">
                                                <?php if (!empty($item['testimonial_name'])): ?>
                                                <h6 class="h6 author-name wpr-el-testi-name">
                                                    <?php echo tp_kses($item['testimonial_name']); ?>
                                                </h6>
                                                <?php endif; ?>

                                                <?php if (!empty($item['testimonial_position'])): ?>
                                                <span class="wpr-el-rep-desi author-position">
                                                    <?php echo tp_kses($item['testimonial_position']); ?>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if (!empty($item['testimonial_footer_logo'])): ?>
                                        <div class="testimonial-mar__item-footer-logo">
                                            <img src="<?php echo esc_url($testi_foot_logo['testimonial_footer_logo']); ?>" alt="testi-img">
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial-mar__area end  -->


        <?php elseif ($settings['wpr_design_style'] == 'layout-3'):

            if (!empty($settings['wpr_arrow_img']['url'])) {
                $wpr_arrow_img_url = !empty($settings['wpr_arrow_img']['id']) ? wp_get_attachment_image_url($settings['wpr_arrow_img']['id'], 'full') . '' : $settings['wpr_arrow_img']['url'];
                $wpr_arrow_img_alt = get_post_meta($settings["wpr_arrow_img"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['wpr_arrow_img2']['url'])) {
                $wpr_arrow_img2_url = !empty($settings['wpr_arrow_img2']['id']) ? wp_get_attachment_image_url($settings['wpr_arrow_img2']['id'], 'full') . '' : $settings['wpr_arrow_img2']['url'];
                $wpr_arrow_img2_alt = get_post_meta($settings["wpr_arrow_img2"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

                <div class="swiper testimonial-sa__slider">
                    <div class="swiper-wrapper h-100">
                        <?php foreach ($settings['wpr_testimonial_slides'] as $key => $item):

                            $testi_avatar = tp_get_img($item, 'testimonial_avatar', 'full', false);
                            $testi_avatar_alt = get_post_meta($item["testimonial_avatar"]["id"], "_wp_attachment_image_alt", true);
                        ?>
                        <div class="swiper-slide h-100">
                            <div class="testimonial-sa__slider-card">
                                <?php if (!empty($item['testimonial_avatar'])): ?>
                                <div class="testimonial-sa__slider-thumb wpr-el-rep-avator">
                                    <img src="<?php echo esc_url($testi_avatar['testimonial_avatar']); ?>" alt="<?php echo esc_attr($testi_avatar_alt); ?>">
                                </div>
                                <?php endif; ?>

                                <div class="testimonial-sa__slider-content">
                                    <div class="testimonial-sa__slider-content-body">
                                        <?php if (!empty($item['testimonial_title'])): ?>
                                        <h5 class="h5 wpr-el-rep-title">
                                        <?php echo tp_kses($item['testimonial_title']); ?>
                                        </h5>
                                        <?php endif; ?>

                                        <?php if (!empty($item['testimonial_content'])): ?>
                                        <p class="wpr-el-rep-content">
                                            <?php echo tp_kses($item['testimonial_content']); ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="testimonial-sa__slider-content-footer">
                                        <?php if (!empty($item['testimonial_name'])): ?>
                                        <span class="author-title wpr-el-testi-name">
                                        <?php echo tp_kses($item['testimonial_name']); ?>
                                        </span>
                                        <?php endif; ?>

                                        <?php if (!empty($item['testimonial_position'])): ?>
                                        <span class="author-designation wpr-el-rep-desi">
                                        <?php echo tp_kses($item['testimonial_position']); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (!empty($settings['wpr_slider_arrow'])): ?>
                <div class="testimonial-sa__slider-controller">
                    <?php if (!empty($settings['wpr_arrow_img']['url'])): ?>
                    <span class="testimonial-sa__slider-controller-prev">
                        <img src="<?php echo esc_url($wpr_arrow_img_url) ?>"
                        alt="<?php echo esc_attr($wpr_arrow_img_alt) ?>">
                    </span>
                    <?php endif; ?>


                    <?php if (!empty($settings['wpr_arrow_img2']['url'])): ?>
                    <span class="testimonial-sa__slider-controller-next">
                        <img src="<?php echo esc_url($wpr_arrow_img2_url) ?>"
                        alt="<?php echo esc_attr($wpr_arrow_img2_alt) ?>">
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>


        <?php elseif ($settings['wpr_design_style'] == 'layout-4'): ?>

                <!-- Testimonial Start  -->
                <div class="swiper testimonial-la__slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['wpr_testimonial_slides'] as $key => $item):

                            $testi_avatar = tp_get_img($item, 'testimonial_avatar', 'full', false);
                            $testi_avatar_alt = get_post_meta($item["testimonial_avatar"]["id"], "_wp_attachment_image_alt", true);
                        ?>
                        <div class="swiper-slide testimonial-la__slider-item">
                            <div class="author">
                                <?php if (!empty($item['testimonial_avatar'])): ?>
                                <figure class="author__avatar wpr-el-rep-avator">
                                    <img src="<?php echo esc_url($testi_avatar['testimonial_avatar']); ?>" alt="<?php echo esc_attr($testi_avatar_alt); ?>">
                                </figure>
                                <?php endif; ?>

                                <div class="author__info">
                                    <?php if (!empty($item['testimonial_name'])): ?>
                                    <h6 class="h6 author__title wpr-el-testi-name">
                                        <?php echo tp_kses($item['testimonial_name']); ?>
                                    </h6>
                                    <?php endif; ?>

                                    <?php if (!empty($item['testimonial_position'])): ?>
                                    <p class="author__designation wpr-el-rep-desi">
                                        <?php echo tp_kses($item['testimonial_position']); ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (!empty($item['testimonial_content'])): ?>
                            <div class="author__testimonial pt-65 wpr-el-rep-content">
                              <?php echo tp_kses($item['testimonial_content']); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (!empty($settings['wpr_slider_arrow'])): ?>
                    <div class="swiper-pagination"></div>
                    <?php endif; ?>
                </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-5'):

            if (!empty($settings['wpr_arrow_img']['url'])) {
                $wpr_arrow_img_url = !empty($settings['wpr_arrow_img']['id']) ? wp_get_attachment_image_url($settings['wpr_arrow_img']['id'], 'full') . '' : $settings['wpr_arrow_img']['url'];
                $wpr_arrow_img_alt = get_post_meta($settings["wpr_arrow_img"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['wpr_arrow_img2']['url'])) {
                $wpr_arrow_img2_url = !empty($settings['wpr_arrow_img2']['id']) ? wp_get_attachment_image_url($settings['wpr_arrow_img2']['id'], 'full') . '' : $settings['wpr_arrow_img2']['url'];
                $wpr_arrow_img2_alt = get_post_meta($settings["wpr_arrow_img2"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <div class="swiper testimonial-health__slider">
            <div class="swiper-wrapper">
                <?php foreach ($settings['wpr_testimonial_slides'] as $key => $item):

                    $testi_avatar = tp_get_img($item, 'testimonial_avatar', 'full', false);
                    $testi_avatar_alt = get_post_meta($item["testimonial_avatar"]["id"], "_wp_attachment_image_alt", true);
                ?>
                <div class="swiper-slide testimonial-health__slider-item   elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                    <div class="testimonial-health__content">
                        <?php if (!empty($item['testimonial_title'])): ?>
                        <h5 class="h5 wpr-el-rep-title">
                            <?php echo tp_kses($item['testimonial_title']); ?>
                        </h5>
                        <?php endif; ?>

                        <?php if (!empty($item['testimonial_content'])): ?>
                        <p class="wpr-el-rep-content">
                            <?php echo tp_kses($item['testimonial_content']); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="testimonial-health__author">
                        <div class="testimonial-health__author-info">
                            <?php if (!empty($item['testimonial_avatar'])): ?>
                            <figure class="testimonial-health__author-thumb wpr-el-rep-avator">
                                <img src="<?php echo esc_url($testi_avatar['testimonial_avatar']); ?>" alt="<?php echo esc_attr($testi_avatar_alt); ?>">
                            </figure>
                            <?php endif; ?>

                            <div class="testimonial-health__author-content">
                                <?php if (!empty($item['testimonial_name'])): ?>
                                <h6 class="h6 author-title wpr-el-testi-name">
                                <?php echo tp_kses($item['testimonial_name']); ?>
                                </h6>
                                <?php endif; ?>

                                <?php if (!empty($item['testimonial_position'])): ?>
                                <span class="author-position wpr-el-rep-desi">
                                    <?php echo tp_kses($item['testimonial_position']); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 68 68"
                            fill="none"
                            class="quote">
                            <path
                                d="M67.3955 39.1053L57.6867 58.9467C57.0445 60.2617 55.7222 61.0739 54.3245 61.0739H44.6155C43.2178 61.0739 42.3111 59.5655 42.9156 58.2892L52.8889 37.8676H43.4444C40.3089 37.8676 37.7778 35.2762 37.7778 32.066V12.7274C37.7778 9.51716 40.3089 6.92578 43.4444 6.92578H62.3333C65.4689 6.92578 68 9.51716 68 12.7274V36.5139C68 37.4034 67.8111 38.2931 67.3955 39.1053ZM30.2222 36.5139V12.7274C30.2222 9.51716 27.6911 6.92578 24.5556 6.92578H5.66667C2.53111 6.92578 0 9.51716 0 12.7274V32.066C0 35.2762 2.53111 37.8676 5.66667 37.8676H15.1111L5.13778 58.2892C4.49556 59.5655 5.43999 61.0739 6.83777 61.0739H16.5467C17.9822 61.0739 19.3045 60.2617 19.9089 58.9467L29.6178 39.1053C29.9955 38.2931 30.2222 37.4034 30.2222 36.5139Z"
                                fill="currentColor" fill-opacity="0.1"/>
                        </svg>
                    </div>
                </div>  
                <?php endforeach; ?>
            </div>

            <?php if (!empty($settings['wpr_slider_arrow'])): ?>
            <div class="testimonial-health__navigation">
                <?php if (!empty($settings['wpr_arrow_img']['url'])): ?>
                <div class="testimonial-health-prev slider-health-arrow common-btn__variation8--extend common-btn__variation8--extend-2">
                    <span>
                        <img src="<?php echo esc_url($wpr_arrow_img_url) ?>" alt="<?php echo esc_attr($wpr_arrow_img_alt) ?>">
                    </span>
                </div>
                <?php endif; ?>

                <?php if (!empty($settings['wpr_arrow_img2']['url'])): ?>
                <div class="testimonial-health-next slider-health-arrow common-btn__variation8--extend common-btn__variation8--extend-2">
                    <span>
                        <img src="<?php echo esc_url($wpr_arrow_img2_url) ?>" alt="<?php echo esc_attr($wpr_arrow_img2_alt) ?>">
                    </span>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>


        <?php elseif ($settings['wpr_design_style'] == 'layout-6'):

            if (!empty($settings['wpr_arrow_img']['url'])) {
                $wpr_arrow_img_url = !empty($settings['wpr_arrow_img']['id']) ? wp_get_attachment_image_url($settings['wpr_arrow_img']['id'], 'full') . '' : $settings['wpr_arrow_img']['url'];
                $wpr_arrow_img_alt = get_post_meta($settings["wpr_arrow_img"]["id"], "_wp_attachment_image_alt", true);
            }
            if (!empty($settings['wpr_arrow_img2']['url'])) {
                $wpr_arrow_img2_url = !empty($settings['wpr_arrow_img2']['id']) ? wp_get_attachment_image_url($settings['wpr_arrow_img2']['id'], 'full') . '' : $settings['wpr_arrow_img2']['url'];
                $wpr_arrow_img2_alt = get_post_meta($settings["wpr_arrow_img2"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <!-- testimonial-fin start -->
        <div class="testimonial-fin wpr-el-section">
            <?php if (!empty($settings['wpr_slider_arrow'])): ?>
            <div class="row testimonial-fin__navigation-outer">
                <div class="col-12 testimonial-fin__navigation">
                    <?php if (!empty($settings['wpr_arrow_img']['url'])): ?>
                    <div  class="testimonial-fin-prev common-btn__variation9 common-btn__variation9--extend arrow">
                        <img src="<?php echo esc_url($wpr_arrow_img_url) ?>" alt="<?php echo esc_attr($wpr_arrow_img_alt) ?>">
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['wpr_arrow_img2']['url'])): ?>
                    <div class="testimonial-fin-next common-btn__variation9 common-btn__variation9--extend arrow">
                        <img src="<?php echo esc_url($wpr_arrow_img2_url) ?>" alt="<?php echo esc_attr($wpr_arrow_img2_alt) ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="swiper testimonial-fin__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['wpr_testimonial_slides'] as $key => $item):
                            ?>
                            <div class="swiper-slide">
                                <div class="testimonial-fin__item">
                                    <div class="flex-grow-1">
                                        <div class="testimonial-fin__item-header">
                                            <?php if (!empty($item['testimonial_name'])): ?>
                                            <h6 class="h6 testimonial-fin__item-title wpr-el-testi-name">
                                                <?php echo tp_kses($item['testimonial_name']); ?>
                                            </h6>
                                            <?php endif; ?>

                                            <?php if (!empty($item['testimonial_date'])): ?>
                                            <span class="testimonial-fin__item-date wpr-el-rep-desi">
                                            <?php echo tp_kses($item['testimonial_date']); ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if (!empty($item['testimonial_content'])): ?>
                                        <div class="testimonial-fin__item-body">
                                            <p class="wpr-el-rep-content">
                                                <?php echo tp_kses($item['testimonial_content']); ?>
                                            </p>
                                        </div>
                                        <?php endif; ?>

                                        <div class="testimonial-fin__item-footer">
                                            <?php if (!empty($item['wpr_testi_rating'])): ?>
                                            <ul class="custom-ul testimonial-fin__item-ratings wpr-el-rep-star">
                                                <?php
                                                $wpr_rating = $item['wpr_testi_rating'];
                                                $wpr_rating_minus = 5 - $item['wpr_testi_rating'];
                                                for ($i = 1; $i <= $wpr_rating; $i++):
                                                ?>
                                                    <li><i class="fas fa-star"></i></li>
                                                <?php endfor; ?>
                                                <?php
                                                for ($i = 1; $i <= $wpr_rating_minus; $i++):
                                                ?>
                                                    <li><i class="fa-regular fa-star"></i></li>
                                                <?php endfor; ?>
                                            </ul>
                                            <?php endif; ?>

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="60"
                                                height="60"
                                                viewBox="0 0 60 60"
                                                fill="none"
                                                >
                                                <path
                                                    d="M59.4667 34.4197L50.9 51.596C50.3333 52.7344 49.1667 53.4375 47.9333 53.4375H39.3667C38.1333 53.4375 37.3333 52.1317 37.8667 51.0268L46.6667 33.3482H38.3333C35.5667 33.3482 33.3333 31.1049 33.3333 28.3259V11.5848C33.3333 8.8058 35.5667 6.5625 38.3333 6.5625H55C57.7667 6.5625 60 8.8058 60 11.5848V32.1763C60 32.9464 59.8333 33.7165 59.4667 34.4197ZM26.6667 32.1763V11.5848C26.6667 8.8058 24.4333 6.5625 21.6667 6.5625H5C2.23333 6.5625 0 8.8058 0 11.5848V28.3259C0 31.1049 2.23333 33.3482 5 33.3482H13.3333L4.53334 51.0268C3.96667 52.1317 4.79999 53.4375 6.03333 53.4375H14.6C15.8667 53.4375 17.0333 52.7344 17.5667 51.596L26.1333 34.4197C26.4667 33.7165 26.6667 32.9464 26.6667 32.1763Z"
                                                    fill="currentColor"
                                                    />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial-fin end -->


        <?php else:

        ?>

        <!-- Testimonial-digital Start -->
        <div class="testimonial-digital wpr-el-section">
            <div class="container container-mini">
                <div class="row">
                    <div class="col-12">
                        <div class="swiper testimonial-digital__slider">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['wpr_testimonial_slides'] as $key => $item):

                                    $testi_avatar = tp_get_img($item, 'testimonial_avatar', 'full', false);
                                    $testi_avatar_alt = get_post_meta($item["testimonial_avatar"]["id"], "_wp_attachment_image_alt", true);
                                ?>
                                <div class="swiper-slide testimonial-digital__item">
                                    <div class="testimonial-digital__item-content">
                                        <?php if (!empty($item['wpr_testi_rating'])): ?>
                                        <ul class="custom-ul rating wpr-el-rep-star">
                                            <?php
                                            $wpr_rating = $item['wpr_testi_rating'];
                                            $wpr_rating_minus = 5 - $item['wpr_testi_rating'];
                                            for ($i = 1; $i <= $wpr_rating; $i++):
                                            ?>
                                                <li><i class="fas fa-star"></i></li>
                                            <?php endfor; ?>
                                            <?php
                                            for ($i = 1; $i <= $wpr_rating_minus; $i++):
                                            ?>
                                                <li><i class="fa-regular fa-star"></i></li>
                                            <?php endfor; ?>
                                        </ul>
                                        <?php endif; ?>

                                        <?php if (!empty($item['testimonial_content'])): ?>
                                        <p class="wpr-el-rep-content">
                                            <?php echo tp_kses($item['testimonial_content']); ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="testimonial-digital__item-author">
                                        <?php if (!empty($item['testimonial_avatar'])): ?>
                                        <div class="author-thumb wpr-el-rep-avator">
                                            <img src="<?php echo esc_url($testi_avatar['testimonial_avatar']); ?>" alt="<?php echo esc_attr($testi_avatar_alt); ?>">
                                        </div>
                                        <?php endif; ?>
                                        <div class="author-info">
                                            <?php if (!empty($item['testimonial_name'])): ?>
                                            <h5 class="wpr-el-testi-name h5">
                                                <?php echo tp_kses($item['testimonial_name']); ?>
                                            </h5>
                                            <?php endif; ?>

                                            <?php if (!empty($item['testimonial_position'])): ?>
                                            <span class="wpr-el-rep-desi">
                                                <?php echo tp_kses($item['testimonial_position']); ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (!empty($settings['wpr_slider_arrow'])): ?>
                            <div class="testimonial-digital__slider-pagination"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial-digital End -->


<?php endif;
    }
}

$widgets_manager->register(new WPR_Testimonial_Slider());
