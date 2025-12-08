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
class WPR_Banner extends Widget_Base
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
		return 'wpr-banner';
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
		return __(WPRCORE_THEME_NAME . ' :: Banner', 'wprealizer');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'banner_section',
			[
				'label' => esc_html__('Banner Controls', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'banner_subtitle',
			[
				'label' => esc_html__('Subtitle', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Digital', 'wprealizer'),
				'placeholder' => esc_html__('Your Text', 'wprealizer'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('productivity', 'wprealizer'),
				'placeholder' => esc_html__('Your Text', 'wprealizer'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_description',
			[
				'label' => esc_html__('Description', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Description', 'wprealizer'),
				'placeholder' => esc_html__('Your Text', 'wprealizer'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'banner_years',
			[
				'label' => esc_html__('Years Active', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('We’re since 2002', 'wprealizer'),
				'placeholder' => esc_html__('Your Text', 'wprealizer'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'video_url',
			[
				'label' => esc_html__('Video URL', 'wprealizer'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'https://themeforest.wprealizer.com/unikon/assets/unikon_agency_video1.mp4',
				'label_block' => true,
				'description' => __("We recommended to put 'mp4' format video.", 'wprealizer')
			]
		);

		$this->add_control(
			'banner_title_tag',
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
				'default' => 'h4',
				'toggle' => false,
			]
		);

		$this->add_control(
			'banner_image',
			[
				'label' => esc_html__('Thumbnail', 'wprealizer'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'banner_link_text',
			[
				'label' => esc_html__('Button Text', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Explore Service', 'wprealizer'),
				'placeholder' => esc_html__('Your Text', 'wprealizer'),
				'label_block' => true,
			]
		);

		tp_render_links_controls($this, 'banner_link');

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_image_size',
				'default' => 'full',
				'exclude' => [
					'custom'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->tp_section_style_controls('section', 'Section - Style', '.wpr-el-section');
		$this->tp_basic_style_controls('b_heading_subtitle', 'Section - Subtitle', '.wpr-el-subtitle');
		$this->tp_basic_style_controls('b_heading_title', 'Section - Title', '.wpr-el-title');
		$this->tp_basic_style_controls('b_heading_desc', 'Section - Title', '.wpr-el-desc');
		$this->tp_link_controls_style('', 'b_btn1_style', 'Button', '.wpr-el-btn');

		$this->start_controls_section(
			'banner_style_section',
			[
				'label' => esc_html__('Image Style', 'wprealizer'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'banner_border-radius',
			[
				'label' => esc_html__('Border Radius', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpr_el_item_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_width',
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
				'selectors' => [
					'{{WRAPPER}} .wpr_el_item_image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_height',
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
				'selectors' => [
					'{{WRAPPER}} .wpr_el_item_image' => 'height: {{SIZE}}{{UNIT}};',
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

		<?php else:

			$img = tp_get_img($settings, 'banner_image', 'tp_image_size');

			$attrs = tp_get_repeater_links_attr($settings, 'banner_link');
			extract($attrs);

			$links_attrs = [
				'href' => $link,
				'target' => $target,
				'rel' => $rel,
			];

			$this->add_render_attribute('title_args', 'class', 'featured-shop-banner-title wpr-el-title');
		?>

			<!-- Hero start -->
			<div class="hero-digital">
				<span class="hero-digital__circle-shape"></span>
				<div class="container container-fitness pb-150">
					<div class="row">
						<div class="col-12">
							<div class="hero-digital__header">
								<?php if (!empty($settings['banner_title'])): ?>
								<h1 class="h1 hero-digital__title">
								<span class="word word-animation wpr-el-subtitle"><?php echo tp_kses($settings['banner_subtitle']); ?></span>
								<br />
								<span class="word word-animation wpr-el-title"><?php echo tp_kses($settings['banner_title']); ?></span>
								</h1>
								<?php endif; ?>

								<?php if (!empty($settings['banner_link_text'])): ?>
								<a <?php echo tp_implode_html_attributes($links_attrs) ?> class="hero-digital__btn-wrapper btn-hover btn-item d-none d-lg-block fade_up_anim wpr-el-btn" data-delay=".2">
									<span></span>
									<p class="hero-digital__btn-text">
									<?php echo tp_kses($settings['banner_link_text']); ?>
									</p>
								</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="row g-4 hero-digital__content-container">
						<div
							class="col-sm-12 col-md-4 col-xl-5 d-none d-md-inline-block"
							>
							<a
								href="#about-digital"
								class="hero-digital__section-jump section-link"
								>
								<img src="<?php echo esc_url($img['banner_image']); ?>" alt="<?php echo esc_attr($img['banner_image_alt']); ?>">
							</a>
						</div>
						<div class="col-sm-12 col-md-8 col-xl-7">
							<div class="hero-digital__content">
								<?php if (!empty($settings['banner_years'])): ?>
								<span
									class="hero-digital__content-stablish-info fade_up_anim"
									data-delay=".4"
									>
									<?php echo tp_kses($settings['banner_years']); ?>
								</span>
								<?php endif; ?>

								<?php if (!empty($settings['banner_description'])): ?>
								<p
									class="hero-digital__content-info fade_up_anim wpr-el-desc"
									data-delay=".8"
									>
									<?php echo tp_kses($settings['banner_description']); ?>
								</p>
								<?php endif; ?>
							</div>
						</div>
						<?php if (!empty($settings['banner_link_text'])): ?>
						<div class="col-12 btn-item d-lg-none">
							<a
								<?php echo tp_implode_html_attributes($links_attrs) ?>
								class="hero-digital__btn-wrapper btn-hover fade_up_anim"
								data-delay=".2"
								>
								<span></span>
								<p class="hero-digital__btn-text">
									<?php echo tp_kses($settings['banner_link_text']); ?>
								</p>
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- Hero End -->


<?php endif;
	}
}

$widgets_manager->register(new WPR_Banner());
