<?php

namespace WPRCore\Widgets;

$cart_sidebar = get_theme_mod('ishpat_cart_sidebar_switch', false);
?>


<!-- search area start -->
<div class="search-area">
    <div class="search-inner p-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="search-wrapper">
                        <div class="search-close">
                            <button class="search-close-btn">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="search-content pt-35">
                            <?php if (!empty($settings['search_title'])) : ?>
                                <h3 class="heading text-center mb-30"><?php echo tp_kses($settings['search_title']); ?></h3>
                            <?php endif; ?>
                            <div class="d-flex justify-content-center">
                                <div class="search w-100 p-relative">
                                    <form action="<?php echo esc_url(home_url('/')) ?>" method="get">
                                        <input class="search-input" type="text"
                                            value="<?php echo esc_attr(get_search_query()); ?>" required name="s"
                                            placeholder="Search...">
                                        <button type="submit" class="search-icon"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="search-overlay"></div>
<!-- search area end -->

<?php if (!empty($cart_sidebar)) : ?>
    <?php include(WPRCORE_ELEMENTS_PATH . '/header-side/header-cart-mini.php'); ?>
<?php endif; ?>

<!-- offcanvas area start -->
<div class="offcanvas__area">
    <div class="offcanvas__close">
        <button class="offcanvas__close-btn offcanvas-close-btn">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <div class="offcanvas__wrapper">
        <div class="offcanvas__content">

            <?php if (!empty($tp_side_logo)) : ?>
                <div class="offcanvas__top mb-40">
                    <div class="offcanvas__logo">
                        <a href="<?php print esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($tp_side_logo); ?>"
                                alt="<?php echo esc_attr($tp_side_logo_alt); ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="tp-main-menu-mobile fix mb-30"></div>

            <div class="offcanvas-info mb-30">
                <?php if (!empty($settings['ofc_contact_title'])) : ?>
                    <h4 class="offcanvas__title"><?php echo tp_kses($settings['ofc_contact_title']); ?></h4>
                <?php endif; ?>

                <?php foreach ($settings['tp_ofc_list'] as $key => $item) :
                    $key = $key + 1;

                    $link_type = $item['link_type'];
                    $url = $item['tp_contact_url'];
                    $tell = $item['tp_contact_tell'];
                    $email = $item['tp_contact_email'];

                    $contact_link;

                    if ($link_type == 'url') {
                        $contact_link = $url;
                    } elseif ($link_type == 'tell') {
                        $contact_link = 'tel:' . $tell;
                    } elseif ($link_type == 'email') {
                        $contact_link = 'mailto:' . $email;
                    }
                ?>
                    <div class="offcanvas__contact-content d-flex">

                        <?php if ($item['tp_box_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                <div class="offcanvas__contact-content-icon"><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></div>
                            <?php endif; ?>
                        <?php elseif ($item['tp_box_icon_type'] == 'image') : ?>
                            <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                <div class="offcanvas__contact-content-icon">
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                <div class="offcanvas__contact-content-icon">
                                    <?php echo $item['tp_box_icon_svg']; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="offcanvas__contact-content-content">
                            <?php if (!empty($item['link_type'])) : ?>
                                <a href="<?php echo esc_url($contact_link); ?>"><?php echo tp_kses($item['tp_contact_info_title']); ?></a>
                            <?php else : ?>
                                <h6 class="tp-white-color"><?php echo tp_kses($item['tp_contact_info_title']); ?></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="offcanvas__social">

                <?php foreach ($settings['tp_ofc_social_list'] as $key => $item) : ?>
                    <a class="icon facebook" href="<?php echo esc_url($item['tp_ofc_social_link']); ?>">
                        <?php if (
                            ($item['tp_box_icon_type'] == 'icon' && (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value']))) ||
                            ($item['tp_box_icon_type'] == 'image' && !empty($item['tp_box_icon_image']['url'])) ||
                            ($item['tp_box_icon_type'] == 'svg' && !empty($item['tp_box_icon_svg']))
                        ) : ?>
                            <?php $this->tp_icon_show($item); ?>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
<!-- offcanvas area end -->