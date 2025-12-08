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
use WPRCore\Elementor\Controls\Group_Control_WPRGradient;
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
class TP_Text_Slider extends Widget_Base
{

	use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait, WPR_Animation_Trait;

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
		return 'tp-text-slider';
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
		return __(WPRCORE_THEME_NAME . ' :: Text Slider', 'wprealizer');
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
			'tp_list_sec',
			[
				'label' => esc_html__('List', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'repeater_condition',
			[
				'label' => __('Field condition', 'wprealizer'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style_1' => __('Style 1', 'wprealizer'),
					//'style_2' => __( 'Style 2', 'wprealizer' ),
				],
				'default' => 'style_1',
				'frontend_available' => true,
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'tp_text_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Brand Identity', 'wprealizer'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_text_list',
			[
				'label' => esc_html__('Text List', 'wprealizer'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_text_title' => esc_html__('Art Direction', 'wprealizer'),
					],
					[
						'tp_text_title' => esc_html__('Branding', 'wprealizer'),
					],
					[
						'tp_text_title' => esc_html__('Content Production', 'wprealizer'),
					],
					[
						'tp_text_title' => esc_html__('Animation', 'wprealizer'),
					],
				],
				'title_field' => '{{{ tp_text_title }}}',
			]
		);

		$this->end_controls_section();
	}

	// style_tab_content
	protected function style_tab_content()
	{
		$this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
		$this->tp_basic_style_controls('title_style', 'Title', '.tp-el-title');

		$this->start_controls_section(
			'tp_text_slider_parcentage',
			[
				'label' => esc_html__('Parcentage', 'wprealizer'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tp_text_slider_parcentage_typo',
				'label'   => esc_html__('Typography', 'wprealizer'),
				'selector' => '{{WRAPPER}} .tp-el-title span',
			]
		);

		$this->add_control(
			'tp_text_slider_parcentage_color',
			[
				'label'       => esc_html__('Number Color', 'wprealizer'),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-el-title span' => 'color: {{VALUE}}; -webkit-text-fill-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tp_text_slider_parcentage_shape_color',
			[
				'label'       => esc_html__('Shape Color', 'wprealizer'),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-el-title span path' => 'fill: {{VALUE}};',
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


		<?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

			<div class="tp-line-text-wrap tp-el-section">
				<div class="swiper tp-line-text-slide" data-sliderSpeed="400" data-autoPlay="true">
					<div class="swiper-wrapper">

						<?php foreach ($settings['tp_text_list'] as $item): ?>
							<div class="swiper-slide">
								<div class="tp-line-content">
									<span class='tp-el-text'><?php echo tp_kses($item['tp_text_title']); ?></span>
								</div>
							</div>
						<?php endforeach; ?>


					</div>
				</div>
			</div>

		<?php else: ?>


			<!-- marquee-area-start -->
			<section class="tp-marquee-area tp-marquee-scroll fix">
				<div class="tp-marquee-item tp-el-section">
					<?php foreach ($settings['tp_text_list'] as $item): ?>
						<h2 class="tp-marquee-title tp-el-title">
							<?php echo tp_kses($item['tp_text_title']); ?>
						</h2>
					<?php endforeach; ?>
				</div>
			</section>
			<!-- marquee-area-end -->

<?php endif;
	}
}

$widgets_manager->register(new TP_Text_Slider());
