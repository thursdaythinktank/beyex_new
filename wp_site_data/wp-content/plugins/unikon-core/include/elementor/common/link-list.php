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


if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Link_List extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait, WPR_Animation_Trait;

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
        return 'wpr-link-list';
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
        return __(WPRCORE_THEME_NAME . ' - Link List', 'wprealizer');
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

        // layout style
        $this->start_controls_section(
            'wpr_layout_style_sec',
            [
                'label' => esc_html__('Layout Style Section', 'wprealizer'),
            ]
        );
        $this->add_control(
            'wpr_layout_style',
            [
                'label' => esc_html__('Layout Style', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => esc_html__('Style 1', 'wprealizer'),
                    'style_2' => esc_html__('Style 2', 'wprealizer'),
                    'style_3' => esc_html__('Style 3', 'wprealizer'),
                ],
                'default' => 'style_1',
            ]
        );

        $this->end_controls_section();


        // Usefull Links
        $this->start_controls_section(
            'tp_ulink',
            [
                'label' => esc_html__('Usefull Links', 'wprealizer'),
                'description' => esc_html__('Control all the style settings from Style tab', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_ulink_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Link Title', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_ulink_link_switcher',
            [
                'label' => esc_html__('Active Link', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_ulink_link_type',
            [
                'label' => esc_html__('Link Type', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_ulink_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_ulink_link',
            [
                'label' => esc_html__('Custom link', 'wprealizer'),
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
                    'tp_ulink_link_type' => '1',
                    'tp_ulink_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_ulink_page_link',
            [
                'label' => esc_html__('Select Link Page', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_ulink_link_type' => '2',
                    'tp_ulink_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_ulink_list',
            [
                'label' => esc_html__('Links - List', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_ulink_title' => esc_html__('Home', 'wprealizer'),
                    ],
                    [
                        'tp_ulink_title' => esc_html__('About', 'wprealizer')
                    ],
                    [
                        'tp_ulink_title' => esc_html__('Services', 'wprealizer')
                    ]
                ],
                'title_field' => '{{{ tp_ulink_title }}}',
            ]
        );
        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {

        // Start Style Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Title/Content Style', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Start Normal Tab
        $this->start_controls_tabs('style_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => __('Normal', 'wprealizer'),
            ]
        );

        // Typography Control (Normal)
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .wpr-list-title',
            ]
        );

        // Text Color Control (Normal)
        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Background Color Control (Normal)
        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // Border Control (Normal)
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => __('Border', 'wprealizer'),
                'selector' => '{{WRAPPER}} .wpr-list-title',
            ]
        );

        // Padding Control (Normal)
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Padding', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control (Normal)
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('Margin', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // End Normal Tab

        // Start Hover Tab
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => __('Hover', 'wprealizer'),
            ]
        );

        // Text Color Control (Hover)
        $this->add_control(
            'text_color_hover',
            [
                'label' => __('Text Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wpr-list-title::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // Background Color Control (Hover)
        $this->add_control(
            'background_color_hover',
            [
                'label' => __('Background Color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // Border Control (Hover)
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border_hover',
                'label' => __('Border', 'wprealizer'),
                'selector' => '{{WRAPPER}} .wpr-list-title:hover',
            ]
        );

        // Padding Control (Hover)
        $this->add_responsive_control(
            'content_padding_hover',
            [
                'label' => __('Padding', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin Control (Hover)
        $this->add_responsive_control(
            'content_margin_hover',
            [
                'label' => __('Margin', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-list-title:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // End Hover Tab

        $this->end_controls_tabs();
        $this->end_controls_section();
        // End Style Tab

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
        <?php if ($settings['wpr_layout_style']  == 'style_2') : ?>

            <!-- <div class="d-flex flex-column gap-2">

            </div> -->

            <div class="hero-ad__tags">
                <?php foreach ($settings['tp_ulink_list'] as $key => $item) :
                    // Link
                    if ('2' == $item['tp_ulink_link_type']) {
                        $link = get_permalink($item['tp_ulink_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_ulink_link']['url']) ? $item['tp_ulink_link']['url'] : '';
                        $target = !empty($item['tp_ulink_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_ulink_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                    <?php if (!empty($link)) : ?>
                        <a class='wpr-list-title tag' href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"
                            rel="<?php echo esc_attr($rel); ?>"><?php echo tp_kses($item['tp_ulink_title']); ?></a>
                    <?php else : ?>
                        <a class='wpr-list-title tag'><?php echo tp_kses($item['tp_ulink_title']); ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['wpr_layout_style']  == 'style_3') : ?>

        <?php else : ?>
            <ul class="custom-ul hero-health__tags">
                <?php foreach ($settings['tp_ulink_list'] as $key => $item) :
                    // Link
                    if ('2' == $item['tp_ulink_link_type']) {
                        $link = get_permalink($item['tp_ulink_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_ulink_link']['url']) ? $item['tp_ulink_link']['url'] : '';
                        $target = !empty($item['tp_ulink_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_ulink_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                    <?php if (!empty($link)) : ?>
                        <li><a class='wpr-list-title' href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"
                                rel="<?php echo esc_attr($rel); ?>"><?php echo tp_kses($item['tp_ulink_title']); ?></a></li>
                    <?php else : ?>
                        <li><a class='wpr-list-title'><?php echo tp_kses($item['tp_ulink_title']); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>

            </ul>


<?php endif;
    }
}

$widgets_manager->register(new WPR_Link_List());
