<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Category_Hero extends Widget_Base
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
        return 'tp-blog-category';
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
        return __(WPRCORE_THEME_NAME . ' :: Blog Category', 'wprealizer');
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


        // layout Panel
        $this->start_controls_section(
            'tp_blog_settings',
            [
                'label' => esc_html__('Settings', 'wprealizer'),
            ]
        );
        $this->add_control(
            'tp_blog_cat_number',
            [
                'label' => esc_html__('Category Number', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('5', 'wprealizer'),
                'placeholder' => esc_html__('Category Number', 'wprealizer'),
            ]
        );
        $this->add_control(
            'tp_blog_search_switch',
            [
                'label' => esc_html__('Search Switcher', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
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
        $settings = $this->get_settings_for_display();

?>

        <?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

        <?php else:
            $terms = get_terms(array('taxonomy' => 'category', 'hide_empty' => false));
        ?>

            <div class="tp-blog-stories-btn-box tp-blog-category-list">
                <?php foreach ($terms as $key => $term) {
                    if ($key == $settings['tp_blog_cat_number']) {
                        break;
                    }
                ?>
                    <a href="<?php echo get_term_link($term->term_id, 'category'); ?> " rel="category">
                        <?php echo $term->name; ?>
                    </a>
                <?php } ?>

                <?php if ($settings['tp_blog_search_switch'] == 'yes'): ?>
                    <div class="wpr-header-2-search p-relative d-inline-flex">
                        <form action="<?php print esc_url(home_url('/')); ?>">
                            <input type="search" name="s" value="<?php print esc_attr(get_search_query()) ?>"
                                placeholder="<?php print esc_attr__('search...', 'wprealizer'); ?>">
                            <button class="wpr-header-2-search-btn" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M13.3994 13.4004L16.9995 17.0005" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path
                                        d="M15.3999 8.20019C15.3999 4.22363 12.1763 1 8.1997 1C4.22314 1 0.999512 4.22363 0.999512 8.20019C0.999512 12.1767 4.22314 15.4004 8.1997 15.4004C12.1763 15.4004 15.3999 12.1767 15.3999 8.20019Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
<?php endif;
    }
}
$widgets_manager->register(new TP_Category_Hero());
