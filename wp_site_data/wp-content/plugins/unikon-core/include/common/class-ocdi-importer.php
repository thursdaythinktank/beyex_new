<?php
/**
 * 
 * Demo Imports
 */

function tp_ocdi_import_files()
{
  return array(
    array(
      'import_file_name' => 'Home 1',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-1.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/',
    ),
    array(
      'import_file_name' => 'Home 2',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-2.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-2/',
    ),
    array(
      'import_file_name' => 'Home 3',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-3.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-3/',
    ),
    array(
      'import_file_name' => 'Home 4',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-4.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-4/',
    ),
    array(
      'import_file_name' => 'Home 5',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-5.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-5/',
    ),
    array(
      'import_file_name' => 'Home 6',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-6.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-6/',
    ),
    array(
      'import_file_name' => 'Home 7',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-7.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-7/',
    ),
    array(
      'import_file_name' => 'Home 8',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-8.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-8/',
    ),
    array(
      'import_file_name' => 'Home 9',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-9.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/home-9/',
    ),
    array(
      'import_file_name' => 'Agency Showcase',
      'local_import_file' => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
      'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
      'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
      'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/showcase.jpg',
      'preview_url' => 'https://unikon.wprealizer.com/agency-showcase/',
    ),
  );
}
add_filter('ocdi/import_files', 'tp_ocdi_import_files');


function tp_ocdi_page($tp_page_name = 'Home')
{
  $posts = get_posts(
    array(
      'post_type' => 'page',
      'title' => $tp_page_name,
      'post_status' => 'all',
      'posts_per_page' => 1,
      'no_found_rows' => true,
      'ignore_sticky_posts' => true,
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
      'orderby' => 'post_date ID',
      'order' => 'ASC',
    )
  );

  if (!empty($posts)) {
    $page_got_by_title = $posts[0];
  } else {
    $page_got_by_title = null;
  }

  return $page_got_by_title;

}

// after demo imports
function tp_ocdi_after_import_setup($demo)
{
    // Default IDs if pages are not found
    $front_page_id = null;
    $blog_page_id = null;

    // Map demo names to front page titles
    $home_page_titles = [
        "Home 1" => "Home 1",
        "Home 2" => "Home 2",
        "Home 3" => "Home 3",
        "Home 4" => "Home 4",
        "Home 5" => "Home 5",
        "Home 6" => "Home 6",
        "Home 7" => "Home 8",
        "Home 8" => "Home 8",
        "Home 9" => "Home 9",
        "Agency Showcase" => "Agency Showcase",
    ];

    // Check if import name is in map and retrieve page by title
    if (array_key_exists($demo['import_file_name'], $home_page_titles)) {
        $front_page = tp_ocdi_page($home_page_titles[$demo['import_file_name']]);
        $blog_page = tp_ocdi_page('Blog');

        if ($front_page) {
            $front_page_id = $front_page->ID;
        }
        if ($blog_page) {
            $blog_page_id = $blog_page->ID;
        }
    }

    // Set front and blog page if IDs are valid
    if ($front_page_id && $blog_page_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id);
        update_option('page_for_posts', $blog_page_id);
    } else {
        error_log('OCDI: Front page or blog page not found for demo import: ' . $demo['import_file_name']);
    }

    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
    if ($main_menu) {
        set_theme_mod('nav_menu_locations', [
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
        ]);
    }

    // Reset WooCommerce default settings if WooCommerce is active
    if (class_exists('woocommerce')) {
        update_option('woocommerce_shop_page_id', '970');
        update_option('woocommerce_cart_page_id', '971');
        update_option('woocommerce_checkout_page_id', '972');
        update_option('woocommerce_myaccount_page_id', '973');
    }
}
add_action('ocdi/after_import', 'tp_ocdi_after_import_setup');


function tp_ocdi_plugin_page_setup($default_settings)
{
  $default_settings['parent_slug'] = 'themes.php';
  $default_settings['page_title'] = esc_html__('One Click Demo Import', 'one-click-demo-import');
  $default_settings['menu_title'] = esc_html__('Import Theme Demos', 'one-click-demo-import');
  $default_settings['capability'] = 'import';
  $default_settings['menu_slug'] = 'one-click-demo-import';

  return $default_settings;
}
add_filter('ocdi/plugin_page_setup', 'tp_ocdi_plugin_page_setup');