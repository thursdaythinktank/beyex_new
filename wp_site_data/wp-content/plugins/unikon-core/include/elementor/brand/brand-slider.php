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
class WPR_Brand_Slider extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Animation_Trait, WPR_Column_Trait;

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
        return 'wpr-brand-slider';
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
        return __(WPRCORE_THEME_NAME . ' - Brand Slider', 'wprealizer');
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
        $this->register_content_controls();
        $this->style_tab_content();
    }

    protected function register_content_controls()
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

        // brand section
        $this->start_controls_section(
            'wpr_brand_title_settings',
            [
                'label' => __('Section - Title', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['wpr_design_style' => ['layout-2']],
            ]
        );

        $this->add_control(
            'wpr_brand_slide_title',
            [
                'label' => esc_html__('Title', 'wprcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'default' => esc_html__('Used by World Leading Companies', 'wprcore'),
                'placeholder' => esc_html__('Widget Title', 'wprcore'),

            ]
        );

        $this->add_responsive_control(
            'wpr_heading_align',
            [
                'label' => esc_html__('Alignment', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__(
                            'Left',
                            'wprealizer'
                        ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'wprealizer'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__(
                            'Right',
                            'wprealizer'
                        ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .wpr-align-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // brand section
        $this->start_controls_section(
            'wpr_brand_gallery_settings',
            [
                'label' => __('Brand Logo', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wpr_brand_slide_gallery',
            [
                'label' => esc_html__('Add Images', 'wprcore'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->end_controls_section();

        // animation
        $this->tp_creative_animation('');
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('wpr_brand_slide_section', 'Section - Style', '.wpr-el-section');
        $this->tp_basic_style_controls('wpr_brand_title', 'Section - Title', '.wpr-el-brand-title');

        $this->start_controls_section(
            'wpr_image_style_sec',
            [
                'label' => esc_html__('Image Styles', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wpr_image_style_width',
            [
                'label' => esc_html__('Width', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-brand-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_image_style_height',
            [
                'label' => esc_html__('Height', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-brand-img img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpr-el-brand-img img' => 'object-fit: {{VALUE}};',
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
        $layout = $settings['wpr_design_style'];
        $animation = $this->tp_animation_show($settings);
?>

        <?php if ($layout === 'layout-2') : ?>

            <!-- Brand area start here -->
            <?php if ($settings['wpr_brand_slide_gallery']) : ?>
                <div class="wpr-el-section hero-mar__brand <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                    <?php if (!empty($settings['wpr_brand_slide_title'])) : ?>
                        <p class="wpr-el-brand-title wpr-align-box title"><?php echo tp_kses($settings['wpr_brand_slide_title']); ?></p>
                    <?php endif; ?>
                    <div class="swiper brand__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['wpr_brand_slide_gallery'] as $image) : ?>
                                <div class="swiper-slide">
                                    <div class="brand-box wpr-el-brand-img">
                                        <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- Brand area end here -->
            <?php endif; ?>

        <?php elseif ($layout === 'layout-3') : ?>

            <div class="clients-digital__items <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <?php foreach ($settings['wpr_brand_slide_gallery'] as $image) : ?>
                    <div class="item-box wpr-el-brand-img" >
                        <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($layout === 'layout-4') : ?>

            <!-- Clients Start  -->
            <div class="clients-la__area">
                <div class="container-fluid">
                    <div class="swiper clients-la__items">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['wpr_brand_slide_gallery'] as $image) : ?>
                            <div class="swiper-slide clients-la__item wpr-el-brand-img">
                                <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Clients End  -->

        <?php elseif ($layout === 'layout-5') : ?>

        <!--  brand slider start -->
        <div class="brand__area">
            <div class="swiper brand__slider--extend pseudo-reset">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['wpr_brand_slide_gallery'] as $image) : ?>
                    <div class="swiper-slide">
                        <div class="brand-box wpr-el-brand-img">
                            <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!--  brand slider end -->

        <?php elseif ($layout === 'layout-6') : ?>

        <!-- Brand start -->
        <div class="brand-health__area <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
            <div class="container container-2xl">
                <div class="row">
                    <div class="col-12">
                        <div class="brand-health__slider-outer-wrapper">
                            <div class="swiper brand-health__slider pseudo-reset">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['wpr_brand_slide_gallery'] as $image) : ?>
                                    <div class="swiper-slide brand-health__item wpr-el-brand-img">
                                        <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Brand end -->


        <?php else: ?>

            <?php if ($settings['wpr_brand_slide_gallery']) : ?>
                <div class="brand-area <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                    <div class="swiper pseudo-reset brand__slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['wpr_brand_slide_gallery'] as $image) : ?>
                                <div class="swiper-slide">
                                    <div class="brand-box wpr-el-brand-img">
                                        <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>


<?php
    }
}

$widgets_manager->register(new WPR_Brand_Slider());
