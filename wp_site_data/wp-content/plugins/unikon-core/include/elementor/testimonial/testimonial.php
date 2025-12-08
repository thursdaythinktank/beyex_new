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
class WPR_Testimonial extends Widget_Base
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
        return 'wpr-testimonial';
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
        return __(WPRCORE_THEME_NAME . ' - Testimonial', 'wprealizer');
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
                // 'layout-3' => esc_html__('Layout 3', 'wprealizer'),
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
            ]
        );

        $this->add_control(
            'wpr_box_active',
            [
                'label' => esc_html__('Box Active', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'wpr_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
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
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'testimonial_avatar',
            [
                'label' => esc_html__('Testimonial Avatar', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'testimonial_bottom_logo',
            [
                'label' => esc_html__('Testimonial Bottom Logo', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-1']
                ]
            ]
        ); 

        $this->add_control(
            'testimonial_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Testimonial Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Content', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nulla ut enim non magna placerat scelerisque sed eu dolor. Sed eu faucibus turpis. Ut bibendum tempor tempus. Ut scelerisque est posuere ex pretium laoreet.', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonial_name',
            [
                'label' => esc_html__('Name', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('David Prutra', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'testimonial_position',
            [
                'label' => esc_html__('Position', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Designer', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'testimonial_shape_img',
            [
                'label' => esc_html__('Shape Image 1', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-10']
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
                    'wpr_design_style' => ['layout-1', 'layout-3', 'layout-4', 'layout-5']
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
                    'wpr_design_style' => ['layout-3', 'layout-5']
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
                    'wpr_design_style' => ['layout-3', 'layout-5']
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('testimonial', 'Section - Style', '.wpr-el-section');
        $this->tp_icon_style(null, 'testimonial_avator', '.wpr-el-avator', 'Avator - Icon/Image/SVG');
        $this->tp_basic_style_controls('testimonial_title', 'Testimonial Title', '.wpr-el-title');
        $this->tp_basic_style_controls('testimonial_content', 'Testimonial Content', '.wpr-el-content');
        $this->tp_basic_style_controls('testimonial_name', 'Testimonial Name', '.wpr-el-testi-name');
        $this->tp_basic_style_controls('testimonial_designation', 'Testimonial Designation', '.wpr-el-desi');

        $this->start_controls_section(
            'wpr_blog_post_avator_section',
            [
                'label' => esc_html__('Avator Image', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_blog_post_avator_w',
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
                    '{{WRAPPER}} .wpr-el-avator img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpr_blog_post_avator_h',
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
                    '{{WRAPPER}} .wpr-el-avator img' => 'min-height: {{SIZE}}{{UNIT}};',
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

            <div class="quote-fit__blockquote">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 109 103"
                fill="none"
              >
                <path
                  d="M62.7899 61.391C59.0179 41.9663 41.223 33.1386 23.0622 36.5785C25.1445 25.6798 35.3479 16.7686 41.9781 8.48475C42.9184 7.31006 43.403 5.24418 41.9781 4.13726C38.4829 1.42192 35.2208 0.576484 32.2158 1.00513C32.0074 0.43473 31.4556 0.00946991 30.7389 0.234807C20.0724 3.59341 13.1649 14.9873 8.54349 24.43C2.44526 36.8931 -0.614017 51.3209 0.102657 65.1698C1.23273 87.0032 20.7264 107.822 43.9395 101.761C60.8861 97.336 65.6961 76.3582 62.7899 61.391ZM19.3569 78.8623C19.3585 78.8549 19.3631 78.8504 19.3648 78.8436C19.4709 78.4342 19.5619 78.0208 19.6584 77.608C19.9724 78.0135 20.2576 78.4636 20.5095 78.9532C20.1114 79.0052 19.7239 79.0385 19.3535 79.0464C19.3512 78.982 19.3591 78.9244 19.3569 78.8623ZM14.4469 27.6243C14.727 27.744 15.0241 27.8197 15.3335 27.8485C14.4265 29.667 13.5901 31.5172 12.8368 33.4085C12.5414 33.3232 12.2319 33.2736 11.9162 33.2741C12.6831 31.3596 13.5416 29.4818 14.4469 27.6243ZM12.1184 83.046C12.8481 83.7999 13.6308 84.5223 14.4457 85.218C14.3238 85.3756 14.2204 85.545 14.1329 85.7229C13.4066 84.873 12.721 83.9897 12.1184 83.046ZM33.055 82.9709C32.1198 81.7499 31.4132 80.4018 30.9693 78.9295C30.9586 78.8211 30.923 78.7126 30.8643 78.6042C30.7276 78.0976 30.6198 77.5775 30.5509 77.0398C32.0847 79.1249 33.3176 81.4472 34.4612 83.7943C33.9682 83.5689 33.5006 83.2922 33.055 82.9709Z"
                  fill="#0F0F0F"
                  fill-opacity="0.08"/>
                <path
                  d="M66.327 33.0659C68.3799 24.7742 73.9789 19.0504 78.0462 11.5725C78.7075 10.3566 78.4478 8.46577 77.063 7.82251C74.5312 6.64613 72.2558 5.34098 69.7245 4.37242C68.9582 2.73859 66.6449 1.66612 64.8739 3.26211C61.7423 6.0842 58.3233 9.70371 55.5915 13.7474C51.9692 18.1909 49.3679 23.5843 48.5039 28.7721C48.4017 29.3866 48.5078 30.0095 48.7484 30.5776C48.618 30.8041 48.4869 31.0277 48.3559 31.2548C47.6946 32.4007 48.0713 33.9407 49.2341 34.6043C63.022 42.4657 68.7255 55.2665 68.3194 68.7539C67.6214 70.7216 67.4441 72.8467 67.7101 74.9832C66.5941 81.7704 64.0386 88.5667 60.2643 94.8434C59.4161 96.2536 59.7323 97.5734 60.5603 98.468C60.7771 99.1739 61.347 99.7709 62.3714 100.002C84.3528 104.968 106.467 94.448 108.852 70.4651C111.071 48.1483 87.8238 29.3408 66.327 33.0659ZM74.6893 95.0817C74.7667 95.0089 74.8356 94.9287 74.9118 94.8541C76.9297 94.6977 78.7742 94.1307 80.3414 93.2186C80.3595 93.2965 80.3713 93.3682 80.3899 93.4467C80.4408 93.6619 80.5503 93.8251 80.6379 94.0092C78.6985 94.5023 76.7089 94.8688 74.6893 95.0817ZM90.2805 53.1243C90.0721 53.5067 89.8891 53.8907 89.705 54.2753C89.6903 54.168 89.6881 54.0573 89.6717 53.95C89.6994 53.156 89.8394 52.3376 90.0552 51.5035C90.0783 51.5193 90.1043 51.5329 90.1275 51.5487C90.2381 52.0084 90.3285 52.4771 90.3991 52.9544C90.3624 53.0131 90.315 53.0622 90.2805 53.1243ZM100.782 77.1908C100.791 76.6667 100.782 76.1387 100.763 75.6073C101.108 75.0222 101.425 74.4218 101.695 73.8006C101.474 74.9871 101.151 76.1054 100.782 77.1908Z"
                  fill="#0F0F0F"
                  fill-opacity="0.08"/>
              </svg>
              <blockquote class="quote-fit__blockquote-content fade_up_anim"    data-delay=".2">
                <?php echo tp_kses($settings['testimonial_content']); ?>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="43"
                  height="43"
                  viewBox="0 0 43 43"
                  fill="none"
                >
                  <path
                    d="M18.2297 17.598C19.7177 25.2609 26.7377 28.7434 33.9021 27.3864C33.0806 31.6858 29.0554 35.2013 26.4398 38.4692C26.0689 38.9326 25.8777 39.7476 26.4398 40.1843C27.8187 41.2555 29.1055 41.589 30.291 41.4199C30.3732 41.6449 30.5909 41.8127 30.8736 41.7238C35.0815 40.3988 37.8065 35.904 39.6296 32.1789C42.0354 27.2623 43.2422 21.5706 42.9595 16.1073C42.5137 7.49406 34.8235 -0.718991 25.6661 1.67225C18.9807 3.41783 17.0832 11.6935 18.2297 17.598ZM35.3638 10.7056C35.3631 10.7085 35.3614 10.7103 35.3607 10.713C35.3188 10.8745 35.2829 11.0376 35.2448 11.2004C35.121 11.0405 35.0085 10.8629 34.9091 10.6698C35.0662 10.6493 35.219 10.6361 35.3651 10.633C35.366 10.6584 35.3629 10.6811 35.3638 10.7056ZM37.3008 30.9188C37.1903 30.8715 37.0731 30.8417 36.951 30.8303C37.3088 30.1129 37.6388 29.3831 37.936 28.6369C38.0525 28.6706 38.1746 28.6902 38.2991 28.6899C37.9966 29.4452 37.6579 30.186 37.3008 30.9188ZM38.2194 9.05517C37.9315 8.75774 37.6227 8.47279 37.3012 8.19831C37.3493 8.13615 37.3901 8.06931 37.4247 7.99913C37.7112 8.33443 37.9816 8.68288 38.2194 9.05517ZM29.96 9.0848C30.3289 9.56648 30.6076 10.0983 30.7827 10.6791C30.787 10.7219 30.801 10.7647 30.8242 10.8074C30.8781 11.0073 30.9206 11.2125 30.9478 11.4246C30.3427 10.602 29.8564 9.6859 29.4052 8.75997C29.5997 8.84886 29.7842 8.95803 29.96 9.0848Z"
                    fill="#0F0F0F"
                    fill-opacity="0.08"
                  />
                  <path
                    d="M16.8352 28.772C16.0253 32.043 13.8165 34.301 12.212 37.2511C11.9511 37.7307 12.0536 38.4766 12.5999 38.7304C13.5986 39.1945 14.4963 39.7094 15.4948 40.0914C15.7972 40.736 16.7097 41.1591 17.4084 40.5295C18.6438 39.4162 19.9926 37.9883 21.0702 36.3931C22.4992 34.6401 23.5254 32.5125 23.8663 30.4659C23.9066 30.2235 23.8647 29.9777 23.7698 29.7536C23.8213 29.6643 23.873 29.576 23.9247 29.4865C24.1856 29.0344 24.0369 28.4269 23.5782 28.1651C18.1389 25.0638 15.889 20.014 16.0491 14.6932C16.3245 13.917 16.3945 13.0787 16.2895 12.2358C16.7298 9.5583 17.7379 6.8772 19.2268 4.40108C19.5615 3.84476 19.4367 3.32409 19.1101 2.97118C19.0245 2.6927 18.7997 2.4572 18.3956 2.36586C9.72404 0.407057 1.00012 4.55703 0.0592599 14.0182C-0.816319 22.8221 8.35475 30.2415 16.8352 28.772ZM13.5363 4.30706C13.5057 4.3358 13.4785 4.36743 13.4485 4.39684C12.6524 4.45855 11.9248 4.68224 11.3065 5.04205C11.2994 5.01131 11.2947 4.98301 11.2874 4.95204C11.2673 4.86716 11.2241 4.80277 11.1896 4.73014C11.9546 4.53564 12.7395 4.39105 13.5363 4.30706ZM7.3856 20.859C7.46781 20.7082 7.53999 20.5567 7.61262 20.405C7.61842 20.4473 7.61931 20.491 7.62577 20.5333C7.61485 20.8466 7.5596 21.1694 7.47449 21.4985C7.46536 21.4922 7.45511 21.4869 7.44597 21.4806C7.40231 21.2993 7.36666 21.1144 7.33881 20.9261C7.35329 20.9029 7.37201 20.8835 7.3856 20.859ZM3.24275 11.3649C3.23941 11.5717 3.24275 11.78 3.25011 11.9896C3.1142 12.2204 2.98899 12.4573 2.8825 12.7024C2.96983 12.2343 3.09705 11.7931 3.24275 11.3649Z"
                    fill="#0F0F0F"
                    fill-opacity="0.08"
                  />
                </svg>
                <cite class="fade_up_anim" data-delay=".4">
                    <?php if (!empty($settings['testimonial_name'])): ?>
                    <span class="wpr-el-testi-name">
                        <?php echo tp_kses($settings['testimonial_name']); ?>
                    </span>
                    <?php endif; ?>
                  <span class="line"></span>
                </cite>
              </blockquote>
            </div>



        <?php elseif ($settings['wpr_design_style'] == 'layout-3'):

        ?>

        <?php elseif ($settings['wpr_design_style'] == 'layout-4'): ?>


        <?php elseif ($settings['wpr_design_style'] == 'layout-5'):

        ?>

        <?php else:

            $testi_avatar = tp_get_img($settings, 'testimonial_avatar', 'full', false);
            $testi_avatar_alt = get_post_meta($settings["testimonial_avatar"]["id"], "_wp_attachment_image_alt", true);

            $testi_bottom_logo = tp_get_img($settings, 'testimonial_bottom_logo', 'full', false);
            $testi_bottom_logo_alt = get_post_meta($settings["testimonial_bottom_logo"]["id"], "_wp_attachment_image_alt", true);

            $box_active_class = $settings['wpr_box_active'] === 'yes' ? 'active' : '';
        ?>


<div class="testimonial-ca__item fade_up_anim <?php echo esc_attr($box_active_class); ?>">
    <div class="testimonial-ca__item-author">
        <?php if (!empty($settings['testimonial_avatar'])): ?>
        <figure class="testimonial-ca__item-author-avatar wpr-el-avator">
            <img src="<?php echo esc_url($testi_avatar['testimonial_avatar']); ?>" alt="<?php echo esc_attr($testi_avatar_alt); ?>">
        </figure>
        <?php endif; ?>

        <div class="testimonial-ca__item-author-info">
            <?php if (!empty($settings['testimonial_name'])): ?>
            <h6 class="h6 title wpr-el-testi-name">
                <?php echo tp_kses($settings['testimonial_name']); ?>
            </h6>
            <?php endif; ?>

            <?php if (!empty($settings['testimonial_position'])): ?>
            <p class="wpr-el-desi">
                <?php echo tp_kses($settings['testimonial_position']); ?>
            </p>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($settings['testimonial_content'])): ?>
    <p class="testimonial-ca__item-content wpr-el-content">
        <?php echo tp_kses($settings['testimonial_content']); ?>
    </p>
    <?php endif; ?>

    <?php if (!empty($settings['testimonial_bottom_logo'])): ?>
    <div class="testimonial-ca__item-footer">
        <img src="<?php echo esc_url($testi_bottom_logo['testimonial_bottom_logo']); ?>" alt="<?php echo esc_attr($testi_bottom_logo_alt); ?>">
    </div>
    <?php endif; ?>
</div>

<?php endif;
    }
}

$widgets_manager->register(new WPR_Testimonial());
