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


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Footer_Social extends Widget_Base
{

    use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait;

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
        return 'wpr-footer-social';
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
        return __(WPRCORE_THEME_NAME . ' :: Footer Social', 'wprealizer');
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


        $this->start_controls_section(
            'tp_footer_social_section_layout',
            [
                'label' => esc_html__('Layout', 'wprealizer'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wpr_design_style',
            [
                'label' => esc_html__('Design Style', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'wprealizer'),
                    // 'layout-2' => esc_html__( 'Layout 2', 'wprealizer' ),
                    // 'layout-3' => esc_html__( 'Layout 3', 'wprealizer' ),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'tp_footer_social_section',
            [
                'label' => esc_html__('Footer Social', 'wprealizer'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );



        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'wprealizer'),
                    // 'style_2' => __( 'Style 2', 'wprealizer' ),
                    // 'style_3' => __( 'Style 3', 'wprealizer' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'wprealizer'),
                    'icon' => esc_html__('Icon', 'wprealizer'),
                    'svg' => esc_html__('SVG', 'wprealizer'),
                ],
                'condition' => [
                    'repeater_condition' => 'style_1',
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'wprealizer'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => 'style_1',
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' => 'style_1',
                ]
            ]
        );


        $repeater->add_control(
            'tp_box_icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-brands fa-facebook',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'tp_box_icon_type' => 'icon',
                    'repeater_condition' => 'style_1',
                ],
            ]
        );

        $repeater->add_control(
            'tp_footer_social_title',
            [
                'label'   => esc_html__('Title', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Facebook', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_footer_social_url',
            [
                'label'   => esc_html__('URL', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::URL,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => false,
                    'nofollow'          => false,
                ],
                'placeholder' => esc_html__('Your URL', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_footer_social_list',
            [
                'label'       => esc_html__('Social List', 'wprealizer'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tp_footer_social_title'   => esc_html__('Facebook', 'wprealizer'),

                    ],
                    [
                        'tp_footer_social_title'   => esc_html__('Instagram', 'wprealizer'),

                    ],
                    [
                        'tp_footer_social_title'   => esc_html__('Behance', 'wprealizer'),

                    ],
                    [
                        'tp_footer_social_title'   => esc_html__('Dribble', 'wprealizer'),

                    ],
                ],
                'title_field' => '{{{ tp_footer_social_title }}}',
            ]
        );


        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_link_controls_style(null, 'tp_footer_social', 'Link Style', '.tp-el-footer-social a');
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

        <?php if ($settings['wpr_design_style'] == 'layout-2') : ?>

            <div class="tp-copyright-2-social tp-el-footer-social">

                <?php foreach ($settings['tp_footer_social_list'] as $menu) :
                    $link = !empty($menu['tp_footer_social_url']['url']) ? $menu['tp_footer_social_url']['url'] : '';
                    $target = !empty($menu['tp_footer_social_url']['is_external']) ? '_blank' : '';
                    $rel = !empty($menu['tp_footer_social_url']['nofollow']) ? 'nofollow' : '';
                ?>
                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($menu['tp_footer_social_title']); ?></a>
                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-3') :
        ?>


            <div class="wpr-footer-3-social tp-el-footer-social">
                <?php foreach ($settings['tp_footer_social_list'] as $menu) :
                    $link = !empty($menu['tp_footer_social_url']['url']) ? $menu['tp_footer_social_url']['url'] : '';
                    $target = !empty($menu['tp_footer_social_url']['is_external']) ? '_blank' : '';
                    $rel = !empty($menu['tp_footer_social_url']['nofollow']) ? 'nofollow' : '';
                ?>
                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">

                        <?php if ($menu['tp_box_icon_type'] == 'icon') : ?>
                            <?php if (!empty($menu['tp_box_icon'])) : ?>
                                <?php \Elementor\Icons_Manager::render_icon($menu['tp_box_icon'], ['aria-hidden' => 'true']); ?>
                            <?php endif; ?>
                        <?php elseif ($menu['tp_box_icon_type'] == 'image') : ?>
                            <?php if (!empty($menu['tp_box_icon_image']['url'])) : ?>
                                <img src="<?php echo $menu['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($menu['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                        <?php else : ?>
                            <span>
                                <?php if (!empty($menu['tp_box_icon_svg'])) : ?>
                                    <?php echo $menu['tp_box_icon_svg']; ?>
                                <?php endif; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>

        <?php else : ?>

            <div class="wpr-footer-newsletter-social wpr-footer-inner-social tp-el-footer-social">
                <?php foreach ($settings['tp_footer_social_list'] as $menu) :
                    $link = !empty($menu['tp_footer_social_url']['url']) ? $menu['tp_footer_social_url']['url'] : '';
                    $target = !empty($menu['tp_footer_social_url']['is_external']) ? '_blank' : '';
                    $rel = !empty($menu['tp_footer_social_url']['nofollow']) ? 'nofollow' : '';
                ?>

                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">

                        <?php if ($menu['tp_box_icon_type'] == 'icon') : ?>
                            <?php if (!empty($menu['tp_box_icon'])) : ?>
                                <?php \Elementor\Icons_Manager::render_icon($menu['tp_box_icon'], ['aria-hidden' => 'true']); ?>
                            <?php endif; ?>
                        <?php elseif ($menu['tp_box_icon_type'] == 'image') : ?>
                            <?php if (!empty($menu['tp_box_icon_image']['url'])) : ?>
                                <img src="<?php echo $menu['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($menu['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                        <?php else : ?>
                            <span>
                                <?php if (!empty($menu['tp_box_icon_svg'])) : ?>
                                    <?php echo $menu['tp_box_icon_svg']; ?>
                                <?php endif; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>


<?php

    }
}

$widgets_manager->register(new TP_Footer_Social());
