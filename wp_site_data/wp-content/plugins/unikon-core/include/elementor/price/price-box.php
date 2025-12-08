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

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Wpr Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class WPR_Price_Box extends Widget_Base
{

    use \WPRCore\Widgets\WPR_Style_Trait;
    use \WPRCore\Widgets\WPR_Animation_Trait;

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
        return 'wpr-price-box';
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
        return __(WPRCORE_THEME_NAME . ' :: Price Box', 'wprealizer');
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

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    private static function get_currency_symbol_text($symbol_text)
    {
        $symbols = [
            'baht' => 'THB',
            'bdt' => 'BDT',
            'dollar' => 'USD',
            'euro' => 'EUR',
            'franc' => 'EUR',
            'guilder' => 'GLD',
            'indian_rupee' => 'INR',
            'pound' => 'GBP',
            'peso' => 'MXN',
            'lira' => 'TRY',
            'ruble' => 'RUB',
            'shekel' => 'ILS',
            'real' => 'BRL',
            'krona' => 'KR',
            'won' => 'KRW',
            'yen' => 'JPY',
        ];

        return isset($symbols[$symbol_text]) ? $symbols[$symbol_text] : '';
    }


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
                    // 'layout-2' => esc_html__('Layout 2', 'wprealizer'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => __('Pricing', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __('Currency', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'wprealizer'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'wprealizer'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'wprealizer'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'wprealizer'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'wprealizer'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'wprealizer'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'wprealizer'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'wprealizer'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'wprealizer'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'wprealizer'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'wprealizer'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'wprealizer'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'wprealizer'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'wprealizer'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'wprealizer'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'wprealizer'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'wprealizer'),
                    'custom' => __('Custom', 'wprealizer'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => __('Custom Symbol', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price_duration',
            [
                'label' => __('Duration', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => '/monthly',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'price_main',
            [
                'label' => __('Price', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => '59.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'wpr_pricing_header',
            [
                'label' => esc_html__('Header Controls', 'wprealizer'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wpr_pricing_active_switcher',
            [
                'label' => esc_html__('Is Active Price?', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'wprealizer'),
                'label_off' => esc_html__('Hide', 'wprealizer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'wpr_pricing_header_subtitle',
            [
                'label' => esc_html__('Subtitle', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('This is subtitle', 'wprealizer'),
                'placeholder' => esc_html__('Your Text', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'wpr_pricing_header_title',
            [
                'label' => esc_html__('Title', 'wprealizer'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Gold Membership', 'wprealizer'),
                'placeholder' => esc_html__('Your Gold Membership Text', 'wprealizer'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_features',
            [
                'label' => __('Features', 'wprealizer'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_feature_switcher',
            [
                'label' => esc_html__('Active Feature', 'wprealizer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'wprealizer'),
                'label_off' => esc_html__('No', 'wprealizer'),
                'return_value' => 'yes',
                'default' => '0',

            ]
        );
        $repeater->add_control(
            'tp_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'wprealizer'),
                    'icon' => esc_html__('Icon', 'wprealizer'),
                    'svg' => esc_html__('SVG', 'wprealizer'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'tp_features_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'wprealizer'),
                'condition' => [
                    'tp_features_icon_type' => 'svg'
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-smile',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
                'condition' => [
                    'tp_features_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'feature_text',
            [
                'label' => __('Feature Text', 'wprealizer'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature', 'wprealizer'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'feature_text' => __('Standard Feature', 'wprealizer'),
                        'tp_check_icon' => 'fa fa-check',
                    ],
                    [
                        'feature_text' => __('Another Great Feature', 'wprealizer'),
                        'tp_check_icon' => 'fa fa-check',
                    ],
                    [
                        'feature_text' => __('Obsolete Feature', 'wprealizer'),
                        'tp_check_icon' => 'fa fa-close',
                    ],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        $this->end_controls_section();

        // price_btn
        $this->tp_link_render_controls('price_btn', 'Button');

        // animation
        $this->tp_creative_animation(['layout-1']);
    }

    protected function style_tab_content()
    {
        $this->tp_section_style_controls('section', 'Section', '.wpr-el-section');
        $this->tp_basic_style_controls('pricing_heading_title', 'Heading Title', '.wpr-el-title');
        $this->tp_basic_style_controls('pricing_heading_desc', 'Heading Description', '.wpr-el-desc');

        $this->tp_basic_style_controls('pricing_heading_symbol', 'Heading Symbol', '.wpr-el-symbol');
        $this->tp_basic_style_controls('pricing_heading_price', 'Heading Price', '.wpr-el-price');
        $this->tp_basic_style_controls('pricing_heading_month', 'Heading Month', '.wpr-el-month');

        // feature item

        $this->start_controls_section(
            'wpr_pricing_f_sec',
            [
                'label' => esc_html__('Feature Item', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpr_pricing_f_tab_typo',
                'label' => esc_html__('Active Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .wpr-el-f-title',
            ]
        );
        $this->start_controls_tabs(
            'wpr_pricing_f_tabs',
        );

        $this->start_controls_tab(
            'wpr_pricing_f_tab_active',
            [
                'label' => esc_html__('Active', 'textdomain'),
            ]
        );

        $this->add_control(
            'wpr_pricing_f_tab_active_color',
            [
                'label' => esc_html__('Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-f-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        // inactive 
        $this->start_controls_tab(
            'wpr_pricing_f_tab_inactive',
            [
                'label' => esc_html__('Inactive', 'textdomain'),
            ]
        );

        $this->add_control(
            'wpr_pricing_f_tab_inactive_color',
            [
                'label' => esc_html__('Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-el-f-title.inactive' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();


        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->tp_link_controls_style('', 'pricing_btn', 'Button', '.wpr-el-price-btn');
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

        <?php if ($settings['wpr_design_style'] == 'layout-2'):
            $control_id = 'price_btn';

            $animation = $this->tp_animation_show($settings);

            if ($settings['currency'] === 'custom') {
                $currency = $settings['currency_custom'];
            } else {
                $currency = self::get_currency_symbol($settings['currency']);
            }

            $is_active_price = $settings['wpr_pricing_active_switcher'] == 'yes' ? true : false;
            $active_class = $is_active_price ? 'active' : '';

            $btn_class = $is_active_price ? 'wpr-btn-4' : 'wpr-btn-4';

            $this->tp_link_attributes_render('price_btn', '' . $btn_class . '  wpr-el-price-btn wpr-btn-4', $this->get_settings());
        ?>

            <div class="wpr-pricing-5-item wpr-pricing-inner-head wpr-el-section <?php echo esc_attr($active_class); ?> mb-40 <?php echo esc_attr($animation['animation']); ?>"
                <?php echo $animation['duration'] . ' ' . $animation['delay']; ?> <?php if ($is_active_price): ?> <?php endif; ?>>
                <div class="wpr-pricing-5-head wpr-pricing-inner-head">

                    <?php if (!empty($settings['wpr_pricing_header_title'])): ?>
                        <h4 class="wpr-pricing-5-head-title wpr-el-title">
                            <?php echo tp_kses($settings['wpr_pricing_header_title']); ?>
                        </h4>
                    <?php endif; ?>

                    <?php if (!empty($settings['wpr_pricing_header_subtitle'])): ?>
                        <span class="wpr-el-desc">
                            <?php echo tp_kses($settings['wpr_pricing_header_subtitle']); ?>
                        </span>
                    <?php endif; ?>

                    <h2 class="wpr-pricing-5-price wpr-el-price">
                        <span class="wpr-price-monthly wpr-el-symbol">
                            <?php echo esc_html($currency); ?>
                        </span>
                        <?php echo tp_kses($settings['price_main']); ?>
                        <b class="wpr-el-month"><?php echo tp_kses($settings['price_duration']); ?></b>
                    </h2>
                </div>
                <div class="wpr-pricing-5-list">
                    <ul>
                        <?php foreach ($settings['features_list'] as $key => $item):

                            $is_active_feature = $item['tp_feature_switcher'] == 'yes' ? true : false;
                            $active_feature_class = $is_active_feature ? 'inactive' : '';
                        ?>
                            <li class="wpr-el-f-title <?php echo esc_attr($active_feature_class); ?>">
                                <?php tp_render_signle_icon_html($item, 'features') ?>
                                <?php echo tp_kses($item['feature_text']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                    <div class="wpr-pricing-inner-btn">
                        <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                            <?php echo $settings['tp_' . $control_id . '_text']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        <?php else:

            $control_id = 'price_btn';

            $animation = $this->tp_animation_show($settings);

            if ($settings['currency'] === 'custom') {
                $currency = $settings['currency_custom'];
            } else {
                $currency = self::get_currency_symbol($settings['currency']);
            }

            $is_active_price = $settings['wpr_pricing_active_switcher'] == 'yes' ? true : false;
            $active_class = $is_active_price ? 'active' : '';

            $btn_class = $is_active_price ? '' : '';

            $this->tp_link_attributes_render('price_btn', '' . $btn_class . '  wpr-el-price-btn pricing-fit__item-buy-plan', $this->get_settings());
        ?>


            <div class="pricing-fit__item <?php echo esc_attr($animation['animation']); ?> fade_up_anim wpr-el-section <?php echo esc_attr($active_class); ?>" data-delay=".2" <?php echo $animation['duration'] . ' ' . $animation['delay']; ?>>
                <?php if (!empty($settings['wpr_pricing_header_subtitle'])): ?>
                <span class="pricing-fit__item-package wpr-el-subtitle">
                    <?php echo tp_kses($settings['wpr_pricing_header_subtitle']); ?> 
                </span>
                <?php endif; ?>

                <?php if (!empty($settings['wpr_pricing_header_title'])): ?>
                <h4 class="h4 pricing-fit__item-price wpr-el-title"><?php echo tp_kses($settings['wpr_pricing_header_title']); ?> - <?php echo tp_kses($settings['price_main']); ?><?php echo esc_html($currency); ?></h4>
                <?php endif; ?>

                <ul class="custom-ul pricing-fit__item-facilitys">
                    <?php foreach ($settings['features_list'] as $key => $item):
                        $is_active_feature = $item['tp_feature_switcher'] == 'yes' ? true : false;
                        $active_feature_class = $is_active_feature ? 'inactive' : '';
                    ?>
                        <li class="wpr-el-f-title <?php echo esc_attr($active_feature_class); ?>">
                            <?php tp_render_signle_icon_html($item, 'features') ?>
                            <?php echo tp_kses($item['feature_text']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>


                <?php if (!empty($settings['tp_' . $control_id . '_text']) && $settings['tp_' . $control_id . '_button_show'] == 'yes'): ?>
                <a <?php echo $this->get_render_attribute_string('tp-button-arg' . $control_id . ''); ?>>
                    <?php echo $settings['tp_' . $control_id . '_text']; ?>
                </a>
                <?php endif; ?>
            </div>

<?php endif;
    }
}

$widgets_manager->register(new WPR_Price_Box());
