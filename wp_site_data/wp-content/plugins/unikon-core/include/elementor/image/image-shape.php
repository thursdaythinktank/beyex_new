<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use WPRCore\Elementor\Controls\Group_Control_WPRBGGradient;
use WPRCore\Elementor\Controls\Group_Control_WPRGradient;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Image_Shape extends Widget_Base
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
        return 'wpr-image-shape';
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
        return __(WPRCORE_THEME_NAME . ' - Image Shape', 'wprealizer');
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
                    'layout_1' => esc_html__('Layout 1', 'wprealizer'),
                    'layout_2' => esc_html__('Layout 2', 'wprealizer'),
                    'layout_3' => esc_html__('Layout 3', 'wprealizer'),
                    // 'layout_4' => esc_html__('Layout 4', 'wprealizer'),
                    // 'layout_5' => esc_html__('Layout 5', 'wprealizer'),
                ],
                'default' => 'layout_1',
            ]
        );

        $this->end_controls_section();


        // shape
        $this->start_controls_section(
            'tp_shape',
            [
                'label' => esc_html__('Shape', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_shape_switch',
            [
                'label' => esc_html__('Shape On/Off', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => ['layout_1'],
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_1',
            [
                'label' => esc_html__('Choose Shape Image 1', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_2',
            [
                'label' => esc_html__('Choose Shape Image 2', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                    'wpr_design_style' => ['layout_2', 'layout_3', 'layout_4'],
                ]
            ]
        );
        $this->add_control(
            'tp_shape_image_3',
            [
                'label' => esc_html__('Choose Shape Image 3', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                    'wpr_design_style' => ['layout_2', 'layout_3', 'layout_4'],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size',
                'exclude' => ['custom'],
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

        // animation
        $this->tp_creative_animation(['layout_2']);
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('about_section', 'Section', '.tp-el-section');
        $this->tp_basic_style_controls('exp_number', 'Experience - Title', '.tp-el-title', ['layout_4']);
        $this->tp_basic_style_controls('exp_text', 'Experience - text', '.tp-el-subtitle', ['layout_4']);
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

        <?php if ($settings['wpr_design_style'] == 'layout_2'):

            // thumbnail
            if (!empty($settings['tp_shape_image_3']['url'])) {
                $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_3']['id'], 'full') : $settings['tp_shape_image_3']['url'];
                $tp_shape_image_3_alt = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
            }
            // shape image 1
            if (!empty($settings['tp_shape_image_1']['url'])) {
                $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
                $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            // shape image 2
            if (!empty($settings['tp_shape_image_2']['url'])) {
                $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
                $tp_shape_image_2_alt = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $animation = $this->tp_animation_show($settings);
        ?>

            <div class="tp-hero-3-shape <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>

                <?php if (!empty($tp_shape_image)): ?>
                    <div class="tp-hero-3-shape-1">
                        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($tp_shape_image_3)): ?>
                    <div class="tp-hero-3-shape-2">
                        <img src="<?php echo esc_url($tp_shape_image_3); ?>" alt="<?php echo esc_attr($tp_shape_image_3_alt); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($tp_shape_image_2)): ?>
                    <div class="tp-hero-3-shape-3">
                        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_2_alt); ?>">
                    </div>
                <?php endif; ?>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout_3'):

            $img = tp_get_img($settings, 'tp_shape_image_1', 'shape_image_size');
            $img2 = tp_get_img($settings, 'tp_shape_image_2', 'shape_image_size');
            $img3 = tp_get_img($settings, 'tp_shape_image_3', 'shape_image_size');
        ?>
            <div class="ptp-cta-3-shae">
                <div class="tp-cta-3-shape p-relative">
                    <?php if (!empty($img['tp_shape_image_1'])): ?>
                        <img src="<?php echo esc_url($img['tp_shape_image_1']); ?>"
                            alt="<?php echo esc_url($img['tp_shape_image_1_alt']); ?>">
                    <?php endif; ?>

                    <?php if (!empty($img2['tp_shape_image_2'])): ?>
                        <div class="tp-cta-3-shape-2">
                            <img src="<?php echo esc_url($img2['tp_shape_image_2']); ?>"
                                alt="<?php echo esc_url($img2['tp_shape_image_2_alt']); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($img3['tp_shape_image_3'])): ?>
                        <div class="tp-cta-3-shape-3">
                            <img src="<?php echo esc_url($img3['tp_shape_image_3']); ?>"
                                alt="<?php echo esc_url($img3['tp_shape_image_3_alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout_4'):
            // thumbnail
            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            // shape image 1
            if (!empty($settings['tp_shape_image_1']['url'])) {
                $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
                $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            $animation = $this->tp_animation_show($settings);
        ?>

            <div class="tp-about-left-wrap-fin p-relative <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <?php if (!empty($tp_image)): ?>
                    <img class="tp-about-img-fin" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                <?php endif; ?>
                <?php if (!empty($tp_shape_image)): ?>
                    <img class="tp-about-profits-fin tptranslateX2 p-absolute" src="<?php echo esc_url($tp_shape_image); ?>"
                        alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                <?php endif; ?>
                <?php if (!empty($settings['tp_exp_year'])): ?>
                    <div class="tp-about-exp-fin tp-el-section p-absolute text-center">
                        <h2 class="tp-about-expreance-years tp-el-title"><?php echo esc_html($settings['tp_exp_year']); ?></h2>
                        <?php if (!empty($settings['tp_exp_year_text'])): ?>
                            <span
                                class="tp-about-expreance-title tp-el-subtitle"><?php echo tp_kses($settings['tp_exp_year_text']); ?></span>
                        <?php endif; ?>
                        <span class="tp-about-angle tp-el-section p-absolute"></span>
                    </div>
                <?php endif; ?>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout_5'):
            // thumbnail
            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            // shape image 1
            if (!empty($settings['tp_shape_image_1']['url'])) {
                $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
                $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }
            $animation = $this->tp_animation_show($settings);
        ?>
            <div class="tp-chose-bus-wrap p-relative <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <?php if (!empty($tp_shape_image)): ?>
                    <img class="tp-chose-bus-img-5 rotate360 p-absolute" src="<?php echo esc_url($tp_shape_image) ?>"
                        alt="<?php echo esc_attr($tp_shape_image_alt) ?>">
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="tp-chose-bus-img">
                            <?php if (!empty($tp_image)): ?>
                                <img class="tp-chose-bus-img-1" src="<?php echo esc_url($tp_image) ?>"
                                    alt="<?php echo esc_attr($tp_image_alt) ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        <?php else:

            // shape image
            if (!empty($settings['tp_shape_image_1']['url'])) {
                $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
                $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>

            <?php if (!empty($tp_shape_image)): ?>
                <div class="wpr-hero-shape-img">
                    <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>" class="rounded-arrow">
                </div>
            <?php endif; ?>
<?php endif;
    }
}

$widgets_manager->register(new WPR_Image_Shape());
