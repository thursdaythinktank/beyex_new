<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
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
class TP_About_Tab extends Widget_Base
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
        return 'tp-about-tab';
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
        return __(WPRCORE_THEME_NAME . ' :: About Tab', 'wprealizer');
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

        // section title 
        $this->tp_section_title_render_controls('about_tab_section_heading', 'Section Heading', 'layout-10');


        // About Tab group
        $this->start_controls_section(
            'wpr_about_tab_rep_section',
            [
                'label' => esc_html__('About List', 'wprealizer'),
                'description' => esc_html__('Control all the style settings from Style tab', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wpr_about_tab_shape_switcher',
            [
                'label' => esc_html__('Image shape', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 0,
                'separator' => 'before',
                'condition' => [
                    'wpr_design_style' => 'layout-10',
                ],
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
                    // 'style_2' => __('Style 2', 'wprealizer'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'wpr_about_tab_active',
            [
                'label' => esc_html__('Active This', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 0,
                'separator' => 'before',
            ]
        );

        $repeater->start_controls_tabs(
            'wpr_about_tab_tabs'
        );

        // tab heading 
        $repeater->start_controls_tab(
            'wpr_about_tab_normal_tab',
            [
                'label' => esc_html__('Heading', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'wpr_about_tab_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title here', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $repeater->end_controls_tab();


        // Tab content 
        $repeater->start_controls_tab(
            'wpr_about_content_tab',
            [
                'label' => esc_html__('Content', 'textdomain'),
            ]
        );

        $repeater->add_control(
            'wpr_about_content_tab_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Slider Image', 'wprealizer'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => 'style_10',
                ],
            ]
        );

        $repeater->add_control(
            'wpr_about_content_item_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Item Image', 'wprealizer'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => 'style_10',
                ],
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'content_thumb',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
                'condition' => [
                    'repeater_condition' => 'style_10',
                ],
            ]
        );

        $repeater->add_control(
            'wpr_about_content_tab_title',
            [
                'label' => esc_html__('Slider Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Your Slider Title here', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('Housing & Dining'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_10',
                ],
            ]
        );

        $repeater->add_control(
            'wpr_about_tab_content',
            [
                'label' => esc_html__('Slider Content', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Your Slider Content here', 'wprealizer'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'wpr_about_content_tab_btn_title',
            [
                'label' => esc_html__('Button title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Find out More', 'wprealizer'),
                'label_block' => false,
                'condition' => [
                    'repeater_condition' => 'style_10',
                ],
            ]
        );

        // tp_render_links_controls($repeater, 'about_tab_content_btn',);

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'wpr_about_lists',
            [
                'label' => esc_html__('About Tab List', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'wpr_about_tab_title' => esc_html__('Gorki Campus', 'wprealizer'),
                    ],
                    [
                        'wpr_about_tab_title' => esc_html__('Skolkovo Campus', 'wprealizer')
                    ],
                    [
                        'wpr_about_tab_title' => esc_html__('Saint Petersburg Campus', 'wprealizer')
                    ]
                ],
                'title_field' => '{{{ wpr_about_tab_title }}}',
            ]
        );

        //  image size 
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'content_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

        $this->tp_creative_animation_multi(null, 'about_tab_left', 'wpr_design_style', 'Left Content Animation');
        $this->tp_creative_animation_multi(null, 'about_tab_right', 'wpr_design_style', 'Right Content Animation');
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_basic_style_controls('about_sec_title', 'Heading Title', '.wpr-el-sec-title', 'layout-1');
        $this->tp_basic_style_controls('about_tab_description', 'Heading Description', '.wpr-el-sec-desc', 'layout-1');
        $this->tp_basic_style_controls('about_tab_title', 'Tab Title', '.wpr-el-tab-title');
        $this->tp_basic_style_controls('about_sec_content', 'Tab Content', '.wpr-el-tab-content');
        $this->tp_link_controls_style('', 'btn1_style', 'Tab Button', '.tp-els-btn',);
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

            <div class="tp-campus-student-content">
                <div class="tab-content" id="myTabContent">
                    <?php foreach ($settings['wpr_about_lists'] as $key => $item):

                        $active_show = $item['wpr_about_tab_active'] ? 'active show' : NULL;

                        // thumbnail
                        $img = tp_get_img($item, 'wpr_about_content_tab_image', 'content_thumb');
                        $content_img = tp_get_img($item, 'wpr_about_content_item_image', 'content_thumb');

                        $wpr_button_title = $item['wpr_about_content_tab_btn_title'];
                        $tp_address = $item['wpr_about_tab_content'];

                    ?>
                        <div class="tab-pane fade <?php echo esc_attr($active_show); ?>" id="home-<?php echo esc_attr($key + 1); ?>"
                            role="tabpanel" aria-labelledby="home-tab-<?php echo esc_attr($key + 1); ?>">
                            <div class="tp-campus-student-wrap p-relative">

                                <?php if (!empty($img['wpr_about_content_tab_image'])): ?>
                                    <div class="tp-campus-student-thumb">
                                        <img src="<?php echo esc_url($img['wpr_about_content_tab_image']) ?>"
                                            alt="<?php echo esc_url($img['wpr_about_content_tab_image_alt']) ?>">
                                    </div>
                                <?php endif; ?>


                                <div class="tp-campus-student-item">

                                    <?php if (!empty($item['wpr_about_content_tab_title'])): ?>
                                        <h4 class="tp-campus-student-item-title wpr-el-tab-title">
                                            <?php echo esc_html($item['wpr_about_content_tab_title']); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if (!empty($item['wpr_about_tab_content'])): ?>
                                        <p class="wpr-el-tab-content">
                                            <?php echo esc_html($item['wpr_about_tab_content']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($content_img['wpr_about_content_item_image'])): ?>
                                        <div class="tp-campus-student-item-thumb">
                                            <img src="<?php echo esc_url($content_img['wpr_about_content_item_image']) ?>"
                                                alt="<?php echo esc_url($content_img['wpr_about_content_item_image_alt']) ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <div class="tp-campus-student-list">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <?php foreach ($settings['wpr_about_lists'] as $key => $item):

                        $active_title = $item['wpr_about_tab_active'] ? 'active' : NULL;
                        $wpr_title = $item['wpr_about_tab_title'];
                    ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tp-els-btn <?php echo esc_attr($active_title); ?>"
                                id="home-tab-<?php echo esc_attr($key + 1); ?>" data-bs-toggle="tab"
                                data-bs-target="#home-<?php echo esc_attr($key + 1); ?>" type="button" role="tab" aria-controls="home"
                                aria-selected="true"><?php echo esc_html($wpr_title); ?></button>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'tp-about-campus-title wpr-el-sec-title');

            $animation_left = $this->tp_animation_show_multi($settings, 'about_tab_left');
            $animation_right = $this->tp_animation_show_multi($settings, 'about_tab_right');
            $tp_shape_switcher = $settings['wpr_about_tab_shape_switcher'];

        ?>

<div class="choose-us-fin__tabs wpr-el-sec-title">
    <ul class="nav nav-pills mb-3"
        id="pills-tab"
        role="tablist">
        <?php foreach ($settings['wpr_about_lists'] as $key => $item):

            $active_title = $item['wpr_about_tab_active'] ? 'active' : NULL;
            $wpr_title = $item['wpr_about_tab_title'];
        ?>
        <li class="nav-item" role="presentation">
            <button
            class="nav-link wpr-el-tab-title <?php echo esc_attr($active_title); ?>"
            id="pills-strategies-tab-<?php echo esc_attr($key + 1); ?>"
            data-bs-toggle="pill"
            data-bs-target="#pills-strategies-<?php echo esc_attr($key + 1); ?>"
            type="button"
            role="tab"
            aria-controls="pills-strategies"
            aria-selected="true"
            >
            <?php echo esc_html($wpr_title); ?>
            </button>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <?php foreach ($settings['wpr_about_lists'] as $key => $item):

            $active_show = $item['wpr_about_tab_active'] ? 'active show' : NULL;

        ?>
        <div
            class="tab-pane wpr-el-tab-content fade <?php echo esc_attr($active_show); ?>"
            id="pills-strategies-<?php echo esc_attr($key + 1); ?>"
            role="tabpanel"
            aria-labelledby="pills-strategies-tab-<?php echo esc_attr($key + 1); ?>"
            tabindex="0">
            <?php if (!empty($item['wpr_about_tab_content'])): ?>
                <?php echo esc_html($item['wpr_about_tab_content']); ?>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<?php endif;
    }
}

$widgets_manager->register(new TP_About_Tab());
