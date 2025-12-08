<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Blog_Hero extends Widget_Base
{

	use WPR_Style_Trait, WPR_Query_Trait, WPR_Column_Trait;

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
		return 'tp-blog-hero';
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
		return __(WPRCORE_THEME_NAME . ' :: Blog Hero', 'wprealizer');
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
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();

		// Query Panel
		$this->tp_query_controls('blog', 'Blog', 'post', 'category', 6, 10, 6, 0, 'date', 'desc', true, true, true, '');

		$this->tp_query_meta_controls('blog_grid_meta', 'Meta Controls', true, true, true, '');
	}

	// style_tab_content
	protected function style_tab_content() {}

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

			$query_args = tp_query_args('post', 'category', $this->get_settings());
			$the_query = new \WP_Query($query_args);
		?>

			<?php
			if ($the_query->have_posts()):
				while ($the_query->have_posts()):
					$the_query->the_post();
					$categories = get_the_category();
			?>
					<div class="tp-blog-stories-banner-wrap p-relative">
						<div class="tp-blog-stories-banner-thumb p-relative">
							<?php if (has_post_thumbnail()): ?>
								<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo esc_attr(the_title()); ?>">
							<?php endif; ?>
						</div>

						<div class="tp-blog-stories-banner-content">

							<?php if (!empty($settings['tp_post_category'])): ?>
								<?php if (!empty($categories[0]->name)): ?>
									<a class="tp-blog-stories-banner-sub"
										href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>">
										<?php echo esc_html($categories[0]->name); ?>
									</a>
								<?php endif; ?>
							<?php endif; ?>

							<h3 class="tp-blog-stories-banner-title">
								<a href="<?php the_permalink(); ?>">
									<?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
								</a>
							</h3>

							<div class="tp-blog-stories-banner-user d-flex align-items-center">
								<?php if (!empty($settings['tp_post_author'] == 'yes')): ?>
									<div class="tp-blog-stories-user-thumb">
										<img src="<?php print get_avatar_url(get_the_author_meta('ID')); ?>" alt="img-blog">
									</div>
								<?php endif; ?>
								<div class="tp-blog-stories-user-content">
									<?php if (!empty($settings['tp_post_author'] == 'yes')): ?>
										<h6>
											<?php print get_the_author(); ?>
										</h6>
									<?php endif; ?>

									<?php if ($settings['tp_post_date'] == 'yes'): ?>
										<?php if (!empty($settings['tp_post_date_format'])):
											$date_format = $settings['tp_post_date_format'] == 'default' ? get_option('date_format') : $settings['tp_post_date_format'];
											$date_format = $settings['tp_post_date_format'] == 'custom' ? $settings['tp_post_date_custom_format'] : $date_format;
										?>
											<span>
												<?php the_time($date_format); ?>
											</span>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>

						</div>
					</div>
			<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>

<?php endif;
	}
}

$widgets_manager->register(new TP_Blog_Hero());
