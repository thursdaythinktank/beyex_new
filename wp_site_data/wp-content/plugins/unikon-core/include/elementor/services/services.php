<?php

namespace WPRCore\Widgets;

use Elementor\Element_Section;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Repeater;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_services extends Widget_Base
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
        return 'wpr-services';
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
        return __(WPRCORE_THEME_NAME . ' - Services', 'wprealizer');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'wpr_services_arrow_switcher',
            [
                'label' => esc_html__('Arrow SWITCHER', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->end_controls_section();

        // Services Sections
        $this->start_controls_section(
            'servicesContentSec',
            [
                'label' => esc_html__('Services Content', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('WPR Title Here', 'wprealizer'),
                'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_title_tag',
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

        $this->add_control(
            'wpr_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is description text here.', 'wprealizer'),
                'placeholder' => esc_html__('Type section description here', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // service section
        $this->start_controls_section(
            'wpr_service_section',
            [
                'label' => __('Service Repeater Item', 'wprealizer'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'service_animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('.2', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'service_image',
            [
                'label' => esc_html__('Service Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'service_number',
            [
                'label' => esc_html__('Service Number', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('2024', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_3']
                ]
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__('Service Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Black book', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'services_desc',
            [
                'label' => esc_html__('Service Description', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Service Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3', 'style_4', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'service_shape_img',
            [
                'label' => esc_html__('Shape Image 1', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_20']
                ]
            ]
        );

        $repeater->add_control(
            'service_cat',
            [
                'label' => esc_html__('Service Cat', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Clutch', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'wpr_btn_link_switcher',
            [
                'label' => esc_html__('Button', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_4', 'style_1', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'wpr_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'wprealizer'),
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => false,
                'condition' => [
                    'wpr_btn_link_switcher' => 'yes',
                ],
                'condition' => [
                    'repeater_condition' => ['style_5']
                ]
            ]
        );
        
        $repeater->add_control(
            'wpr_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'wpr_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'wpr_btn_link',
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
                    'wpr_btn_link_type' => '1',
                    'wpr_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'wpr_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'wpr_btn_link_type' => '2',
                    'wpr_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'wpr_service_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Services Item', 'wprealizer'),
                'default' => [
                    [
                        'service_title' => __('Influencer Marketing', 'wprealizer')
                    ],
                    [
                        'service_title' => __('Others Service', 'wprealizer')
                    ],
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function style_tab_content()
    {

        $this->tp_section_style_controls('services_section', 'Section - Style', '.wpr-el-section'
        );

        $this->tp_basic_style_controls('services_title', 'Heading Title', '.wpr-el-title'
        );

        $this->tp_basic_style_controls('services_desc', 'Heading Description', '.wpr-el-desc'
        );

        $this->tp_basic_style_controls('services_rep_title', 'Services Repeater Titile', '.wpr-el-rep-title'
        );

        $this->tp_basic_style_controls('services_rep_number', 'Services Repeater Number', '.wpr-el-rep-number'
        );
        $this->tp_basic_style_controls('services_rep_cat', 'Services Repeater Cat', '.wpr-el-rep-cat'
        );
        $this->tp_basic_style_controls('services_rep_desc', 'Services Repeater description', '.wpr-el-rep-desc'
        );
        $this->tp_link_controls_style('', 'service_btn_style', 'Button', '.wpr-el-rep-btn');

        // Image -Icon 
        $this->start_controls_section(
            'wpr_services_btn_section',
            [
                'label' => esc_html__('Image - Icon - SVG', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // icon 
        $this->start_controls_tabs(
            'wpr_services_btn_tabs'
        );

        $this->start_controls_tab(
            'wpr_services_btn_tab',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
            ]
        );

        $this->add_responsive_control(
            'wpr_services_btn_icon_color',
            [
                'label' => esc_html__('Icon Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-service-btn span i' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'wpr_services_btn_icon_font-size',
            [
                'label' => esc_html__('Font Size', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-service-btn span i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // image 
        $this->start_controls_tab(
            'wpr_services_btn_image_tab',
            [
                'label' => esc_html__('Image', 'wprealizer'),
            ]
        );

        $this->add_responsive_control(
            'wpr_services_image_w',
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
                    '{{WRAPPER}} .wpr-el-service-img img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpr_services_image_h',
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
                    '{{WRAPPER}} .wpr-el-service-img img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpr-el-service-img img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        // svg
        $this->start_controls_tab(
            'wpr_services_btn_svg_tab',
            [
                'label' => esc_html__('SVG', 'wprealizer'),
            ]
        );
        $this->add_responsive_control(
            'wpr_services_btn_svg_w',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('SVG Width', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-service-btn span svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        //  end tab 

        $this->add_responsive_control(
            'wpr_services_btn_bg',
            [
                'label' => esc_html__('Background Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-service-btn span::before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tp_my_services_btn_normal_border_style',
                'selector' => '{{WRAPPER}} .wpr-el-service-btn span::before',
            ]
        );

        $this->add_responsive_control(
            'wpr_services_btn_bg_margin',
            [
                'label' => esc_html__('Margin', 'wprealizer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-service-btn span i, {{WRAPPER}} .wpr-el-service-img img , {{WRAPPER}} .wpr-el-service-btn span svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wpr_services_btn_bg_padding',
            [
                'label' => esc_html__('Padding', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-service-btn span i, {{WRAPPER}} .wpr-el-service-btn span img , {{WRAPPER}} .wpr-el-service-btn span svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $btn_id = 'theme_btn';
?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'):

        ?>


        <?php foreach ($settings['wpr_service_slides'] as $key => $item):

            $service_image = tp_get_img($item, 'service_image', 'full', false);
            $service_image_alt = get_post_meta($item["service_image"]["id"], "_wp_attachment_image_alt", true);
        ?>
        <div class="awards-mar__item fade_up_anim " data-delay="<?php echo esc_attr($item['service_animation_delay']); ?>">

            <?php if (!empty($item['service_number'])): ?>
            <span class="item__content item__year wpr-el-rep-number">
                <?php echo tp_kses($item['service_number']); ?>
            </span>
            <?php endif; ?>

            <?php if (!empty($item['service_title'])): ?>
            <p class="item__content item__title wpr-el-rep-title">
                <?php echo tp_kses($item['service_title']); ?>
            </p>
            <?php endif; ?>

            <?php if (!empty($item['service_image'])): ?>
            <div class="item__content item__thumb wpr-el-service-img">
                <img src="<?php echo esc_url($service_image['service_image']); ?>"
                alt="<?php echo esc_attr($service_image_alt); ?>"/>
            </div>
            <?php endif; ?>

            <?php if (!empty($item['service_cat'])): ?>
            <span class="item__content item__category wpr-el-rep-cat">
                <?php echo tp_kses($item['service_cat']); ?>
            </span>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>


        <?php elseif ($settings['wpr_design_style'] == 'layout-3'):

        ?>


    <section class="service-sa__area">
        <div class="service-sa__items">
            <?php foreach ($settings['wpr_service_slides'] as $key => $item):

                $service_image = tp_get_img($item, 'service_image', 'full', false);
                $service_image_alt = get_post_meta($item["service_image"]["id"], "_wp_attachment_image_alt", true);
            ?>
            <div class="service-sa__item">
                <?php if (!empty($item['service_number'])): ?>
                <span class="service-sa__item-number wpr-el-rep-number d-none d-md-block">
                    <?php echo tp_kses($item['service_number']); ?>
                </span>
                <?php endif; ?>

                <?php if (!empty($item['service_image'])): ?>
                <figure class="service-sa__item-thumb wpr-el-service-img">
                    <img src="<?php echo esc_url($service_image['service_image']); ?>" alt="<?php echo esc_attr($service_image_alt); ?>"/>
                </figure>
                <?php endif; ?>

                <div class="service-sa__item-content">
                    <?php if (!empty($item['service_title'])): ?>
                    <h5 class="h5 wpr-el-rep-title">
                        <?php echo tp_kses($item['service_title']); ?>
                    </h5>
                    <?php endif; ?>

                    <?php if (!empty($item['services_desc'])): ?>
                    <p class="text-light-gray">
                        <?php echo tp_kses($item['services_desc']); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>


        <?php elseif ($settings['wpr_design_style'] == 'layout-4'):

        ?>

        <div class="swiper service-ca__slider">
            <div class="swiper-wrapper">
                <?php foreach ($settings['wpr_service_slides'] as $key => $item):

                    $service_image = tp_get_img($item, 'service_image', 'full', false);
                    $service_image_alt = get_post_meta($item["service_image"]["id"], "_wp_attachment_image_alt", true);

                    // btn Link
                    if ('2' == $item['wpr_btn_link_type']) {
                        $link = get_permalink($item['wpr_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['wpr_btn_link']['url']) ? $item['wpr_btn_link']['url'] : '';
                        $target = !empty($item['wpr_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['wpr_btn_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                <div class="swiper-slide">
                    <div class="service-ca__slider-item">
                        <div class="service-ca__slider-thumb">
                            <?php if (!empty($item['service_image'])): ?>
                            <img src="<?php echo esc_url($service_image['service_image']); ?>"
                            alt="<?php echo esc_attr($service_image_alt); ?>"/>
                            <?php endif; ?>
                        </div>
                        <div class="service-ca__slider-content">
                            <?php if (!empty($item['service_title'])): ?>
                            <h5 class="h5 wpr-el-rep-title">
                                <a href="<?php echo esc_url($link); ?>">
                                    <?php echo tp_kses($item['service_title']); ?>
                                </a>
                            </h5>
                            <?php endif; ?>

                            <?php if (!empty($item['services_desc'])): ?>
                            <p class="wpr-el-rep-desc">
                                <?php echo tp_kses($item['services_desc']); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($settings['wpr_services_arrow_switcher'])): ?>
            <div class="service-ca__slider-navigation">
                <div class="service-ca__slider-prev">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 30 30"
                        fill="none"
                        >
                        <path
                            d="M27.1849 14.9997C27.1849 15.5172 26.7649 15.9372 26.2474 15.9372H6.01119L13.1612 23.0872C13.5274 23.4534 13.5274 24.0472 13.1612 24.4135C12.9787 24.596 12.7386 24.6884 12.4986 24.6884C12.2586 24.6884 12.0186 24.5972 11.8361 24.4135L3.08608 15.6635C2.99983 15.5772 2.93125 15.4736 2.88375 15.3586C2.78875 15.1299 2.78875 14.8711 2.88375 14.6424C2.93125 14.5274 2.99983 14.4234 3.08608 14.3372L11.8361 5.58719C12.2023 5.22094 12.7961 5.22094 13.1624 5.58719C13.5286 5.95344 13.5286 6.54723 13.1624 6.91348L6.01241 14.0634H26.2474C26.7649 14.0622 27.1849 14.4822 27.1849 14.9997Z"
                            fill="#0F0F0F"
                        />
                    </svg>
                </div>
                <div class="service-ca__slider-next">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 30 30"
                        fill="none"
                        >
                        <path
                            d="M27.1149 15.3598C27.0674 15.4748 26.9988 15.5785 26.9125 15.6647L18.1625 24.4147C17.98 24.5972 17.74 24.6897 17.5 24.6897C17.26 24.6897 17.02 24.5985 16.8375 24.4147C16.4712 24.0485 16.4712 23.4547 16.8375 23.0884L23.9874 15.9384H3.75C3.2325 15.9384 2.8125 15.5184 2.8125 15.0009C2.8125 14.4834 3.2325 14.0634 3.75 14.0634H23.9862L16.8362 6.91348C16.47 6.54723 16.47 5.95344 16.8362 5.58719C17.2025 5.22094 17.7963 5.22094 18.1625 5.58719L26.9125 14.3372C26.9988 14.4234 27.0674 14.5271 27.1149 14.6421C27.2099 14.8721 27.2099 15.1298 27.1149 15.3598Z"
                            fill="#0F0F0F"
                        />
                    </svg>
                </div>
            </div>
            <?php endif; ?>
        </div>


        <?php elseif ($settings['wpr_design_style'] == 'layout-5'):       

         ?>

        <!-- Services start -->
        <div class="services-fin wpr-el-section">

            <?php foreach ($settings['wpr_service_slides'] as $key => $item):

                $service_image = tp_get_img($item, 'service_image', 'full', false);
                $service_image_alt = get_post_meta($item["service_image"]["id"], "_wp_attachment_image_alt", true);

                // btn Link
                if ('2' == $item['wpr_btn_link_type']) {
                    $link = get_permalink($item['wpr_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['wpr_btn_link']['url']) ? $item['wpr_btn_link']['url'] : '';
                    $target = !empty($item['wpr_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['wpr_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="services-fin__item an-pine-vanish">
                <div class="services-fin__item-content">
                    <?php if (!empty($item['service_title'])): ?>
                    <h3 class="h3 services-fin__item-title fade_up_anim wpr-el-rep-title"
                    data-delay="<?php echo esc_attr($item['service_animation_delay']); ?>">
                     <?php echo tp_kses($item['service_title']); ?>
                    </h3>
                    <?php endif; ?>

                    <?php if (!empty($item['service_cat'])): ?>
                    <ul class="custom-ul tags wpr-el-rep-cat">
                        <?php echo tp_kses($item['service_cat']); ?>
                    </ul>
                    <?php endif; ?>

                    <?php if (!empty($item['services_desc'])): ?>
                    <p class="wpr-el-rep-desc">
                        <?php echo tp_kses($item['services_desc']); ?>
                    </p>
                    <?php endif; ?>

                    <a href="<?php echo esc_url($link); ?>" class="common-btn__variation9 common-btn__variation9--noicon wpr-el-rep-btn">
                         <?php echo tp_kses($item['wpr_btn_text']); ?>
                    </a>
                </div>

                <?php if (!empty($item['service_image'])): ?>
                <div class="services-fin__item-thumb wpr-el-service-img">
                    <img class="img-move" src="<?php echo esc_url($service_image['service_image']); ?>" alt="<?php echo esc_attr($service_image_alt); ?>"/>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Services end -->



        <?php else:

        ?>



        <ul class="custom-ul services-mar__services">
            <?php foreach ($settings['wpr_service_slides'] as $key => $item):

                $service_image = tp_get_img($item, 'service_image', 'full', false);
                $service_image_alt = get_post_meta($item["service_image"]["id"], "_wp_attachment_image_alt", true);

                // btn Link
                if ('2' == $item['wpr_btn_link_type']) {
                    $link = get_permalink($item['wpr_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['wpr_btn_link']['url']) ? $item['wpr_btn_link']['url'] : '';
                    $target = !empty($item['wpr_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['wpr_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <li class="fade_up_anim wpr-el-service-img" data-delay="<?php echo esc_attr($item['service_animation_delay']); ?>">
                <?php if (!empty($item['service_title'])): ?>
                <h3 class="h3 service-name wpr-el-rep-title">
                    <a href="<?php echo esc_url($link); ?>">
                        <?php echo tp_kses($item['service_title']); ?>
                    </a>
                </h3>
                <?php endif; ?>

                <?php if (!empty($item['service_image'])): ?>
                <img src="<?php echo esc_url($service_image['service_image']); ?>"
                alt="<?php echo esc_attr($service_image_alt); ?>"/>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>


<?php endif;
    }
}

$widgets_manager->register(new WPR_services());
