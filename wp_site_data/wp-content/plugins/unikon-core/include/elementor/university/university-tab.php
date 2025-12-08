<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
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
class TP_University_Tab extends Widget_Base
{

    use WPR_Style_Trait;

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
        return 'tp-university-tab';
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
        return __(WPRCORE_THEME_NAME . ' :: University Tab', 'wprealizer');
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

        $this->wpr_design_layout('Select Layout', 1);

        $this->start_controls_section(
            'tp_university_tab_rep_section',
            [
                'label' => __('Tab Items', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_university_tab_rep_switcher',
            [
                'label' => esc_html__('Active Tab', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
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
        tp_render_icon_controls($repeater, 'university_tab');

        $repeater->add_control(
            'tp_university_tab_rep_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'wprealizer'),
                'default' => __('Tab Title', 'wprealizer'),
                'placeholder' => __('Type Tab Title', 'wprealizer'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tp_university_tab_rep_template',
            [
                'label' => __('Section Template', 'wprealizer'),
                'placeholder' => __('Select a section template for as tab content', 'wprealizer'),

                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tp_university_tab_rep_tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{tp_university_tab_rep_title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
            ]
        );

        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content() {}

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

        <?php else: ?>

            <div class="tp-tution-wrapper">
                <div class="accordion" id="accordionExample">
                    <?php foreach ($settings['tp_university_tab_rep_tabs'] as $key => $item):
                        $heading = $item['tp_university_tab_rep_title'];

                        $active_id = $item['tp_university_tab_rep_switcher'];
                        $show_tab = ($active_id === "yes") ? ' show' : ''; // Set active class for the first tab
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading_<?php echo esc_attr($key); ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_<?php echo esc_attr($key); ?>" aria-expanded="false" aria-controls="collapse_<?php echo esc_attr($key); ?>">
                                    <?php tp_render_signle_icon_html($item, 'university_tab'); ?>
                                    <?php echo tp_kses($heading); ?>
                                </button>
                            </h2>
                            <div id="collapse_<?php echo esc_attr($key); ?>" class="accordion-collapse collapse<?php echo esc_attr($show_tab); ?>" aria-labelledby="heading_<?php echo esc_attr($key); ?>">
                                <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content($item['tp_university_tab_rep_template'], true); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new TP_University_Tab());
