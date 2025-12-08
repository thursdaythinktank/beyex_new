<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Banner extends Widget_Base
{

    use \WPRCore\Widgets\WPR_Style_Trait;
    use \WPRCore\Widgets\WPR_Animation_Trait;

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
        return 'tp-hero-banner';
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
        return __(WPRCORE_THEME_NAME . ' :: Hero Banner', 'wprealizer');
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

        // Hero title/content
        $this->start_controls_section(
            'hero_content_sec',
            [
                'label' => esc_html__('Content', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__('Choose Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'wprealizer'),
                'description' => esc_html__('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'wprealizer'),
                'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_description',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'description' => esc_html__(
                    'When you design products and services in close partnership with clients'
                ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('This is description text here.', 'wprealizer'),
                'placeholder' => esc_html__('Type section description here', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_year_title',
            [
                'label' => esc_html__('Year', 'wprealizer'),
                'description' => esc_html__('Years'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('12', 'wprealizer'),
                'placeholder' => esc_html__('Years', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_year_content',
            [
                'label' => esc_html__('Year Content', 'wprealizer'),
                'description' => esc_html__('Years of Experience'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Years of Experience', 'wprealizer'),
                'placeholder' => esc_html__('Years of Experience', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // button
        $this->tp_link_render_controls('banner', 'Button', ['layout-1', 'layout-2']);

        // animation
        $this->tp_creative_animation();
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-content', 'layout-1');
        $this->tp_link_controls_style('', 'btn1_style', 'Button', '.tp-els-btn');
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
        $button_control_id = 'banner';
?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>


        <?php else:
            // thumbnail
            $img = tp_get_img($settings, 'tp_image', 'full', false);

            $this->tp_link_attributes_render($button_control_id, 'tp-els-btn', $this->get_settings());

            $animation = $this->tp_animation_show($settings);

            $attrs = [
                'class' => "tp-about-banner-content tp-el-section p-relative " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
            ];
        ?>

            <div <?php echo tp_implode_html_attributes($attrs) ?>>
                <?php if (!empty($settings['tp_sub_title'])): ?>
                    <span class="span tp-el-subtitle">
                        <?php echo tp_kses($settings['tp_sub_title']); ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($settings['tp_description'])): ?>
                    <p class="tp-el-content">
                        <?php echo tp_kses($settings['tp_description']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($settings['tp_banner_text'])): ?>
                    <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $button_control_id . ''); ?>>
                        <?php echo tp_kses($settings['tp_banner_text']); ?>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M1 6H11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M6 1L11 6L6 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                <?php endif; ?>

                <div class="tp-about-banner-content-year">

                    <?php if (!empty($settings['tp_year_title'])): ?>
                        <span data-background="<?php echo esc_url($img['tp_image']); ?>">
                            <?php echo tp_kses($settings['tp_year_title']); ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_year_content'])): ?>
                        <p class="tp-el-title">
                            <?php echo tp_kses($settings['tp_year_content']); ?>
                        </p>
                    <?php endif; ?>
                </div>

            </div>

<?php endif;
    }
}

$widgets_manager->register(new TP_Hero_Banner());
