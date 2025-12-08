<!-- cart mini area start -->

<div class="cartmini__area">
    <div class="cartmini__wrapper d-flex justify-content-between flex-column">
        <div class="cartmini__top-wrapper">
            <div class="cartmini__top p-relative">
                <div class="cartmini__top-title">
                    <h4>Shopping cart</h4>
                </div>
                <div class="cartmini__close">
                    <button type="button" class="cartmini__close-btn cartmini-close-btn"><i
                            class="fal fa-times"></i></button>
                </div>
            </div>
            <?php if ( class_exists( 'WooCommerce' ) && !is_null(WC()->cart)) : ?>
                <?php echo woocommerce_mini_cart(); ?>
                <?php endif; ?>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
<!-- cart mini area end -->