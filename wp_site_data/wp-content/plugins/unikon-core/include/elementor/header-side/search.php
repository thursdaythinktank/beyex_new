<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;



if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Search_area extends Widget_Base
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
        return 'wpr-search-area';
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
        return __(WPRCORE_THEME_NAME . ' - Search', 'wprealizer');
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

        $this->end_controls_section();
    }

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
        $settings = $this->get_settings_for_display();
?>

        <?php if ($settings['wpr_design_style'] == 'layout-3'): ?>


        <!-- popup serch form start -->
        <div class="search__popup">
            <span class="search__popup-toggle">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div class="search__popup-wrapper">
                <form action="<?php print esc_url(home_url('/')); ?>" class="search__popup-form">
                    <input
                    class="search__input"
                    type="search"
                    name="search"
                    value="<?php print esc_attr(get_search_query()) ?>"
                    placeholder="<?php print esc_attr__('Search...', 'wprealizer'); ?>"/>
                    <div class="search__popup-btns-wrapper">
                        <span class="search-clear">
                            <i class="fa-solid fa-x"></i>
                        </span>
                        <button class="common-btn__variation9">
                            <?php print esc_attr__('Search', 'wprealizer'); ?> 
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- popup serch form End -->


    <?php elseif ($settings['wpr_design_style'] == 'layout-2') : ?>

        <!-- popup serch form start -->
        <div class="search__popup">
            <span class="search__popup-toggle">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div class="search__popup-wrapper">
                <form action="<?php print esc_url(home_url('/')); ?>" class="search__popup-form">
                    <input class="search__input"
                    type="search"
                    name="search"
                    value="<?php print esc_attr(get_search_query()) ?>"
                    placeholder="<?php print esc_attr__('Search...', 'wprealizer'); ?>"/>
                    <div class="search__popup-btns-wrapper">
                        <span class="search-clear">
                            <i class="fa-solid fa-x"></i>
                        </span>
                        <button class="common-btn__variation8--extend">
                            <?php print esc_attr__('Search', 'wprealizer'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- popup serch form End -->

        <?php else: ?>
            <!--search-form-start -->

                <!-- popup serch form start -->
                <div class="search__popup">
                    <span class="search__popup-toggle">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                    <div class="search__popup-wrapper">
                        <form action="<?php print esc_url(home_url('/')); ?>" class="search__popup-form">
                            <input
                            class="search__input"
                            type="search"
                            name="search"
                            value="<?php print esc_attr(get_search_query()) ?>"
                            placeholder="<?php print esc_attr__('Search...', 'wprealizer'); ?>"
                            />
                            <div class="search__popup-btns-wrapper">
                                <span class="search-clear">
                                    <i class="fa-solid fa-x"></i>
                                </span>
                                <button class="common-btn__variation3"><?php print esc_attr__('Search', 'wprealizer'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- popup serch form End -->
<?php endif;
    }
}

$widgets_manager->register(new WPR_Search_area());
