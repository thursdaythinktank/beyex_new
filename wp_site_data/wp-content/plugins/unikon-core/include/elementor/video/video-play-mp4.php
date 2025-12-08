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

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Video_Play_Mp4 extends Widget_Base
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
		return 'wpr-video-play-mp4';
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
		return __(WPRCORE_THEME_NAME . ' - Video Play (MP4)', 'wprealizer');
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

		// Content
		$this->start_controls_section(
			'video_content',
			[
				'label' => esc_html__('Video Content', 'wprealizer'),
			]
		);

		$this->add_control(
			'wpr_video_url',
			[
				'label' => esc_html__('Video URL', 'wprealizer'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Url Here',
				'label_block' => true,
				'description' => __("We recommended to put 'mp4' format video.", 'wprealizer')
			]
		);

        $this->add_control(
            'wpr_tag_icon_type',
            [
                'label' => esc_html__('Vedio Icon Type', 'wprealizer'),
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
                'condition' => [
                    'wpr_design_style' => ['layout-2', 'layout-3', 'layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'wpr_tag_icon_type' => 'image',
                    'wpr_design_style' => ['layout-2', 'layout-3', 'layout-4', 'layout-5']
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'solid',

                ],
                'condition' => [
                    'wpr_tag_icon_type' => 'icon',
                ]
            ]
        );

        $this->add_control(
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
                    'wpr_tag_icon_type' => 'svg',
                ],
            ]
        );

		$this->add_control(
			'video_text',
			[
				'label' => esc_html__('Video Title', 'wprealizer'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Video Text', 'wprealizer'),
				'label_block' => true,
				'placeholder' => esc_html__('Video Text', 'wprealizer'),
				'condition' => [
					'wpr_design_style' => 'layout-10'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function style_tab_content()
	{
		$this->tp_section_style_controls('section', 'Section - Style', '.wpr-el-section');

		$this->start_controls_section(
			'wpr_v_p_btn_section',
			[
				'label' => esc_html__('Play Button', 'textdomain'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'wpr_design_style' => ['layout-2', 'layout-3', 'layout-4']
				]
			]
		);

		$this->add_control(
			'wpr_v_p_btn_icon_color',
			[
				'label'       => esc_html__('Icon Color', 'textdomain'),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr_v_p_btn svg' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wpr_v_p_btn_icon_w',
			[
				'label' => esc_html__('Icon width', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px',],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpr_v_p_btn svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpr_v_p_btn_icon_h',
			[
				'label' => esc_html__('Icon Height', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px',],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpr_v_p_btn svg' => 'Height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// bg color tab 

		$this->start_controls_tabs(
			'wpr_v_p_btn_icon_bg_color_tabs',
		);

		$this->start_controls_tab(
			'wpr_v_p_btn_icon_bg_color_normal_tab',
			[
				'label'   => esc_html__('Normal', 'textdomain'),
			]
		);
		$this->add_control(
			'wpr_v_p_btn_icon_bg_color',
			[
				'label'       => esc_html__('Background Color', 'textdomain'),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr_v_p_btn' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		// hover color 
		$this->start_controls_tab(
			'wpr_v_p_btn_icon_bg_color_hover_tab',
			[
				'label'   => esc_html__('Hover', 'textdomain'),
			]
		);
		$this->add_control(
			'wpr_v_p_btn_icon_bg_color_hover',
			[
				'label'       => esc_html__('Background Color', 'textdomain'),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr_v_p_btn:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'wpr_v_p_btn_icon_margin',
			[
				'label'      => esc_html__('Icon margin', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .wpr_v_p_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'wpr_v_p_btn_text_typo',
				'label'   => esc_html__('Button Typography', 'textdomain'),
				'selector' => '{{WRAPPER}} .wpr_v_p_btn_text',
			]
		);

		$this->add_control(
			'wpr_v_p_btn_text_color',
			[
				'label'       => esc_html__('Text Color', 'textdomain'),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr_v_p_btn_text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

        // image 
        $this->start_controls_section(
            'wpr_video_image_tab',
            [
                'label' => esc_html__('Image Style', 'wprealizer'),
				'condition' => [
					'wpr_design_style' => ['layout-2', 'layout-3', 'layout-4']
				]
            ]
        );

        $this->add_control(
            'wpr_video_image_w',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Width', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-video-img img' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wpr_video_image_h',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Image Height', 'wprealizer'),
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-video-img img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpr-el-video-img img' => 'object-fit: {{VALUE}};',
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

			<?php if (!empty($settings['wpr_video_url'])): ?>
				<div class="about-ca__video wpr-el-section wpr-el-video-img">
                    <?php if ($settings['wpr_tag_icon_type'] === 'image' && ($settings['image']['url'] || $settings['image']['id'])):
                        $this->get_render_attribute_string('image');
                        $settings['hover_animation'] = 'disable-animation';
                    ?>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
                    <?php elseif (!empty($settings['icon'])): ?>
                        <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                    <?php elseif (!empty($settings['svg'])): ?>
                        <?php echo $settings['svg']; ?>
                    <?php endif; ?>

					<a class="popup-youtube wpr_v_p_btn" href="<?php echo esc_url($settings['wpr_video_url']); ?>">
						<i class="fa-solid fa-play"></i>
					</a>
				</div>
			<?php endif; ?>

		<?php elseif ($settings['wpr_design_style'] == 'layout-3') : ?>

		<!-- Video Start  -->
		<div class="video-la__area wpr-el-section">
			<div class="video-la__video wpr-el-video-img">
                <?php if ($settings['wpr_tag_icon_type'] === 'image' && ($settings['image']['url'] || $settings['image']['id'])):
                    $this->get_render_attribute_string('image');
                    $settings['hover_animation'] = 'disable-animation';
                ?>
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
                <?php elseif (!empty($settings['icon'])): ?>
                    <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                <?php elseif (!empty($settings['svg'])): ?>
                    <?php echo $settings['svg']; ?>
                <?php endif; ?>

				<a class="popup-youtube wpr_v_p_btn"
					href="<?php echo esc_url($settings['wpr_video_url']); ?>">
					<i class="fa-solid fa-play"></i>
					<span class="pluse"></span>
				</a>
			</div>
		</div>
		<!-- Video End  -->

		<?php elseif ($settings['wpr_design_style'] == 'layout-4') : ?>

		<div class="choose-us-fin__video wpr-el-section">
			<div class="video wpr-el-video-img">
		        <?php if ($settings['wpr_tag_icon_type'] === 'image' && ($settings['image']['url'] || $settings['image']['id'])):
		            $this->get_render_attribute_string('image');
		            $settings['hover_animation'] = 'disable-animation';
		        ?>
		            <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
		        <?php elseif (!empty($settings['icon'])): ?>
		            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
		        <?php elseif (!empty($settings['svg'])): ?>
		            <?php echo $settings['svg']; ?>
		        <?php endif; ?>

				<?php if (!empty($settings['wpr_video_url'])): ?>
				<a class="popup-youtube wpr_v_p_btn"
					href="<?php echo esc_url($settings['wpr_video_url']); ?>">
					<i class="fa-solid fa-play"></i>
				</a>
				<?php endif; ?>
			</div>
		</div>

		<?php elseif ($settings['wpr_design_style'] == 'layout-5') : ?>

		<div class="hero-health__video-thumb-wrapper">
	        <?php if ($settings['wpr_tag_icon_type'] === 'image' && ($settings['image']['url'] || $settings['image']['id'])):
	            $this->get_render_attribute_string('image');
	            $settings['hover_animation'] = 'disable-animation';
	        ?>
	            <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'image'); ?>
	        <?php elseif (!empty($settings['icon'])): ?>
	            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
	        <?php elseif (!empty($settings['svg'])): ?>
	            <?php echo $settings['svg']; ?>
	        <?php endif; ?>

			<a class="popup-youtube" href="<?php echo esc_url($settings['wpr_video_url']); ?>">
				<i class="fa-solid fa-play"></i>
			</a>
		</div>

		<?php else: ?>

		<?php if (!empty($settings['wpr_video_url'])): ?>
		<div class="video-mar__area hero-digital__video-area wpr-el-section">
			<div class="video-wrapper">
				<video src="<?php echo esc_url($settings['wpr_video_url']); ?>" autoplay=""	muted="" loop="">		
				</video>
			</div>
		</div>
		<?php endif; ?>

<?php endif;
	}
}

$widgets_manager->register(new WPR_Video_Play_Mp4());
