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
class WPR_Service_Box extends Widget_Base
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
        return 'wpr-service-box';
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
        return __(WPRCORE_THEME_NAME . ' - Services Box', 'wprealizer');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // service content section
        $this->start_controls_section(
            'wpr_service_content_section',
            [
                'label' => __('Service Content', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'service_image',
            [
                'label' => esc_html__('Service Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'wpr_service_box_number',
            [
                'label' => esc_html__('Service Number', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('01', 'wprealizer'),
                'placeholder' => esc_html__('Enter Number', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-2', 'layout-3'],
                ]
            ]
        );

        $this->add_control(
            'wpr_service_subtitle',
            [
                'label' => esc_html__('Section Subtitle', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subtitle', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_service_title',
            [
                'label' => esc_html__('Service Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Section Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_service_desc',
            [
                'label' => esc_html__('Service Description', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Service Description', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'wprealizer'),
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => false,
            ]
        );

        // service link 
        tp_render_links_controls($this, 'service_link');

        $this->add_control(
            'service_animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('.2', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                // 'condition' => [
                //     'wpr_design_style' => ['layout-1']
                // ]
            ]
        );


        $this->end_controls_section();

        // wpr_service_vedio_section
        $this->start_controls_section(
            'wpr_service_vedio_section',
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

        // additional info
        $this->start_controls_section(
            'wpr_add_info_sec',
            [
                'label' => esc_html__('Additional Info', 'wprealizer'),
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
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
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->tp_basic_style_controls('service_el_number', 'Service Number', '.wpr-el-num', ['layout-2', 'layout-3']);

        $this->tp_basic_style_controls('service_el_title', 'Service Title', '.wpr-el-title');
        $this->tp_basic_style_controls('service_el_desc', 'Service Description', '.wpr-el-desc');

        $this->tp_link_controls_style('', 'service_btn1_style', 'Button', '.wpr-el-btn');

        $this->start_controls_section(
            'wpr_service_img_section',
            [
                'label' => esc_html__('Service Image', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_service_img_w',
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
                    '{{WRAPPER}} .wpr-el-img img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpr_service_img_h',
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
                    '{{WRAPPER}} .wpr-el-img img' => 'min-height: {{SIZE}}{{UNIT}};',
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

        <?php if ($settings['wpr_design_style'] == 'layout-2'):

            if (!empty($settings['service_image']['url'])) {
                $service_image = !empty($settings['service_image']['id']) ? wp_get_attachment_image_url($settings['service_image']['id']) : $settings['service_image']['url'];
                $service_image_alt = get_post_meta($settings["service_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $attrs = tp_get_repeater_links_attr($settings, 'service_link');
            extract($attrs);

            $links_attrs = [
                'href' => $link,
                'target' => $target,
                'rel' => $rel,
            ];
        ?>

            <div class="service__item">
                <div class="service__thumb service__thumb--extend fade_up_anim wpr-el-img" data-delay=".2">
                    <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                        <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_image_alt); ?>" />
                    </a>
                </div>

                <div class="service__content service__content--extend">

                    <span class="wpr-el-num service-number fade_up_anim" data-delay=".3"><?php echo tp_kses($settings['wpr_service_box_number']); ?></span>

                    <div class="service__info">


                        <?php if (!empty($settings['wpr_service_title'])): ?>
                            <h2 class="h2 fade_up_anim wpr-el-title" data-delay=".35">
                                <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                    <?php echo tp_kses($settings['wpr_service_title']); ?>
                                </a>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($settings['wpr_service_desc'])): ?>
                            <p class="wpr-el-desc fade_up_anim" data-delay=".4">
                                <?php echo tp_kses($settings['wpr_service_desc']); ?>
                            </p>
                        <?php endif; ?>

                        <div class="btn-group d-flex align-items-lg-center gap-3">
                            <a <?php echo tp_implode_html_attributes($links_attrs); ?> class="common-btn fade_up_anim wpr-el-btn">
                                <span></span><?php echo tp_kses($settings['wpr_btn_text']); ?></span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="21"
                                    height="12"
                                    viewBox="0 0 21 12"
                                    fill="none">
                                    <path
                                        d="M20.5303 6.53033C20.8232 6.23744 20.8232 5.76256 20.5303 5.46967L15.7574 0.696699C15.4645 0.403806 14.9896 0.403806 14.6967 0.696699C14.4038 0.989593 14.4038 1.46447 14.6967 1.75736L18.9393 6L14.6967 10.2426C14.4038 10.5355 14.4038 11.0104 14.6967 11.3033C14.9896 11.5962 15.4645 11.5962 15.7574 11.3033L20.5303 6.53033ZM0 6.75H20V5.25H0V6.75Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-3'):

            if (!empty($settings['service_image']['url'])) {
                $service_image = !empty($settings['service_image']['id']) ? wp_get_attachment_image_url($settings['service_image']['id']) : $settings['service_image']['url'];
                $service_image_alt = get_post_meta($settings["service_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $attrs = tp_get_repeater_links_attr($settings, 'service_link');
            extract($attrs);

            $links_attrs = [
                'href' => $link,
                'target' => $target,
                'rel' => $rel,
            ];
        ?>

            <div class="service__item">
                <div class="service__content service__content--extend">

                    <span class="wpr-el-num service-number fade_up_anim" data-delay=".3"><?php echo tp_kses($settings['wpr_service_box_number']); ?></span>

                    <div class="service__info">

                        <?php if (!empty($settings['wpr_service_title'])): ?>
                            <h2 class="h2 fade_up_anim wpr-el-title" data-delay=".35">
                                <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                    <?php echo tp_kses($settings['wpr_service_title']); ?>
                                </a>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($settings['wpr_service_desc'])): ?>
                            <p class="wpr-el-desc fade_up_anim" data-delay=".4">
                                <?php echo tp_kses($settings['wpr_service_desc']); ?>
                            </p>
                        <?php endif; ?>

                        <div class="btn-group d-flex align-items-lg-center gap-3">
                            <a <?php echo tp_implode_html_attributes($links_attrs); ?> class="common-btn fade_up_anim wpr-el-btn">
                                <span></span><?php echo tp_kses($settings['wpr_btn_text']); ?></span>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="21"
                                    height="12"
                                    viewBox="0 0 21 12"
                                    fill="none">
                                    <path
                                        d="M20.5303 6.53033C20.8232 6.23744 20.8232 5.76256 20.5303 5.46967L15.7574 0.696699C15.4645 0.403806 14.9896 0.403806 14.6967 0.696699C14.4038 0.989593 14.4038 1.46447 14.6967 1.75736L18.9393 6L14.6967 10.2426C14.4038 10.5355 14.4038 11.0104 14.6967 11.3033C14.9896 11.5962 15.4645 11.5962 15.7574 11.3033L20.5303 6.53033ZM0 6.75H20V5.25H0V6.75Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="service__thumb service__thumb--extend fade_up_anim wpr-el-img" data-delay=".2">
                    <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                        <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_image_alt); ?>" />
                    </a>
                </div>
            </div>

        <?php else:

            if (!empty($settings['service_image']['url'])) {
                $service_image = !empty($settings['service_image']['id']) ? wp_get_attachment_image_url($settings['service_image']['id']) : $settings['service_image']['url'];
                $service_image_alt = get_post_meta($settings["service_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $attrs = tp_get_repeater_links_attr($settings, 'service_link');
            extract($attrs);

            $links_attrs = [
                'href' => $link,
                'target' => $target,
                'rel' => $rel,
            ];
        ?>

            <div class="service-fit__item fade_up_anim wpr-el-section" data-delay="<?php echo esc_attr($settings['service_animation_delay']); ?>">
                <div class="service-fit__item-body">

                    <figure class="service-fit__item-thumb">
                        <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_image_alt); ?>" />
                    </figure>

                    <?php if (!empty($settings['wpr_service_title'])): ?>
                        <h5 class="h5 service-fit__item-title wpr-el-title">
                            <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                <?php echo tp_kses($settings['wpr_service_title']); ?>
                            </a>
                        </h5>
                    <?php endif; ?>

                    <?php if (!empty($settings['wpr_service_desc'])): ?>
                        <p class="wpr-el-desc">
                            <?php echo tp_kses($settings['wpr_service_desc']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <a <?php echo tp_implode_html_attributes($links_attrs); ?> class="learn-more-btn wpr-el-btn">
                    <?php echo tp_kses($settings['wpr_btn_text']); ?>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="100"
                        height="7"
                        viewBox="0 0 100 7"
                        fill="none">
                        <path d="M100 3.5L95 0.613249V6.38675L100 3.5ZM0 4H95.5V3H0V4Z"
                            fill="currentColor" />
                    </svg>
                </a>
            </div>


<?php endif;
    }
}

$widgets_manager->register(new WPR_Service_Box());
