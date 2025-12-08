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
class TP_Course_Search extends Widget_Base
{

    use WPR_Style_Trait, WPR_Query_Trait, WPR_Column_Trait;

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
        return 'course-search';
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
        return __(WPRCORE_THEME_NAME . ' :: Course Search', 'wprealizer');
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

        $this->wpr_design_layout('Select Layout', 2);
    }

    // style_tab_content
    protected function style_tab_content() {}

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
        $settings = $this->get_settings_for_display(); ?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

            <div class="tp-course-banner-heading wpr-offcanvas-search">
                <div class="wpr-footer-newsletter-wrapper wpr-footer-inner-input">
                    <div class="wpr-footer-newsletter-input">
                        <form action="<?php print esc_url(home_url('/courses')); ?>">
                            <input type="text" placeholder="<?php print esc_attr__('Search Courses....', 'wprealizer'); ?>" name="s"
                                value="<?php print esc_attr(get_search_query()) ?>">

                            <div class="wpr-footer-5-newsletter-submit">
                                <button class="tp-btn-inner" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M13.3989 13.4001L16.9989 17.0001" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path
                                            d="M15.3999 8.2001C15.3999 4.22366 12.1764 1.00012 8.19997 1.00012C4.22354 1.00012 1 4.22366 1 8.2001C1 12.1765 4.22354 15.4001 8.19997 15.4001C12.1764 15.4001 15.3999 12.1765 15.3999 8.2001Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="tp-course-banner-heading">
                <div class="wpr-footer-newsletter-wrapper wpr-footer-inner-input">
                    <div class="wpr-footer-newsletter-input">
                        <form action="<?php print esc_url(home_url('/courses')); ?>">
                            <input type="text" placeholder="<?php print esc_attr__('Search Courses....', 'wprealizer'); ?>" name="s"
                                value="<?php print esc_attr(get_search_query()) ?>">

                            <div class="wpr-footer-5-newsletter-submit">
                                <button class="tp-btn-inner">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<?php endif;
    }
}

$widgets_manager->register(new TP_Course_Search());
