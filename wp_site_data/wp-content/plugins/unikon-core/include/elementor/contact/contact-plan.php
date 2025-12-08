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
class TP_Contact_Plan extends Widget_Base
{

    use WPR_Style_Trait, WPR_Animation_Trait;

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
        return 'tp-contact-cta';
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
        return __(WPRCORE_THEME_NAME . ' :: Contact PLAN', 'wprealizer');
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

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', ['layout-1']);

        // list items
        $this->start_controls_section(
            'tp_list_sec',
            [
                'label' => esc_html__('List Items', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_slide_image',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'tp_text_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tp Slide Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_text_desc',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tp Slide Description', 'wprealizer'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_slider_count',
            [
                'label' => esc_html__('Count', 'wprealizer'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100000,
                'step' => 1,
                'default' => 1,
            ]
        );

        tp_render_links_controls($repeater, 'conatct_plan');

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tp_slider_list',
            [
                'label' => esc_html__('Text List', 'wprealizer'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_text_title' => esc_html__('Art Direction', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Branding', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Content Production', 'wprealizer'),
                    ],
                    [
                        'tp_text_title' => esc_html__('Animation', 'wprealizer'),
                    ],
                ],
                'title_field' => '{{{ tp_text_title }}}',
            ]
        );

        $this->end_controls_section();


        //animation
        $this->tp_creative_animation();
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('contact_cta_title', 'Big Title', '.tp-el-title');
        $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
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
            $animation = $this->tp_animation_show($settings);

            $attrs = [
                'class' => "tp-plan-4-section align-box " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];

            $this->add_render_attribute('title_args', 'class', 'tp-plan-4-section-title tp-el-title');
        ?>

            <!-- plan-area-start -->
            <section class="plan-area tp-plan-4-wrap fix tp-el-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div <?php echo tp_implode_html_attributes($attrs); ?>>

                                <?php if (!empty($settings['tp_section_sub_title'])): ?>
                                    <span class="tp-el-subtitle">
                                        <?php echo tp_kses($settings['tp_section_sub_title']); ?>
                                    </span>
                                <?php endif; ?>

                                <?php
                                if (!empty($settings['tp_section_title'])):
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['tp_section_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        tp_kses($settings['tp_section_title'])
                                    );
                                endif;
                                ?>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="tp-plan-4-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                                <div class="row">
                                    <?php foreach ($settings['tp_slider_list'] as $key => $item):
                                        $attrs = tp_get_repeater_links_attr($item, 'conatct_plan');
                                        extract($attrs);

                                        $links_attrs = [
                                            'href' => $link,
                                            'target' => $target,
                                            'rel' => $rel,
                                        ];
                                        $img = tp_get_img($item, 'tp_slide_image', 'tp_image');
                                    ?>
                                        <div class="col-md-4 mb-30">
                                            <a <?php echo tp_implode_html_attributes($links_attrs); ?> class="tp-plan-4-item active">
                                                <div class="tp-plan-4-bg" style="background-image:url(<?php echo esc_url($img['tp_slide_image']); ?>)"></div>
                                                <div class="tp-plan-4-content d-flex align-items-center justify-content-center">
                                                    <div class="tp-plan-4-box text-center">
                                                        <?php if (!empty($item['tp_slider_count'])): ?>
                                                            <span>
                                                                <?php echo tp_kses($item['tp_slider_count']); ?>
                                                            </span>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['tp_text_title'])): ?>
                                                            <h4 class="tp-plan-4-title">
                                                                <?php echo tp_kses($item['tp_text_title']); ?>
                                                            </h4>
                                                        <?php endif; ?>

                                                        <?php if (!empty($item['tp_text_desc'])): ?>
                                                            <p>
                                                                <?php echo tp_kses($item['tp_text_desc']); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- plan-area-end -->

<?php endif;
    }
}

$widgets_manager->register(new TP_Contact_Plan());
