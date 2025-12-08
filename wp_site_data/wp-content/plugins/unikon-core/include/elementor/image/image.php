<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Image extends Widget_Base
{

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
		return 'wpr-image';
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
		return __(WPRCORE_THEME_NAME . ' - Image', 'wprealizer');
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
					'layout-4' => esc_html__('Layout 4', 'wprealizer'),
					'layout-5' => esc_html__('Layout 5', 'wprealizer'),
					'layout-6' => esc_html__('Layout 6', 'wprealizer'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		/**
		 * 
		 * Start control for Style tab
		 */
		//Shape style tab start
		$this->start_controls_section(
			'wpr_image_group_settings',
			[
				'label' => esc_html__('Images', 'wprcore'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'animation_delay',
			[
				'label' => esc_html__('Animation Delay', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('.2', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'label_block' => true,
				'condition' => [
					'wpr_design_style' => ['layout-2', 'layout-5']
				]
			]
		);

		$this->add_control(
			'wpr_shape_switcher',
			[
				'label' => esc_html__('Shape SWITCHER', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'wprealizer'),
				'label_off' => esc_html__('No', 'wprealizer'),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'wpr_design_style' => ['layout-2', 'layout-4']
				]
			]
		);

		$this->add_control(
			'wpr_shape_bg_color1',
			[
				'label' => esc_html__('Shape Bg Color One', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.about-health__thumb-shaps .shap:nth-child(1), .about-fit__thumb' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'wpr_shape_switcher' => 'yes',
					'wpr_design_style' => ['layout-2', 'layout-4']
				]
			]
		);

		$this->add_control(
			'wpr_shape_bg_color2',
			[
				'label' => esc_html__('Shape Bg Color Two', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.about-health__thumb-shaps .shap:nth-child(2)' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'wpr_shape_switcher' => 'yes',
					'wpr_design_style' => ['layout-2']
				]
			]
		);

		$this->add_control(
			'image_one',
			[
				'label' => esc_html__('Choose Image one', 'wprcore'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => ['wpr_design_style'   => ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6']]

			]
		);
		$this->add_control(
			'image_two',
			[
				'label' => esc_html__('Choose Image two', 'wprcore'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => ['wpr_design_style'   => ['layout-10']]
			]
		);
		$this->add_control(
			'image_three',
			[
				'label' => esc_html__('Choose Image three', 'wprcore'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => ['wpr_design_style'   => ['layout-10']]
			]
		);


		$this->end_controls_section();
	}

	protected function style_tab_content()
	{

		$this->start_controls_section(
			'wpr_image_style_sec',
			[
				'label' => esc_html__('Image Styles', 'wprealizer'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'wpr_image_style_width',
			[
				'label' => esc_html__('Width', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wpr_image_style_height',
			[
				'label' => esc_html__('Height', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpr_image_object_style',
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
					'{{WRAPPER}} .wpr-el-image img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'team_hero_shape_bg',
			[
				'label' => esc_html__('Shape BG Color', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-details__card-thumb::before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'wpr_design_style' => ['layout-6']
				],
				'separator' => 'before',
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
		$settings = $this->get_settings_for_display(); ?>

		<?php if ($settings['wpr_design_style'] == 'layout-1') : ?>

			<?php if (!empty($settings['image_one'])) : ?>
				<div class="hero-fit__thumb wpr-el-image">
					<?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => 'img-move']) ?>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-2') : ?>

			<div class="about-health__thumb fade_up_anim" data-delay="<?php echo esc_attr($settings['animation_delay']); ?>">
				<?php if (!empty($settings['image_one'])) : ?>
					<div class="thumbnail wpr-el-image">
						<?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => '']) ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($settings['wpr_shape_switcher'])): ?>
					<div class="about-health__thumb-shaps">
						<span class="shap img-shape-bg-color-one"></span>
						<span class="shap img-shape-bg-color-two"></span>
					</div>
				<?php endif; ?>
			</div>


		<?php elseif ($settings['wpr_design_style'] == 'layout-3') : ?>

			<?php if (!empty($settings['image_one'])) : ?>
				<div class="about-la__thumb fade_up_anim wpr-el-image">
					<?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => 'img-move']) ?>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-4') : ?>
			<?php if (!empty($settings['image_one'])) : ?>
				<div class="about-fit__thumb wpr-el-image">
					<?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => '']) ?>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-5') : ?>

			<div class="gallery-sa__magnific-item w-100 products-fit__gallery-item fade_up_anim" data-delay="<?php echo esc_attr($settings['animation_delay']); ?>">
				<a href="<?php echo esc_url($settings['image_one']['url']); ?>" class="gallery-sa__magnific-link">
					<?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => '']) ?>
					<i class="bi bi-zoom-in" aria-hidden="true"></i>
				</a>
			</div>

		<?php elseif ($settings['wpr_design_style'] == 'layout-6') : ?>
			<?php if (!empty($settings['image_one'])) : ?>
				<div class="team-details__card-thumb">
					<?php echo wp_get_attachment_image($settings['image_one']['id'], 'full', '', ['class' => '']) ?>
				</div>
			<?php endif; ?>


<?php endif;
	}
}

$widgets_manager->register(new WPR_Image());
