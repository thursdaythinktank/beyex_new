<?php 
Class TP_Services_List_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('tp-tp-services-list', 'Services List', array(
			'description'	=> 'WPR Services List'
		));
	}



	public function widget($args, $instance){
        
        $out_id = get_the_ID();

		extract($args);
	 	echo $before_widget; 
	 	if($instance['title']):
     	echo $before_title; ?> 
     	<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
     	<?php echo $after_title; ?>
     	<?php endif; ?>

            <div class="tp-service-details-box mb-50">
                <ul>
				    <?php 
					$q = new WP_Query( array(
					    'post_type'     => 'tp-services',
					    'posts_per_page'=> ($instance['count']) ? $instance['count'] : '3',
					    'order'			=> ($instance['posts_order']) ? $instance['posts_order'] : 'DESC'
					));

					if( $q->have_posts() ):
					while( $q->have_posts() ):$q->the_post();

                    $inner_id = get_the_ID();

                    $active_class = $out_id == $inner_id ? 'active' : NULL;

						?>
			            <li>
			                <a class="<?php echo esc_attr($active_class); ?>" href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
		                        <span>
                                    <i class="fa-solid fa-arrow-right"></i>
		                        </span>
			                </a>
			            </li>

						<?php 
						endwhile; wp_reset_query();           
					endif; 
					?> 
		        </ul>
		    </div>

		<?php echo $after_widget; ?>

		<?php
	}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'wprealizer' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'wprealizer' );
	?>	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
				<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
			</select>
		</p>

	<?php }


}




add_action('widgets_init', function(){
	register_widget('TP_Services_List_Widget');
});