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
class TP_Blog_Grid extends Widget_Base
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
        return 'tp-blog-grid';
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
        return __(WPRCORE_THEME_NAME . ' :: Blog Grid', 'wprealizer');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Query Panel
        $this->tp_query_controls('blog', 'Blog', 'post', 'category', 6, 10, 6, 0, 'date', 'desc', true, true, true, '');

        $this->tp_query_meta_controls('blog_grid_meta', 'Meta Controls', true, true, true, '');

        $this->tp_columns('col');

        $this->tp_creative_animation();
    }

    // style_tab_content
    protected function style_tab_content()
    {

        $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('blog_post_title', 'Title', '.tp-el-title');
        $this->tp_basic_style_controls('blog_post_meta', 'Meta Text', '.tp-el-meta');
        $this->tp_basic_style_controls('blog_post_date', 'Date', '.tp-el-date');
        $this->tp_basic_style_controls('blog_post_author', 'Author Name', '.tp-el-avator-name');
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
        $animation = $this->tp_animation_show($settings);
?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

        <?php else:

            $query_args = tp_query_args('post', 'category', $this->get_settings());
            $the_query = new \WP_Query($query_args);

            $blog_column = is_active_sidebar('blog-sidebar') ? 8 : 12;
        ?>
            <div class="tp-blog-stories-area d-none">
                <div class="row">
                    <div
                        class="col-xxl-<?php print esc_attr($blog_column); ?> col-xl-<?php print esc_attr($blog_column); ?> col-lg-<?php print esc_attr($blog_column); ?>">
                        <div class="row">
                            <?php

                            if ($the_query->have_posts()):
                                while ($the_query->have_posts()):
                                    $the_query->the_post();
                                    $categories = get_the_category();
                            ?>
                                    <div class="<?php echo esc_attr($this->col_show($settings)); ?>">
                                        <div class="tp-blog-stories-item tp-el-section p-relative mb-50 <?php echo esc_attr($animation['animation']); ?>"
                                            <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>

                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="tp-blog-stories-thumb fix p-relative">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail(); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <div class="tp-blog-stories-content">

                                                <div class="tp-blog-stories-tag-wrap d-flex">
                                                    <?php if (!empty($settings['tp_post_category'])):
                                                        $color =  get_term_meta($categories[0]->term_id, '_wprealizer_post_cat_color', true);
                                                    ?>
                                                        <?php if (!empty($categories[0]->name)): ?>
                                                            <a data-bg-color="<?php echo esc_attr($color); ?>" class="tp-blog-tag tp-el-meta tp-blog-categorize"
                                                                href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
                                                                <?php echo esc_html($categories[0]->name); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if ($settings['tp_post_date'] == 'yes'): ?>
                                                        <?php if (!empty($settings['tp_post_date_format'])):
                                                            $date_format = $settings['tp_post_date_format'] == 'default' ? get_option('date_format') : $settings['tp_post_date_format'];
                                                            $date_format = $settings['tp_post_date_format'] == 'custom' ? $settings['tp_post_date_custom_format'] : $date_format;
                                                        ?>
                                                            <span class="tp-el-date">
                                                                <?php the_time($date_format); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <h4 class="tp-blog-stories-title tp-el-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
                                                    </a>
                                                </h4>

                                                <?php if (!empty($settings['tp_post_author'] == 'yes')): ?>
                                                    <div class="tp-blog-stories-user-box d-flex align-items-center">
                                                        <div class="tp-blog-stories-user-thumb">
                                                            <img src="<?php print get_avatar_url(get_the_author_meta('ID')); ?>" alt="img-blog">
                                                        </div>
                                                        <span class="tp-el-avator-name">
                                                            <?php print get_the_author(); ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
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
                    <?php if (is_active_sidebar('blog-sidebar')): ?>
                        <div class="col-lg-4">
                            <div class="tp-sidebar-wrapper pl-55">
                                <?php get_sidebar(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php if (($settings['tp_post_pagination'] == 'yes') && ('-1' != $settings['posts_per_page'])): ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-pagination tp-pagination tp-el-pagination-alignment">
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
                    </div>
                </div>
            </div>


            
<?php endif;
    }
}

$widgets_manager->register(new TP_Blog_Grid());
