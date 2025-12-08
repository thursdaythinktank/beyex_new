<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$blog_column = is_active_sidebar( 'services-sidebar' ) ? 'col-lg-8' : 'col-lg-12';

?>

          <!-- Work Start -->
          <div class="service-details__area pt-150 pb-150">
            <div class="container">
            <?php
                if( have_posts() ):
                while( have_posts() ): the_post(); 
             ?>
              <div class="row g-4 gy-5">
                <div class="<?php echo esc_attr($blog_column); ?> fade_up_anim" data-delay=".4">
                  <article class="service-details__article">
                    <?php the_content(); ?>
                  </article>
                </div>

                <?php
                if(is_active_sidebar( 'services-sidebar' )) :
                ?>
                <div class="col-lg-4 fade_up_anim" data-delay=".6">
                  <div class="widget">
                    <?php dynamic_sidebar( 'services-sidebar' ); ?>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            <?php
                endwhile; wp_reset_query();
                endif;
             ?>
              
            </div>
          </div>
          <!-- work End -->





<?php get_footer();  ?>