<?php

namespace WPRCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use Elementor\REPEA;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use WPRCore\Elementor\Controls\Group_Control_WPRBGGradient;
use WPRCore\Elementor\Controls\Group_Control_WPRGradient;

trait WPR_Animation_Trait
{

	protected function tp_creative_animation($condition = null, $control_id = 'ani_demo', $style = 'wpr_design_style', $control_name = 'Creative Animation')
	{

		$section_args = [
			'label' => esc_html__($control_name, 'wprealizer'),
			'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		];

		if ($condition) {
			$section_args['condition'] = [
				$style => $condition
			];
		};

		$this->start_controls_section(
			'creative_animation_sec',
			$section_args
		);

		$this->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__('Active Animation', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'wprealizer'),
				'label_off' => esc_html__('No', 'wprealizer'),
				'return_value' => 'yes',
				'default' => '0',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tp_anima_type',
			[
				'label' => __('Animation Type', 'wprealizer'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fadeIn' => __('fadeIn', 'wprealizer'),
					'fadeInUp' => __('fadeInUp', 'wprealizer'),
					'fadeInDown' => __('fadeInDown', 'wprealizer'),
					'fadeInLeft' => __('fadeInLeft', 'wprealizer'),
					'fadeInRight' => __('fadeInRight', 'wprealizer'),
					'bounceIn' => __('bounceIn', 'wprealizer'),
				],
				'default' => 'fadeInUp',
				'frontend_available' => true,
				'style_transfer' => true,
				'condition' => [
					'tp_creative_anima_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'tp_anima_dura',
			[
				'label' => esc_html__('Animation Duration', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'wprealizer'),
				'condition' => [
					'tp_creative_anima_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'tp_anima_delay',
			[
				'label' => esc_html__('Animation Delay', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'wprealizer'),
				'condition' => [
					'tp_creative_anima_switcher' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	// creative animation value
	protected function tp_animation_show($data)
	{
		$animation = $data['tp_creative_anima_switcher'] ? 'wow ' . $data['tp_anima_type'] : NULL;
		$duration = $data['tp_anima_dura'] ? 'data-wow-duration="' . $data['tp_anima_dura'] . '"' : NULL;
		$delay = $data['tp_anima_delay'] ? 'data-wow-delay="' . $data['tp_anima_delay'] . '"' : NULL;

		return [
			'animation' => $animation,
			'duration' => $duration,
			'delay' => $delay,
		];
	}

	// Multi creative animation 
	protected function tp_creative_animation_multi($condition = null, $control_id = 'ani_demo', $style = 'wpr_design_style', $control_name = 'Creative Animation')
	{

		$section_args = [
			'label' => esc_html__($control_name, 'wprealizer'),
			'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		];

		if ($condition) {
			$section_args['condition'] = [
				$style => $condition
			];
		};

		$this->start_controls_section(
			'creative_animation_sec' . $control_id,
			$section_args
		);

		$this->add_control(
			'tp_creative_anima_switcher' . $control_id,
			[
				'label' => esc_html__('Active Animation', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'wprealizer'),
				'label_off' => esc_html__('No', 'wprealizer'),
				'return_value' => 'yes',
				'default' => '0',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tp_anima_type' . $control_id,
			[
				'label' => __('Animation Type', 'wprealizer'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fadeIn' => __('fadeIn', 'wprealizer'),
					'fadeInUp' => __('fadeInUp', 'wprealizer'),
					'fadeInDown' => __('fadeInDown', 'wprealizer'),
					'fadeInLeft' => __('fadeInLeft', 'wprealizer'),
					'fadeInRight' => __('fadeInRight', 'wprealizer'),
					'bounceIn' => __('bounceIn', 'wprealizer'),
				],
				'default' => 'fadeInUp',
				'frontend_available' => true,
				'style_transfer' => true,
				'condition' => [
					'tp_creative_anima_switcher' . $control_id => 'yes',
				],
			]
		);

		$this->add_control(
			'tp_anima_dura' . $control_id,
			[
				'label' => esc_html__('Animation Duration', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'wprealizer'),
				'condition' => [
					'tp_creative_anima_switcher' . $control_id => 'yes',
				],
			]
		);

		$this->add_control(
			'tp_anima_delay' . $control_id,
			[
				'label' => esc_html__('Animation Delay', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('0.3s', 'wprealizer'),
				'condition' => [
					'tp_creative_anima_switcher' . $control_id => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	// creative animation value
	protected function tp_animation_show_multi($data, $control_id = 'ani_demo')
	{
		$animation = $data['tp_creative_anima_switcher' . $control_id] ? 'wow ' . $data['tp_anima_type' . $control_id] : NULL;
		$duration = $data['tp_anima_dura' . $control_id] ? 'data-wow-duration="' . $data['tp_anima_dura' . $control_id] . '"' : NULL;
		$delay = $data['tp_anima_delay' . $control_id] ? 'data-wow-delay="' . $data['tp_anima_delay' . $control_id] . '"' : NULL;

		return [
			'animation' => $animation,
			'duration' => $duration,
			'delay' => $delay,
		];
	}
}
