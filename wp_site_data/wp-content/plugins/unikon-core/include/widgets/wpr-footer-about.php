<?php
use function WPRCore\Widgets\tp_kses;
	/**
	 * Ishpat Footer full Widget
	 *
	 *
	 * @author 		ThemePure
	 * @category 	Widgets
	 * @package 	Ishpat/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	 */
	add_action('widgets_init', 'Ishpat_About_Widget');
	function Ishpat_About_Widget() {
		register_widget('Ishpat_About_Widget');
	}
	
	
	class Ishpat_About_Widget  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('Ishpat_About_Widget',esc_html__('Ishpat :: About (footer)','wprealizer'),array(
				'description' => esc_html__('Ishpat About Widget For Footer','wprealizer'),
			));
		}
		
		public function widget($args, $instance){
			extract($args);
			extract($instance);

			print $before_widget; 
			?>


    <?php if( !empty($footer_logo) ): ?>
    <div class="wpr-footer-logo mb-40">
        <?php if(!empty($img_link)) : ?>
        <a href="<?php echo esc_url($img_link); ?>">
            <img src="<?php echo esc_url( $footer_logo ); ?>" height="auto" data-width="<?php echo esc_attr($logo_width); ?>"  alt="<?php echo esc_attr__('Ishpat Logo', 'wprealizer');?>">
        </a>
        <?php else : ?>
        <img src="<?php echo esc_url( $footer_logo ); ?>" height="auto" data-width="<?php echo esc_attr($logo_width); ?>" alt="<?php echo esc_attr__('Ishpat Logo', 'wprealizer');?>">
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="wpr-footer-widget-content">
        <?php if(!empty($short_description)) : ?>
        <p><?php echo tp_kses($short_description); ?></p>
        <?php endif; ?>

        <div class="wpr-footer-widget-social">

            <?php if(!empty($facebook_link)) : ?>
            <a href="<?php echo esc_url($facebook_link); ?>"><i class="fab fa-facebook-f"></i></a>
            <?php endif; ?>
            <?php if(!empty($twitter_link)) : ?>
            <a href="<?php echo esc_url($twitter_link); ?>"><i class="fab fa-twitter"></i></a>
            <?php endif; ?>
            <?php if(!empty($instagram_link)) : ?>
            <a href="<?php echo esc_url($instagram_link); ?>"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>
            <?php if(!empty($tiktok_link)) : ?>
            <a href="<?php echo esc_url($tiktok_link); ?>"><i class="fa-brands fa-tiktok"></i></a>
            <?php endif; ?>
            <?php if(!empty($linkedin_link)) : ?>
            <a href="<?php echo esc_url($linkedin_link); ?>"><i class="fab fa-linkedin-in"></i></a>
            <?php endif; ?>
        </div>
    </div>




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
		public function form($instance){

			//Image
            if ( isset( $instance[ 'footer_logo' ] ) ) {
                $footer_logo = $instance[ 'footer_logo' ];
            }else {
                $footer_logo = '';
            }

			$short_description = isset($instance['short_description'])? $instance['short_description']:'';
			$img_link = isset($instance['img_link'])? $instance['img_link']:'';
			$logo_width = isset($instance['logo_width'])? $instance['logo_width']:'';
			$facebook_link = isset($instance['facebook_link'])? $instance['facebook_link']:'';
			$twitter_link = isset($instance['twitter_link'])? $instance['twitter_link']:'';
			$instagram_link = isset($instance['instagram_link'])? $instance['instagram_link']:'';
			$linkedin_link = isset($instance['linkedin_link'])? $instance['linkedin_link']:'';
			$youtube_link = isset($instance['youtube_link'])? $instance['youtube_link']:'';
			$tiktok_link = isset($instance['tiktok_link'])? $instance['tiktok_link']:'';

			?>

<p>
    <input value="<?php echo esc_attr( $footer_logo ); ?>"
        name="<?php echo $this->get_field_name( 'footer_logo' ); ?>" type="hidden" class="widefat img_val"
        type="text" />
    <img class="img_show" src="<?php echo esc_url( $footer_logo ); ?>" alt="">
</p>

<p>
    <button
        class="button about-up-btn"><?php ( empty( $footer_logo ) ) ?  esc_html_e( "Upload Image", "mechon" ) : esc_html_e( "Change Image", "mechon" ); ?></button>
</p>

<!-- img url -->
<p><label for="img_url"><?php esc_html_e('Logo Link', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('img_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('img_link')); ?>" value="<?php echo esc_attr($img_link); ?>">

<!-- Logo Width -->
<p><label for="logo_width"><?php esc_html_e('Logo Width', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_width')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_width')); ?>" value="<?php echo esc_attr($logo_width); ?>">

<!-- short description -->
<p><label for="short_description"><?php esc_html_e('Short Description:','wprealizer'); ?></p>
<textarea class="widefat" cols="15" rows="3" id="<?php echo esc_attr($this->get_field_id('short_description')); ?>"
    name="<?php echo esc_attr($this->get_field_name('short_description')); ?>"><?php print esc_attr($short_description); ?></textarea>

<h3><?php esc_html_e('Social Links :', 'wprealizer'); ?></h3>
<hr>

<!-- facebook -->
<p><label for="facebook_link"><?php esc_html_e('Facebook Link', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('facebook_link')); ?>" value="<?php echo esc_attr($facebook_link); ?>">
<!-- twitter -->
<p><label for="tw_link"><?php esc_html_e('Twitter Link', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('tw_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('twitter_link')); ?>" value="<?php echo esc_attr($twitter_link); ?>">
<!-- instagram -->
<p><label for="instagram_link"><?php esc_html_e('Instagram Link', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('instagram_link')); ?>" value="<?php echo esc_attr($instagram_link); ?>">
<!-- linkedin -->
<p><label for="linkedin_link"><?php esc_html_e('Linkedin Link', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('linkedin_link')); ?>" value="<?php echo esc_attr($linkedin_link); ?>">
<!-- youtube -->
<p><label for="youtube_link"><?php esc_html_e('Youtube Link', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('youtube_link')); ?>" value="<?php echo esc_attr($youtube_link); ?>"
    style="margin-bottom: 10px;">
<!-- Dribble -->
<p><label for="tiktok_link"><?php esc_html_e('Tiktok Link', 'wprealizer'); ?></label></p>
<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('tiktok_link')); ?>"
    name="<?php echo esc_attr($this->get_field_name('tiktok_link')); ?>" value="<?php echo esc_attr($tiktok_link); ?>"
    style="margin-bottom: 10px;">

<script>
    jQuery(function ($) {
        'use strict';
        /**
         *
         * About Widget About Us upload
         *
         */
        $(function () {
            $(".img_show").css({
                "margin": "0 auto",
                "display": "block",
                "max-width": "80%"
            });
            $(document).on('widget-updated', function (event, widget) {
                var widget_id = $(widget).attr('id');
                if (widget_id.indexOf('mechon_aboutus_widget') != -1) {
                    $imgval = $(".img_val").val();
                    $(".img_show").attr("src", $imgval);
                    $(".img_show").css({
                        "margin": "0 auto",
                        "display": "block",
                        "max-width": "80%"
                    });
                }
            });
            $("body").off("click", ".about-up-btn");
            $("body").on("click", ".about-up-btn", function (e) {

                let frame = wp.media({
                    title: 'Select or Upload Media About Us',
                    button: {
                        text: 'Use this About Us'
                    },
                    multiple: false
                });

                frame.on("select", function () {
                    // Get media attachment details from the frame state
                    let $img = frame.state().get('selection').first().toJSON();

                    $(".img_show").attr("src", $img.url);
                    $(".img_val").val($img.url);

                    $(".img_val").trigger('change');

                    $(".about-up-btn").text("Change Image");
                });

                // Open Media Modal
                frame.open();
                e.preventDefault();
            });
        });
    });
</script>

<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['footer_logo'] = ( ! empty( $new_instance['footer_logo'] ) ) ? strip_tags( $new_instance['footer_logo'] ) : '';
			$instance['short_description'] = ( ! empty( $new_instance['short_description'] ) ) ? strip_tags( $new_instance['short_description'] ) : '';
			$instance['img_link'] = ( ! empty( $new_instance['img_link'] ) ) ? strip_tags( $new_instance['img_link'] ) : '';
			$instance['logo_width'] = ( ! empty( $new_instance['logo_width'] ) ) ? strip_tags( $new_instance['logo_width'] ) : '';
			$instance['facebook_link'] = ( ! empty( $new_instance['facebook_link'] ) ) ? strip_tags( $new_instance['facebook_link'] ) : '';
			$instance['twitter_link'] = ( ! empty( $new_instance['twitter_link'] ) ) ? strip_tags( $new_instance['twitter_link'] ) : '';
			$instance['instagram_link'] = ( ! empty( $new_instance['instagram_link'] ) ) ? strip_tags( $new_instance['instagram_link'] ) : '';
			$instance['linkedin_link'] = ( ! empty( $new_instance['linkedin_link'] ) ) ? strip_tags( $new_instance['linkedin_link'] ) : '';
			$instance['youtube_link'] = ( ! empty( $new_instance['youtube_link'] ) ) ? strip_tags( $new_instance['youtube_link'] ) : '';
			$instance['tiktok_link'] = ( ! empty( $new_instance['tiktok_link'] ) ) ? strip_tags( $new_instance['tiktok_link'] ) : '';
			return $instance;
		}
	}