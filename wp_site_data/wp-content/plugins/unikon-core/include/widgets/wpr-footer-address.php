<?php

use function WPRCore\Widgets\tp_kses;

/**
 * Diego Footer full Widget
 *
 *
 * @author 		ThemePure
 * @category 	Widgets
 * @package 	Diego/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 */
add_action('widgets_init', 'Deigo_Address_Widget');
function Deigo_Address_Widget()
{
	register_widget('Deigo_Address_Widget');
}


class Deigo_Address_Widget  extends WP_Widget
{

	public function __construct()
	{
		parent::__construct('Deigo_Address_Widget', esc_html__('Diego :: Address (footer)', 'wprealizer'), array(
			'description' => esc_html__('Diego Address Widget For Footer', 'wprealizer'),
		));
	}

	public function widget($args, $instance)
	{
		extract($args);
		extract($instance);

		print $before_widget;

		$address_text = isset($instance['address_text']) ? $instance['address_text'] : '';
		$address_link = isset($instance['address_link']) ? $instance['address_link'] : '';
		$title = isset($instance['title']) ? $instance['title'] : '';
?>

		<?php if (!empty($title)):
			echo $before_title; ?>
			<?php echo apply_filters('widget_title', $title); ?>
			<?php echo $after_title; ?>
		<?php endif; ?>

		<?php if (!empty($address_text)) : ?>
			<div class="wpr-footer-4__widget-address">

				<?php if (!empty($address_link)) : ?>
					<a href="<?php echo esc_url($address_link); ?>" target="_blank"><?php echo html_entity_decode($address_text); ?></a>
				<?php else: ?>
					<span>
						<?php echo html_entity_decode($address_text); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>


		<?php print $after_widget; ?>

	<?php
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	public function form($instance)
	{
		$title = isset($instance['title']) ? $instance['title'] : '';

		$address_link = isset($instance['address_link']) ? $instance['address_link'] : '';
		$address_text = isset($instance['address_text']) ? htmlentities($instance['address_text']) : '';

	?>


		<h3><?php esc_html_e('Address Information :', 'wprealizer'); ?></h3>
		<hr>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
		</p>

		<!-- Address Text -->
		<p><label for="address_text"><?php esc_html_e('Address Text', 'wprealizer'); ?></label></p>

		<textarea class="widefat" cols="15" rows="3" id="<?php echo esc_attr($this->get_field_id('address_text')); ?>"
			name="<?php echo esc_attr($this->get_field_name('address_text')); ?>"><?php print html_entity_decode($address_text); ?></textarea>

		<!-- Address Link -->
		<p><label for="address_link"><?php esc_html_e('Address Link', 'wprealizer'); ?></label></p>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('address_link')); ?>"
			name="<?php echo esc_attr($this->get_field_name('address_link')); ?>" value="<?php echo wp_kses_post($address_link); ?>"
			style="margin-bottom: 10px;">



<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();

		$instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['address_text'] = (! empty($new_instance['address_text'])) ? htmlentities($new_instance['address_text']) : '';
		$instance['address_link'] = (! empty($new_instance['address_link'])) ? htmlentities($new_instance['address_link']) : '';


		return $instance;
	}
}
