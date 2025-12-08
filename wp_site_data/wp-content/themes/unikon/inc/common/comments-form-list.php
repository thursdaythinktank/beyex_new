<?php


// wordpress commnets form  start

function custom_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');

    $fields = array(
        'author' => '<div class="row wpr-contact-input-form">
                    <div class="col-xl-6">
                        <div  class="wpr-postbox-details-input-box">
                            <div class="wpr-postbox-details-input wpr-contact-input p-relative">
                                <label>Your Name</label>
                                <input type="text" name="author" id="author" placeholder="' . esc_attr__('Name*', 'unikon') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required' : '') . '>
                            </div>
                        </div>
                    </div>',

        'email' => '<div class="col-xl-6">
                        <div class="wpr-postbox-details-input-box">
                            <div class="wpr-postbox-details-input wpr-contact-input p-relative">
                                <label>Your Email</label>
                                <input type="email" name="email" id="email" placeholder="' . esc_attr__('Email', 'unikon') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required' : '') . '>
                            </div>
                        </div>
                    </div>',
        'url' => '<div class="col-xl-12">
                        <div class="wpr-postbox-details-input-box">
                            <div class="wpr-postbox-details-input wpr-contact-input p-relative">
                                <label>Your Website</label>
                                <input type="text" name="url" id="url" placeholder="' . esc_attr__('Website', 'unikon') . '" value="' . esc_attr($commenter['comment_author_url']) . '">
                            </div>
                        </div>
                    </div>
                </div>',
    );

    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_fields');

// Customize the comment form textarea


// Move the comment textarea to the bottom
function move_comment_textarea_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

add_action('comment_form_fields', 'move_comment_textarea_to_bottom');




// custom_comment_list
function unikon_comment_list($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    $custom_avater = get_the_author_meta('unikon_author_avater');
    $author_name = get_the_author_meta('display_name');

    $args['callback'] = 'custom_comment_list';
    $args['reply_text'] = '<svg width="12" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L1 5L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1 5.00024L9 5.00024C10.3333 5.00024 13 5.80025 13 9.00025" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg> 
                            Reply';


    if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
        // Display pingbacks and trackbacks differently if needed
        ?>
        <li class="pingback">
            <p><?php esc_html_e('Pingback:', 'unikon'); ?>         <?php comment_author_link(); ?></p>
        </li>
        <?php
    } else {
        // Display regular comments
        ?>
        <li class="mt-20" <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
            <div class="postbox__comment-box d-flex wpr-postbox-comment-box">
                <div class="postbox__comment-info ">
                    <div class="postbox__comment-avater wpr-postbox-comment-info mr-20">

                        <?php if (!empty($custom_avater)): ?>
                            <img src="<?php echo esc_url($custom_avater); ?>" alt="<?php echo esc_attr($author_name) ?>">
                        <?php else: ?>
                            <?php print get_avatar($comment, 90, ); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="postbox__comment-text wpr-postbox-comment-text">
                    <div class="postbox__comment-name wpr-postbox-comment-name">
                        <h5><?php comment_author(); ?></h5>
                        <span class="post-meta">
                            <?php comment_date(); ?>
                            <?php echo esc_html__('at', 'unikon'); ?>
                            <?php echo get_comment_time(); ?>
                        </span>
                    </div>
                    <div class="unikon-post-comment-text">
                        <?php if ($comment->comment_approved == '0'): ?>
                            <p><?php esc_html_e('Your comment is awaiting moderation.', 'unikon'); ?></p>
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>
                    <div class="postbox__comment-reply wpr-postbox-comment-reply">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                </div>
            </div>

            <?php
    }
}
