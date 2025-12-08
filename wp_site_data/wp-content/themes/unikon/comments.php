<?php
// Check if comments are allowed
if (comments_open()) :
?>
    <div id="comments" class="comments-area postbox__comment latest-comments wpr-postbox-comment-from wpr-postbox-comment">
        <?php
        // Display the comments list
        if (have_comments()) :
        ?>
            <h3 class="wpr-postbox-comment-title">
                <?php
                $comment_count = get_comments_number();
                echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'unikon');
                ?>
            </h3>

            <ul class="postbox__comment unikon-comment-list mt-20">
                <?php
                wp_list_comments(array(
                    'style'       => 'ul',
                    'callback'    => 'unikon_comment_list',
                    'short_ping'  => true,
                ));
                ?>
            </ul>

        <?php
            // Display comment pagination if needed
            the_comments_pagination(array(
                'prev_text' => esc_html__('Previous', 'unikon'),
                'next_text' => esc_html__('Next', 'unikon'),
            ));
        endif;

        if (is_user_logged_in()) {
            $cl = 'loginformuser';
        } else {
            $cl = '';
        }

        $defaults = [
            'comment_field'      => '
                <div class="col-xxl-12 ' . $cl . '">
                    <div class="wpr-postbox-details-input-box wpr-contact-input-form">
                        <div class="wpr-postbox-details-input">
                            <label>Your comment</label>
                            <textarea class="msg-box" id="comment" name="comment" placeholder="' . esc_attr__('Your Comment Here...', 'unikon') . '" required></textarea>
                        </div>
                    </div>
                </div>
            ',
            'submit_button' => '
            <div class="col-xxl-12">
                <div class="wpr-postbox-details-input-box wpr-contact-btn mt-20">
                    <button type="submit" class="common-btn">' . esc_html__('Post Comment', 'unikon') . '</button>
                </div>
            </div>',

            'cookies' => '<div class="col-xxl-12">
                <div class="wpr-postbox-details-suggetions mb-20">
                    <div class="wpr-postbox-details-remeber">' .
                '<input type="checkbox" id="post_aggre" name="wp-comment-agree" value="1" checked>' .
                '<label class="e-check-label" for="post_aggre">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'unikon') . '</label>
                    </div>
                </div>
            </div>'
        ];


        // Display the comment form
        comment_form($defaults);
        ?>
    </div><!-- .comments-area -->
<?php endif; ?>