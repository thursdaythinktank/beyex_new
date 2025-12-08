<?php

class WPRealizer_Nav_Megamenu_Switch 
{
    private static $instance;

    public static function get_instance() {
        if ( ! self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action('wp_nav_menu_item_custom_fields', [ $this , 'wprealizer_nav_menu_item_custom_fields' ], 10, 4 );
        add_action('wp_update_nav_menu_item', [ $this , 'wprealizer_nav_menu_item_custom_fields_save' ], 10, 2 );
        add_filter('wp_get_nav_menu_items', [ $this , 'wprealizer_nav_menu_item_custom_fields_load' ]);
        add_filter('nav_menu_css_class', [ $this , 'wprealizer_nav_menu_css_class' ], 10, 2 );
    }

    public function wprealizer_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
        $checked = !empty($item->custom_switch) ? 'checked' : '';
        $selected_value = !empty($item->megamenu_layout) ? esc_attr($item->megamenu_layout) : '';

        ?>
        <p class="description description-wide">
            <label for="edit-menu-item-switch-<?php echo esc_attr($item_id); ?>">
                <?php _e('Enable Megamenu'); ?><br>
                <label class="wprealizer-switch">
                    <input type="checkbox" id="edit-menu-item-switch-<?php echo esc_attr($item_id); ?>" name="menu-item-switch[<?php echo esc_attr($item_id); ?>]" value="1" <?php echo $checked; ?>>
                    <span class="slider round"></span>
                </label>
            </label>
        </p>
        <p class="description description-wide wprealizer-megamenu-layout" style="display: <?php echo $checked ? 'block' : 'none'; ?>">
            <label for="edit-menu-item-layout-<?php echo esc_attr($item_id); ?>">
                <?php _e('Megamenu Layout'); ?><br>
                <select id="edit-menu-item-layout-<?php echo esc_attr($item_id); ?>" name="menu-item-layout[<?php echo esc_attr($item_id); ?>]">
                    <option value="" <?php selected($selected_value, ''); ?>><?php _e('Select Layout'); ?></option>
                    <option value="tp-static wprealizer-megamenu-width-1" <?php selected($selected_value, 'tp-static wprealizer-megamenu-width-1'); ?>><?php _e('Width: 1200 PX'); ?></option>
                    <option value="wprealizer-megamenu-width-2" <?php selected($selected_value, 'wprealizer-megamenu-width-2'); ?>><?php _e('Width: 580 PX'); ?></option>
                    <option value="tp-static wprealizer-megamenu-width-3" <?php selected($selected_value, 'tp-static wprealizer-megamenu-width-3'); ?>><?php _e('Width: 90%'); ?></option>
                    <option value="tp-static wprealizer-megamenu-width-4" <?php selected($selected_value, 'tp-static wprealizer-megamenu-width-4'); ?>><?php _e('Width: 1075 PX'); ?></option>
                    <option value="tp-static wprealizer-megamenu-width-5" <?php selected($selected_value, 'tp-static wprealizer-megamenu-width-5'); ?>><?php _e('Width: 590 PX'); ?></option>
                </select>
            </label>
        </p>
        <script>
            jQuery(document).ready(function($) {
                $('#edit-menu-item-switch-<?php echo esc_attr($item_id); ?>').change(function() {
                    if ($(this).is(':checked')) {
                        $(this).closest('p').next('.wprealizer-megamenu-layout').show();
                    } else {
                        $(this).closest('p').next('.wprealizer-megamenu-layout').hide();
                    }
                });
            });
        </script>
        <?php
    }

    public function wprealizer_nav_menu_item_custom_fields_save($menu_id, $menu_item_db_id) {
        if (isset($_POST['menu-item-switch'][$menu_item_db_id])) {
            $custom_switch = sanitize_text_field($_POST['menu-item-switch'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_switch', $custom_switch);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_switch');
        }

        if (isset($_POST['menu-item-layout'][$menu_item_db_id])) {
            $megamenu_layout = sanitize_text_field($_POST['menu-item-layout'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_layout', $megamenu_layout);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_layout');
        }
    }

    public function wprealizer_nav_menu_item_custom_fields_load( $menu_items ) {
        foreach ( $menu_items as $menu_item ) {
            $menu_item->custom_switch = get_post_meta($menu_item->ID, '_menu_item_switch', true);
            $menu_item->megamenu_layout = get_post_meta($menu_item->ID, '_menu_item_layout', true);
        }
        return $menu_items;
    }

    public function wprealizer_nav_menu_css_class( $classes, $item ) {
        if ( ! empty( $item->custom_switch ) ) {
            $classes[] = '';
            if ( ! empty( $item->megamenu_layout ) ) {
                $classes[] =  $item->megamenu_layout;
            }
        }
        return $classes;
    }
}

WPRealizer_Nav_Megamenu_Switch::get_instance();
