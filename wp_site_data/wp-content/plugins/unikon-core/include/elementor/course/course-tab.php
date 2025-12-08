<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

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
class TP_Course_Tab extends Widget_Base
{

    use WPR_Style_Trait, WPR_Column_Trait, WPR_Query_Trait;
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
        return 'course-tab';
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
        return __(WPRCORE_THEME_NAME . ' :: Course Tab', 'wprealizer');
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
            'course_sec',
            [
                'label' => esc_html__('Content Controls', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_course_btn_text',
            [
                'label'       => esc_html__('Button Text', 'wprealizer'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Preview This Course', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'tp_course_tab_shape_switch',
            [
                'label'        => esc_html__('Add Tab Shape?', 'wprealizer'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'wprealizer'),
                'label_off'    => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'tp_course_tab_shape',
            [
                'label'   => esc_html__('Tab Shape', 'wprealizer'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_course_tab_shape_switch' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_course_tab_alignment',
            [
                'label'   => esc_html__('Tab Alignment', 'textdomain'),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start'   => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'end'  => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-tab' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->tp_query_controls('course_tab', 'Course Controls', 'courses', 'course-category');

        $this->tp_columns('course_tab_col');
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

        $posts_per_page = !empty($settings['posts_per_page']) ? $settings['posts_per_page'] : -1;
        $order = !empty($settings['order']) ? $settings['order'] : 'DESC';
        $order_by = !empty($settings['order_by']) ? $settings['order_by'] : 'date';
        $post_exclude = !empty($settings['post__not_in']) ? $settings['post__not_in'] : [];
        $post_include = !empty($settings['post__in']) ? $settings['post__in'] : [];
        $ignore_sticky_posts = (!empty($settings['ignore_sticky_posts']) && 'yes' == $settings['ignore_sticky_posts']) ? true : false;

?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>




        <?php else: ?>

            <?php if (!empty($settings['category'] || !empty($settings['exclude_category']))) :

                if ($settings['tp_course_tab_shape_switch'] == 'yes') :
                    $shape_img = tp_get_img($settings, 'tp_course_tab_shape', 'full', false);
                endif;
            ?>
                <div class="row">
                    <div class="col-12">
                        <div class="tp-course-tab d-flex mb-40">
                            <nav>
                                <div class="nav" id="nav-tab" role="tablist">


                                    <button class="nav-link active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">
                                        <?php echo esc_html__('All Courses', 'wprealizer'); ?>

                                        <?php if (!empty($shape_img['tp_course_tab_shape']) && $settings['tp_course_tab_shape_switch'] == 'yes') : ?>
                                            <span>
                                                <img src="<?php echo esc_url($shape_img['tp_course_tab_shape']); ?>" alt="<?php echo esc_attr($shape_img['tp_course_tab_shape_alt']); ?>">
                                            </span>
                                        <?php endif; ?>
                                    </button>


                                    <?php foreach ($settings['category'] as $list):

                                        $attrs = [
                                            'class' => 'nav-link',
                                            'id' => 'nav-' . $list . '-tab',
                                            'data-bs-toggle' => 'tab',
                                            'data-bs-target' => '#nav-' . $list,
                                            'type' => 'button',
                                            'role' => 'tab',
                                            'aria-controls' => 'nav-' . $list,
                                            'aria-selected' => 'false'
                                        ];
                                    ?>
                                        <button <?php echo tp_implode_html_attributes($attrs); ?>>
                                            <?php echo esc_html(tp_get_categories('course-category')[$list]); ?>

                                            <?php if (!empty($shape_img['tp_course_tab_shape'])) : ?>
                                                <span>
                                                    <img src="<?php echo esc_url($shape_img['tp_course_tab_shape']); ?>" alt="<?php echo esc_attr($shape_img['tp_course_tab_shape_alt']); ?>">
                                                </span>
                                            <?php endif; ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content wow fadeInUp" data-wow-delay=".3s" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab" tabindex="0">
                            <div class="row <?php echo esc_attr($this->row_cols_show($settings, 'course_tab_col')); ?>">
                                <?php

                                $args = array(
                                    'post_type' => 'courses',
                                    'post_status' => 'publish',
                                    'order' => $order,
                                    'orderby' => $order_by,
                                    'post__not_in' => $post_exclude,
                                    'post__in' => $post_include,
                                    'posts_per_page' => $posts_per_page,
                                    'ignore_sticky_posts' => $ignore_sticky_posts
                                );

                                $main_query = new \WP_Query($args);
                                ?>
                                <?php if ($main_query->have_posts()) : ?>
                                    <?php while ($main_query->have_posts()) : $main_query->the_post();
                                        global $post, $authordata;

                                        $tutor_course_img  = get_tutor_course_thumbnail_src();
                                        $course_id         = get_the_ID();
                                        $profile_url       = tutor_utils()->profile_url($authordata->ID, true);
                                        $course_categories = get_tutor_course_categories($course_id);

                                        $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                                        $course_students    = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);

                                        $cat_color = '#17A2B8';
                                        if (!empty($course_categories[0])) {
                                            $cat_color = get_term_meta($course_categories[0]->term_id, '_wprealizer_course_cat_color', true);
                                            $cat_color = ! empty($cat_color) ? $cat_color : '#17A2B8';
                                        }

                                        $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                                        $course_rating = tutor_utils()->get_course_rating();
                                        $price     = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span>Free</span></span>";


                                        $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                                        $course_rating = tutor_utils()->get_course_rating();
                                        $price     = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span>Free</span></span>";

                                        // wishlist
                                        $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                                        $login_url_attr = '';
                                        $action_class   = '';

                                        if (is_user_logged_in()) {
                                            $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                                        } else {
                                            $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                                            if (! tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
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
                                                        <?php if (class_exists('WooCommerce')) : if (!empty(wprealizer_lms_sale_percentage())) : ?>
                                                                <span class="discount"><?php echo tp_kses(wprealizer_lms_sale_percentage()); ?></span>
                                                        <?php endif;
                                                        endif; ?>

                                                        <a href="javascript:void(0);" <?php if (!empty($login_url_attr)) {
                                                                                            echo esc_attr($login_url_attr);
                                                                                        }; ?> class="save-bookmark-btn wprealizer-save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary <?php echo esc_attr($action_class); ?>" data-course-id="<?php echo esc_attr($course_id); ?>">

                                                            <?php if ($is_wish_listed) : ?>
                                                                <i class="tutor-icon-bookmark-bold"></i>
                                                            <?php else : ?>
                                                                <i class="tutor-icon-bookmark-line"></i>
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="tp-course-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <img class="course-pink" src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title(); ?>" loading="lazy">
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



                                                    <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || ! empty($tutor_lesson_count)) : ?>
                                                        <div class="tp-course-meta">
                                                            <?php if (! empty($tutor_lesson_count)) : ?>
                                                                <span>
                                                                    <span>
                                                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </span>
                                                                    <?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'wprealizer'), $tutor_lesson_count); ?>
                                                                </span>
                                                            <?php endif; ?>

                                                            <?php if (! empty($course_students)) : ?>
                                                                <span>
                                                                    <span>
                                                                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </span>
                                                                    <?php printf(_n('%d Student', '%d Students', $course_students, 'wprealizer'), $course_students); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <h4 class="tp-course-title">
                                                        <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?></a>
                                                    </h4>

                                                    <div class="tp-course-rating d-flex align-items-end justify-content-between">
                                                        <?php if ($show_course_ratings) : ?>
                                                            <div class="tp-course-rating-star">
                                                                <p>
                                                                    <?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>
                                                                    <span> /<?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?></span>
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
                        </div>

                        <?php foreach ($settings['category'] as $category):

                            $args = array(
                                'post_type' => 'courses',
                                'post_status' => 'publish',
                                'order' => $order,
                                'orderby' => $order_by,
                                'post__not_in' => $post_exclude,
                                'post__in' => $post_include,
                                'posts_per_page' => $posts_per_page,
                                'ignore_sticky_posts' => $ignore_sticky_posts,
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'course-category',
                                        'field' => 'slug',
                                        'terms' => $category
                                    ]
                                ]
                            );

                            $query = new \WP_Query($args);

                            $attrs = [
                                'class' => 'tab-pane fade',
                                'id'    =>  'nav-' . $category,
                                'role'  => 'tabpanel',
                                'aria-labelledby' => 'nav-' . $category . '-tab',
                                'tabindex' => '0'
                            ];

                        ?>
                            <div <?php echo tp_implode_html_attributes($attrs); ?>>
                                <div class="row <?php echo esc_attr($this->row_cols_show($settings, 'course_tab_col')); ?>">
                                    <?php if ($query->have_posts()) : ?>
                                        <?php while ($query->have_posts()) : $query->the_post();
                                            global $post, $authordata;

                                            $tutor_course_img  = get_tutor_course_thumbnail_src();
                                            $course_id         = get_the_ID();
                                            $profile_url       = tutor_utils()->profile_url($authordata->ID, true);
                                            $course_categories = get_tutor_course_categories($course_id);

                                            $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                                            $course_students    = apply_filters('tutor_course_students', tutor_utils()->count_enrolled_users_by_course($course_id), $course_id);

                                            $cat_color = '#17A2B8';
                                            if (!empty($course_categories[0])) {
                                                $cat_color = get_term_meta($course_categories[0]->term_id, '_wprealizer_course_cat_color', true);
                                                $cat_color = ! empty($cat_color) ? $cat_color : '#17A2B8';
                                            }

                                            $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                                            $course_rating = tutor_utils()->get_course_rating();
                                            $price     = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span>Free</span></span>";


                                            $show_course_ratings = apply_filters('tutor_show_course_ratings', true, get_the_ID());
                                            $course_rating = tutor_utils()->get_course_rating();
                                            $price     = !empty(tutor_utils()->get_course_price()) ? tutor_utils()->get_course_price() : "<span class='price'><span>Free</span></span>";

                                            // wishlist
                                            $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                                            $login_url_attr = '';
                                            $action_class   = '';

                                            if (is_user_logged_in()) {
                                                $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                                            } else {
                                                $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                                                if (! tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
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
                                                            <?php if (class_exists('WooCommerce')) : if (!empty(wprealizer_lms_sale_percentage())) : ?>
                                                                    <span class="discount"><?php echo tp_kses(wprealizer_lms_sale_percentage()); ?></span>
                                                            <?php endif;
                                                            endif; ?>

                                                            <a href="javascript:void(0);" <?php if (!empty($login_url_attr)) {
                                                                                                echo esc_attr($login_url_attr);
                                                                                            }; ?> class="save-bookmark-btn wprealizer-save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary <?php echo esc_attr($action_class); ?>" data-course-id="<?php echo esc_attr($course_id); ?>">

                                                                <?php if ($is_wish_listed) : ?>
                                                                    <i class="tutor-icon-bookmark-bold"></i>
                                                                <?php else : ?>
                                                                    <i class="tutor-icon-bookmark-line"></i>
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="tp-course-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <img class="course-pink" src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title(); ?>" loading="lazy">
                                                        </a>
                                                    </div>

                                                    <div class="tp-course-content">

                                                        <?php if (!empty($course_categories[0])): ?>
                                                            <div class="tp-course-tag mb-10">
                                                                <span class="tag-span" data-cat-color="<?php echo esc_attr($cat_color); ?>">
                                                                    <a href="<?php echo esc_url($course_categories[0]->slug); ?>">
                                                                        <?php echo esc_html($course_categories[0]->name); ?>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        <?php endif; ?>



                                                        <?php if (tutor_utils()->get_option('enable_course_total_enrolled') || ! empty($tutor_lesson_count)) : ?>
                                                            <div class="tp-course-meta">
                                                                <?php if (! empty($tutor_lesson_count)) : ?>
                                                                    <span>
                                                                        <span>
                                                                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </span>
                                                                        <?php printf(_n('%d Lesson', '%d Lessons', $tutor_lesson_count, 'wprealizer'), $tutor_lesson_count); ?>
                                                                    </span>
                                                                <?php endif; ?>

                                                                <?php if (! empty($course_students)) : ?>
                                                                    <span>
                                                                        <span>
                                                                            <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </span>
                                                                        <?php printf(_n('%d Student', '%d Students', $course_students, 'wprealizer'), $course_students); ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <h4 class="tp-course-title">
                                                            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?></a>
                                                        </h4>

                                                        <div class="tp-course-rating d-flex align-items-end justify-content-between">
                                                            <?php if ($show_course_ratings) : ?>
                                                                <div class="tp-course-rating-star">
                                                                    <p>
                                                                        <?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>
                                                                        <span> /<?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?></span>
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
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Course_Tab());
