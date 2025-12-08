<?php

/**
 * WPRCore Sidebar Posts Image
 *
 *
 * @author 		WPRealizer
 * @category 	Widgets
 * @package 	WPRCore/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 */

class TP_Post_Sidebar_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct('tp-latest-posts', 'WPR :: Blog Sidebar Post', array(
			'description' => 'Latest Blog Post Widget by Theme_Pure'
		));
	}


	public function widget($args, $instance)
	{
		extract($args);
		extract($instance);

		echo $before_widget;
?>

		<?php
		if ($instance['title']):
			echo $before_title; ?>
			<?php echo apply_filters('widget_title', $instance['title']); ?>
			<?php echo $after_title; ?>
		<?php endif; ?>

		<div class="widget__latestPost">
			<ul class="custom-ul post__list">

				<?php
				$q = new WP_Query(array(
					'post_type' => 'post',
					'posts_per_page' => ($instance['count']) ? $instance['count'] : '3',
					'order' => ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
					'orderby' => 'date'
				));

				if ($q->have_posts()):
					while ($q->have_posts()):
						$q->the_post();

						$categories = get_the_terms($q->ID, 'category');
				?>

						<li>
							<div class="post__wrapper">
								<?php if (has_post_thumbnail()) : ?>
									<div class="post__thumb">
										<a href="<?php the_permalink() ?>" class="d-block">
											<img src="<?php the_post_thumbnail_url('thumbnail') ?>" alt="<?php the_title() ?>">
										</a>
									</div>
								<?php endif; ?>
								<div class="post__content">
									<h5 class="h5 post__title">
										<a href="<?php the_permalink(); ?>"><?php print wp_trim_words(get_the_title(), 8, ''); ?></a>
									</h5>

									<div class="post__meta">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="20"
											height="20"
											viewBox="0 0 20 20"
											fill="none">
											<path
												d="M15.0002 3.33301H13.7502V2.49967C13.7502 2.26967 13.5635 2.08301 13.3335 2.08301C13.1035 2.08301 12.9168 2.26967 12.9168 2.49967V3.33301H7.0835V2.49967C7.0835 2.26967 6.89683 2.08301 6.66683 2.08301C6.43683 2.08301 6.25016 2.26967 6.25016 2.49967V3.33301H5.00016C3.09183 3.33301 2.0835 4.34134 2.0835 6.24967V14.9997C2.0835 16.908 3.09183 17.9163 5.00016 17.9163H15.0002C16.9085 17.9163 17.9168 16.908 17.9168 14.9997V6.24967C17.9168 4.34134 16.9085 3.33301 15.0002 3.33301ZM5.00016 4.16634H6.25016V4.99967C6.25016 5.22967 6.43683 5.41634 6.66683 5.41634C6.89683 5.41634 7.0835 5.22967 7.0835 4.99967V4.16634H12.9168V4.99967C12.9168 5.22967 13.1035 5.41634 13.3335 5.41634C13.5635 5.41634 13.7502 5.22967 13.7502 4.99967V4.16634H15.0002C16.441 4.16634 17.0835 4.80884 17.0835 6.24967V7.08301H2.91683V6.24967C2.91683 4.80884 3.55933 4.16634 5.00016 4.16634ZM15.0002 17.083H5.00016C3.55933 17.083 2.91683 16.4405 2.91683 14.9997V7.91634H17.0835V14.9997C17.0835 16.4405 16.441 17.083 15.0002 17.083ZM7.29183 10.833C7.29183 11.1788 7.01342 11.458 6.67008 11.458C6.32758 11.458 6.04183 11.1788 6.04183 10.833C6.04183 10.4872 6.31434 10.208 6.65767 10.208H6.67008C7.01342 10.208 7.29183 10.4872 7.29183 10.833ZM10.6252 10.833C10.6252 11.1788 10.3468 11.458 10.0034 11.458C9.66092 11.458 9.37516 11.1788 9.37516 10.833C9.37516 10.4872 9.64767 10.208 9.99101 10.208H10.0034C10.3468 10.208 10.6252 10.4872 10.6252 10.833ZM13.9585 10.833C13.9585 11.1788 13.6801 11.458 13.3368 11.458C12.9943 11.458 12.7085 11.1788 12.7085 10.833C12.7085 10.4872 12.981 10.208 13.3243 10.208H13.3368C13.6801 10.208 13.9585 10.4872 13.9585 10.833ZM7.29183 14.1663C7.29183 14.5122 7.01342 14.7913 6.67008 14.7913C6.32758 14.7913 6.04183 14.5122 6.04183 14.1663C6.04183 13.8205 6.31434 13.5413 6.65767 13.5413H6.67008C7.01342 13.5413 7.29183 13.8205 7.29183 14.1663ZM10.6252 14.1663C10.6252 14.5122 10.3468 14.7913 10.0034 14.7913C9.66092 14.7913 9.37516 14.5122 9.37516 14.1663C9.37516 13.8205 9.64767 13.5413 9.99101 13.5413H10.0034C10.3468 13.5413 10.6252 13.8205 10.6252 14.1663ZM13.9585 14.1663C13.9585 14.5122 13.6801 14.7913 13.3368 14.7913C12.9943 14.7913 12.7085 14.5122 12.7085 14.1663C12.7085 13.8205 12.981 13.5413 13.3243 13.5413H13.3368C13.6801 13.5413 13.9585 13.8205 13.9585 14.1663Z"
												fill="currentColor" />
										</svg>
										<p class="post__date"><?php the_time('d. M, Y'); ?></p>
									</div>
								</div>
							</div>
						</li>

				<?php endwhile;
					wp_reset_query();
				endif; ?>
			</ul>
		</div>
		<!-- latest post end -->

		<?php echo $after_widget; ?>

	<?php
	}



	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$count = !empty($instance['count']) ? $instance['count'] : esc_html__('3', 'wprealizer');
		$posts_order = !empty($instance['posts_order']) ? $instance['posts_order'] : esc_html__('DESC', 'wprealizer');
		$choose_style = !empty($instance['choose_style']) ? $instance['choose_style'] : esc_html__('style_1', 'wprealizer');
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"
				id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>"
				id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($count); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>"
				id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if ($posts_order === 'ASC') {
										echo 'selected="selected"';
									} ?>>ASC</option>
				<option value="DESC" <?php if ($posts_order === 'DESC') {
											echo 'selected="selected"';
										} ?>>DESC</option>
			</select>
		</p>

<?php }
}

add_action('widgets_init', function () {
	register_widget('TP_Post_Sidebar_Widget');
});
