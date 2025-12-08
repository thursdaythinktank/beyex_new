<?php

namespace WPRCore\Widgets;

if (!empty($settings['tp_offcanvas_logo']['url'])) {
   $tp_offcanvas_logo = !empty($settings['tp_offcanvas_logo']['id']) ? wp_get_attachment_image_url($settings['tp_offcanvas_logo']['id'], $offcanvas_image_size, true) : $settings['tp_offcanvas_logo']['url'];
   $tp_offcanvas_logo_alt = get_post_meta($settings["tp_offcanvas_logo"]["id"], "_wp_attachment_image_alt", true);
}
if (!empty($settings['tp_offcanvas_logo_white']['url'])) {
   $tp_offcanvas_logo_white = !empty($settings['tp_offcanvas_logo_white']['id']) ? wp_get_attachment_image_url($settings['tp_offcanvas_logo_white']['id'], $offcanvas_image_size, true) : $settings['tp_offcanvas_logo_white']['url'];
   $tp_offcanvas_logo_white_alt = get_post_meta($settings["tp_offcanvas_logo_white"]["id"], "_wp_attachment_image_alt", true);
}

?>

<!-- offcanvas area start -->
<div class="side-panel__overlay"></div>
<div class="side-panel">
   <div class="side-panel__closer">
      <i class="bi bi-x-lg"></i>
   </div>
   <div class="side-panel__content">
      <a href="<?php print esc_url(home_url('/')); ?>" class="logo d-flex justify-content-center">
         <img src="<?php echo esc_url($tp_offcanvas_logo); ?>"
            alt="<?php echo esc_url($tp_offcanvas_logo_alt); ?>">
      </a>
      <div class="custom-ul side-panel__contact">
         <?php echo \Elementor\Plugin::$instance->frontend->get_builder_content($settings['tp_offcanvas_template']); ?>
      </div>
   </div>
</div>
<!-- offcanvas area end -->