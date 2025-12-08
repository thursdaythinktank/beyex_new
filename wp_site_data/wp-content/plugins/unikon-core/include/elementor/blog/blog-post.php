<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Blog_Post extends Widget_Base
{

    use WPR_Style_Trait, WPR_Query_Trait, WPR_Column_Trait, WPR_Animation_Trait;

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
        return 'wpr-blog-post';
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
        return __(WPRCORE_THEME_NAME . ' - Blog Post', 'wprealizer');
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
                    'layout-2' => esc_html__('Layout 2', 'wprealizer'),
                    'layout-3' => esc_html__('Layout 3', 'wprealizer'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'wpr_services_arrow_switcher',
            [
                'label' => esc_html__('Arrow SWITCHER', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'wpr_design_style' => ['layout-2']
                ]
            ]
        );

        $this->end_controls_section();

        // section column
        $this->tp_columns('col', '');

        // Query Panel
        $this->tp_query_controls('blog', 'Blog', 'post', 'category', 6, 10, 6, 0, 'date', 'desc', true, true, true, '');

        $this->tp_query_meta_controls('blog_grid_meta', 'Meta Controls', true, true, true, '');

        // animation
        $this->tp_creative_animation(['layout-1', 'layout-2']);
    }

    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section - Style', '.wpr-el-section');
        $this->tp_basic_style_controls('blog_post_date', 'Post Date', '.wpr-el-date');
        $this->tp_basic_style_controls('blog_post_cate', 'Post Categories', '.wpr-el-cat');
        $this->tp_basic_style_controls('blog_post_title', 'Title', '.wpr-el-title');

        $this->tp_basic_style_controls('blog_post_author', 'Author Name', '.wpr-el-avator-name');

        $this->start_controls_section(
            'wpr_blog_post_avator_section',
            [
                'label' => esc_html__('Blog Image', 'wprealizer'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wpr_blog_post_avator_w',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Width', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-avator img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wpr_blog_post_avator_h',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Height', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-avator img' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_blog_post_object_style',
            [
                'label' => esc_html__('Object Fit', 'wprealizer'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'none' => esc_html__('None', 'wprealizer'),
                    'contain'  => esc_html__('Contain', 'wprealizer'),
                    'cover' => esc_html__('Cover', 'wprealizer'),
                    'fill' => esc_html__('fill', 'wprealizer'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-avator img' => 'object-fit: {{VALUE}};',
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

        <?php if ($settings['wpr_design_style'] == 'layout-2'):
            $query_args = tp_query_args('post', 'category', $this->get_settings());
            $the_query = new \WP_Query($query_args);

            $animation = $this->tp_animation_show($settings);

        ?>

          <!-- resources-ca__area start  -->
          <div class="resources-ca__area wpr-el-section">
            <div class="container container-4xl border-grid-px">
              <div class="row">
                <div class="col-12">
                  <div class="swiper resources-ca__slider">
                    <div class="swiper-wrapper">
                        <?php
                        if ($the_query->have_posts()):
                            while ($the_query->have_posts()):
                                $the_query->the_post();

                                $categories = get_the_category();
                        ?>

                        <div class="swiper-slide resources-ca__slider-item">
                            <div class="resources-ca__slider-item-wrapper">
                                <?php if (has_post_thumbnail()): ?>
                                <div class="resources-ca__slider-thumb"
                                    style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url()); ?>');">
                                </div>
                                <?php endif; ?>

                                <div class="resources-ca__slider-content">
                                    <div class="resources-ca__slider-content-wrapper">
                                        <div class="resources-ca__slider-meta">
                                            <?php if (!empty($settings['tp_post_category'])): ?>
                                            <?php if (!empty($categories[0]->name)): ?>
                                            <span class="content-type"> 
                                                <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                                                    <?php echo esc_html($categories[0]->name); ?>
                                                </a>
                                            </span>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if ($settings['tp_post_date'] == 'yes'): ?>
                                            <?php if (!empty($settings['tp_post_date_format'])):
                                                $date_format = $settings['tp_post_date_format'] == 'default' ? get_option('date_format') : $settings['tp_post_date_format'];
                                                $date_format = $settings['tp_post_date_format'] == 'custom' ? $settings['tp_post_date_custom_format'] : $date_format;
                                            ?>
                                            <span class="content-date">
                                                <?php the_time($date_format); ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php endif; ?>                            
                                        </div>
                                        <h6 class="h6 resources-ca__slider-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
                                            </a>
                                        </h6>
                                        <p class="resources-ca__slider-desc">
                                            <?php echo wp_trim_words(get_the_content(), 25, false); ?>
                                        </p>

                                        <a href="<?php the_permalink(); ?>" 
                                            class="read-more-btn">
                                            <?php esc_html_e( 'Read More', 'wprealizer' ); ?>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                >
                                                <path
                                                    d="M20.6919 12.2879C20.6539 12.3799 20.599 12.4628 20.53 12.5318L16.53 16.5318C16.384 16.6778 16.192 16.7517 16 16.7517C15.808 16.7517 15.616 16.6788 15.47 16.5318C15.177 16.2388 15.177 15.7637 15.47 15.4707L18.1899 12.7508H4C3.586 12.7508 3.25 12.4148 3.25 12.0008C3.25 11.5868 3.586 11.2508 4 11.2508H18.189L15.469 8.53079C15.176 8.23779 15.176 7.76275 15.469 7.46975C15.762 7.17675 16.237 7.17675 16.53 7.46975L20.53 11.4697C20.599 11.5387 20.6539 11.6216 20.6919 11.7136C20.7679 11.8976 20.7679 12.1039 20.6919 12.2879Z"
                                                    fill="currentColor"
                                                    />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>

                    <?php if (!empty($settings['wpr_services_arrow_switcher'])): ?>
                    <div class="resources-ca__slider-navigation">
                      <div class="resources-ca__slider-prev">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 40 40"
                          fill="none"
                        >
                          <path
                            d="M36.2465 19.9983C36.2465 20.6883 35.6865 21.2483 34.9965 21.2483H8.01492L17.5482 30.7816C18.0365 31.2699 18.0365 32.0617 17.5482 32.55C17.3049 32.7933 16.9848 32.9166 16.6648 32.9166C16.3448 32.9166 16.0248 32.795 15.7814 32.55L4.11478 20.8833C3.99978 20.7683 3.90833 20.6302 3.845 20.4768C3.71833 20.1718 3.71833 19.8268 3.845 19.5218C3.90833 19.3685 3.99978 19.2299 4.11478 19.1149L15.7814 7.44828C16.2698 6.95995 17.0615 6.95995 17.5498 7.44828C18.0382 7.93661 18.0382 8.72834 17.5498 9.21667L8.01655 18.75H34.9965C35.6865 18.7483 36.2465 19.3083 36.2465 19.9983Z"
                            fill="currentColor"
                          />
                        </svg>
                      </div>
                      <div class="resources-ca__slider-pagination"></div>
                      <div class="resources-ca__slider-next">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 40 40"
                          fill="none"
                        >
                          <path
                            d="M36.1532 20.4785C36.0898 20.6318 35.9984 20.77 35.8834 20.885L24.2167 32.5516C23.9734 32.795 23.6533 32.9183 23.3333 32.9183C23.0133 32.9183 22.6933 32.7966 22.45 32.5516C21.9616 32.0633 21.9616 31.2716 22.45 30.7832L31.9832 21.25H5C4.31 21.25 3.75 20.69 3.75 20C3.75 19.31 4.31 18.75 5 18.75H31.9816L22.4483 9.21667C21.96 8.72834 21.96 7.93661 22.4483 7.44828C22.9367 6.95995 23.7284 6.95995 24.2167 7.44828L35.8834 19.1149C35.9984 19.2299 36.0898 19.3681 36.1532 19.5214C36.2798 19.8281 36.2798 20.1718 36.1532 20.4785Z"
                            fill="currentColor"
                          />
                        </svg>
                      </div>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- resources-ca__area end  -->


            <?php if (($settings['tp_post_pagination'] == 'yes') && ('-1' != $settings['posts_per_page'])): ?>
            <div class="row">
                <div class="col-12">
                    <div class="basic-pagination tp-pagination wpr-el-pagination-alignment">
                        <?php
                        $big = 999999999;

                        if (get_query_var('paged')) {
                            $paged = get_query_var('paged');
                        } else if (get_query_var('page')) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }

                        echo paginate_links(
                            array(
                                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                                'format' => '?paged=%#%',
                                'current' => $paged,
                                'total' => $the_query->max_num_pages,
                                'type' => 'list',
                                'prev_text' => '<i class="fa-regular fa-arrow-left icon"></i>',
                                'next_text' => '<i class="fa-regular fa-arrow-right icon"></i>',
                                'show_all' => false,
                                'end_size' => 1,
                                'mid_size' => 4,
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>



        <?php elseif ($settings['wpr_design_style'] == 'layout-3'):
            $query_args = tp_query_args('post', 'category', $this->get_settings());
            $the_query = new \WP_Query($query_args);

            $animation = $this->tp_animation_show($settings);

        ?>

<div class="row align-items-center g-4 wpr-el-section">
    <?php
    if ($the_query->have_posts()):
        while ($the_query->have_posts()):
            $the_query->the_post();

            $categories = get_the_category();
    ?>
    <div class="<?php echo esc_attr($this->col_show($settings)); ?>">
        <div class="latest-articles__card">
            <?php if (has_post_thumbnail()): ?>
            <div class="latest-articles__card-thumb wpr-el-avator">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div>
            <?php endif; ?>

            <div class="latest-articles__card-content">
                <?php if (!empty($settings['tp_post_category'])): ?>
                <?php if (!empty($categories[0]->name)): ?>
                <p class="wpr-el-cat">
                    <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                        <?php echo esc_html($categories[0]->name); ?>
                    </a>  
                </p>
                <?php endif; ?>
                <?php endif; ?>

                <h6 class="h6 wpr-el-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
                    </a>
                </h6>
                <a href="<?php the_permalink(); ?>" class="common-btn__variation7">
                    <span>
                        <?php esc_html_e('Read More', 'unikon'); ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  viewBox="0 0 20 20" fill="none">
                        <path
                            d="M18.0766 10.2412C18.0449 10.3179 17.9992 10.3869 17.9417 10.4444L12.1084 16.2778C11.9867 16.3994 11.8267 16.4611 11.6667 16.4611C11.5067 16.4611 11.3466 16.4003 11.225 16.2778C10.9808 16.0336 10.9808 15.6377 11.225 15.3936L15.9916 10.6269H2.5C2.155 10.6269 1.875 10.3469 1.875 10.0019C1.875 9.65693 2.155 9.37693 2.5 9.37693H15.9908L11.2242 4.61029C10.98 4.36612 10.98 3.97026 11.2242 3.72609C11.4683 3.48193 11.8642 3.48193 12.1084 3.72609L17.9417 9.55943C17.9992 9.61693 18.0449 9.68601 18.0766 9.76267C18.1399 9.91601 18.1399 10.0879 18.0766 10.2412Z"
                            fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>


        <?php else:

            $query_args = tp_query_args('post', 'category', $this->get_settings());
            $the_query = new \WP_Query($query_args);

            $animation = $this->tp_animation_show($settings);
        ?>
        
            <!-- blog-mar__area start   -->
            <div class="blog-mar__area wpr-el-section">
                <div class="row g-4 gy-5 gy-sm-4">
                    <?php
                    if ($the_query->have_posts()):
                        while ($the_query->have_posts()):
                            $the_query->the_post();

                            $categories = get_the_category();
                    ?>
                    <div class="<?php echo esc_attr($this->col_show($settings)); ?> fade_up_anim" data-delay=".2">
                        <div class="blog-mar__item">
                            <?php if (has_post_thumbnail()): ?>
                            <div class="blog-mar__item-thumb wpr-el-avator">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="blog-mar__item-content">
                                <ul class="custom-ul blog-meta">
                                <?php if ($settings['tp_post_date'] == 'yes'): ?>
                                    <?php if (!empty($settings['tp_post_date_format'])):
                                        $date_format = $settings['tp_post_date_format'] == 'default' ? get_option('date_format') : $settings['tp_post_date_format'];
                                        $date_format = $settings['tp_post_date_format'] == 'custom' ? $settings['tp_post_date_custom_format'] : $date_format;
                                    ?>
                                    <li class="wpr-el-date">
                                        <?php the_time($date_format); ?>
                                    </li>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_post_category'])): ?>
                                    <?php if (!empty($categories[0]->name)): ?>
                                    <li class="wpr-el-cat">
                                        <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                                <h5 class="h5 blog-title wpr-el-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
                                </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            <!-- blog-mar__area end  -->

<?php endif;
    }
}

$widgets_manager->register(new WPR_Blog_Post());
