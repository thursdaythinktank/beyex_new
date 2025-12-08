<?php
class TpFooterPost
{

    private $type = 'wpr-footer';
    private $slug;
    private $name;
    private $plural_name;

    public function __construct()
    {
        $this->name = __('Footer', 'wprealizer');
        $this->slug = 'wpr-footer';
        $this->plural_name = __('Footer', 'wprealizer');

        add_action('init', array($this, 'register_custom_post_type'));
    }



    public function register_custom_post_type()
    {

        $icon = WPRCORE_ADDONS_URL . '/assets/img/icons/menu-icon.png';
        $labels = array(
            'name' => $this->name,
            'singular_name' => $this->name,
            'add_new' => sprintf(__('Add New Template', 'wprealizer'), $this->name),
            'add_new_item' => sprintf(__('Add New %s', 'wprealizer'), $this->name),
            'edit_item' => sprintf(__('Edit %s', 'wprealizer'), $this->name),
            'new_item' => sprintf(__('New %s', 'wprealizer'), $this->name),
            'all_items' => sprintf(__('All Templates', 'wprealizer'), $this->plural_name),
            'view_item' => sprintf(__('View %s', 'wprealizer'), $this->name),
            'search_items' => sprintf(__('Search %s', 'wprealizer'), $this->name),
            'not_found' => sprintf(__('No %s found', 'wprealizer'), strtolower($this->name)),
            'not_found_in_trash' => sprintf(__('No %s found in Trash', 'wprealizer'), strtolower($this->name)),
            'parent_item_colon' => '',
            'menu_name' => $this->name,
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'rewrite' => ['slug' => $this->slug],
            'menu_position' => 10,
            'supports' => ['title', 'editor', 'thumbnail', 'page-attributes', 'elementor'],
            'menu_icon' => 'dashicons-admin-page'
        );

        register_post_type($this->type, $args);
        $cpt_support = get_option('elementor_cpt_support');
        if (!$cpt_support) {
            $cpt_support = ['page', 'post', 'wpr-header', 'wpr-footer', 'elementor_disable_color_schemes']; //create array of our default supported post types
            update_option('elementor_cpt_support', $cpt_support); //write it to the database
        }
    }
}

new TpFooterPost();
