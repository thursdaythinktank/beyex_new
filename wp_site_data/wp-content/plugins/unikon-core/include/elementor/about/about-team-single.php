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
class TP_About_Team_Single extends Widget_Base
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
		return 'tp-about-team-single';
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
		return __(WPRCORE_THEME_NAME . ' :: About Team Single', 'wprealizer');
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

		// year item section
		$this->start_controls_section(
			'tp_about_team_single_section',
			[
				'label' => __('Content', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'tp_about_team_single_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title here', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'label_block' => true,
			]
		);
		tp_render_links_controls($this, 'team_link');

		$this->add_control(
			'tp_about_team_single_desc',
			[
				'label' => esc_html__('Designation', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Head Coach', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_about_team_single_image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => __('Team Image', 'wprealizer'),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'separator' => 'before',
				'exclude' => [
					'custom'
				]
			]
		);

		$this->end_controls_section();

		$this->tp_creative_animation();
	}

	protected function style_tab_content()
	{
		$this->tp_basic_style_controls('team_title', 'Team Title', '.tp-el-title');
		$this->tp_basic_style_controls('team_designation', 'Team Designation', '.tp-el-designation');
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
			if (!empty($settings['tp_about_team_single_image']['url'])) {
				$tp_image_url = !empty($settings['tp_about_team_single_image']['id']) ? wp_get_attachment_image_url($settings['tp_about_team_single_image']['id'], $settings['thumbnail_size']) : $settings['tp_about_team_single_image']['url'];
				$tp_image_alt = get_post_meta($settings["tp_about_team_single_image"]["id"], "_wp_attachment_image_alt", true);
			}
			$title = $settings['tp_about_team_single_title'];
			$description = $settings['tp_about_team_single_desc'];

			$attrs = tp_get_repeater_links_attr($settings, 'team_link');
			extract($attrs);

			$links_attrs = [
				'href' => $link,
				'target' => $target,
				'rel' => $rel,
			];

			$animation = $this->tp_animation_show($settings);
		?>

			<div class="tp-about-team-item p-relative <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
				<?php if (!empty($tp_image_url)): ?>
					<div class="tp-about-team-thumb">
						<img src="<?php echo esc_url($tp_image_url); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
					</div>
				<?php endif; ?>
				<div class="tp-about-team-content">
					<?php if (!empty($title)): ?>
						<h4 class="tp-about-team-title tp-el-title">
							<a <?php echo tp_implode_html_attributes($links_attrs); ?>>
								<?php echo esc_html($title); ?>
							</a>
						</h4>
					<?php endif; ?>

					<?php if (!empty($description)): ?>
						<p class="tp-el-designation"><?php echo esc_html($description); ?></p>
					<?php endif; ?>
				</div>
			</div>
<?php endif;
	}
}

$widgets_manager->register(new TP_About_Team_Single());
