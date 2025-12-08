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


if (!defined('ABSPATH'))
  exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Counter extends Widget_Base
{

  use WPR_Style_Trait, WPR_Icon_Trait, WPR_Animation_Trait, WPR_Column_Trait;

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
    return 'wpr-counter';
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
    return __(WPRCORE_THEME_NAME . ' - Counter', 'wprealizer');
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
    $this->start_controls_section(
      'wpr_layout',
      [
        'label' => esc_html__('Design Layout', 'wprealizer'),
      ]
    );

    $this->add_control(
      'wpr_design_style',
      [
        'label' => esc_html__('Select Layout', 'wprealizer'),
        'type' => Controls_Manager::SELECT,
        'options' => [
          'layout-1' => esc_html__('Layout 1', 'wprealizer'),
          'layout-2' => esc_html__('Layout 2', 'wprealizer'),
          'layout-3' => esc_html__('Layout 3', 'wprealizer'),
          'layout-4' => esc_html__('Layout 4', 'wprealizer'),
          'layout-5' => esc_html__('Layout 5', 'wprealizer'),
          'layout-6' => esc_html__('Layout 6', 'wprealizer'),
          'layout-7' => esc_html__('Layout 7', 'wprealizer'),
          'layout-8' => esc_html__('Layout 8', 'wprealizer'),
        ],
        'default' => 'layout-1',
      ]
    );

    $this->end_controls_section();

    /**
     * 
     * Start Content control
     */
    $this->start_controls_section(
      'wpr_counter_section_settings',
      [
        'label' => esc_html__('Counter Content', 'wprcore'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
        'repeater_condition',
        [
            'label' => __('Field condition', 'wprealizer'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'style_1' => __('Style 1', 'wprealizer'),
                'style_2' => __('Style 2', 'wprealizer'),
                'style_3' => __('Style 3', 'wprealizer'),
                'style_4' => __('Style 4', 'wprealizer'),
                'style_5' => __('Style 5', 'wprealizer'),
                'style_6' => __('Style 6', 'wprealizer'),
                'style_7' => __('Style 7', 'wprealizer'),
                'style_8' => __('Style 8', 'wprealizer'),
            ],
            'default' => 'style_1',
            'frontend_available' => true,
            'style_transfer' => true,
        ]
    );

    // animation Delay
    $repeater->add_control(
      'wpr_rep_animation_delay',
      [
        'label' => esc_html__('Animation Delay', 'wprcore'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => '.2s',
        'condition' => [
            'repeater_condition' => [ 'style_1', 'style_2', 'style_5', 'style_6', 'style_8']
        ]
      ]
    );

    // Number controll
    $repeater->add_control(
      'wpr_counter_number',
      [
        'label' => esc_html__('Number', 'wprcore'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 10,
      ]
    );
    // Number Prefix
    $repeater->add_control(
      'wpr_counter_prefix',
      [
        'label' => esc_html__('Prefix', 'wprcore'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__('1', 'wprcore'),
      ]
    );
    // Number Suffix
    $repeater->add_control(
      'wpr_counter_suffix',
      [
        'label' => esc_html__('Suffix', 'wprcore'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__('Plus', 'wprcore'),
      ]
    );
    // Title
    $repeater->add_control(
      'wpr_counter_title',
      [
        'label' => esc_html__('Title', 'wprcore'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__('Type your title here', 'wprcore'),
      ]
    );

    $repeater->add_control(
        'wpr_tag_icon_type',
        [
            'label' => esc_html__('Icon Type', 'wprealizer'),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => false,
            'options' => [
                'icon' => [
                    'title' => esc_html__('Icon', 'wprealizer'),
                    'icon' => 'eicon-nerd-wink',
                ],
                'image' => [
                    'title' => esc_html__('Image', 'wprealizer'),
                    'icon' => 'fa fa-image',
                ],
                'svg' => [
                    'title' => esc_html__('Svg', 'wprealizer'),
                    'icon' => 'fas fa-code',
                ],
            ],
            'default' => 'icon',
            'toggle' => false,
            'style_transfer' => true,
            'condition' => [
                'repeater_condition' => ['style_3']
            ]
        ]
    );

    $repeater->add_control(
        'image',
        [
            'label' => esc_html__('Image', 'wprealizer'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                'wpr_tag_icon_type' => 'image',
                'repeater_condition' => ['style_3']
            ],
        ]
    );

    $repeater->add_control(
        'icon',
        [
            'label' => esc_html__('Icon', 'wprealizer'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-star',
                'library' => 'solid',

            ],
            'condition' => [
                'wpr_tag_icon_type' => 'icon',
            ]
        ]
    );

    $repeater->add_control(
        'svg',
        [
            'type' => Controls_Manager::TEXTAREA,
            'label_block' => true,
            'label' => __('Svg Code', 'wprealizer'),
            'default' => __('Svg Code Here', 'wprealizer'),
            'placeholder' => __('Type Svg Code here', 'wprealizer'),
            'dynamic' => [
                'active' => true,
            ],
            'condition' => [
                'wpr_tag_icon_type' => 'svg',
            ],
        ]
    );

    $this->add_control(
      'wpr_counter_list',
      [
        'label' => esc_html__('Repeater List', 'wprcore'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'wpr_counter_title' => esc_html__('Active user', 'wprcore'),
            'wpr_counter_number' => esc_html__(10, 'wprcore'),
            'wpr_counter_suffix' => esc_html__('k', 'wprcore'),
          ],
          [
            'wpr_counter_title' => esc_html__('Total Download', 'wprcore'),
            'wpr_counter_number' => esc_html__(20, 'wprcore'),
            'wpr_counter_suffix' => esc_html__('k+', 'wprcore'),
          ],
        ],
        'title_field' => '{{{ wpr_counter_title }}}',
      ]
    );

    $this->end_controls_section();

    // animation
    $this->tp_creative_animation('layout-2', 'layout-1');


    $this->tp_columns('col', ['layout-40']);
  }

  // style_tab_content
  protected function style_tab_content()
  {

    $this->tp_section_style_controls('wpr_counter_section', 'Section - Style', '.wpr-el-section');
    $this->tp_basic_style_controls('wpr_counter_prefix', 'Counter - Prefix', '.wpr-el-counter-prefix');
    $this->tp_basic_style_controls('wpr_counter_number', 'Counter - Number', '.wpr-el-counter-number');
    $this->tp_basic_style_controls('wpr_counter_suffix', 'Counter - Suffix', '.wpr-el-counter-suffix');
    $this->tp_basic_style_controls('wpr_counter_title', 'Counter - Title', '.wpr-el-counter-title');
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
    $id = $this->get_id();
?>

  <?php if ($settings['wpr_design_style'] == 'layout-2') : ?>

  <!-- Funfact start -->
  <div class="funfact-v2 wpr_el-section">
    <div class="container">
      <div class="row">
        <?php foreach ($settings['wpr_counter_list'] as $key => $list) : ?>
          <div class="col-sm-6 col-md-4 fade_up_anim" data-delay="<?php esc_attr($list['wpr_rep_animation_delay']); ?>">
            <div class="funfact-mar__item">
              <?php
              $counter_prefix = $list['wpr_counter_prefix'] ? '<span class="wpr-el-counter-prefix">' . $list['wpr_counter_prefix'] . '</span>' : '';
              $counter_number = !empty($list['wpr_counter_number']) ? '<span class="wpr-el-counter-number odometer count" data-odometer-final="' . esc_attr($list['wpr_counter_number']) . '"></span>' : '';
              $counter_suffix = $list['wpr_counter_suffix'] ? '<span class="wpr-el-counter-suffix">' . $list['wpr_counter_suffix'] . '</span>' : '';
              $allowed_html = [
                  'span' => [
                      'class' => [],
                      'data-odometer-final' => [],
                  ],
              ];

              printf('<h3 class="h3 countdown-info st-counter-number">%1$s%2$s%3$s</h3>', tp_kses($counter_prefix), wp_kses($counter_number, $allowed_html), tp_kses($counter_suffix));
              printf(tp_kses('<p class="wpr-el-counter-title info">%1$s</p>'), $list['wpr_counter_title']);
              ?>
            </div>
          </div>
        <?php endforeach; ?> 
      </div>
    </div>
  </div>

    <?php elseif ($settings['wpr_design_style'] == 'layout-3') : ?>

          <!-- Funfact__area start  -->
          <div class="funfact__area overflow-hidden">
            <div class="container container-4xl custom-container">
              <div class="funfact__items swiper">
                <div class="swiper-wrapper">
                  <?php foreach ($settings['wpr_counter_list'] as $key => $list) : 
                      $allowed_html = [
                          'span' => [
                              'class' => [],
                              'data-odometer-final' => [],
                          ],
                      ];
                    ?>
                  <div class="funfact__item swiper-slide">
                    <div class="funfact__content">
                      <p><?php echo tp_kses($list['wpr_counter_title']); ?></p>

                        <?php if ($list['wpr_tag_icon_type'] === 'image' && ($list['image']['url'] || $list['image']['id'])):
                            $this->get_render_attribute_string('image');
                            $list['hover_animation'] = 'disable-animation';
                        ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html($list, 'image'); ?>
                        <?php elseif (!empty($list['icon'])): ?>
                            <?php \Elementor\Icons_Manager::render_icon($list['icon'], ['aria-hidden' => 'true']); ?>
                        <?php elseif (!empty($list['svg'])): ?>
                            <?php echo $list['svg']; ?>
                        <?php endif; ?>
                    </div>
                    <h3 class="h3 funfact__count">
                        <span class="odometer" data-odometer-final="<?php echo wp_kses($list['wpr_counter_number'], true); ?>">0</span >&nbsp; <?php echo tp_kses($list['wpr_counter_suffix']); ?>
                    </h3>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- Funfact__area end  -->

    <?php elseif ($settings['wpr_design_style'] == 'layout-4') : ?>

    <div class="funfacts wpr_el-section">
      <?php foreach ($settings['wpr_counter_list'] as $key => $list) : ?>
      <div class="funfacts__item fade_up_anim" data-delay="<?php esc_attr($list['wpr_rep_animation_delay']); ?>">
        <div class="inner-content">
              <?php
              $counter_prefix = !empty($list['wpr_counter_prefix']) ? '<span class="wpr-el-counter-prefix">' . esc_html($list['wpr_counter_prefix']) . '</span>' : '';
              $counter_number = !empty($list['wpr_counter_number']) ? '<span class="wpr-el-counter-number odometer" data-odometer-final="' . esc_attr($list['wpr_counter_number']) . '"></span>' : '';
              $counter_suffix = !empty($list['wpr_counter_suffix']) ? '<em class="wpr-el-counter-suffix">' . esc_html($list['wpr_counter_suffix']) . '</em>' : '';

              $allowed_html = [
                  'span' => [
                      'class' => [],
                      'data-odometer-final' => [],
                  ],
              ];

              printf('<h4 class="h4">%1$s%2$s%3$s</h4>', tp_kses($counter_prefix), wp_kses($counter_number, $allowed_html), tp_kses($counter_suffix));
              printf(tp_kses('<p class="wpr-el-counter-title info">%1$s</p>'), esc_html($list['wpr_counter_title']));
              ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php elseif ($settings['wpr_design_style'] == 'layout-5') : ?>

      <div class="funfacts-health__items">
        <?php foreach ($settings['wpr_counter_list'] as $key => $list) : ?>
        <div class="funfacts-health__item fade_up_anim"  data-delay="<?php esc_attr($list['wpr_rep_animation_delay']); ?>">
          <div class="inner-content">
            <?php
            $counter_prefix = !empty($list['wpr_counter_prefix']) ? '<span class="wpr-el-counter-prefix">' . esc_html($list['wpr_counter_prefix']) . '</span>' : '';
            $counter_number = !empty($list['wpr_counter_number']) ? '<span class="wpr-el-counter-number odometer count" data-odometer-final="' . esc_attr($list['wpr_counter_number']) . '"></span>' : '';
            $counter_suffix = !empty($list['wpr_counter_suffix']) ? '<em class="wpr-el-counter-suffix">' . esc_html($list['wpr_counter_suffix']) . '</em>' : '';

            $allowed_html = [
                'span' => [
                    'class' => [],
                    'data-odometer-final' => [],
                ],
            ];

            printf('<h2 class="h2">%1$s%2$s%3$s</h2>', tp_kses($counter_prefix), wp_kses($counter_number, $allowed_html), tp_kses($counter_suffix));
            printf(tp_kses('<p class="wpr-el-counter-title info">%1$s</p>'), esc_html($list['wpr_counter_title']));

            ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    <?php elseif ($settings['wpr_design_style'] == 'layout-6') : ?>

        <div class="about-ad__funfacts">
            <?php foreach ($settings['wpr_counter_list'] as $key => $list) : ?>
            <div class="funfact fade_up_anim" data-delay="<?php esc_attr($list['wpr_rep_animation_delay']); ?>">
                <div class="funfact__wrapper">
                    <p><?php echo ($list['wpr_counter_title']); ?></p>
                    <h2 class="h2 odometer wpr-el-counter-title" data-odometer-final="<?php echo wp_kses($list['wpr_counter_number'], true); ?>">0</h2>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($settings['wpr_design_style'] == 'layout-7') : ?>

      <?php foreach ($settings['wpr_counter_list'] as $key => $list) : ?>
      <div class="about-fin__experience">
          <?php
          $counter_prefix = !empty($list['wpr_counter_prefix']) ? '<span class="wpr-el-counter-prefix">' . esc_html($list['wpr_counter_prefix']) . '</span>' : '';
          $counter_number = !empty($list['wpr_counter_number']) ? '<span class="wpr-el-counter-number odometer count" data-odometer-final="' . esc_attr($list['wpr_counter_number']) . '"></span>' : '';
          $counter_suffix = !empty($list['wpr_counter_suffix']) ? '<span class="wpr-el-counter-suffix">' . esc_html($list['wpr_counter_suffix']) . '</span>' : '';

          $allowed_html = [
              'span' => [
                  'class' => [],
                  'data-odometer-final' => [],
              ],
          ];

          printf('<h3 class="h3 experience ">%1$s%2$s%3$s</h3>', tp_kses($counter_prefix), wp_kses($counter_number, $allowed_html), tp_kses($counter_suffix));
          printf(tp_kses('<p class="wpr-el-counter-title info">%1$s</p>'), esc_html($list['wpr_counter_title']));

          ?>
      </div>
      <?php endforeach; ?>

    <?php elseif ($settings['wpr_design_style'] == 'layout-8') : ?>

      <div class="about-fit__counters">
        <?php foreach ($settings['wpr_counter_list'] as $key => $list) : ?>
        <div class="about-fit__counters-item fade_up_anim" data-delay="<?php esc_attr($list['wpr_rep_animation_delay']); ?>">
          <div class="counter">
            <?php
            $counter_prefix = !empty($list['wpr_counter_prefix']) ? '<span class="wpr-el-counter-prefix">' . esc_html($list['wpr_counter_prefix']) . '</span>' : '';
            $counter_number = !empty($list['wpr_counter_number']) ? '<span class="wpr-el-counter-number odometer count" data-odometer-final="' . esc_attr($list['wpr_counter_number']) . '"></span>' : '';
            $counter_suffix = !empty($list['wpr_counter_suffix']) ? '<span class="wpr-el-counter-suffix">' . esc_html($list['wpr_counter_suffix']) . '</span>' : '';

            $allowed_html = [
                'span' => [
                    'class' => [],
                    'data-odometer-final' => [],
                ],
            ];

            printf('<h3 class="h3">%1$s%2$s%3$s</h3>', tp_kses($counter_prefix), wp_kses($counter_number, $allowed_html), tp_kses($counter_suffix));
            printf(tp_kses('<p class="wpr-el-counter-title info">%1$s</p>'), esc_html($list['wpr_counter_title']));
            ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>


    <?php else : ?>
      <!-- Funfact start -->
      <div class="funfact-digital wpr_el-section">
        <div class="container">
          <div class="row">
            <?php foreach ($settings['wpr_counter_list'] as $key => $list) : ?>
              <div class="col-sm-6 col-lg-3 funfact-digital__item fade_up_anim" data-delay="<?php esc_attr($list['wpr_rep_animation_delay']); ?>">
                <div class="counter funfact-digital__counter">
                <?php
                $counter_prefix = !empty($list['wpr_counter_prefix']) ? '<span class="wpr-el-counter-prefix">' . esc_html($list['wpr_counter_prefix']) . '</span>' : '';
                $counter_number = !empty($list['wpr_counter_number']) ? '<span class="wpr-el-counter-number odometer count" data-odometer-final="' . esc_attr($list['wpr_counter_number']) . '"></span>' : '';
                $counter_suffix = !empty($list['wpr_counter_suffix']) ? '<span class="wpr-el-counter-suffix">' . esc_html($list['wpr_counter_suffix']) . '</span>' : '';

                $allowed_html = [
                    'span' => [
                        'class' => [],
                        'data-odometer-final' => [],
                    ],
                ];

                printf('<h3 class="h3 countdown-info st-counter-number">%1$s%2$s%3$s</h3>', tp_kses($counter_prefix), wp_kses($counter_number, $allowed_html), tp_kses($counter_suffix));
                printf(tp_kses('<p class="wpr-el-counter-title info">%1$s</p>'), esc_html($list['wpr_counter_title']));
                ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <!-- Funfact End -->

    <?php endif; ?>

<?php
  }
}

$widgets_manager->register(new WPR_Counter());
