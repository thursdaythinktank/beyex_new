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
class TP_Campus_Slider extends Widget_Base
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
        return 'tp-campus-slider';
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
        return __(WPRCORE_THEME_NAME . ' :: Campus Slider', 'wprealizer');
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


        // testimonial section
        $this->start_controls_section(
            'tp_campus_slider_item',
            [
                'label' => __('Slider Item', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_slider_item_navigator',
            [
                'label' => esc_html__('Navigator', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_campus_slider_image',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'slider_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );


        $this->add_control(
            'tp_campus_slider_items',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__('Testimonial Item', 'wprealizer'),
                'default' => [
                    [
                        'tp_campus_slider_image' => __('item#1', 'wprealizer')
                    ],
                    [
                        'tp_campus_slider_image' => __('item#2', 'wprealizer')
                    ],
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');


        $this->start_controls_section(
            '_section_style_dot',
            [
                'label' => __('Nav Style', 'wprealizer'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tp_slider_item_navigator' => 'yes',
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
                    '{{WRAPPER}} .tp-campus-life-arrow' => 'left: {{SIZE}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .tp-campus-life-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important;',
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
            $navigator = $settings['tp_slider_item_navigator'];
        ?>
            <section class="tp-campus-life-area p-relative">
                <div class="container-fluid gx-0 fix">
                    <div class="row justify-content-center gx-0">
                        <div id="down2" class="tp-campus-life-slider p-relative tp-el-section">
                            <div class="swiper tp-campus-life-active">
                                <div class="swiper-wrapper align-items-center">
                                    <?php foreach ($settings['tp_campus_slider_items'] as $key => $item):
                                        // thumbnail
                                        $tp_image = !empty($item['tp_campus_slider_image']['id']) ? wp_get_attachment_image_url($item['tp_campus_slider_image']['id'], $item['slider_thumbnail_size']) : $item['tp_campus_slider_image']['url'];
                                        $tp_image_alt = get_post_meta($item["tp_campus_slider_image"]["id"], "_wp_attachment_image_alt", true);
                                    ?>
                                        <div class="swiper-slide">
                                            <?php if (!empty($tp_image)): ?>
                                                <div class="tp-campus-life-thumb text-center">
                                                    <img src="<?php echo esc_url($tp_image); ?>"
                                                        alt="<?php echo esc_attr($tp_image_alt); ?>">
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ('yes' == $navigator): ?>
                    <div class="tp-campus-life-arrow">
                        <div class="tp-campus-prev">
                            <span>
                                <svg width="34" height="18" viewBox="0 0 34 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M33 9H0.999999" stroke="currentCOlor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9 1L1 9L9 17" stroke="currentCOlor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                        <div class="tp-campus-next">
                            <span>
                                <svg width="34" height="18" viewBox="0 0 34 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9H33" stroke="currentCOlor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M25 1L33 9L25 17" stroke="currentCOlor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
<?php endif;
    }
}

$widgets_manager->register(new TP_Campus_Slider());
