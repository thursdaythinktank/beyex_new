<?php

namespace WPRCore\Widgets;

$cart_sidebar = get_theme_mod('wprealizer_cart_sidebar_switch', false);

?>


<!-- Menu Button Toggle start -->
<div class="side-panel__overlay"></div>
<div class="side-panel">
    <div class="side-panel__closer">
        <i class="bi bi-x-lg"></i>
    </div>
    <div class="side-panel__content">
        <a href="<?php print esc_url(home_url('/')); ?>" class="logo d-flex justify-content-center">
            <img src="<?php echo esc_url($offcanvas_logo); ?>" alt="<?php echo esc_attr($offcanvas_logo_alt); ?>" />
        </a>

        <div class="side-panel__mobile-menu"></div>

        <?php if (!empty($settings['offcanvas_description'])): ?>
        <p>
            <?php echo tp_kses($settings['offcanvas_description']); ?>
        </p>
        <?php endif; ?>
        <ul class="custom-ul side-panel__contact">
            <?php foreach ($settings['wpr_contact_list'] as $key => $item): ?>
            <li class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                <div class="contact-thumb">
                    <?php tp_render_signle_icon_html($item, 'icon_box'); ?>
                </div>
                <div class="contact-content">
                    <?php if (!empty($item['wpr_contact_label'])): ?>
                    <p><?php echo $item['wpr_contact_label']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($item['wpr_contact_value'])): ?>
                    <?php echo $item['wpr_contact_value']; ?>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>

        <?php if (!empty($settings['copyright_text'])): ?>
        <p class="side-panel__copyright">
            <?php echo tp_kses($settings['copyright_text']); ?>
        </p>
        <?php endif; ?>
    </div>
</div>
<!-- Menu Button Toggle end -->