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
class WPR_Icon_Box extends Widget_Base
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
		return 'wpr-icon-box';
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
		return __(WPRCORE_THEME_NAME . ' - Icon Box', 'wprealizer');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'wpr_icon_box_section',
			[
				'label' => esc_html__('Icon Box Contents', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		tp_render_icon_controls($this, 'icon_box');

		$this->add_control(
			'animation_data_delay',
			[
				'label' => esc_html__('Animation Delay', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('.3s', 'wprealizer'),
				'placeholder' => esc_html__('Animation Delay', 'wprealizer'),
				'label_block' => true,
				'condition' => [
					'wpr_design_style' => ['layout-1', 'layout-2', 'layout-3', 'layout-4'],
				]
			]
		);

		$this->add_control(
			'wpr_icon_box_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Branding', 'wprealizer'),
				'placeholder' => esc_html__('Your Text', 'wprealizer'),
				'label_block' => true,
			]
		);
		// tp_render_links_controls($this, 'icon_box');

		$this->add_control(
			'wpr_icon_box_desc',
			[
				'label' => esc_html__('Description', 'wprealizer'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Branding is one of the most important ingredients for the success of any business.', 'wprealizer'),
				'placeholder' => esc_html__('Your Text', 'wprealizer'),
				'label_block' => true,
				'condition' => [
					'wpr_design_style' => ['layout-1', 'layout-2', 'layout-4'],
				]
			]
		);

		$this->add_control(
			'wpr_icon_box_number',
			[
				'label' => esc_html__('Number', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('001', 'wprealizer'),
				'placeholder' => esc_html__('Enter Number', 'wprealizer'),
				'label_block' => true,
				'condition' => [
					'wpr_design_style' => ['layout-1', 'layout-5'],
				]
			]
		);

		$this->end_controls_section();

		// animation
		$this->tp_creative_animation();
	}

	// style_tab_content
	protected function style_tab_content()
	{
		$this->tp_section_style_controls('section', 'Section - Style', '.wpr-el-section');

		// icon 
		$this->start_controls_section(
			'wpr_icon_box_section_style',
			[
				'label' => esc_html__('Icon/Image/SVG', 'wprealizer'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'wpr_icon_box_tabs',
		);

		$this->start_controls_tab(
			'wpr_icon_box_tab_icon',
			[
				'label'   => esc_html__('Icon', 'wprealizer'),
			]
		);

		$this->add_control(
			'wpr_icon_box_tab_icon_color',
			[
				'label'       => esc_html__('Color', 'wprealizer'),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-icon i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'wpr_icon_box_tab_icon_size',
			[
				'label' => esc_html__('Size', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		// Image 
		$this->start_controls_tab(
			'wpr_icon_box_tab_image',
			[
				'label'   => esc_html__('Image', 'wprealizer'),
			]
		);


		$this->add_responsive_control(
			'wpr_icon_box_tab_image_w',
			[
				'label' => esc_html__('Width', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'wpr_icon_box_tab_image_h',
			[
				'label' => esc_html__('Height', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-icon img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		// SVG 
		$this->start_controls_tab(
			'wpr_icon_box_tab_svg',
			[
				'label'   => esc_html__('svg', 'wprealizer'),
			]
		);


		$this->add_responsive_control(
			'wpr_icon_box_tab_svg_w',
			[
				'label' => esc_html__('Width', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'wpr_icon_box_tab_svg_h',
			[
				'label' => esc_html__('Height', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-el-icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'wpr_icon_box_background',
			[
				'label' => esc_html__('Background Color', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-el-icon::after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'wpr_icon_box_background_border',
				'label'    => esc_html__('Border', 'wprealizer'),
				'selector' => '{{WRAPPER}} .wpr-el-icon',
			]
		);
		$this->end_controls_section();

		$this->tp_basic_style_controls('icon_box_title', 'Title', '.wpr-el-title');
		$this->tp_basic_style_controls('icon_box_content', 'Description', '.wpr-el-content');
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

		<?php if ($settings['wpr_design_style'] == 'layout-4'):
			$animation = $this->tp_animation_show($settings);

		?>

			<div class="roadmap-fin__item wpr-el-section fade_up_anim <?php echo esc_attr($animation['animation']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?> data-delay="<?php echo esc_attr($settings['animation_data_delay']); ?>">
				<span class="roadmap-fin__number"></span>

				<figure class="roadmap-fin__icon">
					<?php tp_render_signle_icon_html($settings, 'icon_box'); ?>
				</figure>

				<?php if (!empty($settings['wpr_icon_box_title'])): ?>
				<h5 class="h5 wpr-el-title">
					<?php echo tp_kses($settings['wpr_icon_box_title']); ?>
				</h5>
				<?php endif; ?>

				<?php if (!empty($settings['wpr_icon_box_desc'])): ?>
				<p class="wpr-el-content">
					<?php echo tp_kses($settings['wpr_icon_box_desc']); ?>
				</p>
				<?php endif; ?>
			</div>


		<?php elseif ($settings['wpr_design_style'] == 'layout-3'):
			$animation = $this->tp_animation_show($settings);
		?>

            <div class="hero-health__feature wpr-el-section fade_up_anim <?php echo esc_attr($animation['animation']); ?>" data-delay="<?php echo esc_attr($settings['animation_data_delay']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <div class="icon wpr-el-icon">
                  	<?php tp_render_signle_icon_html($settings, 'icon_box'); ?>
                </div>

                <?php if (!empty($settings['wpr_icon_box_title'])): ?>
                <p class="wpr-el-title">
                	<?php echo tp_kses($settings['wpr_icon_box_title']); ?>
                </p>
            	<?php endif; ?>
            </div>

		<?php elseif ($settings['wpr_design_style'] == 'layout-2'):
			$animation = $this->tp_animation_show($settings);
		?>

        <div class="core-value__item fade_up_anim wpr-el-section <?php echo esc_attr($animation['animation']); ?>" data-delay="<?php echo esc_attr($settings['animation_data_delay']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
            <figure class="core-value__item-icon wpr-el-icon">
	            <?php tp_render_signle_icon_html($settings, 'icon_box'); ?>
            </figure>
            <div class="core-value__item-content">
            	<?php if (!empty($settings['wpr_icon_box_title'])): ?>
	            <h6 class="h6 core-value__item-title wpr-el-title">
	                <?php echo tp_kses($settings['wpr_icon_box_title']); ?>
	            </h6>
	        	<?php endif; ?>

	            <?php if (!empty($settings['wpr_icon_box_desc'])): ?>
	            <p class="wpr-el-content">
	                <?php echo tp_kses($settings['wpr_icon_box_desc']); ?>
	            </p>
	            <?php endif; ?>
              	<p class="core-value__item-border-bottom"></p>
            </div>
        </div>

		<?php elseif ($settings['wpr_design_style'] == 'layout-5'):
		?>

		<div class="circular-text">
			<div class="circular-text-wrapper">
				<span class="circular-text-content wpr-el-title" data-content="<?php echo esc_attr($settings['wpr_icon_box_title']); ?>">
				</span>

				<?php if (!empty($settings['wpr_icon_box_number'])): ?>
				<span class="years wpr-el-number">
					<?php echo tp_kses($settings['wpr_icon_box_number']); ?>
				</span>
				<?php endif; ?>
			</div>
		</div>

		<?php else:
			$animation = $this->tp_animation_show($settings);

		?>


			<div class="process-sa__item-wrapper fade_up_anim <?php echo esc_attr($animation['animation']); ?>" data-delay="<?php echo esc_attr($settings['animation_data_delay']); ?>" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
				<div class="process-sa__item">
					<div class="process-sa__item-thumb wpr-el-icon">
						<?php tp_render_signle_icon_html($settings, 'icon_box'); ?>
					</div>
					<div class="process-sa__item-content">
						<?php if (!empty($settings['wpr_icon_box_title'])): ?>
						<h5 class="h5 wpr-el-title">
							<?php echo tp_kses($settings['wpr_icon_box_title']); ?>
						</h5>
						<?php endif; ?>

						<?php if (!empty($settings['wpr_icon_box_desc'])): ?>
						<p class="wpr-el-content">
							<?php echo tp_kses($settings['wpr_icon_box_desc']); ?>
						</p>
						<?php endif; ?>
					</div>

					<?php if (!empty($settings['wpr_icon_box_number'])): ?>
					<div class="process-sa__item-number d-none d-md-flex">
						<span>
							<?php echo tp_kses($settings['wpr_icon_box_number']); ?>
						</span>
						<span class="line"></span>
					</div>
					<?php endif; ?>
				</div>
			</div>


		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new WPR_Icon_Box());
