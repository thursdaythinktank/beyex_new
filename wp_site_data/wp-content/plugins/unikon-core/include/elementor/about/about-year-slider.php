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
class TP_About_Year_Slider extends Widget_Base
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
		return 'tp-about-year-title';
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
		return __(WPRCORE_THEME_NAME . ' :: About Year Slider', 'wprealizer');
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

		// year item section
		$this->start_controls_section(
			'tp_about_year_slider_section',
			[
				'label' => __('Year  Slider', 'wprealizer'),
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
				],
				'default' => 'style_1',
				'frontend_available' => true,
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'tp_about_year_slider_year',
			[
				'label' => esc_html__('Year', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('1999', 'wprealizer'),
				'label_block' => false,
			]
		);

		$repeater->add_control(
			'tp_about_year_slider_title',
			[
				'label' => esc_html__('Title', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title here', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_about_year_slider_desc',
			[
				'label' => esc_html__('Description', 'wprealizer'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Etiam quis sapien in orci feugiat suscipit quis eget risus. Morbi in dapibus magna, et congue tortor. Students loved the system, but the teachers struggled to manage the paperwork and manual tracking.', 'wprealizer'),
				'description' => tp_get_allowed_html_desc('intermediate'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tp_about_year_slider_image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => __('Slider Image', 'wprealizer'),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'tp_about_year_slider_slides',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_about_year_slider_year' => __('1996', 'wprealizer')
					],
					[
						'tp_about_year_slider_year' => __('2001', 'wprealizer')
					],
				],
				'title_field' => '{{{ tp_about_year_slider_year }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'about-year-slider-image-size',
				'default' => 'full',
				'separator' => 'before',
				'exclude' => [
					'custom'
				]
			]
		);

		$this->end_controls_section();

		// year shape 
		$this->start_controls_section(
			'tp_about_year_slider_shape',
			[
				'label' => __('Shape', 'wprealizer'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'tp_about_year_slider_image_shape_switcher',
			[
				'label' => esc_html__('Image shape', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'wprealizer'),
				'label_off' => esc_html__('No', 'wprealizer'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
		$this->tp_basic_style_controls('about_year_slider_title', 'Slider - Title', '.tp-el-slider-title');
		$this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title');
		$this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-content', 'layout-1');
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
			$image_shape = $settings['tp_about_year_slider_image_shape_switcher'];
		?>

			<section class="tp-about-year-area p-relative tp-el-section">
				<div class="tp-about-year-shape">
					<?php if ('yes' == $image_shape): ?>
						<div class="shape-2">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/our-mission/thumb-2-shape.jpg" alt="">
						</div>
					<?php endif; ?>
				</div>
				<div class="tp-about-year-plr tp-about-year-nav">
					<div class="slider slider-nav">
						<?php foreach ($settings['tp_about_year_slider_slides'] as $key => $item):
							$year = $item['tp_about_year_slider_year'];
						?>
							<div>
								<?php if (!empty($year)): ?>
									<h3 class="tp-about-year-nav-title tp-el-slider-title"><?php echo esc_html($year); ?></h3>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="tp-about-year-box">
					<div class="container">
						<div class="row align-items-center">
							<div class="slider slider-for">
								<?php foreach ($settings['tp_about_year_slider_slides'] as $key => $item):
									if (!empty($item['tp_about_year_slider_image']['url'])) {
										$tp_image_url = !empty($item['tp_about_year_slider_image']['id']) ? wp_get_attachment_image_url($item['tp_about_year_slider_image']['id'], $settings['about-year-slider-image-size_size']) : $item['tp_about_year_slider_image']['url'];
										$tp_image_alt = get_post_meta($item["tp_about_year_slider_image"]["id"], "_wp_attachment_image_alt", true);
									}

									$title = $item['tp_about_year_slider_title'];
									$description = $item['tp_about_year_slider_desc'];

								?>
									<div class="tp-about-year-inner">
										<div class="row align-items-center">
											<div class="col-lg-6">
												<?php if (!empty($tp_image_url)): ?>
													<div class="tp-about-year-thumb">
														<img src="<?php echo esc_url($tp_image_url); ?>"
															alt="<?php echo esc_attr($tp_image_alt); ?>">
													</div>
												<?php endif; ?>
											</div>
											<div class="col-lg-6">
												<div class="tp-about-year-content">
													<?php if (!empty($title)): ?>
														<h4 class="tp-about-year-content-title tp-el-title">
															<?php echo tp_kses($title); ?>
														</h4>
													<?php endif; ?>

													<?php if (!empty($description)): ?>
														<p class="tp-el-content">
															<?php echo tp_kses($description); ?>
														</p>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php endif;
	}
}

$widgets_manager->register(new TP_About_Year_Slider());
