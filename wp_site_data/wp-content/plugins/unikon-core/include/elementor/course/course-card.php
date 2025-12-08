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
class TP_Course_Card extends Widget_Base
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
        return 'course-card';
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
        return __(WPRCORE_THEME_NAME . ' :: Course Card', 'wprealizer');
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

        $this->wpr_design_layout('Select Layout', 4);

        $this->start_controls_section(
            'course_sec',
            [
                'label' => esc_html__('Content Controls', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'wpr_design_style!' => ['layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_post_content',
            [
                'label' => esc_html__('Description', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => ['layout-2']
                ]
            ]
        );
        $this->add_control(
            'tp_post_content_limit',
            [
                'label' => esc_html__('Description Limit', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => '10',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tp_post_content' => 'yes',
                    'wpr_design_style' => ['layout-2']
                ]
            ]
        );
        $this->add_control(
            'tp_course_main_image',
            [
                'label' => esc_html__('Main Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_course_time',
            [
                'label' => esc_html__('Course Time', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('20 min', 'wprealizer'),
                'placeholder' => esc_html__('Your Course Time here', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_course_student_text',
            [
                'label' => esc_html__('Students Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Offline Students', 'wprealizer'),
                'placeholder' => esc_html__('Your Offline Students here', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_course_live_image',
            [
                'label' => esc_html__('Live video Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_course_student_image',
            [
                'label' => esc_html__('Student Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        // course button
        $this->add_control(
            'tp_course_btn_text',
            [
                'label' => esc_html__('Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Preview This Course', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-1', 'layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_course_btn_url',
            [
                'label' => esc_html__('Video Class Url', 'wprealizer'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__('Placeholder Text', 'wprealizer'),
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ['layout-4']
                ]
            ]
        );

        $this->end_controls_section();

        $this->tp_query_controls('course_card', 'Course Controls', 'courses', 'course-category');

        // columns
        $this->tp_columns('course_card_col', ['layout-1', 'layout-2', 'layout-3', 'layout-40']);

        // animation
        $this->tp_creative_animation(['layout-2', 'layout-3', 'layout-4']);
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('a_p_content_style', 'Content', '.tp-el-content');
        $this->tp_basic_style_controls('a_p_content_title', 'Title', '.tp-el-title');
        $this->tp_basic_style_controls('c_card_meta', 'Course Meta', '.tp-el-c-meta');
        $this->tp_basic_style_controls('c_card_desc', 'Description', '.tp-el-c-desc');
        $this->tp_basic_style_controls('c_card_price', 'Price', '.tp-el-c-price');

        // avator 
        $this->start_controls_section(
            'tp_c_card_author_meta_secton_style',
            [
                'label' => esc_html__('Author meta', 'textdomain'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tp_c_card_author_image_w',
            [
                'label' => esc_html__('Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%',],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 36,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-avatar .tutor-avatar' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'tp_c_card_author_image_h',
            [
                'label' => esc_html__('Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%',],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 36,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-avatar .tutor-avatar' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tp_c_card_author_image_border_control',
                'label'    => esc_html__('Border', 'textdomain'),
                'selector' => '{{WRAPPER}} .tp-el-avatar .tutor-avatar',
            ]
        );

        $this->add_control(
            'tp_c_card_author_image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'textdomain'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .tp-el-avatar .tutor-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tp_c_card_author_image_name_typo',
                'label' => esc_html__('Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .tp-el-avatar',
            ]
        );

        $this->add_control(
            'tp_c_card_author_image_name_color',
            [
                'label' => esc_html__('Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-avatar' => 'color: {{VALUE}}',
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

        <?php if ($settings['wpr_design_style'] == 'layout-4'):

            $animation = $this->tp_animation_show($settings);

            if (!empty($settings['tp_course_btn_url']['url'])) {
                $this->add_link_attributes('tp_course_btn_url', $settings['tp_course_btn_url']);
            }
            $main_image = tp_get_img($settings, 'tp_course_main_image', 'tp_image');

            $live_image = tp_get_img($settings, 'tp_course_live_image', 'tp_image');
            $student_image = tp_get_img($settings, 'tp_course_student_image', 'tp_image');
        ?>
            <?php
            $args = tp_query_args('courses', 'course-category', $this->get_settings());
            $main_query = new \WP_Query($args);
            ?>
            <?php if ($main_query->have_posts()):
                $main_query->the_post();
                global $post, $authordata;
                $tutor_course_img = get_tutor_course_thumbnail_src();

                $course_id = get_the_ID();
                $course_categories = get_tutor_course_categories($course_id);

                $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);

                $cat_color = '#17A2B8';
                if (!empty($course_categories[0])) {
                    $cat_color = get_term_meta($course_categories[0]->term_id, '_wprealizer_course_cat_color', true);
                    $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
                }


                $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                $course_rating = tutor_utils()->get_course_rating();

                $designation = get_the_author_meta('_tutor_profile_job_title', $post->post_author);

                $attrs = [
                    'class' => "tp-live-bg " . $animation['animation'] . ' ' . $animation['duration'] . ' ' . $animation['delay'],
                ];

            ?>
                <div <?php echo tp_implode_html_attributes($attrs); ?>>
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="tp-live-thumb p-relative">
                                <img src="<?php echo esc_url($main_image['tp_course_main_image']); ?>"
                                    alt="<?php echo esc_attr($main_image['tp_course_main_image_alt']); ?>">

                                <?php if (!empty($live_image['tp_course_live_image'])): ?>
                                    <div class="tp-live-thumb-video">
                                        <img src="<?php echo esc_url($live_image['tp_course_live_image']); ?>"
                                            alt="<?php echo esc_attr($live_image['tp_course_live_image_alt']); ?>">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['tp_course_time'])): ?>
                                    <div class="tp-live-thumb-text">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z"
                                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                                <path d="M8 3.7998V7.9998L10.8 9.3998" stroke="white" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                            <?php echo tp_kses($settings['tp_course_time']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="tp-live-content">

                                <?php if (!empty($course_categories[0])): ?>
                                    <span class="tp-live-tag" data-cat-color="<?php echo esc_attr($cat_color); ?>">
                                        <a href="<?php echo get_term_link($course_categories[0]); ?>">
                                            <?php echo esc_html($course_categories[0]->name); ?>
                                        </a>
                                    </span>
                                <?php endif; ?>

                                <div class="tp-live-teacher">
                                    <div class="tp-live-teacher-info d-flex align-items-center">
                                        <div class="tp-live-teacher-thumb">
                                            <?php
                                            echo wp_kses(
                                                tutor_utils()->get_tutor_avatar($post->post_author),
                                                tutor_utils()->allowed_avatar_tags()
                                            );
                                            ?>
                                        </div>
                                        <div class="tp-live-teacher-text">

                                            <?php if (!empty($designation)): ?>
                                                <span>
                                                    <?php echo tp_kses($designation); ?>
                                                </span>
                                            <?php endif; ?>

                                            <h4 class="tp-live-teacher-title">
                                                <?php echo esc_html(get_the_author()); ?></a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="tp-live-rating">
                                        <p>
                                            <?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>
                                            <span>/<?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?></span>
                                        </p>
                                        <div class="tp-live-rating-star">
                                            <?php
                                            $course_rating = tutor_utils()->get_course_rating();
                                            tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="tp-live-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
                                    </a>
                                </h4>

                                <div class="tp-live-total">
                                    <div class="tp-live-total-student">
                                        <?php if (!empty($settings['tp_course_student_text'])): ?>
                                            <span>
                                                <?php echo tp_kses($settings['tp_course_student_text']); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if (!empty($student_image['tp_course_student_image'])): ?>
                                            <img src="<?php echo esc_url($student_image['tp_course_student_image']); ?>"
                                                alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($settings['tp_course_btn_text'])): ?>
                                        <div class="tp-live-join">
                                            <a class="tp-btn-border" <?php $this->print_render_attribute_string('tp_course_btn_url'); ?>>
                                                <span>
                                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.70732 0.75H8.39024C9.65603 0.75 10.333 1.00147 10.7145 1.38301C11.0961 1.76456 11.3476 2.44153 11.3476 3.70732V9.95122C11.3476 11.217 11.0961 11.894 10.7145 12.2755C10.333 12.6571 9.65603 12.9085 8.39024 12.9085H3.70732C2.53342 12.9085 1.82979 12.5071 1.40543 11.9979C0.961765 11.4655 0.75 10.7255 0.75 9.95122V3.70732C0.75 2.44153 1.00147 1.76456 1.38301 1.38301C1.76456 1.00147 2.44153 0.75 3.70732 0.75Z"
                                                            stroke="currentColor" stroke-width="1.5">
                                                        </path>
                                                        <path
                                                            d="M7.21976 6.34479C8.03014 6.34479 8.68708 5.68785 8.68708 4.87747C8.68708 4.0671 8.03014 3.41016 7.21976 3.41016C6.40938 3.41016 5.75244 4.0671 5.75244 4.87747C5.75244 5.68785 6.40938 6.34479 7.21976 6.34479Z"
                                                            fill="currentColor">
                                                        </path>
                                                        <path
                                                            d="M13.6712 10.4795L13.6684 10.4775L12.8476 9.90073V3.75854L13.6676 3.18235C13.6677 3.18227 13.6678 3.18219 13.668 3.18211C14.021 2.93474 14.2801 2.87809 14.4413 2.87174C14.6067 2.86523 14.7268 2.9096 14.7996 2.94693C14.8665 2.98117 14.9706 3.05164 15.0602 3.19079C15.1476 3.3265 15.2501 3.57203 15.2501 4.00427V9.66281C15.2501 10.095 15.1476 10.3406 15.0602 10.4763C14.9706 10.6154 14.8665 10.6859 14.7996 10.7202L14.7996 10.7201L14.7922 10.724C14.7375 10.7528 14.6301 10.7938 14.4781 10.7938C14.3158 10.7938 14.0436 10.7437 13.6712 10.4795Z"
                                                            stroke="currentColor" stroke-width="1.5">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <?php echo tp_kses($settings['tp_course_btn_text']); ?>
                                                <i>
                                                    <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.71533 1L13 5.28471L8.71533 9.56941" stroke="currentColor"
                                                            stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                        <path d="M1 5.28473H12.88" stroke="currentColor" stroke-width="2"
                                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                </i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;
            wp_reset_query(); ?>



        <?php elseif ($settings['wpr_design_style'] == 'layout-3'):
            $animation = $this->tp_animation_show($settings);

        ?>
            <div class="tp-course-5-position">
                <div class="row tp-gx-60 <?php echo esc_attr($this->row_cols_show($settings, 'course_card_col')); ?> <?php echo esc_attr($animation['animation']); ?>"
                    <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                    <?php
                    $args = tp_query_args('courses', 'course-category', $this->get_settings());
                    $main_query = new \WP_Query($args);
                    ?>
                    <?php if ($main_query->have_posts()): ?>
                        <?php while ($main_query->have_posts()):
                            $main_query->the_post();
                            global $post, $authordata;

                            $tutor_course_img = get_tutor_course_thumbnail_src();
                            $course_id = get_the_ID();
                            $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                            $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                            $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);

                            $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                            $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                            // wishlist
                            $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                            $login_url_attr = '';
                            $action_class = '';

                            if (is_user_logged_in()) {
                                $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                            } else {
                                $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                                if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                    $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                                }
                            }

                        ?>
                            <div class="col">
                                <div class="tp-course-5-item mb-60">
                                    <div class="tp-course-5-hover"></div>
                                    <div class="tp-course-5-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <img class="course-pink" src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title(); ?>"
                                                loading="lazy">
                                        </a>
                                        <div class="tp-course-5-price">
                                            <span><?php echo tp_kses($price); ?></span>
                                        </div>
                                    </div>
                                    <div class="tp-course-5-content tp-el-content">
                                        <div class="tp-course-5-avatar d-flex align-items-center">
                                            <a href="<?php echo esc_url($profile_url); ?>" class="d-flex align-items-center gap-2">
                                                <?php
                                                echo wp_kses(
                                                    tutor_utils()->get_tutor_avatar($post->post_author),
                                                    tutor_utils()->allowed_avatar_tags()
                                                );
                                                ?>

                                                <?php echo esc_html(get_the_author()); ?>
                                            </a>
                                        </div>

                                        <h4 class="tp-course-5-title tp-el-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
                                            </a>
                                        </h4>

                                        <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
                                            <div class="tp-course-meta d-flex flex-wrap">
                                                <?php if (!empty($tutor_lesson_count)): ?>
                                                    <div class="tp-course-4-info-item">
                                                        <span class="tp-el-c-meta">
                                                            <span>
                                                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z"
                                                                        stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            <?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'wprealizer'), $tutor_lesson_count); ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($course_students)): ?>
                                                    <div class="tp-course-4-info-item">
                                                        <span>
                                                            <span>
                                                                <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z"
                                                                        stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14"
                                                                        stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            <?php printf(_n('%d Student', '%d Students', $course_students, 'wprealizer'), $course_students); ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                        wp_reset_query();
                    endif; ?>
                </div>
            </div>

        <?php elseif ($settings['wpr_design_style'] == 'layout-2'):
            $animation = $this->tp_animation_show($settings);
        ?>

            <div class="row <?php echo esc_attr($this->row_cols_show($settings, 'course_card_col')); ?> <?php echo esc_attr($animation['animation']); ?>"
                <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>

                <?php

                $args = tp_query_args('courses', 'course-category', $this->get_settings());
                $main_query = new \WP_Query($args);

                ?>
                <?php if ($main_query->have_posts()): ?>
                    <?php while ($main_query->have_posts()):
                        $main_query->the_post();
                        global $post, $authordata;

                        $tutor_course_img = get_tutor_course_thumbnail_src();
                        $course_id = get_the_ID();
                        $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                        $course_categories = get_tutor_course_categories($course_id);

                        $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                        $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);

                        $cat_color = '#17A2B8';
                        if (!empty($course_categories[0])) {
                            $cat_color = get_term_meta($course_categories[0]->term_id, '_wprealizer_course_cat_color', true);
                            $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
                        }

                        $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                        $course_rating = tutor_utils()->get_course_rating();
                        $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";


                        $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                        $course_rating = tutor_utils()->get_course_rating();
                        $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                        // wishlist
                        $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                        $login_url_attr = '';
                        $action_class = '';

                        if (is_user_logged_in()) {
                            $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                        } else {
                            $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                            if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                            }
                        }

                    ?>
                        <div class="col">

                            <div class="tp-course-4-item d-flex tp-el-content">
                                <div class="tp-course-4-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="course-pink" src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title(); ?>"
                                            loading="lazy">
                                    </a>
                                </div>

                                <div class="tp-course-4-content">
                                    <?php if ($show_course_ratings): ?>
                                        <div class="tp-course-4-rating">
                                            <?php
                                            $course_rating = tutor_utils()->get_course_rating();
                                            tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                            ?>
                                            <span>
                                                (<?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?>
                                                <?php echo esc_html__('reviews', 'wprealizer'); ?>)
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <h4 class="tp-course-4-title">
                                        <a class="tp-el-title" href="<?php the_permalink(); ?>">
                                            <?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
                                        </a>
                                    </h4>

                                    <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
                                        <div class="tp-course-4-info d-flex align-items-center">
                                            <?php if (!empty($tutor_lesson_count)): ?>
                                                <div class="tp-course-4-info-item">
                                                    <span>
                                                        <span>
                                                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z"
                                                                    stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                        <?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'wprealizer'), $tutor_lesson_count); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($course_students)): ?>
                                                <div class="tp-course-4-info-item">
                                                    <span>
                                                        <span>
                                                            <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z"
                                                                    stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14"
                                                                    stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                        <?php printf(_n('%d Student', '%d Students', $course_students, 'wprealizer'), $course_students); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_post_content'])):
                                        $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                                    ?>
                                        <p class="tp-el-rep-des tp-el-c-desc">
                                            <?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?>
                                        </p>
                                    <?php endif; ?>


                                    <div class="tp-course-4-avatar d-flex align-items-center justify-content-between">
                                        <div class="tp-course-4-avatar-info d-flex align-items-center tp-el-avatar">

                                            <a href="<?php echo esc_url($profile_url); ?>" class="d-flex align-items-center gap-2">
                                                <?php
                                                echo wp_kses(
                                                    tutor_utils()->get_tutor_avatar($post->post_author),
                                                    tutor_utils()->allowed_avatar_tags()
                                                );
                                                ?>

                                                <?php echo esc_html(get_the_author()); ?>
                                            </a>
                                        </div>
                                        <div class="tp-course-4-ammount">
                                            <span class="tp-el-c-price">
                                                <?php echo tp_kses($price); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                    wp_reset_query();
                endif; ?>
            </div>

        <?php else: ?>

            <div class="row <?php echo esc_attr($this->row_cols_show($settings, 'course_card_col')); ?>">
                <?php

                $args = tp_query_args('courses', 'course-category', $this->get_settings());
                $main_query = new \WP_Query($args);

                ?>
                <?php if ($main_query->have_posts()): ?>
                    <?php while ($main_query->have_posts()):
                        $main_query->the_post();
                        global $post, $authordata;

                        $tutor_course_img = get_tutor_course_thumbnail_src();
                        $course_id = get_the_ID();
                        $profile_url = tutor_utils()->profile_url($authordata->ID, true);
                        $course_categories = get_tutor_course_categories($course_id);

                        $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                        $course_students = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);

                        $cat_color = '#17A2B8';
                        if (!empty($course_categories[0])) {
                            $cat_color = get_term_meta($course_categories[0]->term_id, '_wprealizer_course_cat_color', true);
                            $cat_color = !empty($cat_color) ? $cat_color : '#17A2B8';
                        }

                        $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                        $course_rating = tutor_utils()->get_course_rating();
                        $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";


                        $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                        $course_rating = tutor_utils()->get_course_rating();
                        $price = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span class='lms-free'>Free</span></span>";

                        // wishlist
                        $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                        $login_url_attr = '';
                        $action_class = '';

                        if (is_user_logged_in()) {
                            $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                        } else {
                            $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                            if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                            }
                        }

                    ?>
                        <div class="col">
                            <div class="tp-course-item p-relative fix mb-30">

                                <div class="tp-course-teacher mb-15">
                                    <span>
                                        <a href="<?php echo esc_url($profile_url); ?>" class="d-flex align-items-center gap-2">
                                            <?php
                                            echo wp_kses(
                                                tutor_utils()->get_tutor_avatar($post->post_author),
                                                tutor_utils()->allowed_avatar_tags()
                                            );
                                            ?>

                                            <?php echo esc_html(get_the_author()); ?></a>
                                    </span>

                                    <div class="wprealizer-course-card-header-right d-flex align-items-center gap-2">
                                        <?php if (class_exists('WooCommerce')):
                                            if (!empty(wprealizer_lms_sale_percentage())): ?>
                                                <span class="discount"><?php echo tp_kses(wprealizer_lms_sale_percentage()); ?></span>
                                        <?php endif;
                                        endif; ?>

                                        <a href="javascript:void(0);" <?php if (!empty($login_url_attr)) {
                                                                            echo esc_attr($login_url_attr);
                                                                        }; ?>
                                            class="save-bookmark-btn wprealizer-save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary <?php echo esc_attr($action_class); ?>"
                                            data-course-id="<?php echo esc_attr($course_id); ?>">

                                            <?php if ($is_wish_listed): ?>
                                                <i class="tutor-icon-bookmark-bold"></i>
                                            <?php else: ?>
                                                <i class="tutor-icon-bookmark-line"></i>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="tp-course-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="course-pink" src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title(); ?>"
                                            loading="lazy">
                                    </a>
                                </div>

                                <div class="tp-course-content">

                                    <?php if (!empty($course_categories[0])): ?>
                                        <div class="tp-course-tag mb-10">
                                            <span class="tag-span" data-cat-color="<?php echo esc_attr($cat_color); ?>">
                                                <a href="<?php echo get_term_link($course_categories[0]); ?>">
                                                    <?php echo esc_html($course_categories[0]->name); ?>
                                                </a>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || !empty($tutor_lesson_count)): ?>
                                        <div class="tp-course-meta">
                                            <?php if (!empty($tutor_lesson_count)): ?>
                                                <span>
                                                    <span>
                                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z"
                                                                stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'wprealizer'), $tutor_lesson_count); ?>
                                                </span>
                                            <?php endif; ?>

                                            <?php if (!empty($course_students)): ?>
                                                <span>
                                                    <span>
                                                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z"
                                                                stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path
                                                                d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14"
                                                                stroke="#94928E" stroke-width="1.2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <?php printf(_n('%d Student', '%d Students', $course_students, 'wprealizer'), $course_students); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <h4 class="tp-course-title">
                                        <a
                                            href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?></a>
                                    </h4>

                                    <div class="tp-course-rating d-flex align-items-end justify-content-between">
                                        <?php if ($show_course_ratings): ?>
                                            <div class="tp-course-rating-star">
                                                <p>
                                                    <?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>
                                                    <span>
                                                        /<?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?></span>
                                                </p>
                                                <div class="tp-course-rating-icon">
                                                    <?php
                                                    $course_rating = tutor_utils()->get_course_rating();
                                                    tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="tp-course-pricing">
                                            <?php echo tp_kses($price); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="tp-course-btn home-2">
                                    <a href="<?php the_permalink(); ?>"><?php echo esc_html($settings['tp_course_btn_text']); ?></a>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                    wp_reset_query();
                endif; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Course_Card());
