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
class WPR_Hero_Slider extends Widget_Base
{

    use \WPRCore\Widgets\WPR_Style_Trait;

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
        return 'wpr-slider';
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
        return __(WPRCORE_THEME_NAME . ' - Hero Slider', 'wprealizer');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'wprealizer'),
                'description' => esc_html__('Control all the style settings from Style tab', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wpr_slider_dots_enable',
            [
                'label' => esc_html__('Enable Dots Navigation?', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
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
            'wpr_slider_content_bg',
            [
                'label' => esc_html__('Content Background Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-10']
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
                    // 'style_2' => __('Style 2', 'wprealizer'),
                    // 'style_3' => __('Style 3', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'wpr_slider_image',
            [
                'label' => esc_html__('Upload Slider Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'wpr_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subtitle here', 'wprealizer'),
                'placeholder' => esc_html__('Type subtitle here', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_10'],
                ]
            ]
        );
        $repeater->add_control(
            'wpr_slider_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is title', 'wprealizer'),
                'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_10'],
                ]
            ]
        );
        $repeater->add_control(
            'wpr_slider_title_tag',
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
            'wpr_slider_desc',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Type Content', 'wprealizer'),
                'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_10'
                ]
            ]
        );

        $repeater->add_control(
            'tp_btn_link_switcher',
            [
                'label' => esc_html__('Button', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_10'],
                ]
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
                'condition' => [
                    'repeater_condition' => ['style_10'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ],
                'condition' => [
                    'repeater_condition' => ['style_10'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button Link', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'wprealizer'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_link_switcher' => 'yes',
                ],
                'condition' => [
                    'repeater_condition' => ['style_10'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_link_switcher' => 'yes',
                ],
                'condition' => [
                    'repeater_condition' => ['style_10'],
                ]
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'wpr_slider_title' => esc_html__('Slider title 1', 'wprealizer')
                    ],
                    [
                        'wpr_slider_title' => esc_html__('Slider title 2', 'wprealizer')
                    ],
                    [
                        'wpr_slider_title' => esc_html__('Slider title 3', 'wprealizer')
                    ],
                ],
                'title_field' => '{{{ wpr_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tp_image_slider',
            [
                'label' => esc_html__('Image Slider', 'wprealizer'),
                'description' => esc_html__('Control all the style settings from Style tab', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => 'layout-10',
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'wpr_slider_bottom_image',
            [
                'label' => esc_html__('Upload Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'wpr_slider_number',
            [
                'label' => esc_html__('Number', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('01', 'wprealizer'),
                'placeholder' => esc_html__('Type your number here', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'slider_image_list',
            [
                'label' => esc_html__('Slider List', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'wpr_slider_number' => esc_html__('Slider Image 1', 'wprealizer')
                    ],
                    [
                        'wpr_slider_number' => esc_html__('Slider Image 2', 'wprealizer')
                    ],
                    [
                        'wpr_slider_number' => esc_html__('Slider Image 3', 'wprealizer')
                    ],
                ],
                'title_field' => '{{{ wpr_slider_number }}}',
            ]
        );
        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        // $this->tp_section_style_controls('heading_section', 'Section - Style', '.tp-el-section');
        // $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        // $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
        // $this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-content', 'layout-20');
        // $this->tp_link_controls_style('', 'btn1_style', 'Button', '.tp-btn');

        $this->start_controls_section(
            'wpr_slider_img_section',
            [
                'label' => esc_html__('Project Image', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_slider_img_w',
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
                    '{{WRAPPER}} .wpr-el-rep-img img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpr_slider_img_h',
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
                    '{{WRAPPER}} .wpr-el-rep-img img' => 'min-height: {{SIZE}}{{UNIT}};',
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
            <!-- slider-area-start -->
            <section class="slider-area tp-slider-5-wrap tp-el-section">

                <div class="slider tp-slider-5-active">
                    <?php foreach ($settings['slider_list'] as $key => $item):
                        $this->add_render_attribute('title_args', 'class', 'tp-el-title tp-slider-5-title p-relative');

                        // thumbnail 
                        if (!empty($item['wpr_slider_image']['url'])) {
                            $wpr_slider_image_url = !empty($item['wpr_slider_image']['id']) ? wp_get_attachment_image_url($item['wpr_slider_image']['id'], $settings['thumbnail_size']) : $item['wpr_slider_image']['url'];
                            $wpr_slider_image_alt = get_post_meta($item["wpr_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        // btn Link
                        if ('2' == $item['tp_btn_link_type']) {
                            $link = get_permalink($item['tp_btn_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                            $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                        }

                    ?>
                        <div class="tp-slider-5-bg" style="background-image: url(<?php echo esc_attr($wpr_slider_image_url); ?>)">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="tp-slider-5-content">

                                            <?php if (!empty($item['wpr_slider_sub_title'])): ?>
                                                <span class="tp-el-subtitle">
                                                    <?php echo tp_kses($item['wpr_slider_sub_title']); ?>
                                                </span>
                                            <?php endif; ?>

                                            <?php if (!empty($item['wpr_slider_title'])):
                                                printf(
                                                    '<%1$s %2$s>%3$s %4$s</%1$s>',
                                                    tag_escape($item['wpr_slider_title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    tp_kses($item['wpr_slider_title']),
                                                    ''
                                                );
                                            endif;
                                            ?>

                                            <?php if (!empty($link)): ?>
                                                <div class="tp-slider-5-btn">
                                                    <a class="tp-btn-white tp-btn" target="<?php echo esc_attr($target); ?>"
                                                        rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                                        <?php echo tp_kses($item['tp_btn_text']); ?>
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

                <div class="slider tp-slider-5-arrow">
                    <?php foreach ($settings['slider_image_list'] as $key => $item):
                        if (!empty($item['wpr_slider_bottom_image']['url'])) {
                            $wpr_slider_bottom_image_url = !empty($item['wpr_slider_bottom_image']['id']) ? wp_get_attachment_image_url($item['wpr_slider_bottom_image']['id'], $settings['thumbnail_size']) : $item['wpr_slider_bottom_image']['url'];
                            $wpr_slider_bottom_image_alt = get_post_meta($item["wpr_slider_bottom_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                        <div class="tp-slider-5-next">
                            <div class="tp-slider-5-thumb-sm">
                                <img src="<?php echo esc_url($wpr_slider_bottom_image_url); ?>"
                                    alt="<?php echo esc_attr($wpr_slider_bottom_image_alt); ?>">

                                <?php if (!empty($item['wpr_slider_number'])): ?>
                                    <span>
                                        <?php echo tp_kses($item['wpr_slider_number']); ?>
                                    </span>
                                <?php endif; ?>

                                <div class="tp-slider-5-next-hover"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </section>
            <!-- slider-area-end -->

        <?php elseif ($settings['wpr_design_style'] == 'layout-3'): ?>

        <?php else: ?>

          <!-- image-slider__area start  -->
          <div class="image-slider__area">
            <div class="swiper image-slider">
              <div class="swiper-wrapper">
                <?php foreach ($settings['slider_list'] as $key => $item):
                   // thumbnail 
                    if (!empty($item['wpr_slider_image']['url'])) {
                        $wpr_slider_image_url = !empty($item['wpr_slider_image']['id']) ? wp_get_attachment_image_url($item['wpr_slider_image']['id'], $settings['thumbnail_size']) : $item['wpr_slider_image']['url'];
                        $wpr_slider_image_alt = get_post_meta($item["wpr_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                <div class="swiper-slide wpr-el-rep-img">
                  <img src="<?php echo esc_url($wpr_slider_image_url); ?>"
                   alt="<?php echo esc_attr($wpr_slider_image_alt); ?>">
                </div>
                <?php endforeach; ?>
              </div>
              <div class="autoplay-progress">
                <svg viewBox="0 0 48 48">
                  <circle cx="24" cy="24" r="20"></circle>
                </svg>
                <span></span>
              </div>
            </div>
          </div>
          <!-- image-slider__area end  -->

<?php endif;
    }
}

$widgets_manager->register(new WPR_Hero_Slider());
