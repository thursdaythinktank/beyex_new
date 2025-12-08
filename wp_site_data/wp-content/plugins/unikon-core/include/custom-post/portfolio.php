<?php
class TpPortfoliosPost
{
	function __construct()
	{
		add_action('init', array($this, 'register_custom_post_type'));
		add_action('init', array($this, 'create_cat'));
		add_filter('template_include', array($this, 'portfolios_template_include'));
	}

	public function portfolios_template_include($template)
	{
		if (is_singular('wpr-portfolios')) {
			return $this->get_template('single-wpr-portfolios.php');
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
		$ishpat_portfolios_slug = get_theme_mod('ishpat_portfolios_slug', __('wpr-portfolios', 'wprealizer'));
		$labels = array(
			'name'                  => esc_html_x('Portfolios', 'Post Type General Name', 'wprealizer'),
			'singular_name'         => esc_html_x('Portfolio', 'Post Type Singular Name', 'wprealizer'),
			'menu_name'             => esc_html__('Portfolios', 'wprealizer'),
			'name_admin_bar'        => esc_html__('Portfolios', 'wprealizer'),
			'archives'              => esc_html__('Item Archives', 'wprealizer'),
			'parent_item_colon'     => esc_html__('Parent Item:', 'wprealizer'),
			'all_items'             => esc_html__('All Items', 'wprealizer'),
			'add_new_item'          => esc_html__('Add New Portfolio', 'wprealizer'),
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
			'label'                 => esc_html__('Portfolio', 'wprealizer'),
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
				'slug' => $ishpat_portfolios_slug,
				'with_front' => false
			),
		);

		register_post_type('wpr-portfolios', $args);
	}

	public function create_cat()
	{
		$labels = array(
			'name'                       => esc_html_x('Portfolio Categories', 'Taxonomy General Name', 'wprealizer'),
			'singular_name'              => esc_html_x('Portfolio Categories', 'Taxonomy Singular Name', 'wprealizer'),
			'menu_name'                  => esc_html__('Portfolio Categories', 'wprealizer'),
			'all_items'                  => esc_html__('All Portfolio Category', 'wprealizer'),
			'parent_item'                => esc_html__('Parent Item', 'wprealizer'),
			'parent_item_colon'          => esc_html__('Parent Item:', 'wprealizer'),
			'new_item_name'              => esc_html__('New Portfolio Category Name', 'wprealizer'),
			'add_new_item'               => esc_html__('Add New Portfolio Category', 'wprealizer'),
			'edit_item'                  => esc_html__('Edit Portfolio Category', 'wprealizer'),
			'update_item'                => esc_html__('Update Portfolio Category', 'wprealizer'),
			'view_item'                  => esc_html__('View Portfolio Category', 'wprealizer'),
			'separate_items_with_commas' => esc_html__('Separate items with commas', 'wprealizer'),
			'add_or_remove_items'        => esc_html__('Add or remove items', 'wprealizer'),
			'choose_from_most_used'      => esc_html__('Choose from the most used', 'wprealizer'),
			'popular_items'              => esc_html__('Popular Portfolio Category', 'wprealizer'),
			'search_items'               => esc_html__('Search Portfolio Category', 'wprealizer'),
			'not_found'                  => esc_html__('Not Found', 'wprealizer'),
			'no_terms'                   => esc_html__('No Portfolio Category', 'wprealizer'),
			'items_list'                 => esc_html__('Portfolio Category list', 'wprealizer'),
			'items_list_navigation'      => esc_html__('Portfolio Category list navigation', 'wprealizer'),
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

		register_taxonomy('portfolios-cat', 'wpr-portfolios', $args);
	}
}

new TpPortfoliosPost();
