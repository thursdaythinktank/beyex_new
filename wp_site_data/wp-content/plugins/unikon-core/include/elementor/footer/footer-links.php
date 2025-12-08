<?php

namespace WPRCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use WPRCore\Elementor\Controls\Group_Control_WPRGradient;
use \Elementor\Repeater;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Footer_Links extends Widget_Base
{

  use WPR_Style_Trait, WPR_Icon_Trait, WPR_Offcanvas_Trait, WPR_Menu_Trait;

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
    return 'wpr-footer-links';
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
    return __(WPRCORE_THEME_NAME . ' :: Footer Links', 'wprealizer');
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

    // layout Panel
    $this->wpr_design_layout('Layout Style', 3);

    $this->start_controls_section(
      'tp_footer_links_sec',
      [
        'label' => esc_html__('Menu List Controls', 'wprealizer'),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'tp_footer_links_title',
      [
        'label'   => esc_html__('Menu List Title', 'wprealizer'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Demo Title', 'wprealizer'),
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'tp_footer_links_link_type',
      [
        'label' => esc_html__('Menu Link Type', 'wprealizer'),
        'type' => Controls_Manager::SELECT,
        'options' => [
          '1' => 'Custom Link',
          '2' => 'Internal Page',
        ],
        'default' => '1',
        'label_block' => true,
      ]
    );



    $repeater->add_control(
      'tp_footer_links_link',
      [
        'label' => esc_html__('Menu link', 'wprealizer'),
        'type' => Controls_Manager::URL,
        'dynamic' => [
          'active' => true,
        ],
        'placeholder' => esc_html__('https://your-link.com', 'wprealizer'),
        'show_external' => false,
        'default' => [
          'url' => '#',
          'is_external' => false,
          'nofollow' => false,
        ],
        'condition' => [
          'tp_footer_links_link_type' => '1',
        ],
        'label_block' => true,
      ]
    );

    $repeater->add_control(
      'tp_footer_links_page_link',
      [
        'label' => esc_html__('Select Menu Page', 'wprealizer'),
        'type' => Controls_Manager::SELECT2,
        'label_block' => true,
        'options' => tp_get_all_types_post('page'),
        'condition' => [
          'tp_footer_links_link_type' => '2',
        ]
      ]
    );


    $this->add_control(
      'tp_footer_links_list',
      [
        'label'       => esc_html__('Link List', 'wprealizer'),
        'type'        => Controls_Manager::REPEATER,
        'fields'      => $repeater->get_controls(),
        'default'     => [
          [
            'tp_footer_links_title'   => esc_html__('Projects', 'wprealizer'),
            'tp_footer_links_url'     => '#',
          ],
          [
            'tp_footer_links_title'   => esc_html__('What We Do', 'wprealizer'),
            'tp_footer_links_url'     => '#',
          ],
          [
            'tp_footer_links_title'   => esc_html__('About', 'wprealizer'),
            'tp_footer_links_url'     => '#',
          ],
        ],
        'title_field' => '{{{ tp_footer_links_title }}}',
      ]
    );


    $this->end_controls_section();
  }

  // style_tab_content
  protected function style_tab_content()
  {

    $this->tp_basic_style_controls('tp_footer_menu', 'Footer Links', ' .tp-el-footer-links ul li a');

    $this->start_controls_section(
      'tp_footer_links_list_spacing_sec',
      [
        'label' => esc_html__('Item', 'wprealizer'),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'tp_links_text_color',
      [
        'label' => esc_html__('Text Border Color', 'wprealizer'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .tp-el-footer-links a:after' => 'background: {{VALUE}}',
        ],
      ]
    );

    $this->add_control(
      'tp_footer_links_list_margin',
      [
        'label'      => esc_html__('Margin', 'wprealizer'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors'  => [
          '{{WRAPPER}} .tp-el-footer-links ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'tp_footer_links_list_padding',
      [
        'label'      => esc_html__('Padding', 'wprealizer'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors'  => [
          '{{WRAPPER}} .tp-el-footer-links ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
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
    $settings = $this->get_settings_for_display(); ?>

    <?php if ($settings['wpr_design_style'] == 'layout-2') : ?>

      <div class="wpr-footer-widget wpr-footer-widget-4 has-border tp-el-footer-links">
        <div class="wpr-footer-widget-link">

          <ul>

            <?php foreach ($settings['tp_footer_links_list'] as $menu) :

              if ('2' == $menu['tp_footer_links_link_type']) {
                $link = get_permalink($menu['tp_footer_links_page_link']);
                $target = '_self';
                $rel = 'nofollow';
              } else {
                $link = !empty($menu['tp_footer_links_link']['url']) ? $menu['tp_footer_links_link']['url'] : '';
                $target = !empty($menu['tp_footer_links_link']['is_external']) ? '_blank' : '';
                $rel = !empty($menu['tp_footer_links_link']['nofollow']) ? 'nofollow' : '';
              }

            ?>
              <li>
                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class=" tp-el-footer-link-item"><?php echo tp_kses($menu['tp_footer_links_title']); ?></a>
              </li>
            <?php endforeach; ?>

          </ul>

        </div>
      </div>

    <?php elseif ($settings['wpr_design_style'] == 'layout-3') : ?>

      <div class="wpr-header-right-list tp-el-footer-links">
        <ul class="d-flex align-items-center list-unstyled">
          <?php foreach ($settings['tp_footer_links_list'] as $menu) :

            if ('2' == $menu['tp_footer_links_link_type']) {
              $link = get_permalink($menu['tp_footer_links_page_link']);
              $target = '_self';
              $rel = 'nofollow';
            } else {
              $link = !empty($menu['tp_footer_links_link']['url']) ? $menu['tp_footer_links_link']['url'] : '';
              $target = !empty($menu['tp_footer_links_link']['is_external']) ? '_blank' : '';
              $rel = !empty($menu['tp_footer_links_link']['nofollow']) ? 'nofollow' : '';
            }

          ?>
            <li>
              <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class=" tp-el-footer-link-item"><?php echo tp_kses($menu['tp_footer_links_title']); ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    <?php else : ?>
      <div class="wpr-footer-3">
        <div class="wpr-footer-widget">
          <div class="wpr-footer-widget-link tp-el-footer-links">
            <ul>

              <?php foreach ($settings['tp_footer_links_list'] as $menu) :

                if ('2' == $menu['tp_footer_links_link_type']) {
                  $link = get_permalink($menu['tp_footer_links_page_link']);
                  $target = '_self';
                  $rel = 'nofollow';
                } else {
                  $link = !empty($menu['tp_footer_links_link']['url']) ? $menu['tp_footer_links_link']['url'] : '';
                  $target = !empty($menu['tp_footer_links_link']['is_external']) ? '_blank' : '';
                  $rel = !empty($menu['tp_footer_links_link']['nofollow']) ? 'nofollow' : '';
                }

              ?>
                <li>
                  <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class=" tp-el-footer-link-item"><?php echo tp_kses($menu['tp_footer_links_title']); ?></a>
                </li>
              <?php endforeach; ?>

            </ul>
          </div>
        </div>
      </div>
    <?php endif; ?>

<?php

  }
}

$widgets_manager->register(new TP_Footer_Links());
