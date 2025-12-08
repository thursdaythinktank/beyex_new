<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Product extends Widget_Base
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
		return 'tp-product';
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
		return __(WPRCORE_THEME_NAME . ' :: Product', 'wprealizer');
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

		$this->wpr_design_layout('Select Layout', 1);

		$this->tp_query_controls('product', 'Product', 'product', 'product_cat');

		//$this->tp_columns('product_col', ['layout-1'], 'Select Column');

		// section column
		$this->tp_columns('col', ['layout-1']);
	}

	// style_tab_content
	protected function style_tab_content()
	{
		$this->tp_basic_style_controls('ad_t_meta_subtitle', 'Meta Subtitle', '.tp-el-meta');
		$this->tp_basic_style_controls('ad_t_title', 'Title', '.tp-el-title');
		$this->tp_basic_style_controls('ad_t_p_price', 'Old price', '.tp-el-price .price del span, .tp-el-price .price del');
		$this->tp_basic_style_controls('ad_t_n_price', 'New price', '.tp-el-price .price ins span');
		$this->tp_link_controls_style('', 'ad_t_n_percentage', 'Percentage', '.tp-el-percentage span');
		$this->tp_link_controls_style('', 'ad_t_btn', 'Button', '.tp-el-btn');
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

		<?php if ($settings['wpr_design_style'] == 'layout-2'): ?>

		<?php else:

			$args = tp_query_args('product', 'product_cat', $settings);
			$query = new \WP_Query($args);
		?>

			<div class="tp-shop-right">
				<div class="row">
					<?php

					if ($query->have_posts()):
						while ($query->have_posts()):
							$query->the_post();
							global $product;
							$product = wc_get_product();
							$terms = get_the_terms(get_the_ID(), 'product_cat');
					?>
							<div class="<?php echo esc_attr($this->col_show($settings)); ?>">
								<div class="tp-shop-product-item text-center mb-50">

									<?php if (has_post_thumbnail()): ?>
										<div class="tp-shop-product-thumb p-relative">
											<?php the_post_thumbnail('full', ['class' => 'w-100']); ?>

											<div class="tp-shop-product-thumb-btn">
												<?php do_action('woocommerce_before_add_to_cart_button'); ?>

												<?php $view_details_text = __('View Details', 'wprealizer'); ?>

												<a class="tp-el-btn" href="<?php the_permalink(); ?>" class="button">
													<?php echo esc_html($view_details_text); ?>
												</a>
											</div>

											<div class="tp-shop-product-thumb-tag tp-el-percentage">
												<?php echo wprealizer_sale_percentage(); ?>
											</div>
										</div>
									<?php endif; ?>

									<div class="tp-shop-product-content">
										<div class="tp-shop-product-tag">
											<?php foreach ($terms as $key => $term):
												$count = count($terms) - 1;

												$name = ($count > $key) ? $term->name . ', ' : $term->name
											?>
												<span class="tp-el-meta">
													<a href="<?php echo get_term_link($term->slug, 'product_cat'); ?> ">
														<?php echo esc_html($name); ?></a>
												</span>

											<?php endforeach; ?>
										</div>

										<h4 class="tp-shop-product-title tp-el-title">
											<a href="<?php the_permalink(); ?>">
												<?php echo wp_trim_words(get_the_title(), $settings['tp_post_title_word'], ''); ?>
											</a>
										</h4>

										<div class="tp-shop-product-price">
											<span class=" tp-el-price"><?php echo woocommerce_template_loop_price(); ?></span>
										</div>
									</div>

								</div>
							</div>

					<?php
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
<?php endif;
	}
}

$widgets_manager->register(new TP_Product());
