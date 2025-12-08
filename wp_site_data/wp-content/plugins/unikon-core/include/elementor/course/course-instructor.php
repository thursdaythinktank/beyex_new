<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use TUTOR\Instructors_List;
use \Etn\Utils\Helper as Helper;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Course_Instructor extends Widget_Base
{

    use WPR_Style_Trait, WPR_Column_Trait, WPR_Query_Trait, WPR_Animation_Trait;
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
        return 'course-instructor';
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
        return __(WPRCORE_THEME_NAME . ' :: Course Instructor', 'wprealizer');
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

    private function get_tutor_social_list()
    {
        $tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();
        $social_list = array();
        foreach ($tutor_user_social_icons as $key => $social_icon) {
            $social_list[$key] = $social_icon['label'];
        }
        return $social_list;
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
            'course_sec',
            [
                'label' => esc_html__('Content Controls', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_instructor_btn_text',
            [
                'label'       => esc_html__('Button Text', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Details', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
            ]
        );

        $this->add_control(
            'tp_instructor_social_icons',
            [
                'label'    => esc_html__('Social Icons', 'textdomain'),
                'description' => esc_html__('Select social icons to display', 'textdomain'),
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options'  => $this->get_tutor_social_list(),
                'default'  => ['_tutor_profile_facebook', '_tutor_profile_twitter',],
            ]
        );


        $this->end_controls_section();



        // columns
        $this->tp_columns('course_instructor_col');
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');
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
            $instructors_list = Instructors_List::get_instructors(array('approved'), 0, 12);

        ?>

            <div class="row <?php echo esc_attr($this->row_cols_show($settings, 'course_instructor_col')); ?>">
                <?php foreach ($instructors_list as $key => $instructor) :
                    $_ID = $instructor->ID;
                    $name = $instructor->display_name;
                    $job_title = get_user_meta($_ID, '_tutor_profile_job_title', true);
                    $profile_url       = tutor_utils()->profile_url($_ID, true);

                    $tutor_user_social_icons = tutor_utils()->tutor_user_social_icons();

                    foreach ($tutor_user_social_icons as $key => $social_icon) {
                        $url                                    = get_user_meta($_ID, $key, true);
                        $tutor_user_social_icons[$key]['url'] = $url;
                    }
                ?>
                    <div class="col">
                        <div class="tp-leadership-item mb-55">
                            <div class="tp-leadership-thumb instructor p-relative">
                                <?php
                                $instructor_image = get_user_meta($_ID, '_tutor_profile_photo', true);
                                if (! empty($instructor_image)) {
                                    echo wp_get_attachment_image($instructor_image, 'full');
                                }
                                ?>

                                <div class="tp-leadership-hover-box d-flex justify-content-between align-items-center">
                                    <div class="tp-leadership-social instructor">
                                        <?php
                                        if (!empty($settings['tp_instructor_social_icons'])) {
                                            foreach ($tutor_user_social_icons as $key => $social_icon) {
                                                foreach ($settings['tp_instructor_social_icons'] as $icon) {
                                                    if ($key == $icon) {
                                                        $url = $social_icon['url'];
                                                        ! empty($url) ? printf('<a href="%s" class="%s" title="%s" target="_blank" rel="noopener noreferrer nofollow"></a>', esc_url($url), esc_attr($social_icon['icon_classes']), esc_attr($social_icon['label'])) : '';
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php if (!empty($settings['tp_instructor_btn_text'])) : ?>
                                        <div class="tp-leadership-btn">
                                            <a href="<?php echo esc_url($profile_url); ?>"><?php echo tp_kses($settings['tp_instructor_btn_text']); ?><span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                        <path d="M1.00195 9.00098L9.00195 1.00098" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M1.00195 1.00098H9.00195V9.00098" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tp-leadership-content">

                                <?php if (!empty($job_title)) : ?>
                                    <span><?php echo tp_kses($job_title); ?></span>
                                <?php endif; ?>

                                <h4 class="tp-leadership-title instructor">
                                    <a href="<?php echo esc_url($profile_url); ?>"><?php echo tp_kses($name); ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Course_Instructor());
