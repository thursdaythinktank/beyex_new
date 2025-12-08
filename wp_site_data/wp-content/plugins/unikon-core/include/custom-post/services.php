<?php
class TpServicesPost
{
	function __construct()
	{
		add_action('init', array($this, 'register_custom_post_type'));
		add_action('init', array($this, 'create_cat'));
		add_filter('template_include', array($this, 'services_template_include'));
	}

	public function services_template_include($template)
	{
		if (is_singular('wpr-services')) {
			return $this->get_template('single-wpr-services.php');
		}
		return $template;
	}

	public function get_template($template)
	{
		if ($theme_file = locate_template(array($template))) {
			$file = $theme_file;
		} else {
			$file = WPRCORE_ADDONS_DIR . '/include/template/' . $template;
		}
		return apply_filters(__FUNCTION__, $file, $template);
	}


	public function register_custom_post_type()
	{
		$ishpat_services_slug = get_theme_mod('ishpat_services_slug', __('wpr-services', 'wprealizer'));
		$labels = array(
			'name'                  => esc_html_x('Services', 'Post Type General Name', 'wprealizer'),
			'singular_name'         => esc_html_x('Service', 'Post Type Singular Name', 'wprealizer'),
			'menu_name'             => esc_html__('Services', 'wprealizer'),
			'name_admin_bar'        => esc_html__('Services', 'wprealizer'),
			'archives'              => esc_html__('Item Archives', 'wprealizer'),
			'parent_item_colon'     => esc_html__('Parent Item:', 'wprealizer'),
			'all_items'             => esc_html__('All Items', 'wprealizer'),
			'add_new_item'          => esc_html__('Add New Service', 'wprealizer'),
			'add_new'               => esc_html__('Add New', 'wprealizer'),
			'new_item'              => esc_html__('New Item', 'wprealizer'),
			'edit_item'             => esc_html__('Edit Item', 'wprealizer'),
			'update_item'           => esc_html__('Update Item', 'wprealizer'),
			'view_item'             => esc_html__('View Item', 'wprealizer'),
			'search_items'          => esc_html__('Search Item', 'wprealizer'),
			'not_found'             => esc_html__('Not found', 'wprealizer'),
			'not_found_in_trash'    => esc_html__('Not found in Trash', 'wprealizer'),
			'featured_image'        => esc_html__('Featured Image', 'wprealizer'),
			'set_featured_image'    => esc_html__('Set featured image', 'wprealizer'),
			'remove_featured_image' => esc_html__('Remove featured image', 'wprealizer'),
			'use_featured_image'    => esc_html__('Use as featured image', 'wprealizer'),
			'inserbt_into_item'     => esc_html__('Insert into item', 'wprealizer'),
			'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'wprealizer'),
			'items_list'            => esc_html__('Items list', 'wprealizer'),
			'items_list_navigation' => esc_html__('Items list navigation', 'wprealizer'),
			'filter_items_list'     => esc_html__('Filter items list', 'wprealizer'),
		);

		$args   = array(
			'label'                 => esc_html__('Service', 'wprealizer'),
			'labels'                => $labels,
			'supports'              => ['title', 'editor', 'thumbnail', 'elementor'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-media-document',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => $ishpat_services_slug,
				'with_front' => false
			),
		);

		register_post_type('wpr-services', $args);
	}

	public function create_cat()
	{
		$labels = array(
			'name'                       => esc_html_x('Service Categories', 'Taxonomy General Name', 'wprealizer'),
			'singular_name'              => esc_html_x('Service Categories', 'Taxonomy Singular Name', 'wprealizer'),
			'menu_name'                  => esc_html__('Service Categories', 'wprealizer'),
			'all_items'                  => esc_html__('All Service Category', 'wprealizer'),
			'parent_item'                => esc_html__('Parent Item', 'wprealizer'),
			'parent_item_colon'          => esc_html__('Parent Item:', 'wprealizer'),
			'new_item_name'              => esc_html__('New Service Category Name', 'wprealizer'),
			'add_new_item'               => esc_html__('Add New Service Category', 'wprealizer'),
			'edit_item'                  => esc_html__('Edit Service Category', 'wprealizer'),
			'update_item'                => esc_html__('Update Service Category', 'wprealizer'),
			'view_item'                  => esc_html__('View Service Category', 'wprealizer'),
			'separate_items_with_commas' => esc_html__('Separate items with commas', 'wprealizer'),
			'add_or_remove_items'        => esc_html__('Add or remove items', 'wprealizer'),
			'choose_from_most_used'      => esc_html__('Choose from the most used', 'wprealizer'),
			'popular_items'              => esc_html__('Popular Service Category', 'wprealizer'),
			'search_items'               => esc_html__('Search Service Category', 'wprealizer'),
			'not_found'                  => esc_html__('Not Found', 'wprealizer'),
			'no_terms'                   => esc_html__('No Service Category', 'wprealizer'),
			'items_list'                 => esc_html__('Service Category list', 'wprealizer'),
			'items_list_navigation'      => esc_html__('Service Category list navigation', 'wprealizer'),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('services-cat', 'wpr-services', $args);
	}
}

new TpServicesPost();
