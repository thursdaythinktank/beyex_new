<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package unikon
 */

get_header();

$unikon_404_thumb = get_theme_mod('unikon_error_thumb', get_template_directory_uri() . '/assets/img/error/error.png');
$unikon_error_title = get_theme_mod('unikon_error_title', __('Oops!', 'unikon'));
$unikon_error_title_sm = get_theme_mod('unikon_error_title_sm', __('Something went Wrong...', 'unikon'));
$unikon_error_link_text = get_theme_mod('unikon_error_link_text', __('Back To Home', 'unikon'));
$unikon_error_desc = get_theme_mod('unikon_error_desc', __('Sorry, we couldn\'t find your page.', 'unikon'));

?>



<!-- error area start -->
<div class="wpr-error-area pt-120 pb-120">
   <div class="container">
      <div class="row">
         <div class="col-xl-12">
            <div class="wpr-error-wrapper text-center">

               <?php if (!empty($unikon_error_title)) : ?>
                  <h3 class="wpr-error-title"><?php print esc_html($unikon_error_title); ?></h3>
               <?php endif; ?>

               <?php if (!empty($unikon_404_thumb)) : ?>
                  <img src="<?php echo esc_url($unikon_404_thumb); ?>" alt="<?php print esc_attr__('Error 404', 'unikon'); ?>">
               <?php endif; ?>

               <div class="wpr-error-content mt-50">

                  <?php if (!empty($unikon_error_title_sm)) : ?>
                     <h4 class="wpr-error-title-sm"><?php print esc_html($unikon_error_title_sm); ?></h4>
                  <?php endif; ?>

                  <?php if (!empty($unikon_error_desc)) : ?>
                     <p><?php print esc_html($unikon_error_desc); ?></p>
                  <?php endif; ?>

                  <?php if (!empty($unikon_error_link_text)) : ?>
                     <a href="<?php print esc_url(home_url('/')); ?>" class="common-btn mt-20 square-btn"><?php print esc_html($unikon_error_link_text); ?></a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- error area end -->


<?php
get_footer();
