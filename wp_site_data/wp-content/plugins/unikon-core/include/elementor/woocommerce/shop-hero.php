<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Shop_Hero_Slider extends Widget_Base
{

   use WPR_Style_Trait, WPR_Animation_Trait;


   /**
    * Retrieve the widget name.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget name.
    */
   public function get_name()
   {
      return 'tp-shop-hero-slider';
   }

   /**
    * Retrieve the widget title.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget title.
    */
   public function get_title()
   {
      return __(WPRCORE_THEME_NAME . ' :: Shop Hero Slider', 'wprealizer');
   }

   /**
    * Retrieve the widget icon.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return string Widget icon.
    */
   public function get_icon()
   {
      return 'wpr-icon';
   }

   /**
    * Retrieve the list of categories the widget belongs to.
    *
    * Used to determine where to display the widget in the editor.
    *
    * Note that currently Elementor supports only one category.
    * When multiple categories passed, Elementor uses the first one.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return array Widget categories.
    */
   public function get_categories()
   {
      return ['wprealizer'];
   }

   /**
    * Retrieve the list of scripts the widget depended on.
    *
    * Used to set scripts dependencies required to run the widget.
    *
    * @since 1.0.0
    *
    * @access public
    *
    * @return array Widget scripts dependencies.
    */
   public function get_script_depends()
   {
      return ['wprealizer'];
   }

   /**
    * Register the widget controls.
    *
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @since 1.0.0
    *
    * @access protected
    */

   protected function register_controls()
   {
      $this->register_controls_section();
      $this->style_tab_content();
   }

   protected function register_controls_section()
   {

      $this->start_controls_section(
         'tp_shop_hero_slider_sec',
         [
            'label' => esc_html__('Section Label', 'wprealizer'),
            'tab'   => Controls_Manager::TAB_CONTENT,
         ]
      );


      $repeater = new Repeater();

      $repeater->add_control(
         'tp_shop_hero_slider_subtitle',
         [
            'label'   => esc_html__('Subtitle', 'wprealizer'),
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__('Shoes Collection', 'wprealizer'),
            'label_block' => true,
         ]
      );
      $repeater->add_control(
         'tp_shop_hero_slider_title',
         [
            'label'   => esc_html__('Title', 'wprealizer'),
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__('Shoes Collection', 'wprealizer'),
            'label_block' => true,
         ]
      );

      $repeater->add_control(
         'tp_shop_hero_slider_image',
         [
            'label'   => esc_html__('Image', 'wprealizer'),
            'type'    => Controls_Manager::MEDIA,
            'default' => [
               'url' => Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $repeater->add_control(
         'tp_shop_hero_slider_link_text',
         [
            'label'       => esc_html__('Button Text', 'wprealizer'),
            'type'        => Controls_Manager::TEXT,
            'default'     => esc_html__('Shop Now', 'wprealizer'),
            'placeholder' => esc_html__('Your Text', 'wprealizer'),
         ]
      );

      tp_render_links_controls($repeater, 'shop_hero_slider');

      $this->add_control(
         'tp_shop_hero_slider_list',
         [
            'label'       => esc_html__('Slider List', 'wprealizer'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
               [
                  'tp_shop_hero_slider_title'   => esc_html__('Shoes Collection', 'wprealizer'),
               ],
               [
                  'tp_shop_hero_slider_title'   => esc_html__('Shoes Collection', 'wprealizer'),
               ],
               [
                  'tp_shop_hero_slider_title'   => esc_html__('Shoes Collection', 'wprealizer'),
               ],
            ],
            'title_field' => '{{{ tp_shop_hero_slider_title }}}',
         ]
      );

      $this->end_controls_section();
   }

   protected function style_tab_content()
   {
      $this->tp_section_style_controls('section', 'Section - Style', '.tp-el-section');
   }

   /**
    * Render the widget output on the frontend.
    *
    * Written in PHP and used to generate the final HTML.
    *
    * @since 1.0.0
    *
    * @access protected
    */
   protected function render()
   {
      $settings = $this->get_settings_for_display();


?>



      <!-- hero area start -->
      <div class="tp-shop-slider-area p-relative">
         <div class="shop-slider-wrapper">
            <div class="swiper-container tp-shop-slider-active">
               <div class="tp-shop-slider-arrow-box">
                  <button class="tp-shop-next"><i class="fa-light fa-angle-left"></i></button>
                  <button class="tp-shop-prev"><i class="fa-light fa-angle-right"></i></button>
               </div>
               <div class="swiper-wrapper">
                  <?php foreach ($settings['tp_shop_hero_slider_list'] as $item) :
                     $img = tp_get_img($item, 'tp_shop_hero_slider_image', 'full', false);

                     $attrs = tp_get_repeater_links_attr($item, 'shop_hero_slider');
                     extract($attrs);

                     $link_attrs = [
                        'class' => 'tp-shop-btn',
                        'href' => $link,
                        'target' => $target,
                        'rel' => $rel,
                     ]
                  ?>
                     <div class="swiper-slide">
                        <div class="tp-shop-slider-bg tp-shop-slider-ovarlay">
                           <div class="tp-shop-slider-thumb" style="background-image: url('<?php echo esc_url($img['tp_shop_hero_slider_image']); ?>')"></div>
                           <div class="container container-1300">
                              <div class="row">
                                 <div class="col-xl-8">
                                    <div class="tp-shop-slider-content z-index">
                                       <div class="tp-shop-slider-title-box">

                                          <?php if (!empty($item['tp_shop_hero_slider_subtitle'])) : ?>
                                             <span class="tp-shop-slider-subtitle"><?php echo tp_kses($item['tp_shop_hero_slider_subtitle']); ?></span>
                                          <?php endif; ?>

                                          <?php if (!empty($item['tp_shop_hero_slider_title'])) : ?>
                                             <h2 class="tp-shop-slider-title"><?php echo tp_kses($item['tp_shop_hero_slider_title']); ?></h2>
                                          <?php endif; ?>

                                       </div>
                                       <div class="tp-shop-slider-btn-box">
                                          <a <?php echo tp_implode_html_attributes($link_attrs); ?>><?php echo tp_kses($item['tp_shop_hero_slider_link_text']); ?></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach; ?>

               </div>
               <div class="fraction-wrapper d-none d-lg-block">
                  <div id="paginations"></div>
                  <div class="shop-slider-progress-bar">
                     <span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- hero area end -->


<?php
   }
}

$widgets_manager->register(new TP_Shop_Hero_Slider());
