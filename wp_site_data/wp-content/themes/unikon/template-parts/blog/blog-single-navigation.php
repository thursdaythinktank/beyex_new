<?php if (get_previous_post_link() or get_next_post_link()):
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>


    <div class="wpr-postbox-details-navigation mb-60">
        <?php if (get_previous_post_link()): ?>
            <div class="wpr-postbox-details-navigation-content text-start text-md-start">
                <a class="wpr-postbox-details-navigation-btn" href="<?php echo get_permalink($prev_post) ?>">
                    <span class="prev-post">
                        <i class="fa fa-arrow-left"></i>
                    </span>
                    <?php echo esc_html__('PREVIOUS', 'unikon'); ?>
                </a>
                <h4 class="wpr-postbox-details-navigation-title">
                    <a href="<?php echo get_permalink($prev_post) ?>">
                        <?php print wp_trim_words(get_the_title($prev_post), 6, ''); ?>
                    </a>
                </h4>
            </div>
        <?php else: ?>
            <span class="wpr-navigation-no-post">
                <?php echo esc_html__('No Previous Post Available', 'unikon'); ?>
            </span>
        <?php endif; ?>

        <div class="wpr-postbox-details-navigation-bar text-md-center">
            <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">
                <span>
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.5"
                            d="M1 5.21053C1 3.22567 1 2.23323 1.61662 1.61662C2.23323 1 3.22567 1 5.21053 1C7.19539 1 8.18782 1 8.80444 1.61662C9.42105 2.23323 9.42105 3.22567 9.42105 5.21053C9.42105 7.19539 9.42105 8.18782 8.80444 8.80444C8.18782 9.42105 7.19539 9.42105 5.21053 9.42105C3.22567 9.42105 2.23323 9.42105 1.61662 8.80444C1 8.18782 1 7.19539 1 5.21053Z"
                            stroke="#0f0f0f" stroke-width="1.5" />
                        <path opacity="0.5"
                            d="M12.5781 16.7896C12.5781 14.8048 12.5781 13.8123 13.1947 13.1957C13.8114 12.5791 14.8038 12.5791 16.7887 12.5791C18.7735 12.5791 19.7659 12.5791 20.3826 13.1957C20.9992 13.8123 20.9992 14.8048 20.9992 16.7896C20.9992 18.7745 20.9992 19.7669 20.3826 20.3835C19.7659 21.0002 18.7735 21.0002 16.7887 21.0002C14.8038 21.0002 13.8114 21.0002 13.1947 20.3835C12.5781 19.7669 12.5781 18.7745 12.5781 16.7896Z"
                            stroke="#0f0f0f" stroke-width="1.5" />
                        <path
                            d="M1 16.7894C1 14.8045 1 13.8121 1.61662 13.1955C2.23323 12.5789 3.22567 12.5789 5.21053 12.5789C7.19539 12.5789 8.18782 12.5789 8.80444 13.1955C9.42105 13.8121 9.42105 14.8045 9.42105 16.7894C9.42105 18.7742 9.42105 19.7667 8.80444 20.3833C8.18782 20.9999 7.19539 20.9999 5.21053 20.9999C3.22567 20.9999 2.23323 20.9999 1.61662 20.3833C1 19.7667 1 18.7742 1 16.7894Z"
                            stroke="#0f0f0f" stroke-width="1.5" />
                        <path
                            d="M12.5781 5.21053C12.5781 3.22567 12.5781 2.23323 13.1947 1.61662C13.8114 1 14.8038 1 16.7887 1C18.7735 1 19.7659 1 20.3826 1.61662C20.9992 2.23323 20.9992 3.22567 20.9992 5.21053C20.9992 7.19539 20.9992 8.18782 20.3826 8.80444C19.7659 9.42105 18.7735 9.42105 16.7887 9.42105C14.8038 9.42105 13.8114 9.42105 13.1947 8.80444C12.5781 8.18782 12.5781 7.19539 12.5781 5.21053Z"
                            stroke="#0f0f0f" stroke-width="1.5" />
                    </svg>
                </span>
            </a>
        </div>

        <?php if (get_next_post_link()): ?>
        <div class="wpr-postbox-details-navigation-content next text-sart text-md-end">
            <a class="wpr-postbox-details-navigation-btn" href="<?php echo get_permalink($next_post) ?>"> <?php echo esc_html__('Next', 'unikon'); ?>
                <span class="next-post">
                    <i class="fa fa-arrow-right"></i>
                </span>
            </a>
            <h4 class="wpr-postbox-details-navigation-title">
                <a href="<?php echo get_permalink($next_post) ?>">
                    <?php print wp_trim_words(get_the_title($next_post), 6, ''); ?>
                </a>
            </h4>
        </div>
        <?php else: ?>
        <span class="wpr-navigation-no-post">
            <?php echo esc_html__('No Next Post Available', 'unikon'); ?>
        </span>
        <?php endif; ?>
    </div>

<?php endif; ?> <!-- navigation end -->