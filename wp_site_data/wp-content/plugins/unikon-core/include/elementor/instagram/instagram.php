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
class TP_Instagram extends Widget_Base
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
		return 'tp-instagram';
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
		return __(WPRCORE_THEME_NAME . ' :: Instagram', 'wprealizer');
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

		$this->start_controls_section(
			'tp_instagram_sec',
			[
				'label' => esc_html__('Instagram Controls', 'wprealizer'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tp_instagam_image',
			[
				'label' => esc_html__('Thumbnail', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'tp_tag_icon_type',
			[
				'label' => esc_html__('Instagram Icon Type', 'wprealizer'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'icon' => [
						'title' => esc_html__('Icon', 'wprealizer'),
						'icon' => 'eicon-nerd-wink',
					],
					'image' => [
						'title' => esc_html__('Image', 'wprealizer'),
						'icon' => 'fa fa-image',
					],
					'svg' => [
						'title' => esc_html__('Svg', 'wprealizer'),
						'icon' => 'fas fa-code',
					],
				],
				'default' => 'icon',
				'toggle' => false,
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Image', 'wprealizer'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_tag_icon_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'wprealizer'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',

				],
				'condition' => [
					'tp_tag_icon_type' => 'icon',
				]
			]
		);

		$repeater->add_control(
			'svg',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'label' => __('Svg Code', 'wprealizer'),
				'default' => __('Svg Code Here', 'wprealizer'),
				'placeholder' => __('Type Svg Code here', 'wprealizer'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'tp_tag_icon_type' => 'svg',
				],
			]
		);

		$this->add_control(
			'tp_instagam_list',
			[
				'label' => esc_html__('Image List', 'wprealizer'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tp_instagam_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'tp_instagam_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				],
				'dynamic' => [
					'active' => true,
				],

			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'tp_image_size',
				'default' => 'full',
				'separator' => 'before',
				'exclude' => [
					'custom'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
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

		<?php else: ?>
			<div class="swiper tp-instagram-active">
				<div class="swiper-wrapper wow fadeInUp" data-wow-delay=".2s">

					<?php foreach ($settings['tp_instagam_list'] as $key => $item):

						$img = tp_get_img($item, 'tp_instagam_image', 'tp_image_size', false);
					?>
						<div class="swiper-slide tp-instagram-item">
							<?php if (!empty($item['tp_instagam_image']['url'])): ?>
								<a class="popup-image" href="<?php echo esc_url($item['tp_instagam_image']['url']); ?>">
									<img src="<?php echo esc_url($img['tp_instagam_image']); ?>"
										alt="<?php echo esc_attr($img['tp_instagam_image_alt']); ?>">
								</a>
							<?php endif; ?>

							<div class="tp-instagram-shape">
								<?php if ($item['tp_tag_icon_type'] === 'image' && ($item['image']['url'] || $item['image']['id'])):
									$this->get_render_attribute_string('image');
									$item['hover_animation'] = 'disable-animation';
								?>
									<?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'image'); ?>
								<?php elseif (!empty($item['icon'])): ?>
									<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
								<?php elseif (!empty($item['svg'])): ?>
									<?php echo $item['svg']; ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

<?php endif;
	}
}

$widgets_manager->register(new TP_Instagram());
