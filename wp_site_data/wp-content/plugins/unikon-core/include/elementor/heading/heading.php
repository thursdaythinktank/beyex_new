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

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly


/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Heading extends Widget_Base
{

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
		return 'wpr-heading';
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
		return __(WPRCORE_THEME_NAME . ' - Heading', 'wprealizer');
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
		$this->register_content_controls();
		$this->register_style_controls();
	}

	protected function register_content_controls()
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

		// Title/Content
		$this->start_controls_section(
			'wpr_section_heading_settings',
			[
				'label' => __('Section Heading', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'wpr_heading_subtitle',
			[
				'label' => esc_html__('Sub Title', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('basic'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Sub Title',
				'placeholder' => esc_html__('Type Before Heading Text', 'wprealizer'),
				'label_block' => true,

			]
		);

		$this->add_control(
			'wpr_heading_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Your Section Title',
				'placeholder' => esc_html__('Type Heading Text', 'wprealizer'),
				'label_block' => true,

			]
		);
		$this->add_control(
			'wpr_heading_title_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'wprealizer'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h1' => [
						'title' => esc_html__('H1', 'wprealizer'),
						'icon' => 'eicon-editor-h1'
					],
					'h2' => [
						'title' => esc_html__('H2', 'wprealizer'),
						'icon' => 'eicon-editor-h2'
					],
					'h3' => [
						'title' => esc_html__('H3', 'wprealizer'),
						'icon' => 'eicon-editor-h3'
					],
					'h4' => [
						'title' => esc_html__('H4', 'wprealizer'),
						'icon' => 'eicon-editor-h4'
					],
					'h5' => [
						'title' => esc_html__('H5', 'wprealizer'),
						'icon' => 'eicon-editor-h5'
					],
					'h6' => [
						'title' => esc_html__('H6', 'wprealizer'),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h2',
				'toggle' => false,

			]
		);

		$this->add_control(
			'wpr_heading_anim_img',
			[
				'label' => esc_html__('Choose Image', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => ['wpr_design_style'   => ['layout-6']],
			]
		);

		$this->add_control(
			'wpr_heading_description',
			[
				'label' => esc_html__('Description', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.',
				'placeholder' => esc_html__('Type section description here', 'wprealizer'),

			]
		);
		$this->add_responsive_control(
			'wpr_heading_align',
			[
				'label' => esc_html__('Alignment', 'wprealizer'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'wprealizer'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'wprealizer'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'wprealizer'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .wpr-align-box' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		// animation
		$this->tp_creative_animation();
	}


	protected function register_style_controls()
	{
		// Style Tab Content
		$this->start_controls_section(
			'wpr_heading_area_styling',
			[
				'label' => __('Section - Style', 'wprealizer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'wpr_heading_area_background',
				'label' => esc_html__('Background', 'wprealizer'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .wpr-el-section',
			]
		);
		$this->add_responsive_control(
			'wpr_heading__area_padding',
			[
				'label' => esc_html__('Padding', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wpr_heading__area_margin',
			[
				'label' => esc_html__('Margin', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wpr_heading__area_border_radius',
			[
				'label' => esc_html__('Border Radius', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'name',
				'label' => esc_html__('label', 'wprealizer'),
				'selector' => '{{WRAPPER}} .wpr-el-section',
			]
		);
		$this->end_controls_section();

		// Heading Title Style Tab

		$this->start_controls_section(
			'wpr_heading_title_style_settings',
			[
				'label' => __('Section - Title', 'wprealizer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('wpr_heading_title_tabs');

		// Normal Tab
		$this->start_controls_tab(
			'wpr_heading_title_normal_tab',
			[
				'label' => esc_html__('Normal', 'wprealizer'),
			]
		);

		$this->add_control(
			'wpr_heading_title_normal_color',
			[
				'label' => esc_html__('Text Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'wpr_heading_title_hover_tab',
			[
				'label' => esc_html__('Hover', 'wprealizer'),
			]
		);

		$this->add_control(
			'wpr_heading_title_hover_color',
			[
				'label' => esc_html__('Hover Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'wpr_heading_title_tab_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'elementor') . ' (s)',
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'' => [ // Use empty string for units like seconds
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-title' => 'transition: all {{SIZE}}s ease-in-out; -webkit-transition: all {{SIZE}}s ease-in-out;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wpr_heading_title_typography',
				'label' => esc_html__('Typography', 'wprealizer'),
				'selector' => '{{WRAPPER}} .wpr-el-title',
			]
		);
		$this->add_responsive_control(
			'wpr_heading_title_padding',
			[
				'label' => esc_html__('Padding', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wpr_heading_title_margin',
			[
				'label' => esc_html__('Margin', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();

		// Heading Sub - Title Style Tab

		$this->start_controls_section(
			'wpr_heading_subtitle_style_settings',
			[
				'label' => __('Section - Subtitle', 'wprealizer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wpr_heading_subtitle_normal_color',
			[
				'label' => esc_html__('Text Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wpr_heading_subtitle_typography',
				'label' => esc_html__('Typography', 'wprealizer'),
				'selector' => '{{WRAPPER}} .wpr-el-subtitle',
			]
		);
		$this->add_responsive_control(
			'wpr_heading_subtitle_padding',
			[
				'label' => esc_html__('Padding', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wpr_heading_subtitle_margin',
			[
				'label' => esc_html__('Margin', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();

		// Heading Sub - Title Style Tab

		$this->start_controls_section(
			'wpr_heading_content_style_settings',
			[
				'label' => __('Section - Content', 'wprealizer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wpr_heading_desc_normal_color',
			[
				'label' => esc_html__('Text Color', 'wprealizer'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wpr_heading_desc_typography',
				'label' => esc_html__('Typography', 'wprealizer'),
				'selector' => '{{WRAPPER}} .wpr-el-content',
			]
		);
		$this->add_responsive_control(
			'wpr_heading_desc_padding',
			[
				'label' => esc_html__('Padding', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wpr_heading_desc_margin',
			[
				'label' => esc_html__('Margin', 'wprealizer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'wpr_heading_desc_width',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__('Content Width', 'marketicore'),
				'size_units' => ['%', 'custom'],
				'default' => [
					'size' => '100',
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpr_heading_desc_auto_center',
			[
				'label' => esc_html__('Auto center', 'marketicore'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marketicore'),
				'label_off' => esc_html__('Hide', 'marketicore'),
				'return_value' => 'yes',
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
		$content_auto_center = ($settings['wpr_heading_desc_auto_center'] == 'yes') ? 'mx-auto' : false;
?>

		<?php if ($settings['wpr_design_style'] == 'layout-2'):
			$animation = $this->tp_animation_show($settings);
			$this->add_render_attribute('title_args', 'class', 'h2 section__header-title-v12 wpr-el-title');
		?>


			<div class="wpr-el-section wpr-align-box section__header-v12 <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
				<?php if (!empty($settings['wpr_heading_subtitle'])): ?>
					<span class="wpr-el-subtitle section__header-sub-title-v12"><?php echo tp_kses($settings['wpr_heading_subtitle']); ?></span>
				<?php endif; ?>

				<?php if (!empty($settings['wpr_heading_title'])):
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						tag_escape($settings['wpr_heading_title_tag']),
						$this->get_render_attribute_string('title_args'),
						tp_kses($settings['wpr_heading_title'])
					);
				endif; ?>

				<?php if (!empty($settings['wpr_heading_description'])): ?>
					<p class="wpr-el-content <?php echo esc_attr($content_auto_center); ?>"><?php echo tp_kses($settings['wpr_heading_description']); ?></p>
				<?php endif; ?>
			</div>

		<?php elseif ($settings['wpr_design_style'] == 'layout-3'):
			$animation = $this->tp_animation_show($settings);
			$this->add_render_attribute('title_args', 'class', 'wpr-el-title h3 section__header-title-v2--extend');
		?>

			<div class="wpr-el-section wpr-align-box section__header <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
				<span class="section__header-sub-title-frontLine"></span>
				<span class="wpr-el-subtitle section__header-sub-title-v2"><?php echo tp_kses($settings['wpr_heading_subtitle']); ?></span>

				<?php if (!empty($settings['wpr_heading_title'])):
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						tag_escape($settings['wpr_heading_title_tag']),
						$this->get_render_attribute_string('title_args'),
						tp_kses($settings['wpr_heading_title'])
					);
				endif; ?>

				<?php if (!empty($settings['wpr_heading_description'])): ?>
					<p class="wpr-el-content <?php echo esc_attr($content_auto_center); ?>"><?php echo tp_kses($settings['wpr_heading_description']); ?></p>
				<?php endif; ?>

			</div>



		<?php elseif ($settings['wpr_design_style'] == 'layout-4'):
			$animation = $this->tp_animation_show($settings);
			$this->add_render_attribute('title_args', 'class', 'h3 section__title wpr-el-title');
		?>

			<div class="wpr-el-section wpr-align-box section__header-v2 <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>

				<?php if (!empty($settings['wpr_heading_subtitle'])): ?>
					<span class="wpr-el-subtitle section__sub-title"><?php echo tp_kses($settings['wpr_heading_subtitle']); ?></span>
				<?php endif; ?>

				<?php if (!empty($settings['wpr_heading_title'])):
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						tag_escape($settings['wpr_heading_title_tag']),
						$this->get_render_attribute_string('title_args'),
						tp_kses($settings['wpr_heading_title'])
					);
				endif; ?>

				<?php if (!empty($settings['wpr_heading_description'])): ?>
					<p class="wpr-el-content <?php echo esc_attr($content_auto_center); ?>"><?php echo tp_kses($settings['wpr_heading_description']); ?></p>
				<?php endif; ?>

			</div>


		<?php elseif ($settings['wpr_design_style'] == 'layout-5'):
			$animation = $this->tp_animation_show($settings);
			$this->add_render_attribute('title_args', 'class', 'h1 wpr-el-title ' . $animation['animation']);
		?>


			<div class="wpr-el-section wpr-align-box hero-fin__title hero-fit__content <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>

				<?php if (!empty($settings['wpr_heading_subtitle'])): ?>
					<span class="wpr-el-subtitle section__header-sub-title-v10--extend"><?php echo tp_kses($settings['wpr_heading_subtitle']); ?></span>
				<?php endif; ?>


				<?php if (!empty($settings['wpr_heading_title'])):
					printf(
						'<%1$s %2$s><span class="">%3$s</span></%1$s>',
						tag_escape($settings['wpr_heading_title_tag']),
						$this->get_render_attribute_string('title_args'),
						tp_kses($settings['wpr_heading_title'])
					);
				endif; ?>

				<?php if (!empty($settings['wpr_heading_description'])): ?>
					<p class="wpr-el-content <?php echo esc_attr($content_auto_center); ?>"><?php echo tp_kses($settings['wpr_heading_description']); ?></p>
				<?php endif; ?>

			</div>

		<?php elseif ($settings['wpr_design_style'] == 'layout-6'):
			$animation = $this->tp_animation_show($settings);
			$this->add_render_attribute('title_args', 'class', 'tp-section-title-200 wpr-el-title h1 title' . $animation['animation']);
		?>

			<div class="wpr-el-section wpr-align-box hero-fin__title <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>

				<?php if (!empty($settings['wpr_heading_title'])):
					printf(
						'<%1$s %2$s><span class="">%3$s</span></%1$s>',
						tag_escape($settings['wpr_heading_title_tag']),
						$this->get_render_attribute_string('title_args'),
						tp_kses($settings['wpr_heading_title'])
					);
				endif; ?>

				<?php if (!empty($settings['wpr_heading_anim_img'])): ?>
					<?php echo wp_get_attachment_image($settings['wpr_heading_anim_img']['id'], 'full', '', ['class' => 'img-cursor d-none d-md-block']) ?>
				<?php endif; ?>

			</div>

		<?php else:
			$animation = $this->tp_animation_show($settings);
			$this->add_render_attribute('title_args', 'class', 'h2 section__header-title-v11 wpr-el-title');
		?>


			<div class="wpr-el-section wpr-align-box section-header <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>

				<?php if (!empty($settings['wpr_heading_subtitle'])): ?>
					<span class="wpr-el-subtitle section__header-sub-title-v11"><?php echo tp_kses($settings['wpr_heading_subtitle']); ?></span>
				<?php endif; ?>

				<?php if (!empty($settings['wpr_heading_title'])):
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						tag_escape($settings['wpr_heading_title_tag']),
						$this->get_render_attribute_string('title_args'),
						tp_kses($settings['wpr_heading_title'])
					);
				endif; ?>

				<?php if (!empty($settings['wpr_heading_description'])): ?>
					<p class="wpr-el-content <?php echo esc_attr($content_auto_center); ?>"><?php echo tp_kses($settings['wpr_heading_description']); ?></p>
				<?php endif; ?>

			</div>



<?php endif;
	}
}

$widgets_manager->register(new WPR_Heading());
