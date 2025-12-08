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
class WPR_FAQ extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait;

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
        return 'wpr-faq';
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
        return __(WPRCORE_THEME_NAME . ' - Accordion', 'wprealizer');
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
                    'layout-7' => esc_html__('Layout 7', 'wprealizer'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'faq_section',
            [
                'label' => esc_html__('Title & Description', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'faq_subtitle',
            [
                'label' => esc_html__('Subtitle', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Digital', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'faq_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('productivity', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'faq_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'faq_title_tag',
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
                'default' => 'h4',
                'toggle' => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__('Accordion', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                    'style_3' => __('Style 3', 'wprealizer'),
                    'style_4' => __('Style 4', 'wprealizer'),
                    'style_5' => __('Style 5', 'wprealizer'),
                    'style_6' => __('Style 6', 'wprealizer'),
                    'style_7' => __('Style 7', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'wpr_accordion_active_switch',
            [
                'label' => esc_html__('Show', 'tp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tp-core'),
                'label_off' => esc_html__('Hide', 'tp-core'),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

        $repeater->add_control(
            'accordion_data_delay',
            [
                'label' => esc_html__('Accordion Animation Delay', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('.2s', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_5', 'style_6', 'style_7']
                ]
            ]
        );

        $repeater->add_control(
            'accordion_title',
            [
                'label' => esc_html__('Accordion Item', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('This is accordion item title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'faq_inner_logo',
            [
                'label' => esc_html__('Inner Logo', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ], 
                'condition' => [
                    'repeater_condition' => ['style_4']
                ]
            ]
        );

        $repeater->add_control(
            'faq_inner_image',
            [
                'label' => esc_html__('Inner Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ], 
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_3', 'style_4']
                ]
            ]
        );

        $repeater->add_control(
            'faq_inner_image2',
            [
                'label' => esc_html__('Inner Image 02', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ], 
                'condition' => [
                    'repeater_condition' => ['style_4']
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
                    'repeater_condition' => ['style_1', 'style_5']
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

        $repeater->add_control(
            'accordion_number',
            [
                'label' => esc_html__('Accordion Number', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('2023', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_4']
                ]
            ]
        );

        $repeater->add_control(
            'accordian_list',
            [
                'label' => esc_html__('Accordion List', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Accordion List', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_5']
                ]
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label' => esc_html__('Repeater Accordion', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'separator' => 'before',
                'default' => [
                    [
                        'accordion_title' => esc_html__('This is accordion item title #1', 'wprealizer'),
                    ],
                    [
                        'accordion_title' => esc_html__('This is accordion item title #2', 'wprealizer'),
                    ],
                    [
                        'accordion_title' => esc_html__('This is accordion item title #3', 'wprealizer'),
                    ],
                    [
                        'accordion_title' => esc_html__('This is accordion item title #4', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wpr_theme_btn_button_group',
            [
                'label' => esc_html__('Theme Button', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_button_type',
            [
                'label' => esc_html__('Button Style Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'inline' => esc_html__('Inline', 'wprealizer'),
                    'w-100 d-block' => esc_html__('Full Width', 'wprealizer'),
                ],

            ]
        );

        $this->add_control(
            'wpr_theme_btn_button_show',
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
            'wpr_theme_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'wprealizer'),
                'title' => esc_html__('Enter button text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_theme_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'wpr_theme_btn_line_effect',
            [
                'label' => esc_html__('Line Effect', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'wpr_theme_btn_button_show' => 'yes',
                    'wpr_design_style!' => ['layout-1', 'layout-2', 'layout-3']
                ],
            ]
        );

        $this->add_control(
            'wpr_theme_btn_icon_show',
            [
                'label' => esc_html__('Add Icon ?', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->tp_single_icon_control('theme_btn', 'wpr_theme_btn_icon_show', 'yes');

        $this->add_control(
            'wpr_theme_btn_icon_position',
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
                    'wpr_theme_btn_icon_show' => 'yes',
                    'wpr_design_style' => ['layout-1', 'layout-4']
                ],
            ]
        );

        $this->add_control(
            'wpr_theme_btn_link_type',
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
                    'wpr_theme_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'wpr_theme_btn_link',
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
                    'wpr_theme_btn_link_type' => '1',
                    'wpr_theme_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'wpr_theme_btn_page_link',
            [
                'label' => esc_html__('Select Button Link Page', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_types_post('page'),
                'condition' => [
                    'wpr_theme_btn_link_type' => '2',
                    'wpr_theme_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'wpr_button_align',
            [
                'label' => esc_html__('Alignment', 'wprealizer'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'wprealizer'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'wprealizer'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'wprealizer'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-theme-btn' => 'justify-content: {{VALUE}};',
                ],
                'frontend_available' => true,
                'toggle' => true,
            ]
        );
        $this->end_controls_section();

    }

    // style_tab_content
    protected function style_tab_content() {

        $this->tp_section_style_controls('faq_section', 'Section - Style', '.wpr-el-section');
        $this->tp_basic_style_controls('faq_subtitle', 'Heading Subtitle', '.wpr-el-subtitle');
        $this->tp_basic_style_controls('faq_title', 'Heading Title', '.wpr-el-title');
        $this->tp_link_controls_style('', 'b_btn1_style', 'Button', '.wpr-el-btn');

        $this->tp_basic_style_controls('faq_feature_list_title', 'Repeater List Title', '.wpr-el-rep-title');
        $this->tp_basic_style_controls('faq_description', 'Repeater List Description', '.wpr-el-rep-desc');
        $this->tp_link_controls_style('', 'faq_rep_btn', 'Button', '.wpr-el-rep-btn');

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
                    '{{WRAPPER}} .wpr-el-image img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpr-el-image img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpr-el-image img' => 'object-fit: {{VALUE}};',
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


        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

            <div class="accordion faq-sa__accordion" id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
                <?php foreach ($settings['accordions'] as $key => $item):
                    $collapsed = $item['wpr_accordion_active_switch'] ? '' : 'collapsed';
                    $show = $item['wpr_accordion_active_switch'] ? 'show' : '';
                ?>
                <!-- accordion-item-->
                <div class="accordion-item fade_up_anim" data-delay="<?php echo esc_attr($item['accordion_data_delay']); ?>">
                    <h5 class="h5 accordion-header">
                    <button
                    class="accordion-button <?php echo esc_attr($collapsed); ?> wpr-el-rep-title"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo-<?php echo esc_attr($this->get_id() . $key); ?>"
                    aria-expanded="false"
                    aria-controls="collapseTwo-<?php echo esc_attr($this->get_id() . $key); ?>"
                    >
                    <?php echo esc_html($item['accordion_title']); ?>
                    </button>
                    </h5>
                    <div
                        id="collapseTwo-<?php echo esc_attr($this->get_id() . $key); ?>"
                        class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                        data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>"
                        >
                        <div class="accordion-body">
                            <p class="wpr-el-rep-desc">
                            <?php echo tp_kses($item['accordion_description']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- accordion-item-->
                <?php endforeach; ?>
            </div>


        <?php elseif ($settings['wpr_design_style'] == 'layout-3') : ?>

<div class="row gy-5 g-md-5">
    <div class="col-md-8">
        <div class="accordion services-la__accordion" id="services-la__accordion-<?php echo esc_attr($this->get_id()); ?>">
            <?php foreach ($settings['accordions'] as $key => $item):
                $collapsed = $item['wpr_accordion_active_switch'] ? '' : 'collapsed';
                $show = $item['wpr_accordion_active_switch'] ? 'show' : '';
                $active = ($key == 0 ) ? 'active' : '';
                $counter = $key + 1; // Incremental ID starting from 1
            ?>
            <div class="accordion-item fade_up_anim" data-delay="<?php echo esc_attr($item['accordion_data_delay']); ?>">
                <h2 class="accordion-header">
                <button
                class="accordion-button <?php echo esc_attr($collapsed); ?>"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse-<?php echo esc_attr($this->get_id() . $key); ?>"
                data-bs-id="#collapse-<?php echo $counter; ?>" 
                aria-expanded="true"
                aria-controls="collapse-<?php echo esc_attr($this->get_id() . $key); ?>">
                <span class="accordion-title wpr-el-rep-title"><?php echo tp_kses($item['accordion_title']); ?></span>
                </button>
                </h2>
                <div id="collapse-<?php echo esc_attr($this->get_id() . $key); ?>"
                    class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                    data-bs-parent="#services-la__accordion-<?php echo esc_attr($this->get_id()); ?>"
                    >
                    <div class="accordion-body wpr-el-rep-desc">
                        <?php echo tp_kses($item['accordion_description']); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-4 d-md-flex align-items-center justify-content-md-end">
        <div class="services-la__accordion-thumb wpr-el-image">
            <?php foreach ($settings['accordions'] as $key => $item):
                $img = tp_get_img($item, 'faq_inner_image', 'full', false);
                $img_alt = get_post_meta($item["faq_inner_image"]["id"], "_wp_attachment_image_alt", true);
                // Set active class only for the first image
                $active_class = ($key == 0) ? 'active' : '';
            ?>

            <!-- faq img -->
            <?php if (!empty($img['faq_inner_image'])): ?>
                <img src="<?php echo esc_url($img['faq_inner_image']); ?>" 
                alt="<?php echo esc_attr($img_alt); ?>" 
                class="img-move <?php echo esc_attr($active_class); ?>" />
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Services End  -->

        <?php elseif ($settings['wpr_design_style'] == 'layout-4') : ?>

        <!-- Awards area start -->
        <div class="award__area wpr-el-section">
            <div class="container container-4xl">
                <div class="row">
                    <div class="col-12">
                        <div class="award__items">
                            <?php foreach ($settings['accordions'] as $key => $item):

                                // inner logo
                                $logo = tp_get_img($item, 'faq_inner_logo', 'full', false);
                                $logo_alt = get_post_meta($item["faq_inner_logo"]["id"], "_wp_attachment_image_alt", true);

                                // inner img1
                                $img = tp_get_img($item, 'faq_inner_image', 'full', false);
                                $img_alt = get_post_meta($item["faq_inner_image"]["id"], "_wp_attachment_image_alt", true);

                                // inner img2
                                $img2 = tp_get_img($item, 'faq_inner_image2', 'full', false);
                                $img2_alt = get_post_meta($item["faq_inner_image2"]["id"], "_wp_attachment_image_alt", true);

                                // Set active class only for the first image
                                $active_class = ($key == 0) ? 'active' : '';
                            ?>
                            <div class="award__item <?php echo esc_attr($active_class); ?>">
                                <div class="award__item-left">
                                    <?php if (!empty($item['accordion_title'])): ?>
                                    <h4 class="h4 title wpr-el-rep-title">
                                        <?php echo tp_kses($item['accordion_title']); ?>
                                    </h4>
                                    <?php endif; ?>
                                    <div class="award wpr-el-image">
                                        <?php if (!empty($item['accordion_description'])): ?>
                                        <p class="wpr-el-rep-desc">
                                        <?php echo tp_kses($item['accordion_description']); ?>
                                        </p>
                                        <?php endif; ?>

                                        <?php if (!empty($logo['faq_inner_logo'])): ?>
                                        <img src="<?php echo esc_url($logo['faq_inner_logo']); ?>" 
                                        alt="<?php echo esc_attr($logo_alt); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="description">
                                    <?php if (!empty($item['accordion_description'])): ?>
                                    <p class="wpr-el-rep-desc">
                                    <?php echo tp_kses($item['accordion_description']); ?>
                                    </p>
                                    <?php endif; ?>
                                    <div class="images">
                                        <?php if (!empty($img['faq_inner_image'])): ?>
                                        <div>
                                            <img src="<?php echo esc_url($img['faq_inner_image']); ?>" 
                                            alt="<?php echo esc_attr($img_alt); ?>" />
                                        </div>
                                        <?php endif; ?>

                                        <?php if (!empty($img2['faq_inner_image2'])): ?>
                                        <div>
                                            <img src="<?php echo esc_url($img2['faq_inner_image2']); ?>" 
                                            alt="<?php echo esc_attr($img2_alt); ?>" />
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($item['accordion_number'])): ?>
                                    <div class="year-wrapper">
                                        /<span class="year">
                                            <?php echo tp_kses($item['accordion_number']); ?>
                                        </span>
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
        <!-- Awards area end -->


        <?php elseif ($settings['wpr_design_style'] == 'layout-5') : ?>

<div class="service-health__accordion accordion"  id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
    <?php foreach ($settings['accordions'] as $key => $item):
        $collapsed = $item['wpr_accordion_active_switch'] ? '' : 'collapsed';
        $show = $item['wpr_accordion_active_switch'] ? 'show' : '';

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
    <div class="accordion-item fade_up_anim" data-delay="<?php echo esc_attr($item['accordion_data_delay']); ?>">
        <h4 class="h4 accordion-header">
            <button
            class="accordion-button wpr-el-rep-title <?php echo esc_attr($collapsed); ?>"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>"
            aria-expanded="true"
            aria-controls="collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>">
            <?php echo esc_html($item['accordion_title']); ?>
            </button>
        </h4>
        <div
            id="collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>"
            class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
            data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>">
            <div class="accordion-body">
                <div class="left-content">
                    <p class="wpr-el-rep-desc">
                        <?php echo tp_kses($item['accordion_description']); ?>
                    </p>
                    <?php if (!empty($link)): ?>
                    <a href="<?php echo esc_url($link); ?>" class="learn-more wpr-el-rep-btn">
                        <?php echo tp_kses($item['wpr_btn_text']); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <?php if (!empty($item['accordian_list'])): ?>
                <ul class="custom-ul right-content">
                    <?php echo tp_kses($item['accordian_list']); ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-6') : ?>

    
        <div class="faq-fin__accordion accordion wpr-el-section"
            id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
            <?php foreach ($settings['accordions'] as $key => $item):
                $collapsed = $item['wpr_accordion_active_switch'] ? '' : 'collapsed';
                $show = $item['wpr_accordion_active_switch'] ? 'show' : '';
            ?>
            <div class="accordion-item fade_up_anim" data-delay="<?php echo esc_attr($item['accordion_data_delay']); ?>">
                <h2 class="accordion-header">
                <button
                class="accordion-button <?php echo esc_attr($collapsed); ?> wpr-el-rep-title "
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseTwo-<?php echo esc_attr($this->get_id() . $key); ?>"
                aria-expanded="false"
                aria-controls="collapseTwo-<?php echo esc_attr($this->get_id() . $key); ?>"
                >
                <?php echo esc_html($item['accordion_title']); ?>
                </button>
                </h2>
                <div
                    id="collapseTwo-<?php echo esc_attr($this->get_id() . $key); ?>"
                    class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                    data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>"
                    >
                    <div class="accordion-body wpr-el-rep-desc">
                        <?php echo tp_kses($item['accordion_description']); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-7') : ?>

<div class="faq-fit__accordion accordion" id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
    <?php foreach ($settings['accordions'] as $key => $item):
        $collapsed = $item['wpr_accordion_active_switch'] ? '' : 'collapsed';
        $show = $item['wpr_accordion_active_switch'] ? 'show' : '';
    ?>
    <div class="accordion-item fade_up_anim" data-delay="<?php echo esc_attr($item['accordion_data_delay']); ?>">
        <h2 class="accordion-header">
        <button
        class="accordion-button <?php echo esc_attr($collapsed); ?> wpr-el-rep-title"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>"
        aria-expanded="true"
        aria-controls="collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>"
        >
        <?php echo esc_html($item['accordion_title']); ?>
        </button>
        </h2>
        <div
            id="collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>"
            class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
            data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>"
            >
            <div class="accordion-body wpr-el-rep-desc">
                <?php echo esc_html($item['accordion_description']); ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

        <?php else: 
            
            ?>


            <div class="services-digital__accordion accordion wpr-el-section" id="accordionExample-<?php echo esc_attr($this->get_id()); ?>">
                <?php foreach ($settings['accordions'] as $key => $item):
                    $collapsed = $item['wpr_accordion_active_switch'] ? '' : 'collapsed';
                    $show = $item['wpr_accordion_active_switch'] ? 'show' : '';

                    $img = tp_get_img($item, 'faq_inner_image', 'full', false);
                    $img_alt = get_post_meta($item["faq_inner_image"]["id"], "_wp_attachment_image_alt", true);

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
                <div class="services-digital__item accordion-item fade_up_anim"  data-delay="<?php echo esc_attr($item['accordion_data_delay']); ?>">
                    <h4 class="h4 services-digital__item-title accordion-header">
                    <button
                    class="accordion-button <?php echo esc_attr($collapsed); ?> wpr-el-rep-title"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>"
                    aria-expanded="true"
                    aria-controls="collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>">
                    <?php echo esc_html($item['accordion_title']); ?>
                    </button>
                    </h4>
                    <div id="collapseOne-<?php echo esc_attr($this->get_id() . $key); ?>"
                         class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                         data-bs-parent="#accordionExample-<?php echo esc_attr($this->get_id()); ?>">
                        <div class="accordion-body services-digital__item-content-wrapper">
                            <div class="services-digital__item-content">
                                <p class="wpr-el-rep-desc">
                                    <?php echo tp_kses($item['accordion_description']); ?>
                                </p>
                                <?php if (!empty($link)): ?>
                                <ul class="custom-ul services-digital__item-tags">
                                    <li>
                                        <a href="<?php echo esc_url($link); ?>" class="wpr-el-rep-btn">
                                        <?php echo tp_kses($item['wpr_btn_text']); ?>
                                        </a>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($img['faq_inner_image'])): ?>
                            <figure class="services-digital__item-thumb wpr-el-image">
                                <img
                                src="<?php echo esc_url($img['faq_inner_image']); ?>"
                                alt="<?php echo esc_attr($img_alt); ?>"
                                />
                            </figure>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>




<?php endif;
    }
}

$widgets_manager->register(new WPR_FAQ());
