<?php

/**
 * Template part for displaying header side information
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */

$unikon_offcanvas_logo = get_theme_mod('unikon_offcanvas_logo', get_template_directory_uri() . '/assets/img/logo-light-large.svg');
$unikon_offcanvas_content_switch = get_theme_mod('unikon_offcanvas_content_switch', false);
$unikon_offcanvas_content = get_theme_mod('unikon_offcanvas_content', esc_html__('Discover, Explore & Understanding The Product Description Maecenas ullamcorper eros libero, facilities tempore mi darius vel. Sed ut felid ligula. Pellentesque.', 'unikon'));

$unikon_offcanvas_number_label = get_theme_mod('unikon_offcanvas_number_label', esc_html__('Contact Us 24/7', 'unikon'));
$unikon_offcanvas_number = get_theme_mod('unikon_offcanvas_number', esc_html__('+55(9900)66622', 'unikon'));

$unikon_offcanvas_email_label = get_theme_mod('unikon_offcanvas_email_label', esc_html__('Contact Mail', 'unikon'));
$unikon_offcanvas_email = get_theme_mod('unikon_offcanvas_email', esc_html__('info.unikon@demo.com', 'unikon'));

$unikon_offcanvas_location_label = get_theme_mod('unikon_offcanvas_location_label', esc_html__('Contact Location', 'unikon'));
$unikon_offcanvas_location = get_theme_mod('unikon_offcanvas_location', esc_html__('18/2, Topkhana Road, Australia.', 'unikon'));
$unikon_offcanvas_copyright = get_theme_mod('unikon_offcanvas_copyright', esc_html__('@Unikon.Copyright © 2024 ', 'unikon'));

?>


<!-- Menu Button Toggle start -->
<div class="side-panel__overlay"></div>
<div class="side-panel">
   <div class="side-panel__closer">
      <i class="bi bi-x-lg"></i>
   </div>
   <div class="side-panel__content">
      <?php if (!empty($unikon_offcanvas_logo)) : ?>
         <a href="<?php print esc_url(home_url('/')); ?>" class="logo d-flex justify-content-center unikon-offcanvas-logo">
            <img src="<?php echo esc_url($unikon_offcanvas_logo); ?>" alt="<?php echo esc_attr__('unikon Logo', 'unikon'); ?>">
         </a>
      <?php endif; ?>

      <div class="side-panel__mobile-menu"></div>

      <?php if (!empty($unikon_offcanvas_content)) : ?>
      <p><?php echo unikon_kses($unikon_offcanvas_content); ?></p>
      <?php endif; ?>
      <ul class="custom-ul side-panel__contact">
         <?php if (!empty($unikon_offcanvas_number)) : ?>
         <li>
            <div class="contact-thumb">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  version="1.1"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  width="80"
                  height="80"
                  x="0"
                  y="0"
                  viewBox="0 0 512 512"
                  style="enable-background: new 0 0 512 512"
                  xml:space="preserve"
                  class=""
                  >
                  <g
                     transform="matrix(0.5,0,0,0.5,128.00711631774902,127.99352844245732)"
                     >
                     <path
                        d="M134.037 377.963c71.241 71.243 155.541 119.531 231.326 132.521a50.033 50.033 0 0 0 12.748 1.507c23.139 0 57.092-12.253 103.081-37.131a49.854 49.854 0 0 0 24.567-29.714l3.741-11.813a50.688 50.688 0 0 0-15.685-54.692L436.362 329.7a51.192 51.192 0 0 0-64.082-2.1l-27.319 20.344a38.848 38.848 0 0 1-46.4.521q-.141-.1-.288-.192a428.061 428.061 0 0 1-134.549-134.546q-.091-.147-.192-.288a38.848 38.848 0 0 1 .521-46.4L184.4 139.72a51.191 51.191 0 0 0-2.1-64.082l-48.94-57.453A50.685 50.685 0 0 0 78.667 2.5L66.855 6.241A49.855 49.855 0 0 0 37.14 30.807C7.218 86.121-4.438 124.017 1.516 146.637c12.99 75.785 61.278 160.085 132.521 231.326zm245.41-40.735a39.251 39.251 0 0 1 49.134 1.608l57.453 48.94a38.865 38.865 0 0 1 12.027 41.933l-3.742 11.813a40.276 40.276 0 0 1-5.21 10.8 833.96 833.96 0 0 1-121.67-106.152zM70.479 17.681l11.812-3.742a40.372 40.372 0 0 1 12.2-1.911 38.836 38.836 0 0 1 29.734 13.938l48.939 57.453a39.251 39.251 0 0 1 1.608 49.134l-8.941 12.008A834.012 834.012 0 0 1 59.674 22.891a40.268 40.268 0 0 1 10.805-5.21zM47.694 36.517a43.333 43.333 0 0 1 3.28-5.171 845.633 845.633 0 0 0 107.64 122.905l-4.185 5.621a50.661 50.661 0 0 0-.784 60.37 440.161 440.161 0 0 0 138.113 138.113 50.663 50.663 0 0 0 60.37-.784l5.621-4.185a845.648 845.648 0 0 0 122.9 107.64 43.333 43.333 0 0 1-5.171 3.28c-51.977 28.117-88.067 39.736-107.266 34.52a5.748 5.748 0 0 0-.565-.124C214.845 472.676 39.324 297.155 13.3 144.348a5.748 5.748 0 0 0-.124-.565C7.962 124.584 19.577 88.5 47.694 36.517zm246.785 195.715a6 6 0 0 0 5.739 1.75l57.046-13.211c2.438.928 4.89 1.769 7.313 2.508A114.107 114.107 0 0 0 431.152 4.992 114.106 114.106 0 0 0 306.508 182.5l-13.383 43.883a6 6 0 0 0 1.354 5.849zM300.2 84.349A102.107 102.107 0 1 1 368.078 211.8a104.199 104.199 0 0 1-8.141-2.866 6 6 0 0 0-3.576-.272l-48.726 11.285 11.253-36.9a6 6 0 0 0-1.034-5.475A102.206 102.206 0 0 1 300.2 84.349zm37.788 30.551a6 6 0 0 1 6-6h84.687a6 6 0 0 1 0 12h-84.687a6 6 0 0 1-6-6zm0-36.126a6 6 0 0 1 6-6h118.1a6 6 0 0 1 0 12h-118.1a6 6 0 0 1-6-6.003zm0 70.349a6 6 0 0 1 6-6h70.863a6 6 0 0 1 0 12h-70.863a6 6 0 0 1-6-6.003z"
                        fill="currentColor"
                        opacity="1"
                        data-original="#000000"
                     ></path>
                  </g>
               </svg>
            </div>
            <div class="contact-content">
               <p><?php echo unikon_kses($unikon_offcanvas_number_label); ?></p>
               <a href="tel:<?php echo unikon_kses($unikon_offcanvas_number); ?>"><?php echo unikon_kses($unikon_offcanvas_number); ?></a>
            </div>
         </li>
         <?php endif; ?>

         <?php if (!empty($unikon_offcanvas_email)) : ?>
         <li>
            <div class="contact-thumb">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  version="1.1"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  width="80"
                  height="80"
                  x="0"
                  y="0"
                  viewBox="0 0 64 64"
                  style="enable-background: new 0 0 512 512"
                  xml:space="preserve"
                  class=""
                  >
                  <g
                     transform="matrix(0.5,0,0,0.5,15.999128341674805,16.000248432159424)"
                     >
                     <path
                        d="M61.956 18.093c-.013-.044-.043-.08-.062-.122-.033-.073-.057-.15-.11-.215-.006-.008-.016-.011-.022-.019-.006-.007-.007-.016-.013-.023-.031-.035-.076-.052-.111-.082-.064-.055-.125-.11-.199-.146-.046-.023-.096-.031-.146-.046a.961.961 0 0 0-.241-.052c-.018 0-.034-.011-.052-.011H21.187c-.038 0-.073.016-.11.02-.088.011-.176.02-.255.052-.036.014-.065.042-.1.061a.994.994 0 0 0-.215.146c-.008.008-.02.01-.028.019-.027.028-.037.063-.061.093a.964.964 0 0 0-.126.194c-.025.054-.038.109-.052.165-.011.043-.034.081-.04.127l-3.345 27.244v.01c-.015.132-.002.266.035.395.013.043.042.078.061.119.034.076.059.155.113.223.006.008.016.01.022.017.005.006.006.014.011.02.054.061.127.096.193.142.05.034.091.082.145.107.014.006.029.004.043.01a1 1 0 0 0 .371.083c.008 0 .016-.004.023-.004h39.757c.007 0 .013.004.02.004a.99.99 0 0 0 .293-.058c.023-.007.049-.005.072-.014.04-.016.073-.046.111-.067a.976.976 0 0 0 .211-.142c.008-.007.018-.01.026-.017.025-.026.035-.06.057-.087.052-.065.1-.13.135-.207.02-.045.03-.09.043-.137.015-.051.041-.097.048-.151L61.99 18.5v-.002a1.003 1.003 0 0 0-.036-.403zm-5.047 25.399L45.304 32.081l14.407-11.408zM21.938 20.511l11.605 11.407-14.407 11.411zm17.086 13.99L23.636 19.376h34.489zm-4.044-1.17 3.272 3.216a.998.998 0 0 0 1.322.071l4.15-3.286 11.48 11.289H20.728l14.253-11.289zM14.533 20.464H8.255a1 1 0 1 0 0 2h6.278a1 1 0 1 0 0-2zM2.862 28.488a1 1 0 0 0 1 1h9.809a1 1 0 1 0 0-2H3.862a1 1 0 0 0-1 1zM2 35.512a1 1 0 0 0 1 1h9.809a1 1 0 1 0 0-2H3a1 1 0 0 0-1 1zM12.946 42.536a1 1 0 0 0-1-1H8.255a1 1 0 1 0 0 2h3.691a1 1 0 0 0 1-1z"
                        fill="currentColor"
                        opacity="1"
                        data-original="currentColor"
                     ></path>
                  </g>
               </svg>
            </div>
            <div class="contact-content">
               <p><?php echo unikon_kses($unikon_offcanvas_email_label); ?></p>
               <a href="mailto:<?php echo unikon_kses($unikon_offcanvas_email) ?>"><?php echo unikon_kses($unikon_offcanvas_email); ?></a>
            </div>
         </li>
         <?php endif; ?>

         <?php if (!empty($unikon_offcanvas_location)) : ?>
         <li>
            <div class="contact-thumb">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  version="1.1"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  width="80"
                  height="80"
                  x="0"
                  y="0"
                  viewBox="0 0 512.001 512.001"
                  style="enable-background: new 0 0 512 512"
                  xml:space="preserve"
                  class=""
                  >
                  <g
                     transform="matrix(0.5,0,0,0.5,128.0006670464063,128.0008087158203)"
                     >
                     <path
                        d="m511.512 501.838-75-197.57a7.5 7.5 0 0 0-3.33-3.872l-79.886-45.006 23.323-36.98c14.314-22.714 21.881-48.963 21.881-75.909 0-78.575-63.925-142.5-142.5-142.5s-142.5 63.925-142.5 142.5c0 26.953 7.57 53.203 21.892 75.911l23.317 36.98-79.889 45.004a7.498 7.498 0 0 0-3.331 3.872l-75 197.57a7.502 7.502 0 0 0 10.693 9.197l120.568-67.926 120.568 67.926a7.503 7.503 0 0 0 7.363 0l120.568-67.926 120.568 67.926a7.497 7.497 0 0 0 8.573-.847 7.501 7.501 0 0 0 2.122-8.35zM263.501 388.712a22.436 22.436 0 0 0 11.521-9.217c.381-.6 64.229-101.834 64.229-101.834l32.519 153.008-108.269 60.996zM148.08 210.409c-12.809-20.31-19.579-43.792-19.579-67.909 0-70.304 57.196-127.5 127.5-127.5s127.5 57.196 127.5 127.5c0 24.112-6.768 47.596-19.569 67.909-1.001 1.587-99.823 158.299-101.547 161.006-.016.023-.03.047-.045.07-1.391 2.2-3.76 3.515-6.339 3.515-2.581 0-4.961-1.321-6.354-3.511-1.002-1.589-100.021-158.611-101.533-161.025l-.034-.055zM88.548 312.131l69.916-39.387-12.18 57.304a7.5 7.5 0 0 0 7.343 9.062 7.503 7.503 0 0 0 7.328-5.942l11.797-55.502 64.221 101.849a22.53 22.53 0 0 0 11.526 9.196v102.956L140.232 430.67l14.487-68.159a7.5 7.5 0 0 0-5.776-8.896 7.495 7.495 0 0 0-8.896 5.776l-14.929 70.236-103.256 58.174zm298.335 117.497L353.54 272.743l69.913 39.388 66.687 175.67z"
                        fill="currentColor"
                        opacity="1"
                        data-original="#000000"
                        class=""
                     ></path>
                     <path
                        d="M338.501 142.5c0-45.49-37.01-82.5-82.5-82.5s-82.5 37.01-82.5 82.5 37.01 82.5 82.5 82.5 82.5-37.01 82.5-82.5zm-150 0c0-37.22 30.28-67.5 67.5-67.5s67.5 30.28 67.5 67.5-30.28 67.5-67.5 67.5-67.5-30.28-67.5-67.5z"
                        fill="currentColor"
                        opacity="1"
                        data-original="#000000"
                        class=""
                     ></path>
                     <path
                        d="M308.501 142.5c0-28.948-23.552-52.5-52.5-52.5s-52.5 23.552-52.5 52.5 23.552 52.5 52.5 52.5 52.5-23.552 52.5-52.5zm-90 0c0-20.678 16.822-37.5 37.5-37.5s37.5 16.822 37.5 37.5-16.822 37.5-37.5 37.5-37.5-16.822-37.5-37.5z"
                        fill="currentColor"
                        opacity="1"
                        data-original="#000000"
                        class=""
                     ></path>
                  </g>
               </svg>
            </div>
            <div class="contact-content">
               <p><?php echo unikon_kses($unikon_offcanvas_location_label); ?></p>
               <span><?php echo unikon_kses($unikon_offcanvas_location); ?></span>
            </div>
         </li>
         <?php endif; ?>
      </ul>
      <p class="side-panel__copyright">
         <?php echo unikon_kses($unikon_offcanvas_copyright); ?>
      </p>
   </div>
</div>
<!-- Menu Button Toggle end -->