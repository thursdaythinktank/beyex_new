<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */

// main header settings
$header_right_switch   = get_theme_mod('header_right_switch', false);

$header_right_btn_text = get_theme_mod('unikon_header_right_btn_text', false);

$header_right_btn_text = get_theme_mod( 'unikon_header_right_btn_text', __( 'Lets Talk', 'unikon' ) );
$header_right_btn_link = get_theme_mod( 'unikon_header_right_btn_link', __( '#', 'unikon' ) ); 

$unikon_header_sticky      = get_theme_mod('unikon_header_sticky', false);

$sticky_id = $unikon_header_sticky ? 'sticky' : '';
?>

      <!-- Header area start -->
      <header>
        <!-- Menu -->
        <div class="menu-area <?php echo esc_attr($sticky_id); ?>">
          <div class="container container-3xl header-border-bottom">
            <div class="row align-items-center position-relative">
              <div class="col-lg-12 hamburger-menu position-relative">
                <div
                  class="nav-wrap d-flex justify-content-between align-items-center">
                  <div class="menu-logo-wrap">
                    <?php unikon_header_logo(); ?>
                  </div>
                  <div class="nav-wrap d-flex justify-content-between align-items-center">
                    <div class="mainmenu text-right">
                      <div class="home-menu">
                        <?php unikon_header_menu(); ?>
                      </div>

                      <?php if ($header_right_switch) : ?>
                      <div class="menu-btn-wrap menu-btn-wrap__mobile">
                        <?php if ( !empty( $header_right_btn_text ) ): ?>
                        <a class="common-btn" href="<?php print esc_url($header_right_btn_link); ?>"><?php print esc_html($header_right_btn_text); ?></a>
                        <?php endif; ?>
                      </div>
                        <?php endif; ?>
                    </div>
                  </div>

                  <?php if ($header_right_switch) : ?>
                  <div class="nav-wrap d-flex justify-content-end align-items-center">
                    <div class="menu-btn-wrap menu-btn-wrap__desktop">

                      <div class="menu-btn-hidden">
                        <?php if ( !empty( $header_right_btn_text ) ): ?>
                        <a class="common-btn" href="<?php print esc_url($header_right_btn_link); ?>"><?php print esc_html($header_right_btn_text); ?></a>
                        <?php endif; ?>
                      </div>

                      <?php if (has_nav_menu('main-menu')) : ?>
                      <button class="side-panel__activator">
                        <span></span>
                        <span></span>
                        <span></span>
                      </button>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if (!$header_right_switch) : ?>
                  <?php if (has_nav_menu('main-menu')) : ?>
                  <button class="side-panel__activator d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                  </button>
                  <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Menu end -->
      </header>
      <!-- Header area end -->

<?php do_action('unikon_offcanvas_style'); ?>