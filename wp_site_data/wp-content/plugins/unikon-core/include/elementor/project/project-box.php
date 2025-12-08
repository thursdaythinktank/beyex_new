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
class WPR_Project_Box extends Widget_Base
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
        return 'wpr-project-box';
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
        return __(WPRCORE_THEME_NAME . ' - Project Box', 'wprealizer');
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

        // project content section
        $this->start_controls_section(
            'wpr_project_content_section',
            [
                'label' => __('Project Content', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'project_image',
            [
                'label' => esc_html__('Project Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'wpr_project_subtitle',
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
            'wpr_project_title',
            [
                'label' => esc_html__('Project Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Section Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_project_desc',
            [
                'label' => esc_html__('Project Description', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Project Description', 'wprealizer'),
                'label_block' => true,
            ]
        );

        // project link 
        tp_render_links_controls($this, 'project_link');

        tp_render_icon_controls($this, 'icon_box');
        
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

        $this->tp_basic_style_controls('project_el_title', 'Project Title', '.wpr-el-title');
        $this->tp_basic_style_controls('project_el_desc', 'Project Description', '.wpr-el-desc');

        $this->tp_link_controls_style('', 'project_btn1_style', 'Button', '.wpr-el-btn');

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
                    '{{WRAPPER}} .wpr-el-img img' => 'min-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpr-el-img img' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wpr_project_icon_img',
            [
                'label' => esc_html__('Project Icon Image', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_project_icon_img_w',
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
                    '{{WRAPPER}} .wpr-el-btn img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wpr_project_icon_img_h',
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
                    '{{WRAPPER}} .wpr-el-btn img' => 'height: {{SIZE}}{{UNIT}};',
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

        <?php else:

            if (!empty($settings['project_image']['url'])) {
                $project_image = !empty($settings['project_image']['id']) ? wp_get_attachment_image_url($settings['project_image']['id']) : $settings['project_image']['url'];
                $project_image_alt = get_post_meta($settings["project_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $attrs = tp_get_repeater_links_attr($settings, 'project_link');
            extract($attrs);

            $links_attrs = [
                'href' => $link,
                'target' => $target,
                'rel' => $rel,
            ];
        ?>


<div class="work-sa__item wpr-el-section ">
    <a <?php echo tp_implode_html_attributes($links_attrs); ?> class="work-sa__item-figure wpr-el-img">
        <img src="<?php echo esc_url($project_image); ?>" alt="<?php echo esc_attr($project_image_alt); ?>">
    </a>

    <div class="work-sa__item-body">
        <div class="work-sa__item-content">
            <?php if (!empty($settings['wpr_project_title'])): ?>
            <h6 class="h6 wpr-el-title">
            <a <?php echo tp_implode_html_attributes($links_attrs); ?>>
               <?php echo tp_kses($settings['wpr_project_title']); ?>
            </a>
            </h6>
            <?php endif; ?>

            <?php if (!empty($settings['wpr_project_desc'])): ?>
            <p class="wpr-el-desc">
                <?php echo tp_kses($settings['wpr_project_desc']); ?>
            </p>
            <?php endif; ?>
        </div>
        <a <?php echo tp_implode_html_attributes($links_attrs); ?> class="arrow wpr-el-btn">
            <?php tp_render_signle_icon_html($settings, 'icon_box'); ?>
        </a>
    </div>
</div>



<?php endif;
    }
}

$widgets_manager->register(new WPR_Project_Box());
