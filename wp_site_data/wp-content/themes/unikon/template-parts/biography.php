<?php
$author_data = get_the_author_meta('description', get_query_var('author'));
$author_name = get_the_author_meta('display_name');

// from meta
$facebook_url = get_the_author_meta('unikon_facebook');
$custom_avater = get_the_author_meta('unikon_author_avater');
$twitter_url = get_the_author_meta('unikon_twitter');
$linkedin_url = get_the_author_meta('unikon_linkedin');
$instagram_url = get_the_author_meta('unikon_instagram');
$youtube_url = get_the_author_meta('unikon_youtube');

$author_bio_avatar_size = 180;
if ($author_data != '') :
?>

    <div class="wpr-postbox-details-author-box mb-40 p-relative">
        <div class="wpr-postbox-details-author-wrap d-flex align-items-center">
            <div class="wpr-postbox-details-author-avata">
                <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>">
                    <?php if (!empty($custom_avater)) : ?>
                        <img src="<?php echo esc_url($custom_avater); ?>" alt="<?php echo esc_attr($author_name) ?>">
                    <?php else : ?>
                        <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
                    <?php endif; ?>
                </a>
            </div>
            <div class="wpr-postbox-details-author-content">
                <h4 class="blog-details-author-title">
                    <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>">
                        <?php print esc_html($author_name); ?>
                    </a>
                </h4>

                <p>
                    <?php echo unikon_kses($author_data); ?>
                </p>
            </div>
        </div>
        <div class="wpr-postbox-details-author-social">
            <?php if (!empty($facebook_url)) : ?>
                <a href="<?php echo esc_url($facebook_url); ?>"><i class="fa-brands fa-facebook-f"></i></a>
            <?php endif; ?>

            <?php if (!empty($twitter_url)) : ?>
                <a href="<?php echo esc_url($twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a>
            <?php endif; ?>

            <?php if (!empty($linkedin_url)) : ?>
                <a href="<?php echo esc_url($linkedin_url); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
            <?php endif; ?>

            <?php if (!empty($instagram_url)) : ?>
                <a href="<?php echo esc_url($instagram_url); ?>"><i class="fa-brands fa-instagram"></i></a>
            <?php endif; ?>

            <?php if (!empty($youtube_url)) : ?>
                <a href="<?php echo esc_url($youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>