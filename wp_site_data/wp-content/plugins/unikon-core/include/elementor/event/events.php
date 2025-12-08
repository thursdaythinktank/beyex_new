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
class TP_Event_New_Post extends Widget_Base
{

    use WPR_Style_Trait, WPR_Animation_Trait, WPR_Column_Trait, WPR_Icon_Trait;
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
        return 'event-test';
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
        return __(WPRCORE_THEME_NAME . ' :: Event Post', 'wprealizer');
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

    public function get_event_category()
    {
        return Helper::get_event_category();
    }

    public function get_event_tag()
    {
        return Helper::get_event_tag();
    }


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
                    'layout-2' => esc_html__('Layout 2', 'wprealizer'),
                    'layout-3' => esc_html__('Layout 3', 'wprealizer'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Start of event section
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Event Info', 'wprealizer'),
            ]
        );
        $this->add_control(
            'etn_event_cat',
            [
                'label' => esc_html__('Event Category', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_event_category(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'etn_event_tag',
            [
                'label' => esc_html__('Event Tag', 'wprealizer'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_event_tag(),
                'multiple' => true,
            ]
        );
        $this->add_control(
            'etn_event_count',
            [
                'label' => esc_html__('Event count', 'wprealizer'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'etn_desc_show',
            [
                'label' => esc_html__('Show Description', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => "layout-10"
                ],
            ]
        );

        $this->add_control(
            'etn_desc_limit',
            [
                'label' => esc_html__('Description Limit', 'wprealizer'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'condition' => [
                    'wpr_design_style' => "layout-10",
                    'etn_desc_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_with_status',
            [
                'label' => esc_html__('Event status filter By', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('All', 'wprealizer'),
                    'upcoming' => esc_html__('upcoming Event', 'wprealizer'),
                    'expire' => esc_html__('Expire Event', 'wprealizer'),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order Event By', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'ID' => esc_html__('Id', 'wprealizer'),
                    'title' => esc_html__('Title', 'wprealizer'),
                    'post_date' => esc_html__('Post Date', 'wprealizer'),
                    'etn_start_date' => esc_html__('Event Start Date', 'wprealizer'),
                    'etn_end_date' => esc_html__('Event End Date', 'wprealizer'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Event Order', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__('Ascending', 'wprealizer'),
                    'DESC' => esc_html__('Descending', 'wprealizer'),
                ],
            ]
        );
        $this->add_control(
            'show_event_location',
            [
                'label' => esc_html__('Show Event Location', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_parent_event',
            [
                'label' => esc_html__('Show Recurring Parent Events', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_child_event',
            [
                'label' => esc_html__('Show Recurring Child Event', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_event_time',
            [
                'label' => esc_html__('Show Event Time', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => "layout-1"
                ],
            ]
        );
        $this->add_control(
            'show_event_btn',
            [
                'label' => esc_html__('Show Event Button', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'wpr_design_style' => ['layout-1', 'layout-3'],
                ],
            ]
        );
        $this->add_control(
            'tp_event_btn_text',
            [
                'label' => esc_html__('Event Button Text', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
                'label_block' => true,
                'condition' => [
                    'wpr_design_style' => ["layout-3"],
                ],
            ]
        );

        $this->end_controls_section();

        // colum controls
        $this->tp_columns('col', ['layout-2', 'layout-3']);

        // animation
        $this->tp_creative_animation(['layout-1', 'layout-2', 'layout-3']);
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');

        $this->tp_section_style_controls('coming_box', 'Event - Box', '.tp-el-box');

        // meta date 
        $this->start_controls_section(
            'tp_event_meta_date_sec',
            [
                'label' => esc_html__('Meta - Date', 'wprealizer'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tp_event_meta_bg',
                'label' => esc_html__('Background color', 'wprealizer'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .tp-el-event-meta-date',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tp_event_meta_day_typo',
                'label' => esc_html__('Day Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .tp-el-date-day',
            ]
        );

        $this->add_control(
            'tp_event_meta_day_color',
            [
                'label' => esc_html__('Day color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-date-day' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tp_event_meta_m_y_typo',
                'label' => esc_html__('Month Year Typography', 'wprealizer'),
                'selector' => '{{WRAPPER}} .tp-el-date-month-year',
            ]
        );

        $this->add_control(
            'tp_event_meta_m_y_color',
            [
                'label' => esc_html__('Month Year color', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-date-month-year' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->tp_basic_style_controls('coming_title', 'Event - Title', '.tp-el-box-title');
        $this->tp_basic_style_controls('coming_meta', 'Event - Meta', '.tp-el-box-meta span');
        $this->tp_link_controls_style('layout-3', 'event_btn', 'Event - Button', '.tp-el-box-btn');
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

        $event_cat = $settings["etn_event_cat"];
        $event_tag = $settings["etn_event_tag"];
        $event_count = $settings["etn_event_count"];
        //$etn_event_col = $settings["etn_event_col"];
        $etn_desc_limit = $settings["etn_desc_limit"];
        $order = (isset($settings["order"]) ? $settings["order"] : 'DESC');
        $show_event_location = (isset($settings["show_event_location"]) ? $settings["show_event_location"] : 'yes');
        $show_end_date = (isset($settings["show_end_date"]) ? $settings["show_end_date"] : 'no');
        $etn_desc_show = (isset($settings["etn_desc_show"]) ? $settings["etn_desc_show"] : 'yes');
        $orderby = $settings["orderby"];
        $show_child_event = $settings["show_child_event"];
        $show_parent_event = $settings["show_parent_event"];
        $show_event_time = $settings["show_event_time"];
        $show_event_btn = $settings["show_event_btn"];

        if ($orderby == "etn_start_date" || $orderby == "etn_end_date") {
            $orderby_meta = "meta_value";
        } else {
            $orderby_meta = null;
        }
        $filter_with_status = $settings['filter_with_status'];
        $post_parent = Helper::show_parent_child($show_parent_event, $show_child_event);

        $data = Helper::post_data_query(
            'etn',
            $event_count,
            $order,
            $event_cat,
            'etn_category',
            null,
            null,
            $event_tag,
            $orderby_meta,
            $orderby,
            $filter_with_status,
            $post_parent
        );

?>

        <?php if ($settings['wpr_design_style'] == 'layout-3'):

            $animation = $this->tp_animation_show($settings); ?>

            <!-- event area start -->
            <div class="row <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <?php if (!empty($data)):
                    foreach ($data as $index => $value):
                        $social = get_post_meta($value->ID, 'etn_event_socials', true);
                        $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                        $category = Helper::cate_with_link($value->ID, 'etn_category');
                        $start_date = get_post_meta($value->ID, 'etn_start_date', true);
                        $end_date = get_post_meta($value->ID, 'etn_end_date', true);
                        // $etn_start_date_new = Helper::etn_date_new( $start_date );
                        $etn_start_date = Helper::etn_date($start_date);
                        $etn_end_date = Helper::etn_date($end_date);

                        $start_time = get_post_meta($value->ID, 'etn_start_time', true);
                        $end_time = get_post_meta($value->ID, 'etn_end_time', true);

                        $start_date_digit = date("d", strtotime($start_date));
                        $start_day_month_digit = date("d,M", strtotime($start_date));
                        $start_month_digit = date("M", strtotime($start_date));
                        $start_date_year_month = date("d F, Y", strtotime($start_date));

                        $event_options = get_option("etn_event_options");

                        $etn_schedule = get_post_meta($value->ID, 'etn_event_schedule', true);
                        $etn_start_date = get_post_meta($value->ID, 'etn_start_date', true);



                        $etn_schedule_arr = [];

                        $data = Helper::single_template_options($value->ID);

                        foreach ($etn_schedule as $key => $single_schedule) {

                            $etn_schedule_arr[] = $single_schedule;
                        }

                        $etn_speakers_arr = [];

                        foreach ($etn_schedule_arr as $key => $etn_speaker) {
                            $etn_schedule_topics = get_post_meta($etn_speaker, 'etn_schedule_topics', true);

                            $etn_schedule_speakers = $etn_schedule_topics[0]['speakers'];

                            foreach ($etn_schedule_speakers as $speaker) {
                                $etn_speakers_arr[] = $speaker;
                            }
                        }
                        $etn_speakers_arr = array_unique($etn_speakers_arr);

                ?>
                        <div class="<?php echo esc_attr($this->col_show($settings)); ?>">
                            <div class="tp-event-4-item mb-30">
                                <div class="tp-event-4-thumb-wrap text-center">
                                    <div class="tp-event-4-thumb fix">
                                        <?php echo get_the_post_thumbnail($value->ID); ?>
                                    </div>
                                </div>

                                <div class="tp-event-4-box">
                                    <div class="tp-event-4-content tp-el-box-meta">
                                        <p class="tp-el-date-day"><?php echo esc_html($start_date_year_month); ?></p>
                                        <h4 class="tp-event-4-title tp-el-box-title">
                                            <a href="<?php echo get_the_permalink($value->ID); ?>">
                                                <?php echo get_the_title($value->ID); ?>
                                            </a>
                                        </h4>

                                        <?php if (!empty($settings['show_event_location'])):

                                            $location = '';
                                            $loc_arr = $etn_event_location;

                                            if (!empty(is_array($loc_arr) || is_object($loc_arr))):
                                                foreach ($loc_arr as $key => $loc) {
                                                    if ($key == 'address') {
                                                        $location .= $loc;
                                                    } elseif ($key == 'custom_url') {
                                                        $location .= $loc;
                                                    }
                                                }
                                            endif;
                                            if (!empty($location)):
                                        ?>
                                                <span>
                                                    <i class="fa-sharp fa-light fa-location-dot mr-5"></i>
                                                    <?php echo esc_html($location); ?>
                                                </span>
                                        <?php endif;
                                        endif; ?>
                                    </div>

                                    <div class="tp-event-4-info d-flex align-items-center justify-content-between">

                                        <?php if (!empty($etn_schedule)):
                                            $etn_schedule_topics = get_post_meta($etn_schedule[0], 'etn_schedule_topics', true);

                                            $total_speker = '';
                                        ?>

                                            <div class="tp-event-inner-user">
                                                <?php
                                                foreach ($etn_speakers_arr as $key => $wprealizer_speaker):

                                                    $key += 1;

                                                    $speaker_meta = get_user_meta($wprealizer_speaker);

                                                    $speaker_thumb_url = $speaker_meta['image'][0];

                                                    $total_speker = $key;

                                                    if ($key <= 3 && !empty($speaker_thumb_url)):
                                                ?>
                                                        <img title="<?php echo get_the_title($wprealizer_speaker); ?>"
                                                            src="<?php echo esc_url($speaker_thumb_url); ?>"
                                                            alt="<?php echo esc_attr__('Speaker Img', 'wprealizer'); ?>">
                                                    <?php
                                                    endif;
                                                endforeach;

                                                if ($total_speker > 3):
                                                    $due_speker = $total_speker - 3;
                                                    ?>
                                                    <span><?php echo esc_html('+' . $due_speker); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php

                                        endif;
                                        ?>

                                        <?php if (!empty($settings['show_event_btn'])): ?>
                                            <div class="tp-event-4-btn">
                                                <a class="tp-el-box-btn" href="<?php echo get_the_permalink($value->ID); ?>">
                                                    <?php echo tp_kses($settings['tp_event_btn_text']); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                else: ?>
                    <p class="etn-not-found-post"><?php echo esc_html__('No Event Found', 'wprealizer'); ?></p>
                <?php endif; ?>
            </div>
            <!-- event area end -->

        <?php elseif ($settings['wpr_design_style'] == 'layout-2'):

            $animation = $this->tp_animation_show($settings); ?>

            <!-- event area start -->
            <div class="row <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <?php if (!empty($data)):
                    foreach ($data as $index => $value):
                        $social = get_post_meta($value->ID, 'etn_event_socials', true);
                        $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                        $category = Helper::cate_with_link($value->ID, 'etn_category');
                        $start_date = get_post_meta($value->ID, 'etn_start_date', true);
                        $end_date = get_post_meta($value->ID, 'etn_end_date', true);
                        // $etn_start_date_new = Helper::etn_date_new( $start_date );
                        $etn_start_date = Helper::etn_date($start_date);
                        $etn_end_date = Helper::etn_date($end_date);

                        $start_time = get_post_meta($value->ID, 'etn_start_time', true);
                        $end_time = get_post_meta($value->ID, 'etn_end_time', true);

                        $start_date_digit = date("d", strtotime($start_date));
                        $start_day_month_digit = date("d,M", strtotime($start_date));
                        $start_month_digit = date("M", strtotime($start_date));
                        $start_date_year_month = date("F d, Y", strtotime($start_date));


                        $event_options = get_option("etn_event_options");


                        $data = Helper::single_template_options($value->ID);
                ?>
                        <div class="<?php echo esc_attr($this->col_show($settings)); ?>">
                            <div class="tp-event-3-item mb-30 tp-el-box">
                                <div class="tp-event-3-thumb p-relative">
                                    <?php echo get_the_post_thumbnail($value->ID); ?>

                                    <div class="tp-event-3-date tp-el-event-meta-date">
                                        <span class="tp-el-date-day"><?php echo esc_html($start_date_digit); ?></span>
                                        <p class="tp-el-date-month-year"><?php echo esc_html($start_month_digit); ?></p>
                                    </div>
                                </div>

                                <div class="tp-event-3-content tp-el-box-meta">
                                    <h3 class="tp-event-3-title tp-el-box-title">
                                        <a href="<?php echo get_the_permalink($value->ID); ?>">
                                            <?php echo get_the_title($value->ID); ?>
                                        </a>
                                    </h3>

                                    <?php if (!empty($settings['show_event_location'])):

                                        $location = '';
                                        $loc_arr = $etn_event_location;

                                        if (!empty(is_array($loc_arr) || is_object($loc_arr))):
                                            foreach ($loc_arr as $key => $loc) {
                                                if ($key == 'address') {
                                                    $location .= $loc;
                                                } elseif ($key == 'custom_url') {
                                                    $location .= $loc;
                                                }
                                            }
                                        endif;
                                        if (!empty($location)):
                                    ?>
                                            <span>
                                                <i class="fa-sharp fa-light fa-location-dot mr-5"></i>
                                                <?php echo esc_html($location); ?>
                                            </span>
                                    <?php endif;
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                else: ?>
                    <p class="etn-not-found-post"><?php echo esc_html__('No Event Found', 'wprealizer'); ?></p>
                <?php endif; ?>
            </div>

            <!-- event area end -->

        <?php else:
            $this->add_render_attribute('title_args', 'class', 'section__title mb-15 tp-el-title');

            $animation = $this->tp_animation_show($settings);

        ?>
            <div class="tp-event-wrap <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <div class="container">
                    <div class="row">
                        <?php if (!empty($data)):
                            foreach ($data as $index => $value):
                                $social = get_post_meta($value->ID, 'etn_event_socials', true);
                                $etn_event_location = get_post_meta($value->ID, 'etn_event_location', true);
                                $category = Helper::cate_with_link($value->ID, 'etn_category');
                                $start_date = get_post_meta($value->ID, 'etn_start_date', true);
                                $end_date = get_post_meta($value->ID, 'etn_end_date', true);
                                // $etn_start_date_new = Helper::etn_date_new( $start_date );
                                $etn_start_date = Helper::etn_date($start_date);
                                $etn_end_date = Helper::etn_date($end_date);

                                $start_time = get_post_meta($value->ID, 'etn_start_time', true);
                                $end_time = get_post_meta($value->ID, 'etn_end_time', true);

                                $start_date_digit = date("d", strtotime($start_date));
                                $start_month_digit = date("M", strtotime($start_date));
                                $start_year_digit = date("Y", strtotime($start_date));
                                $start_date_year_month = date("F d, Y", strtotime($start_date));

                                $event_options = get_option("etn_event_options");

                                $data = Helper::single_template_options($value->ID);
                        ?>
                                <div class="tp-event-item tp-el-box">
                                    <div class="row align-items-center">

                                        <div class="col-md-2">
                                            <div class="tp-event-list">
                                                <h4 class="tp-event-list-count tp-el-date-day">
                                                    <?php echo esc_html($start_date_digit); ?>
                                                </h4>
                                                <span class="tp-el-date-month-year">
                                                    <?php echo esc_html($start_month_digit); ?>,
                                                    <?php echo esc_html($start_year_digit); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="tp-event-content">
                                                <h3 class="tp-event-title tp-el-box-title"><a class="tp-img-reveal tp-img-reveal-item"
                                                        href="<?php echo get_the_permalink($value->ID); ?>"
                                                        data-img="<?php echo esc_url(get_the_post_thumbnail_url($value->ID)); ?>"
                                                        data-fx="1">
                                                        <?php echo get_the_title($value->ID); ?>
                                                    </a>
                                                </h3>
                                                <div class="tp-event-info tp-el-box-meta">

                                                    <?php if (!empty($settings['show_event_time'])): ?>
                                                        <span>
                                                            <i class="far fa-clock"></i>
                                                            <?php echo esc_html($start_time); ?>-
                                                            <?php echo esc_html($end_time); ?>
                                                        </span>
                                                    <?php endif; ?>

                                                    <?php if (!empty($settings['show_event_location'])):

                                                        $location = '';
                                                        $loc_arr = $etn_event_location;

                                                        if (!empty(is_array($loc_arr) || is_object($loc_arr))):
                                                            foreach ($loc_arr as $key => $loc) {
                                                                if ($key == 'address') {
                                                                    $location .= $loc;
                                                                } elseif ($key == 'custom_url') {
                                                                    $location .= $loc;
                                                                }
                                                            }
                                                        endif;
                                                        if (!empty($location)):
                                                    ?>
                                                            <a class="ml-10">
                                                                <span>
                                                                    <i class="fa-sharp fa-light fa-location-dot"></i>
                                                                    <?php echo esc_html($location); ?>
                                                                </span>
                                                            </a>
                                                    <?php endif;
                                                    endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if (!empty($settings['show_event_btn'])): ?>
                                            <div class="col-md-1">
                                                <div class="tp-event-arrow text-lg-end">
                                                    <a href="<?php echo get_the_permalink($value->ID); ?>">
                                                        <span>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1 10H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M10 1L19 10L10 19" stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        else: ?>
                            <p class="etn-not-found-post"><?php echo esc_html__('No Event Found', 'wprealizer'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Event_New_Post());
