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
class WPR_Project_Slider extends Widget_Base
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
        return 'wpr-project-slider';
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
        return __(WPRCORE_THEME_NAME . ' - Project Slider', 'wprealizer');
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

    $this->end_controls_section();

        // project content section
        $this->start_controls_section(
            'wpr_project_content_section',
            [
                'label' => __('Project Content', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'wpr_subtitle',
            [
                'label' => esc_html__('Section Subtitle', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Subtitle', 'wprealizer'),
                'label_block' => true,
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
            'wpr_btn_link_switcher',
            [
                'label' => esc_html__('Button SWITCHER', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'wpr_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'wpr_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->end_controls_section();

        // project section
        $this->start_controls_section(
            'wpr_project_section',
            [
                'label' => __('Project Repeater Item', 'wprealizer'),
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
            'project_image',
            [
                'label' => esc_html__('Project Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'project_tags1',
            [
                'label' => esc_html__('Project Tags 1', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Living', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3']
                ]
            ]
        ); 

        $repeater->add_control(
            'project_tags2',
            [
                'label' => esc_html__('Project Tags 2', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Playground', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3']
                ]
            ]
        ); 

        $repeater->add_control(
            'project_subtitle',
            [
                'label' => esc_html__('Project Subtitle', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Case study', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'project_number',
            [
                'label' => esc_html__('Project Number', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('01', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'project_title',
            [
                'label' => esc_html__('Project Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Black book', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_1', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'project_date',
            [
                'label' => esc_html__('Project Date', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Design - 2014', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'project_content',
            [
                'label' => esc_html__('Project Content', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nulla ut enim non magna placerat scelerisque sed eu dolor. Sed eu faucibus turpis. Ut bibendum tempor tempus. Ut scelerisque est posuere ex pretium laoreet.', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'project_shape_img',
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
            'project_shape_img2',
            [
                'label' => esc_html__('Shape Image 2', 'wprealizer'),
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
            'wpr_btn_link_switcher',
            [
                'label' => esc_html__('Button SWITCHER', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_4']
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

        $this->add_control(
            'wpr_project_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Project Item', 'wprealizer'),
                'default' => [
                    [
                        'project_title' => __('Black book', 'wprealizer')
                    ],
                    [
                        'project_title' => __('Others Project', 'wprealizer')
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        // wpr_project_vedio_section
        $this->start_controls_section(
            'wpr_project_vedio_section',
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
                'label' => esc_html__('Image Section', 'tp-core'),
                'condition' => [
                    'wpr_design_style' => ['layout-10']
                ]
            ]
        );

        $this->add_control(
            'wpr_shape_image',
            [
                'label' => esc_html__('Shape Image', 'tp-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_shape_image2',
            [
                'label' => esc_html__('Shape Image 2', 'tp-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_shape_svg_code',
            [
                'label' => esc_html__('Shape SVG Code', 'tp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Default Shape SVG Code', 'tp-core'),
                'placeholder' => esc_html__('Type your Shape SVG Code here', 'tp-core'),
            ]
        );

        $this->end_controls_section();

        // additional info
        $this->start_controls_section(
            'wpr_add_info_sec',
            [
                'label' => esc_html__('Additional Info', 'tp-core'),
                'condition' => [
                    'wpr_design_style' => ['layout-1']
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

        // social media
        $this->start_controls_section(
            '_section_project_social',
            [
                'label' => __('Project Social', 'wprcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style' => ['layout-5']
                ]
            ]
        );

        $this->add_control(
            'show_social',
            [
                'label' => __('Show Social Links?', 'wprcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'wprcore'),
                'label_off' => __('No', 'wprcore'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Website Address', 'wprcore'),
                'placeholder' => __('Add your profile link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Email', 'wprcore'),
                'placeholder' => __('Add your email link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Phone', 'wprcore'),
                'placeholder' => __('Add your phone link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Facebook', 'wprcore'),
                'default' => __('#', 'wprcore'),
                'placeholder' => __('Add your facebook link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Twitter', 'wprcore'),
                'default' => __('#', 'wprcore'),
                'placeholder' => __('Add your twitter link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Instagram', 'wprcore'),
                'default' => __('#', 'wprcore'),
                'placeholder' => __('Add your instagram link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('LinkedIn', 'wprcore'),
                'placeholder' => __('Add your linkedin link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Youtube', 'wprcore'),
                'placeholder' => __('Add your youtube link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Google Plus', 'wprcore'),
                'placeholder' => __('Add your Google Plus link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Flickr', 'wprcore'),
                'placeholder' => __('Add your flickr link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Vimeo', 'wprcore'),
                'placeholder' => __('Add your vimeo link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Behance', 'wprcore'),
                'placeholder' => __('Add your hehance link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Dribbble', 'wprcore'),
                'placeholder' => __('Add your dribbble link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Pinterest', 'wprcore'),
                'placeholder' => __('Add your pinterest link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Github', 'wprcore'),
                'placeholder' => __('Add your github link', 'wprcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('project', 'Section - Style', '.wpr-el-section');

        $this->tp_basic_style_controls('project_heading_subtitle', 'Heading Subtitle', '.wpr-el-subtitle');
        $this->tp_basic_style_controls('project_heading_title', 'Heading Title', '.wpr-el-title');
         $this->tp_link_controls_style('', 'project_btn1_style', 'Button', '.wpr-el-btn');
        $this->tp_basic_style_controls('project_rep_subtitle', 'Project Repeater SubTitle', '.wpr-el-rep-subtitle');
        $this->tp_basic_style_controls('project_rep_number', 'Project Repeater Number', '.wpr-el-rep-number');
        $this->tp_basic_style_controls('project_rep_title', 'Project Repeater Title', '.wpr-el-rep-title');
        $this->tp_basic_style_controls('project_rep_date', 'Project Repeater Date', '.wpr-el-rep-date');
        $this->tp_basic_style_controls('project_rep_desc', 'Project Repeater Description', '.wpr-el-rep-desc');
        $this->tp_link_controls_style('', 'project_btn2_style', 'Button', '.wpr-el-rep-btn');
        $this->tp_link_controls_style('', 'project_social', 'Project Social Icon', '.wpr-el-project-social');


        $this->start_controls_section(
            'wpr_project_img_section',
            [
                'label' => esc_html__('Project Image', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_project_img_w',
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
            'wpr_project_img_h',
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
        $settings = $this->get_settings_for_display();
?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

            <!-- case-study-mar__area start  -->
            <div class="case-study-mar__area">
                <div class="case-study-mar__wrapper">
                    <?php foreach ($settings['wpr_project_slides'] as $key => $item):

                        $project_image = tp_get_img($item, 'project_image', 'full', false);
                        $project_image_alt = get_post_meta($item["project_image"]["id"], "_wp_attachment_image_alt", true);

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
                    <div class="case-study-mar__item an-pine-vanish">
                        <?php if (!empty($project_image['project_image'])): ?>
                        <figure class="case-study-mar__item-thumb wpr-el-rep-img">
                            <img class="img-move" src="<?php echo esc_url($project_image['project_image']); ?>"
                                alt="<?php echo esc_attr($project_image_alt); ?>"/>
                        </figure>
                        <?php endif; ?>
                        
                        <div class="case-study-mar__item-content">
                            <?php if (!empty($item['project_subtitle'])): ?>
                            <h5 class="h5 item-sub-title wpr-el-rep-subtitle">
                                <?php echo tp_kses($item['project_subtitle']); ?>
                            </h5>
                            <?php endif; ?>

                            <?php if (!empty($item['project_number'])): ?>
                            <span class="case-study-number wpr-el-rep-number">
                                <?php echo tp_kses($item['project_number']); ?>   
                            </span>
                            <?php endif; ?>

                            <?php if (!empty($item['project_title'])): ?>
                            <h3 class="h3 item-title wpr-el-rep-title">
                                <?php echo tp_kses($item['project_title']); ?>
                            </h3>
                            <?php endif; ?>

                            <?php if (!empty($item['project_content'])): ?>
                            <p class="wpr-el-rep-desc">
                                <?php echo tp_kses($item['project_content']); ?>
                            </p>
                            <?php endif; ?>

                            <?php if (!empty($link)): ?>
                            <a href="<?php echo esc_url($link); ?>" class="common-btn square-btn wpr-el-rep-btn"><?php echo tp_kses($item['wpr_btn_text']); ?>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="21"
                                    height="12"
                                    viewBox="0 0 21 12"
                                    fill="none"
                                    >
                                    <path
                                        d="M20.5303 6.53033C20.8232 6.23744 20.8232 5.76256 20.5303 5.46967L15.7574 0.696699C15.4645 0.403806 14.9896 0.403806 14.6967 0.696699C14.4038 0.989593 14.4038 1.46447 14.6967 1.75736L18.9393 6L14.6967 10.2426C14.4038 10.5355 14.4038 11.0104 14.6967 11.3033C14.9896 11.5962 15.4645 11.5962 15.7574 11.3033L20.5303 6.53033ZM0 6.75H20V5.25H0V6.75Z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- case-study-mar__area end  -->

        <?php elseif ($settings['wpr_design_style'] == 'layout-3'): ?>

<!--  landmark slider start -->
<div class="landmark__area">
    <div class="container container-4xl">
        <div class="row">
            <div class="col-12">
                <div class="swiper landmark__slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['wpr_project_slides'] as $key => $item):

                            $project_image = tp_get_img($item, 'project_image', 'full', false);
                            $project_image_alt = get_post_meta($item["project_image"]["id"], "_wp_attachment_image_alt", true);
                        ?>
                        <div class="swiper-slide">
                            <div class="landmark__slide">
                                <?php if (!empty($project_image['project_image'])): ?>
                                <img src="<?php echo esc_url($project_image['project_image']); ?>" alt="<?php echo esc_attr($project_image_alt); ?>"/>
                                <?php endif; ?>
                                <ul class="custom-ul landmark__slider-tags">
                                    <?php if (!empty($item['project_tags1'])): ?>
                                    <li class="landmark__slider-tag">
                                    <?php echo tp_kses($item['project_tags1']); ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if (!empty($item['project_tags2'])): ?>
                                    <li class="landmark__slider-tag">
                                    <?php echo tp_kses($item['project_tags2']); ?>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="landmark__slider-next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" fill="none">
                            <path
                                d="M36.1532 20.4785C36.0898 20.6318 35.9984 20.77 35.8834 20.885L24.2167 32.5516C23.9734 32.795 23.6533 32.9183 23.3333 32.9183C23.0133 32.9183 22.6933 32.7966 22.45 32.5516C21.9616 32.0633 21.9616 31.2716 22.45 30.7832L31.9832 21.25H5C4.31 21.25 3.75 20.69 3.75 20C3.75 19.31 4.31 18.75 5 18.75H31.9816L22.4483 9.21667C21.96 8.72834 21.96 7.93661 22.4483 7.44828C22.9367 6.95995 23.7284 6.95995 24.2167 7.44828L35.8834 19.1149C35.9984 19.2299 36.0898 19.3681 36.1532 19.5214C36.2798 19.8281 36.2798 20.1718 36.1532 20.4785Z"
                                fill="currentColor"
                                />
                        </svg>
                    </div>
                    <div class="landmark__slider-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" fill="none">
                            <path
                                d="M3.84684 19.5215C3.91018 19.3682 4.00162 19.23 4.11662 19.115L15.7833 7.44836C16.0266 7.20503 16.3467 7.08175 16.6667 7.08175C16.9867 7.08175 17.3067 7.20336 17.5501 7.44836C18.0384 7.9367 18.0384 8.72842 17.5501 9.21676L8.01676 18.75L35 18.75C35.69 18.75 36.25 19.31 36.25 20C36.25 20.69 35.69 21.25 35 21.25L8.01839 21.25L17.5517 30.7833C18.04 31.2717 18.04 32.0634 17.5517 32.5517C17.0633 33.0401 16.2716 33.0401 15.7833 32.5517L4.11662 20.885C4.00162 20.77 3.91018 20.6319 3.84684 20.4786C3.72017 20.1719 3.72017 19.8282 3.84684 19.5215Z"
                                fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  landmark slider end -->


        <?php elseif ($settings['wpr_design_style'] == 'layout-4'): ?>

        <div class="case-studies-health__masonry">
            <?php foreach ($settings['wpr_project_slides'] as $key => $item):

                $project_image = tp_get_img($item, 'project_image', 'full', false);
                $project_image_alt = get_post_meta($item["project_image"]["id"], "_wp_attachment_image_alt", true);

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

                $counter = $key + 1; // Incremental ID starting from 1
            ?>
            <div class="case-studies-health__item item-<?php echo $counter; ?>">
                <?php if (!empty($project_image['project_image'])): ?>
                <div class="case-studies-health__thumb">
                    <img src="<?php echo esc_url($project_image['project_image']); ?>"
                    alt="<?php echo esc_attr($project_image_alt); ?>"/>
                </div>
                <?php endif; ?>

                <?php if (!empty($link)): ?>
                <a href="<?php echo esc_url($link); ?>" class="common-btn__variation8--extend wpr-el-rep-btn">
                    <?php echo tp_kses($item['wpr_btn_text']); ?>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 15"
                        fill="none"
                        >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M15.6047 5.59423C17.0639 6.64489 18.83 7 20 7V8C18.83 8 17.0639 8.35511 15.6047 9.40577C14.1709 10.4381 13 12.163 13 15H12C12 11.837 13.3291 9.81193 15.0203 8.59423C15.3337 8.36859 15.6584 8.17142 15.9878 8H0V7H15.9878C15.6584 6.82858 15.3337 6.63141 15.0203 6.40577C13.3291 5.18807 12 3.16296 12 0H13C13 2.83704 14.1709 4.56193 15.6047 5.59423Z"
                            fill="currentColor"
                        ></path>
                    </svg>
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-5'): ?>

<div class="showcase-v2 overflow-hidden">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="showcase-v2__wrapper">
                    <?php if (!empty($settings['show_social'])): ?>
                    <ul class="custom-ul side__social">
                        <?php if (!empty($settings['web_title'])): ?>
                        <li>   
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['web_title']); ?>">
                                <i class="fas fa-globe"></i>
                            </a>
                        </li> 
                        <?php endif; ?>
                        <?php if (!empty($settings['phone_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['phone_title']); ?>"><i class="fas fa-phone"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['facebook_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['facebook_title']); ?>"><i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['twitter_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['twitter_title']); ?>"><i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['linkedin_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['linkedin_title']); ?>"><i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['instagram_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['instagram_title']); ?>"><i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['youtube_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['youtube_title']); ?>"><i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['googleplus_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['googleplus_title']); ?>"><i class="fab fa-google-plus-g"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['flickr_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['flickr_title']); ?>"><i class="fab fa-flickr"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['vimeo_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['vimeo_title']); ?>"><i class="fab fa-vimeo-v"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['behance_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['behance_title']); ?>"><i class="fab fa-behance"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['dribble_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['dribble_title']); ?>"><i class="fab fa-dribbble"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['pinterest_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['pinterest_title']); ?>"><i class="fab fa-pinterest-p"></i></a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($settings['gitub_title'])): ?>
                        <li>
                            <a class="wpr-el-project-social" href="<?php echo esc_url($settings['gitub_title']); ?>"><i class="fab fa-github"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <?php endif; ?>



                    <ul class="list-unstyled showcase-v2__ul">
                        <?php foreach ($settings['wpr_project_slides'] as $key => $item):

                            $project_image = tp_get_img($item, 'project_image', 'full', false);
                            $project_image_alt = get_post_meta($item["project_image"]["id"], "_wp_attachment_image_alt", true);
                        ?>
                        <li>
                            <div class="showcase-v2__item">
                                <?php if (!empty($item['project_title'])): ?>
                                <a href="#" class="showcase-v2__link wpr-el-rep-title">
                                    <?php echo tp_kses($item['project_title']); ?>
                                </a>
                                <?php endif; ?>

                                <?php if (!empty($project_image['project_image'])): ?>
                                <div class="showcase-v2__bg-image">
                                    <img src="<?php echo esc_url($project_image['project_image']); ?>"
                                    alt="<?php echo esc_attr($project_image_alt); ?>"/>
                                </div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</div>
<!-- end wrap -->



        <?php else:

            // btn Link
            if ('2' == $settings['wpr_btn_link_type']) {
                $btn_link = get_permalink($settings['wpr_btn_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $btn_link = !empty($settings['wpr_btn_link']['url']) ? $settings['wpr_btn_link']['url'] : '';
                $target = !empty($settings['wpr_btn_link']['is_external']) ? '_blank' : '';
                $rel = !empty($settings['wpr_btn_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>

        <!-- work-digital Start -->
        <div class="work-digital pt-150 pb-150 wpr-el-section">
            <div class="container container-mini">
                <div class="row">
                    <div class="col-12">
                        <div class="section__header-v12">
                            <?php if (!empty($settings['wpr_subtitle'])): ?>
                            <span class="section__header-sub-title-v12 wpr-el-subtitle">
                                <?php echo tp_kses($settings['wpr_subtitle']); ?>
                            </span>
                            <?php endif; ?>

                            <?php if (!empty($settings['wpr_title'])): ?>
                            <h2 class="h2 section__header-title-v12 wpr-el-title">
                                <?php echo tp_kses($settings['wpr_title']); ?>
                            </h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-fitness">
                <div class="row">
                    <div class="col-12">
                        <div class="work-digital__items">
                            <?php foreach ($settings['wpr_project_slides'] as $key => $item):

                                $project_image = tp_get_img($item, 'project_image', 'full', false);
                                $project_image_alt = get_post_meta($item["project_image"]["id"], "_wp_attachment_image_alt", true);

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
                            <div class="work-digital__item">
                                <?php if (!empty($project_image['project_image'])): ?>
                                <figure class="work-digital__item-thumb wpr-el-rep-img">
                                    <img src="<?php echo esc_url($project_image['project_image']); ?>"
                                    alt="<?php echo esc_attr($project_image_alt); ?>"/>

                                    <?php if (!empty($link)): ?>
                                    <a href="<?php echo esc_url($link); ?>" class="work-digital__item-link btn-hover btn-item wpr-el-rep-btn"
                                    ><?php echo tp_kses($item['wpr_btn_text']); ?></a>
                                    <?php endif; ?>
                                </figure>
                                <?php endif; ?>
                                <div class="work-digital__item-content">
                                    <?php if (!empty($item['project_title'])): ?>
                                    <h5 class="h5 work-title wpr-el-rep-title">
                                        <a href="<?php echo esc_url($link); ?>">
                                            <?php echo tp_kses($item['project_title']); ?>
                                        </a>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if (!empty($item['project_date'])): ?>
                                    <p class="work-info wpr-el-rep-date">
                                        <?php echo tp_kses($item['project_date']); ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($settings['wpr_btn_link_switcher'])): ?>
                <div class="row">
                    <div class="col-12 pt-100 text-center">
                        <?php if (!empty($btn_link)): ?>
                        <a href="<?php echo esc_url($btn_link); ?>" class="common-btn common-btn-v1 black-transparent-btn wpr-el-btn"
                        ><?php echo tp_kses($settings['wpr_btn_text']); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- work-digital Start -->


<?php endif;
    }
}

$widgets_manager->register(new WPR_Project_Slider());
