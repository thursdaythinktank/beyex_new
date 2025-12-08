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
	exit; // Exit if accessed directly][po
/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Tp_Mission_Sticky extends Widget_Base
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
		return 'tp-mission-sticky';
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
		return __(WPRCORE_THEME_NAME . ' :: Mission Sticky', 'wprealizer');
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

		$this->start_controls_section(
			'tp_mission_sticky_image_section',
			[
				'label' => esc_html__('Main Thumbnail', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tp_mission_sticky_image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'main_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);


		$this->end_controls_section();

		// section title 
		$this->tp_section_title_render_controls('mission_sticky', 'Section Heading',);

		// list repeater
		$this->start_controls_section(
			'tp_mission_sticky_item_section',
			[
				'label' => esc_html__('Sticky item', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'tp_mission_sticky_item_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Creativity', 'wprealizer'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_mission_sticky_item_desc',
			[
				'label' => esc_html__('Description', 'wprealizer'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Encouraging behaviours which encompass notions of originality, and problem-solving in all that we do.', 'wprealizer'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_mission_sticky_item_image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'item_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);


		$repeater->add_control(
			'tp_mission_sticky_item_button_title',
			[
				'label' => esc_html__('Button title', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Learn More', 'wprealizer'),
				'label_block' => false,
			]
		);
		tp_render_links_controls($repeater, 'mission_sticky_item_btn');

		$this->add_control(
			'tp_mission_sticky_item_list',
			[
				'label' => esc_html__('Item List', 'wprealizer'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_mission_sticky_item_title' => esc_html__('Creativity', 'wprealizer'),
					],
					[
						'tp_mission_sticky_item_title' => esc_html__('Scholarship', 'wprealizer'),
					],
					[
						'tp_mission_sticky_item_title' => esc_html__('Community', 'wprealizer'),
					],
				],
				'title_field' => '{{{ tp_mission_sticky_item_title }}}',
			]
		);

		$this->end_controls_section();

		$this->tp_creative_animation_multi(null, 'mission_stickey_left', 'wpr_design_style', 'Left Content Animation');
		$this->tp_creative_animation_multi(null, 'mission_stickey_right', 'wpr_design_style', 'Right Content Animation');
	}

	// style_tab_content
	protected function style_tab_content()
	{
		$this->tp_section_style_controls('tp_mission_sticky_section_style', 'Section', '.tp-el-section');
		$this->tp_basic_style_controls('tp_mission_sticky_section_title', 'Section Title', '.tp-el-title');
		$this->tp_basic_style_controls('tp_mission_sticky_section_desc', 'Section Description', '.tp-el-desc');
		$this->tp_basic_style_controls('tp_mission_sticky_item_title', 'Item Title', '.tp-el-sticky-title');
		$this->tp_basic_style_controls('tp_mission_sticky_item_desc', 'Item Description', '.tp-el-sticky-desc');
		$this->tp_link_controls_style('', 'btn1_style', 'Button', 'a.tp-btn');


		$this->start_controls_section(
			'tp_mission_sticky_item_style_section',
			[
				'label' => esc_html__('Content width', 'wprealizer'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'tp_mission_sticky_area_width',
			[
				'label' => esc_html__('Content width', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .tp-el-mission_sticky_content' => 'width: {{SIZE}}{{UNIT}};',
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

		$tp_main_image = !empty($settings['tp_mission_sticky_image']['id']) ? wp_get_attachment_image_url($settings['tp_mission_sticky_image']['id'], $settings['main_thumbnail_size']) : $settings['tp_mission_sticky_image']['url'];
		$tp_main_image_alt = get_post_meta($settings["tp_mission_sticky_image"]["id"], "_wp_attachment_image_alt", true);

		$animation_left = $this->tp_animation_show_multi($settings, 'mission_stickey_left');
		$animation_right = $this->tp_animation_show_multi($settings, 'mission_stickey_right');

		$this->add_render_attribute('title_args', 'class', 'tp-our-mission-title tp-el-title');
?>
		<!-- our-mission-area-start -->
		<section class="tp-our-mission-area tp-el-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="tp-our-mission-thumb <?php echo esc_attr($animation_left['animation']); ?>" <?php echo $animation_left['duration'] . ' ' . $animation_left['delay']; ?>>
							<img src="<?php echo esc_url($tp_main_image); ?>" alt="<?php echo esc_attr($tp_main_image_alt); ?>">
						</div>
					</div>
					<div class="col-lg-8">
						<div class="tp-our-mission-wrapper <?php echo esc_attr($animation_right['animation']); ?>" <?php echo $animation_right['duration'] . ' ' . $animation_right['delay']; ?>>
							<div class="tp-our-mission-heading">
								<?php
								if (!empty($settings['tp_mission_sticky_title'])):
									printf(
										'<%1$s %2$s>%3$s</%1$s>',
										tag_escape($settings['tp_mission_sticky_title_tag']),
										$this->get_render_attribute_string('title_args'),
										tp_kses($settings['tp_mission_sticky_title'])
									);
								endif;
								?>
								<?php if (!empty($settings['tp_mission_sticky_description'])): ?>
									<p class="tp-el-desc">
										<?php echo tp_kses($settings['tp_mission_sticky_description']); ?>
									</p>
								<?php endif; ?>
							</div>
							<?php foreach ($settings['tp_mission_sticky_item_list'] as $key => $item):
								if (!empty($item['tp_mission_sticky_item_image']['url'])) {
									$tp_item_image = !empty($item['tp_mission_sticky_item_image']['id']) ? wp_get_attachment_image_url($item['tp_mission_sticky_item_image']['id'], $item['item_thumbnail_size']) : $item['tp_mission_sticky_item_image']['url'];
									$tp_item_image_alt = get_post_meta($item["tp_mission_sticky_item_image"]["id"], "_wp_attachment_image_alt", true);
								}

								$item_title = $item['tp_mission_sticky_item_title'];
								$item_desc = $item['tp_mission_sticky_item_desc'];

								$button_title = $item['tp_mission_sticky_item_button_title'];

								$attrs = tp_get_repeater_links_attr($item, 'mission_sticky_item_btn');
								extract($attrs);

								$links_attrs = [
									'href' => $link,
									'target' => $target,
									'rel' => $rel,
								];

							?>
								<div
									class="tp-our-mission-item d-flex align-items-center justify-content-center justify-content-md-between mb-20">
									<div class="tp-our-mission-item-content tp-el-mission_sticky_content">
										<?php if (!empty($item_title)): ?>
											<h4 class="tp-our-mission-item-title tp-el-sticky-title">
												<?php echo tp_kses($item_title); ?>
											</h4>
										<?php endif; ?>

										<?php if (!empty($item_desc)): ?>
											<p class="tp-el-sticky-desc">
												<?php echo tp_kses($item_desc); ?>
											</p>
										<?php endif; ?>

										<?php if (!empty($button_title)): ?>
											<div class="tp-our-mission-item-btn">
												<a class="tp-btn-3 tp-btn" <?php echo tp_implode_html_attributes($links_attrs); ?>>
													<?php echo esc_html($button_title); ?>
													<i>
														<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12"
															viewBox="0 0 13 12" fill="none">
															<path d="M1.5 6H11.5" stroke="white" stroke-width="1.5"
																stroke-linecap="round" stroke-linejoin="round" />
															<path d="M6.5 1L11.5 6L6.5 11" stroke="white" stroke-width="1.5"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>
													</i></a>
											</div>
										<?php endif; ?>
									</div>
									<div class="tp-our-mission-item-thumb">
										<?php if (!empty($tp_item_image)): ?>
											<div class="tp-our-mission-item-thumb-1">
												<img src="<?php echo esc_url($tp_item_image); ?>"
													alt="<?php echo esc_attr($tp_item_image_alt); ?>">
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- our-mission-area-end -->

<?php
	}
}

$widgets_manager->register(new Tp_Mission_Sticky());
