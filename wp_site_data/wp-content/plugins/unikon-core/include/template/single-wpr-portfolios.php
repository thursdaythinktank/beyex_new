<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

function display_related_portfolios($post_id) {
      // Get the categories of the current post
      $categories = wp_get_post_terms($post_id, 'portfolios-cat', array('fields' => 'ids'));
      
      // Custom query arguments
      $args = array(
          'post_type' => 'wpr-portfolios',
          'posts_per_page' => 3, // Number of related posts to display
          'post__not_in' => array($post_id), // Exclude the current post
          'tax_query' => array(
              array(
                  'taxonomy' => 'portfolios-cat',
                  'field'    => 'id',
                  'terms'    => $categories,
              ),
          ),
      );
  
      // Custom query
      $related_posts = new WP_Query($args);
  
      // Check if the custom query has posts
      if ($related_posts->have_posts()) :
          echo '<div class="container border-top pt-75">';
          echo '<div class="row more-project g-4">';
          // Loop through the related posts
          while ($related_posts->have_posts()) : $related_posts->the_post();
              // Variables for the current post
              $related_post_id = get_the_ID();
              $title = get_the_title();
              $permalink = get_permalink();
              $thumbnail = get_the_post_thumbnail_url($related_post_id, 'full');
              $category = wp_get_post_terms($related_post_id, 'portfolios-cat', array('fields' => 'names'));
              $category_name = !empty($category) ? $category[0] : '';
  
              echo '<div class="col-md-6">';
              echo '<div class="work-sa__item">';
              echo '<figure class="work-sa__item-figure">';
              echo '<a href="' . esc_url($permalink) . '">';
              echo '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr($title) . '">';
              echo '</a>';
              echo '</figure>';
              echo '<div class="work-sa__item-body">';
              echo '<h6 class="h6"><a href="' . esc_url($permalink) . '">' . esc_html($title) . '</a></h6>';
              echo '<div class="tp-project-item-btn">';
              echo '<a href="' . esc_url($permalink) . '" class="arrow">';
              echo '<img src="https://unikon.wprealizer.com/wp-content/uploads/2024/11/arrow-lg.png" alt="arrow" />';
              echo '</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
          endwhile;
          echo '</div>';
          echo '</div>';
          wp_reset_postdata();
      else :
          // If no related posts found, display a message or leave empty
          echo '<p>No related projects found.</p>';
      endif;
  }

?>


<!-- Work Start -->
<div class="case-details__area pt-150 pb-150">
      <div class="container pb-75">
            <?php
            if( have_posts() ):
            while( have_posts() ): the_post();

            global $post;

              $portfolio_info_list = function_exists('get_field') ? get_field('portfolio_info_list') : '';

              $portfolio_client_label = function_exists('get_field') ? get_field('portfolio_client_label') : '';
              $portfolio_client_name = function_exists('get_field') ? get_field('portfolio_client_name') : '';

              $portfolio_industry_label = function_exists('get_field') ? get_field('portfolio_industry_label') : '';
              $portfolio_industry_name = function_exists('get_field') ? get_field('portfolio_industry_name') : '';

              $portfolio_project_label = function_exists('get_field') ? get_field('portfolio_project_label') : '';
              $portfolio_project_name = function_exists('get_field') ? get_field('portfolio_project_name') : '';

              $portfolio_duration_label = function_exists('get_field') ? get_field('portfolio_duration_label') : '';
              $portfolio_duration = function_exists('get_field') ? get_field('portfolio_duration') : '';
            ?>
            <div class="row g-4 g-xxl-5">
                  <div class="col-xl-8 fade_up_anim" data-delay=".2">
                        <?php the_content(); ?>
                  </div>
                  <div class="col-xl-4 fade_up_anim" data-delay=".4">
                        <div class="case-details__shortInfo">
                              <ul class="custom-ul case-details__shortInfo-info">
                                    <?php if (!empty($portfolio_info_list['portfolio_client_name'])) : ?>
                                    <li>
                                          <h6 class="h6 title">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_client_label'] ); ?> 
                                          </h6>
                                          <span class="info">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_client_label'] ); ?>
                                          </span>
                                    </li>
                                    <?php endif; ?>

                                    <?php if (!empty($portfolio_info_list['portfolio_industry_name'])) : ?>
                                    <li>
                                          <h6 class="h6 title">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_industry_label'] ); ?>  
                                          </h6>
                                          <span class="info">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_industry_name'] ); ?> 
                                          </span>
                                    </li>
                                    <?php endif; ?>

                                    <?php if (!empty($portfolio_info_list['portfolio_project_name'])) : ?>
                                    <li>
                                          <h6 class="h6 title">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_project_label'] ); ?> 
                                          </h6>
                                          <span class="info">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_project_name'] ); ?> 
                                          </span>
                                    </li>
                                    <?php endif; ?>

                                    <?php if (!empty($portfolio_info_list['portfolio_duration'])) : ?>
                                    <li>
                                          <h6 class="h6 title">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_duration_label'] ); ?> 
                                          </h6>
                                          <span class="info">
                                          <?php echo wp_kses_post( $portfolio_info_list['portfolio_duration'] ); ?> 
                                          </span>
                                    </li>
                                    <?php endif; ?>
                              </ul>
                        </div>
                  </div>
            </div>

            <?php
            endwhile; wp_reset_query();
            endif;
            ?>
      </div>
      <?php display_related_portfolios(get_the_ID()); ?>
</div>
<!-- work End -->



<?php get_footer();  ?>