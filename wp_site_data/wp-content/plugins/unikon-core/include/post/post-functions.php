<?php

function wprealizer_post_read_count()
{
   global $post;
   // load the content
   $thecontent = $post->post_content;
   // count the number of words
   $words = str_word_count(strip_tags($thecontent));
   // rounding off and deviding per 200 words per minute
   $m = floor($words / 50);

   // calculate the amount of read time
   $readtime = $m . ' Min' . ($m == 1 ? '' : 'ute');

   // return the readtime
   return $readtime;
}


function wprealizer_blog_post_social()
{
   $post_url = get_the_permalink();
   ?>
   <div class="tp-postbox-share">
      <button class="p-relative">
         <?php echo esc_html__(' Share this post:', 'wprealizer'); ?>
         <span>
            <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path
                  d="M11 5.40002C12.1046 5.40002 13.0001 4.52697 13.0001 3.45001C13.0001 2.37305 12.1046 1.5 11 1.5C9.89545 1.5 9 2.37305 9 3.45001C9 4.52697 9.89545 5.40002 11 5.40002Z"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
               <path
                  d="M3.00005 9.95007C4.10464 9.95007 5.00009 9.07702 5.00009 8.00006C5.00009 6.9231 4.10464 6.05005 3.00005 6.05005C1.89545 6.05005 1 6.9231 1 8.00006C1 9.07702 1.89545 9.95007 3.00005 9.95007Z"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
               <path
                  d="M11 14.5001C12.1046 14.5001 13.0001 13.6271 13.0001 12.5501C13.0001 11.4731 12.1046 10.6001 11 10.6001C9.89545 10.6001 9 11.4731 9 12.5501C9 13.6271 9.89545 14.5001 11 14.5001Z"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
               <path d="M4.72656 8.98157L9.28 11.5686" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round"></path>
               <path d="M9.27333 4.4314L4.72656 7.01841" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round"></path>
            </svg>
         </span>
      </button>

      <ul class="tp-postbox-share-hover m-0 p-0">

         <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url); ?>" target="_blank">
               <i class=" fab fa-facebook tp-facebook"></i>
               <b><?php echo esc_html__('Facebook', 'wprealizer'); ?></b>
            </a>
         </li>
         <li>
            <a href="https://twitter.com/share?url=<?php echo esc_url($post_url); ?>" target="_blank">
               <i class="fab fa-twitter tp-twitter"></i>
               <b><?php echo esc_html__('Twitter', 'wprealizer'); ?></b>
            </a>
         </li>
         <li>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>"
               target="_blank">
               <i class="fab fa-linkedin tp-linkedin"></i>
               <b><?php echo esc_html__('Linkedin', 'wprealizer'); ?></b>
            </a>
         </li>
         <li>
            <a href="https://vimeo.com/share?url=<?php echo esc_url($post_url); ?>" target="_blank">
               <i class="fa-brands fa-vimeo-v"></i>
               <b><?php echo esc_html__('Vimeo', 'wprealizer'); ?></b>
            </a>
         </li>
      </ul>
   </div>


   <?php return false;
}

// wprealizer_product_single_social
function wprealizer_product_single_social()
{
   $post_url = get_the_permalink();
   ?>
   <div class="tp-product-details-social">
      <span><?php echo esc_html__('Share:', 'wprealizer'); ?> </span>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url); ?>" target="_blank"><i
            class="fa-brands fa-facebook-f"></i></a>
      <a href="https://twitter.com/share?url=<?php echo esc_url($post_url); ?>" target="_blank"><i
            class="fa-brands fa-twitter"></i></a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>" target="_blank"><i
            class="fa-brands fa-linkedin-in"></i></a>
      <a href="https://vimeo.com/share?url=<?php echo esc_url($post_url); ?>" target="_blank"><i
            class="fa-brands fa-vimeo-v"></i></a>
   </div>

   <?php return false;
}
