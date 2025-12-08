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
class TP_Campus_Link extends Widget_Base
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
        return 'tp-campus-link';
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
        return __(WPRCORE_THEME_NAME . ' :: Campus Link', 'wprealizer');
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
                'label' => __('Link Item', 'wprealizer'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_campus_link_link_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'wprealizer'),
                'default' => __('Accounting', 'wprealizer'),
                'placeholder' => __('Type button Title', 'wprealizer'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        tp_render_links_controls($repeater, 'campus_link');



        $this->add_control(
            'tp_campus_link_items',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tp_campus_link_link_title }}}',
                'default' => [
                    [
                        'tp_campus_link_link_title' => __('Accounting', 'wprealizer')
                    ],
                    [
                        'tp_campus_link_link_title' => __('Advertising', 'wprealizer')
                    ],
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
        $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
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

        ?>

            <div class="tp-undergraduate-program-list">
                <ul>
                    <?php foreach ($settings['tp_campus_link_items'] as $key => $item):

                        $button_title = $item['tp_campus_link_link_title'];

                        $attrs = tp_get_repeater_links_attr($item, 'campus_link',);
                        extract($attrs);

                        $links_attrs = [
                            'href' => $link,
                            'target' => $target,
                            'rel' => $rel,
                        ];
                    ?>
                        <li>
                            <a class="tp-el-title" <?php echo tp_implode_html_attributes($links_attrs); ?>><?php echo tp_kses($button_title); ?>
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

$widgets_manager->register(new TP_Campus_Link());
