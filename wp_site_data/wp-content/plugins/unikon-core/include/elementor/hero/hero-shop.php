<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Shop_Slider extends Widget_Base
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
        return 'tp-slider-shop';
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
        return __(WPRCORE_THEME_NAME . ' :: Hero Shop Slider', 'wprealizer');
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

        $this->wpr_design_layout('Design Layout', 1);



        $this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'wprealizer'),
                'description' => esc_html__('Control all the style settings from Style tab', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_slider_dots_enable',
            [
                'label' => esc_html__('Enable Dots Navigation?', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
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
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'tp_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subtitle here', 'wprealizer'),
                'placeholder' => esc_html__('Type subtitle here', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is title', 'wprealizer'),
                'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_slider_title_tag',
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
            'tp_btn_link_switcher',
            [
                'label' => esc_html__('Button', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'wprealizer'),
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => false,
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ],
            ]
        );

        tp_render_links_controls($repeater, 'shop_hero');

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Slider title 1', 'wprealizer')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Slider title 2', 'wprealizer')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Slider title 3', 'wprealizer')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('heading_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-content', 'layout-20');
        $this->tp_link_controls_style('', 'btn1_style', 'Button', '.tp-btn');


        $this->start_controls_section(
            '_section_style_dot',
            [
                'label' => __('Dot Style', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tp_slider_dots_enable' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'tp_dot_horizontal_offset',
            [
                'label' => esc_html__('Horizontal Position', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp_el_nav_dot' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_control(
            'tp_dot_vertical_offset',
            [
                'label' => esc_html__('Vertical Position', 'wprealizer'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp_el_nav_dot' => 'bottom: {{SIZE}}{{UNIT}} !important;',
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
        $settings = $this->get_settings_for_display(); ?>


        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>


        <?php elseif ($settings['wpr_design_style'] == 'layout-3'):


        ?>


        <?php else: ?>

            <div class="tp-shop-banner-active swiper tp-el-section">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['slider_list'] as $key => $item):
                        $img = tp_get_img($item, 'tp_slider_image', 'full', false);
                        $attrs = tp_get_repeater_links_attr($item, 'shop_hero');
                        extract($attrs);

                        $links_attrs = [
                            'href' => $link,
                            'target' => $target,
                            'rel' => $rel,
                        ];

                        $this->add_render_attribute('title_args', 'class', 'tp-shop-banner-title tp-el-title');
                    ?>
                        <div class="swiper-slide">
                            <div class="container">
                                <div class="row">
                                    <?php if (!empty($img['tp_slider_image'])): ?>
                                        <div class="col-lg-7">
                                            <div class="tp-shop-banner-thumb">
                                                <img src="<?php echo esc_url($img['tp_slider_image']); ?>"
                                                    alt="<?php echo esc_url($img['tp_slider_image_alt']); ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-lg-5">
                                        <div class="tp-shop-banner-content">

                                            <?php if (!empty($item['tp_slider_sub_title'])): ?>
                                                <span class="tp-el-subtitle">
                                                    <?php echo tp_kses($item['tp_slider_sub_title']); ?>
                                                </span>
                                            <?php endif; ?>


                                            <?php if (!empty($item['tp_slider_title'])):
                                                printf(
                                                    '<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($item['tp_slider_title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    tp_kses($item['tp_slider_title']),
                                                );
                                            endif;
                                            ?>

                                            <?php if (!empty($link) && ($item['tp_btn_link_switcher'] == 'yes')): ?>
                                                <div class="tp-shop-banner-btn">
                                                    <a class="tp-btn" <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                                        <?php echo tp_kses($item['tp_btn_text']); ?>
                                                        <span>
                                                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if ($settings['tp_slider_dots_enable'] == 'yes'): ?>
                <div class="tp-shop-banner-dot tp_el_nav_dot"></div>
            <?php endif; ?>

<?php endif;
    }
}

$widgets_manager->register(new TP_Hero_Shop_Slider());
