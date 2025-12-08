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
add_action('widgets_init', 'Deigo_Contact_Widget');
function Deigo_Contact_Widget()
{
	register_widget('Deigo_Contact_Widget');
}


class Deigo_Contact_Widget  extends WP_Widget
{

	public function __construct()
	{
		parent::__construct('Deigo_Contact_Widget', esc_html__('Diego :: Contact (footer)', 'wprealizer'), array(
			'description' => esc_html__('Diego Contact Widget For Footer', 'wprealizer'),
		));
	}

	public function widget($args, $instance)
	{
		extract($args);
		extract($instance);

		print $before_widget;

		$mail_text = isset($instance['mail_text']) ? $instance['mail_text'] : '';
		$mail_link = isset($instance['mail_link']) ? $instance['mail_link'] : '';

		$phone_text = isset($instance['phone_text']) ? $instance['phone_text'] : '';
		$phone_link = isset($instance['phone_link']) ? $instance['phone_link'] : '';

		$title = isset($instance['title']) ? $instance['title'] : '';
?>

		<?php if (!empty($title)):
			echo $before_title; ?>
			<?php echo apply_filters('widget_title', $title); ?>
			<?php echo $after_title; ?>
		<?php endif; ?>

		<?php if (!empty($mail_text)) : ?>
			<div class="wpr-footer-4__widget-mail">
				<?php if (!empty($mail_link)) : ?>
					<span>
						<a href="<?php echo esc_url($mail_link); ?>"><?php echo tp_kses($mail_text); ?></a>
					</span>
				<?php else: ?>
					<span>
						<?php echo tp_kses($mail_text); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($phone_text)) : ?>
			<div class="wpr-footer-4__widget-tel">
				<?php if (!empty($phone_link)) : ?>
					<span>
						<a href="<?php echo esc_url($phone_link); ?>"><?php echo tp_kses($phone_text); ?></a>
					</span>
				<?php else: ?>
					<span>
						<?php echo tp_kses($phone_text); ?>
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
		$mail_link = isset($instance['mail_link']) ? $instance['mail_link'] : '';
		$mail_text = isset($instance['mail_text']) ? $instance['mail_text'] : '';
		$phone_link = isset($instance['phone_link']) ? $instance['phone_link'] : '';
		$phone_text = isset($instance['phone_text']) ? $instance['phone_text'] : '';

	?>


		<h3><?php esc_html_e('Contact Information :', 'wprealizer'); ?></h3>
		<hr>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
		</p>

		<!-- Email Text -->
		<p><label for="mail_text"><?php esc_html_e('Mail Text', 'wprealizer'); ?></label></p>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('mail_text')); ?>"
			name="<?php echo esc_attr($this->get_field_name('mail_text')); ?>" value="<?php echo esc_attr($mail_text); ?>"
			style="margin-bottom: 10px;">

		<!-- Email Link -->
		<p><label for="mail_link"><?php esc_html_e('Mail Link', 'wprealizer'); ?></label></p>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('mail_link')); ?>"
			name="<?php echo esc_attr($this->get_field_name('mail_link')); ?>" value="<?php echo esc_attr($mail_link); ?>"
			style="margin-bottom: 10px;">


		<!-- Phone Text -->
		<p><label for="phone_text"><?php esc_html_e('Phone Text', 'wprealizer'); ?></label></p>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_text')); ?>"
			name="<?php echo esc_attr($this->get_field_name('phone_text')); ?>" value="<?php echo esc_attr($phone_text); ?>"
			style="margin-bottom: 10px;">

		<!-- Phone link -->
		<p><label for="phone_link"><?php esc_html_e('Phone Link', 'wprealizer'); ?></label></p>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_link')); ?>"
			name="<?php echo esc_attr($this->get_field_name('phone_link')); ?>" value="<?php echo esc_attr($phone_link); ?>"
			style="margin-bottom: 10px;">


<?php
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

		$instance['mail_text'] = (! empty($new_instance['mail_text'])) ? strip_tags($new_instance['mail_text']) : '';
		$instance['mail_link'] = (! empty($new_instance['mail_link'])) ? strip_tags($new_instance['mail_link']) : '';

		$instance['phone_text'] = (! empty($new_instance['phone_text'])) ? strip_tags($new_instance['phone_text']) : '';
		$instance['phone_link'] = (! empty($new_instance['phone_link'])) ? strip_tags($new_instance['phone_link']) : '';

		return $instance;
	}
}
