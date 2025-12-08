<?php

namespace WPRCore\Widgets;

use Elementor\Controls_Manager;
use \Elementor\Utils;

trait WPR_Icon_Trait
{

    protected function tp_single_icon_control($control_id = null, $condition_key = null, $conditions_value = 'layout-1')
    {


        $this->add_control(
            'tp_' . $control_id . '_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'wprealizer'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'wprealizer'),
                    'icon' => esc_html__('Icon', 'wprealizer'),
                    'svg' => esc_html__('SVG', 'wprealizer'),
                ],
                'condition' => [
                    $condition_key => $conditions_value
                ]
            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_image',
            [
                'label' => esc_html__('Upload Icon Image', 'wprealizer'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_' . $control_id . '_icon_type' => 'image',
                    $condition_key => $conditions_value
                ]

            ]
        );

        $this->add_control(
            'tp_' . $control_id . '_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'wprealizer'),
                'condition' => [
                    'tp_' . $control_id . '_icon_type' => 'svg',
                    $condition_key => $conditions_value
                ]
            ]
        );


        $this->add_control(
            'tp_' . $control_id . '_icon',
            [
                'label' => esc_html__('Icon', 'wprealizer'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-regular fa-arrow-right',
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
                    'tp_' . $control_id . '_icon_type' => 'icon',
                    $condition_key => $conditions_value
                ],
            ]
        );
    }

    /**
     * Daynamic Icon Trait
     * 
     */
    function tp_icon_show($data)
    {
        if ($data['tp_box_icon_type'] == 'icon'): ?>
            <?php if (!empty($data['tp_box_icon']) || !empty($data['tp_box_selected_icon']['value'])): ?>
                <?php tp_render_icon($data, 'tp_box_icon', 'tp_box_selected_icon'); ?>
            <?php endif; ?>
        <?php elseif ($data['tp_box_icon_type'] == 'image'): ?>
            <?php if (!empty($data['tp_box_icon_image']['url'])): ?>
                <img src="<?php echo $data['tp_box_icon_image']['url']; ?>"
                    alt="<?php echo get_post_meta(attachment_url_to_postid($data['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
            <?php endif; ?>
        <?php else: ?>
            <?php if (!empty($data['tp_box_icon_svg'])): ?>
                <?php echo $data['tp_box_icon_svg']; ?>
            <?php endif; ?>
<?php endif;
    }
}
