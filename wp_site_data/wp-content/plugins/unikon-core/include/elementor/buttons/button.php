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
class WPR_Theme_Button extends Widget_Base
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
		return 'wpr-theme-button';
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
		return __(WPRCORE_THEME_NAME . ' - Theme Button', 'wprealizer');
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
					'layout-7' => esc_html__('Layout 7', 'wprealizer'),
					'layout-8' => esc_html__('Layout 8', 'wprealizer'),
					'layout-9' => esc_html__('Layout 9', 'wprealizer'),
					'layout-10' => esc_html__('Layout 10', 'wprealizer'),
					'layout-11' => esc_html__('Layout 11', 'wprealizer'),
					'layout-12' => esc_html__('Layout 12', 'wprealizer'),
					'layout-13' => esc_html__('Layout 13', 'wprealizer'),
					'layout-14' => esc_html__('Layout 14', 'wprealizer'),
					'layout-15' => esc_html__('Layout 15', 'wprealizer'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tp_theme_btn_button_group',
			[
				'label' => esc_html__('Theme Button', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tp_button_type',
			[
				'label' => esc_html__('Button Style Type', 'wprealizer'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline' => esc_html__('Inline', 'wprealizer'),
					'w-100 d-block' => esc_html__('Full Width', 'wprealizer'),
				],

			]
		);

		$this->add_control(
			'tp_theme_btn_button_show',
			[
				'label' => esc_html__('Show Button', 'wprealizer'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'wprealizer'),
				'label_off' => esc_html__('Hide', 'wprealizer'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tp_theme_btn_text',
			[
				'label' => esc_html__('Button Text', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Read More', 'wprealizer'),
				'title' => esc_html__('Enter button text', 'wprealizer'),
				'label_block' => true,
				'condition' => [
					'tp_theme_btn_button_show' => 'yes'
				],
			]
		);

		$this->add_control(
			'wpr_button_img_thumb',
			[
				'label' => esc_html__('Choose Thumbnail', 'wprcore'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => ['wpr_design_style'   => ['layout-12']],
			]
		);

		// $this->add_control(
		// 	'tp_theme_btn_line_effect',
		// 	[
		// 		'label' => esc_html__('Line Effect', 'wprealizer'),
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'label_on' => esc_html__('Show', 'wprealizer'),
		// 		'label_off' => esc_html__('Hide', 'wprealizer'),
		// 		'return_value' => 'yes',
		// 		'default' => 'no',
		// 		'condition' => [
		// 			'tp_theme_btn_button_show' => 'yes',
		// 			'wpr_design_style!' => ['layout-1', 'layout-2', 'layout-3']
		// 		],
		// 	]
		// );

		$this->add_control(
			'tp_theme_btn_icon_show',
			[
				'label' => esc_html__('Add Icon ?', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'wprealizer'),
				'label_off' => esc_html__('Hide', 'wprealizer'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->tp_single_icon_control('theme_btn', 'tp_theme_btn_icon_show', 'yes');

		$this->add_control(
			'tp_theme_btn_icon_position',
			[
				'label' => esc_html__('Choose Icon Position', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'wprealizer'),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__('Right', 'wprealizer'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
				// 'condition' => [
				// 	'tp_theme_btn_icon_show' => 'yes',
				// 	'wpr_design_style' => ['layout-1', 'layout-4']
				// ],
			]
		);

		$this->add_control(
			'tp_theme_btn_link_type',
			[
				'label' => esc_html__('Button Link Type', 'wprealizer'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => 'Custom Link',
					'2' => 'Internal Page',
				],
				'default' => '1',
				'label_block' => true,
				'condition' => [
					'tp_theme_btn_button_show' => 'yes'
				],
			]
		);
		$this->add_control(
			'tp_theme_btn_link',
			[
				'label' => esc_html__('Button link', 'wprealizer'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('https://your-link.com', 'wprealizer'),
				'show_external' => false,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'condition' => [
					'tp_theme_btn_link_type' => '1',
					'tp_theme_btn_button_show' => 'yes'
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'tp_theme_btn_page_link',
			[
				'label' => esc_html__('Select Button Link Page', 'wprealizer'),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => tp_get_all_types_post('page'),
				'condition' => [
					'tp_theme_btn_link_type' => '2',
					'tp_theme_btn_button_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'tp_button_align',
			[
				'label' => esc_html__('Alignment', 'wprealizer'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'wprealizer'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'wprealizer'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'wprealizer'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn' => 'justify-content: {{VALUE}};',
				],
				'frontend_available' => true,
				'toggle' => true,
			]
		);
		$this->end_controls_section();
	}

	// style_tab_content
	protected function style_tab_content()
	{

		$this->start_controls_section(
			'tp_theme_btn_style_sec',
			[
				'label' => esc_html__('Button Style', 'wprealizer'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tp_theme_btn_typography',
				'label' => esc_html__('Typhography', 'wprealizer'),
				'selector' => '{{WRAPPER}} .wpr-el-theme-btn, {{WRAPPER}} .wpr-el-theme-circle-btn .rotate',
			]
		);

		$this->add_control(
			'tp_theme_btn_icon_image_size',
			[
				'label' => esc_html__('Icon Image Size', 'wprealizer'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100000,
						'step' => 10,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn .theme-btn-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'tp_theme_btn_icon_show' => 'yes',
					'tp_theme_btn_icon_type' => 'image'
				],
			]
		);

		$this->add_control(
			'tp_theme_btn_icon_size',
			[
				'label' => esc_html__('Icon Size', 'wprealizer'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn .theme-btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'tp_theme_btn_icon_show' => 'yes',
					'tp_theme_btn_icon_type' => 'icon'
				],
			]
		);

		$this->add_control(
			'tp_theme_btn_icon_svg_size',
			[
				'label' => esc_html__('Icon SVG Size', 'wprealizer'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn .theme-btn-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'tp_theme_btn_icon_show' => 'yes',
					'tp_theme_btn_icon_type' => 'svg'
				],
			]
		);

		$this->start_controls_tabs(
			'tp_theme_btn_state_tabs',
		);

		// button normal state
		$this->start_controls_tab(
			'tp_theme_btn_normal_tab',
			[
				'label' => esc_html__('Normal', 'wprealizer'),
			]
		);

		$this->add_control(
			'tp_theme_btn_color',
			[
				'label' => esc_html__('Text Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn, .wpr-el-theme-circle-btn .rotate' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tp_theme_btn_icon_color',
			[
				'label' => esc_html__('Icon Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn .theme-btn-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'tp_theme_btn_icon_show' => 'yes',
					'tp_theme_btn_icon_type' => 'icon'
				],
			]
		);

		$this->add_control(
			'tp_theme_btn_bg_color',
			[
				'label' => esc_html__('Background Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tp_theme_btn_line_color',
			[
				'label' => esc_html__('Button Line Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-line-btn:before' => 'background: {{VALUE}};',
				],
				'condition' => [
					'tp_theme_btn_line_effect' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tp_theme_btn_border',
				'selector' => '{{WRAPPER}} .wpr-el-theme-btn',
			]
		);

		$this->add_control(
			'tp_theme_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tp_theme_btn_box_shadow',
				'selector' => '{{WRAPPER}} .wpr-el-theme-btn',
			]
		);

		$this->end_controls_tab();
		// end normal state

		// button hover state
		$this->start_controls_tab(
			'tp_theme_btn_hover_tab',
			[
				'label' => esc_html__('Hover', 'wprealizer'),
			]
		);

		$this->add_control(
			'tp_theme_btn_hover_color',
			[
				'label' => esc_html__('Text Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tp_theme_btn_hover_icon_color',
			[
				'label' => esc_html__('Icon Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn:hover .theme-btn-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'tp_theme_btn_icon_show' => 'yes',
					'tp_theme_btn_icon_type' => 'icon'
				],

			]
		);

		$this->add_control(
			'tp_theme_btn_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tp_theme_btn_line_hvr_color',
			[
				'label' => esc_html__('Line Hover Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-line-btn:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tp_theme_btn_hover_border',
				'selector' => '{{WRAPPER}} .wpr-el-theme-btn:hover',
			]
		);

		$this->add_control(
			'tp_theme_btn_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tp_theme_btn_hover_box_shadow',
				'selector' => '{{WRAPPER}} .wpr-el-theme-btn:hover',
			]
		);

		$this->end_controls_tab();
		// end hover state


		$this->end_controls_tabs();
		// end button state tabs

		$this->add_control(
			'tp_theme_btn_margin',
			[
				'label' => esc_html__('Button Margin', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tp_theme_btn_padding',
			[
				'label' => esc_html__('Button Padding', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tp_theme_btn_icon_margin',
			[
				'label' => esc_html__('Icon Margin', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-theme-btn .theme-btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// animation
		$this->tp_creative_animation();
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
		$btn_id = 'theme_btn';

?>

		<?php if ($settings['wpr_design_style'] == 'layout-2'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn outline ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>


			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-3'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn square-btn ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>


			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-4'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn__variation3 ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>


			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
						<?php endif; ?>
					</a>

				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-5'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn__variation4 ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
						<?php endif; ?>
					</a>

				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-6'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'common-btn__variation4 common-btn__variation4--extend ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
						<?php endif; ?>
					</a>

				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-7'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn__variation8--extend ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>


			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-8'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn__variation8--extend common-btn__variation8--extend-2 ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>
						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text">

								<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
									<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
								<?php endif; ?>
								<!-- Button Text -->
								<?php echo $settings['tp_' . $btn_id . '_text']; ?>

								<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
									<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
								<?php endif; ?>
							</span>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>


		<?php elseif ($settings['wpr_design_style'] == 'layout-9'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn common-btn__variation5 common-btn__variation5--extend ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<div class="arrow"><?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?></div>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>



		<?php elseif ($settings['wpr_design_style'] == 'layout-10'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn__variation6 ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper animated <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span><span class="btn-dot"></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<div class="arrow"><?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?></div>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>


		<?php elseif ($settings['wpr_design_style'] == 'layout-11'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn__variation9 ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<div class="arrow"><?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?></div>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-12'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn__variation10 ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<div class="arrow"><?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?></div>
						<?php endif; ?>
					</a>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-13'):
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'years popup-youtube ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>

			<div class="hero-mar__thumb">
				<div class="circular-text wpr-el-theme-btn">
					<div class="circular-text-wrapper">
						<div class="circular-video-text wpr-el-theme-circle-btn" data-content="<?php echo $settings['tp_' . $btn_id . '_text']; ?>">
						</div>
						<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?> <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
							<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
								<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
							<?php endif; ?>
							<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
								<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
							<?php endif; ?>
						</a>
					</div>
				</div>
			</div>

		<?php else:
			$tp_button_type = $settings['tp_button_type'];
			$this->tp_link_attributes_render('theme_btn', 'wpr-el-theme-btn common-btn common-btn-v1 ' . $tp_button_type, $this->get_settings());
			$animation = $this->tp_animation_show($settings);
		?>


			<?php if (!empty($settings['tp_' . $btn_id . '_text']) || ($settings['tp_theme_btn_icon_show'] == 'yes') && $settings['tp_' . $btn_id . '_button_show'] == 'yes'): ?>
				<div class="wpr-btn-wrapper <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
					<a <?php echo $this->get_render_attribute_string('tp-button-arg' . $btn_id . ''); ?>>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'left') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-left'); ?>
						<?php endif; ?>

						<?php if (!empty($settings['tp_' . $btn_id . '_text'])): ?>
							<span class="theme-btn-text"><?php echo $settings['tp_' . $btn_id . '_text']; ?></span>
						<?php endif; ?>

						<?php if (($settings['tp_theme_btn_icon_position'] == 'right') && ($settings['tp_theme_btn_icon_show'] == 'yes')): ?>
							<?php tp_render_signle_icon_html($settings, 'theme_btn', 'theme-btn-icon on-right'); ?>
						<?php endif; ?>
					</a>
				</div>

			<?php endif; ?>

		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new WPR_Theme_Button());
