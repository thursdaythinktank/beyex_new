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
class TP_University_Instructor extends Widget_Base
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
        return 'tp-university-instructor';
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
        return __(WPRCORE_THEME_NAME . ' :: University Instructor', 'wprealizer');
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
        $this->wpr_design_layout('Layout Style', 1);

        // uni_instructor_content
        $this->start_controls_section(
            'tp_uni_instructor_content',
            [
                'label' => __('Content', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_uni_instructor_content_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'wprealizer'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );



        $this->add_control(
            'tp_uni_instructor_content_subtitle',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Subtitle', 'wprealizer'),
                'default' => __('Principal', 'wprealizer'),
                'placeholder' => __('Type Subtitle', 'wprealizer'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'tp_uni_instructor_content_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'wprealizer'),
                'default' => __('James Warren', 'wprealizer'),
                'placeholder' => __('Type title', 'wprealizer'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_responsive_control(
            'tp_uni_instructor_content__align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .align-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'tp_uni_instructor_content_Button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Button Title', 'wprealizer'),
                'default' => __('Details', 'wprealizer'),
                'placeholder' => __('Type button Title', 'wprealizer'),
                'label_block' => false,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        tp_render_links_controls($this, 'uni_instructor');

        $this->end_controls_section();

        // testimonial section
        $this->start_controls_section(
            'tp_uni_instructor_social_item_section',
            [
                'label' => __('Social Item', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );



        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_instructor_social_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default-value', 'wprealizer'),
                'description' => esc_html__('This title won\'t show in frontend. Its only for Repeater Identification', 'wprealizer'),
                'label_block' => true,
            ]
        );

        tp_render_icon_controls($repeater, 'instructor_social');

        tp_render_links_controls($repeater, 'instructor_social');

        $this->add_control(
            'tp_instructor_social_list',
            [
                'label' => esc_html__('Section Label', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_instructor_social_title' => esc_html__('Facebook', 'wprealizer'),
                        'tp_instructor_social_icon' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands',
                        ]
                    ],
                    [
                        'tp_instructor_social_title' => esc_html__('Twitter', 'wprealizer'),
                        'tp_instructor_social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ]
                    ],
                ],
                'title_field' => '{{{ tp_instructor_social_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->tp_creative_animation();
    }

    protected function style_tab_content()
    {
        // 
        $this->start_controls_section(
            'tp_uni_instructor_content_img_style',
            [
                'label' => __('Image', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tp_uni_instructor_content_img_hover_color',
                'types' => ['gradient',],
                'selector' => '{{WRAPPER}} .tp-el-thumb::after ',
            ]
        );
        $this->add_control(
            'tp_name_hvr_color',
            [
                'label' => esc_html__('Name Hover Color', 'wprealizer'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tp-el-title a:hover' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .tp-el-titles a:hover' => '-webkit-text-fill-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->end_controls_section();

        $this->tp_basic_style_controls('uni_instructor_content_subtitle', 'Designation', '.tp-el-subtitle');
        $this->tp_basic_style_controls('uni_instructor_content_title', 'Name', '.tp-el-title');
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


        <?php else:
            $img = tp_get_img($settings, 'tp_uni_instructor_content_image', 'thumbnail');

            $button_title = $settings['tp_uni_instructor_content_Button_text'];
            $tp_title = $settings['tp_uni_instructor_content_title'];
            $tp_subtitle = $settings['tp_uni_instructor_content_subtitle'];

            $attrs = tp_get_repeater_links_attr($settings, 'uni_instructor');
            extract($attrs);

            $links_attrs = [
                'href' => $link,
                'target' => $target,
                'rel' => $rel,
            ];

            $animation = $this->tp_animation_show($settings);
        ?>

            <div class="tp-leadership-item mb-55 <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <div class="tp-leadership-thumb p-relative tp-el-thumb">

                    <?php if (!empty($img['tp_uni_instructor_content_image'])): ?>
                        <img src="<?php echo esc_url($img['tp_uni_instructor_content_image']) ?>"
                            alt="<?php echo esc_url($img['tp_uni_instructor_content_image_alt']) ?>">
                    <?php endif; ?>

                    <div class="tp-leadership-hover-box d-flex justify-content-between align-items-center">
                        <div class="tp-leadership-social">
                            <?php foreach ($settings['tp_instructor_social_list'] as $key => $item):

                                $social_attrs = tp_get_repeater_links_attr($item, 'instructor_social');
                                extract($social_attrs);

                                $links_attrs_social = [
                                    'href' => $link,
                                    'target' => $target,
                                    'rel' => $rel,
                                ];

                            ?>
                                <a <?php echo tp_implode_html_attributes($links_attrs_social); ?>>
                                    <?php tp_render_signle_icon_html($item, 'instructor_social'); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php if (!empty($attrs)): ?>
                            <div class="tp-leadership-btn">
                                <a <?php echo tp_implode_html_attributes($links_attrs); ?>><?php echo esc_html($button_title); ?><span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <path d="M1.00195 9.00098L9.00195 1.00098" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.00195 1.00098H9.00195V9.00098" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tp-leadership-content">
                    <?php if (!empty($tp_subtitle)): ?>
                        <span class="tp-el-subtitle"><?php echo esc_html($tp_subtitle); ?></span>
                    <?php endif; ?>

                    <?php if (!empty($tp_title)): ?>
                        <h4 class="tp-leadership-title tp-el-title tp-el-titles">
                            <a class="tp-el-title" <?php echo tp_implode_html_attributes($links_attrs); ?>>
                                <?php echo esc_html($tp_title); ?>
                            </a>
                        </h4>
                    <?php endif; ?>

                </div>
            </div>

            <div class="tp-undergraduate-program-list d-none">
                <ul>
                    <?php foreach ($settings['tp_campus_link_items'] as $key => $item):

                        $button_title = $item['tp_campus_link_link_title'];

                        $attrs = tp_get_repeater_links_attr($item, 'campus_link');
                        extract($attrs);

                        $links_attrs = [
                            'href' => $link,
                            'target' => $target,
                            'rel' => $rel,
                        ];
                    ?>
                        <li>
                            <a <?php echo tp_implode_html_attributes($links_attrs); ?>><?php echo tp_kses($button_title); ?>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none">
                                        <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-opacity="1" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
<?php endif;
    }
}

$widgets_manager->register(new TP_University_Instructor());
