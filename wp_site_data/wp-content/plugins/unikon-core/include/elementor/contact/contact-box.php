<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Contact_Link extends Widget_Base
{

	use WPR_Style_Trait, WPR_Animation_Trait;

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
		return 'tp-contact-link';
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
		return __(WPRCORE_THEME_NAME . ' :: Contact Box', 'wprealizer');
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
		$this->wpr_design_layout('Layout Style', 1);

		$this->start_controls_section(
			'tp_contact_link_section',
			[
				'label' => esc_html__('Item', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		tp_render_icon_controls($this, 'icon_box');

		$this->add_control(
			'tp_contact_link_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Page Title', 'wprealizer'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'tp_contact_link_description',
			[
				'label' => esc_html__('Description', 'wprealizer'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Page Description', 'wprealizer'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'tp_contact_link_text',
			[
				'label' => esc_html__('Link Text', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Page Link Text', 'wprealizer'),
				'label_block' => true,
			]
		);

		// contact link 
		tp_render_links_controls($this, 'contact_link');

		$this->end_controls_section();

		//animation
		$this->tp_creative_animation();
	}

	protected function style_tab_content()
	{
		$this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
		$this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
		$this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
		$this->tp_icon_style(NULL, 'icon_box', '.wpr-icon-box-icon');
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
			$animation = $this->tp_animation_show($settings);
			$title = $settings['tp_contact_link_title'];

			$attrs = tp_get_repeater_links_attr($settings, 'contact_link');
			extract($attrs);

			$links_attrs = [
				'href' => $link,
				'target' => $target,
				'rel' => $rel,
			];
		?>

			<div class="tp-contact-info-item tp-el-section <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
				<div class="tp-contact-info-icon wpr-icon-box-icon">
					<?php tp_render_signle_icon_html($settings, 'icon_box'); ?>
				</div>
				<?php if (!empty($title)): ?>
					<h4 class="tp-contact-info-title tp-el-title">
						<?php echo tp_kses($title); ?>
					</h4>
				<?php endif; ?>

				<?php if (!empty($settings['tp_contact_link_description'])): ?>
					<p class="tp-el-subtitle">
						<?php echo tp_kses($settings['tp_contact_link_description']); ?>
					</p>
				<?php endif; ?>

				<?php if (!empty($settings['tp_contact_link_text'])): ?>
					<a <?php echo tp_implode_html_attributes($links_attrs); ?>>
						<?php echo tp_kses($settings['tp_contact_link_text']); ?>
					</a>
				<?php endif; ?>
			</div>

<?php endif;
	}
}

$widgets_manager->register(new TP_Contact_Link());
