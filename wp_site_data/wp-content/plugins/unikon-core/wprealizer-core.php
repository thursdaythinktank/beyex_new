<?php

/**
 * Plugin Name: Unikon Core
 * Description: Unikon elementor core plugin for Unikon wordpress theme.
 * Plugin URI:  https://wprealizer.com
 * Version:     1.0.1
 * Author:      WPRealizer
 * Author URI:  https://wprealizer.com
 * Text Domain: wprealizer
 * Elementor tested up to: 3.24.6
 */



if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Define
 */
define('WPRCORE_ADDONS_URL', plugins_url('/', __FILE__));
define('WPRCORE_ADDONS_DIR', dirname(__FILE__));
define('WPRCORE_ADDONS_PATH', plugin_dir_path(__FILE__));
define('WPRCORE_ELEMENTS_PATH', WPRCORE_ADDONS_DIR . '/include/elementor');
define('WPRCORE_ELEMENTS_URL', WPRCORE_ADDONS_URL . '/include/elementor');
define('WPRCORE_WIDGET_PATH', WPRCORE_ADDONS_DIR . '/include/widgets');
define('WPRCORE_INCLUDE_PATH', WPRCORE_ADDONS_DIR . '/include');
define('WPRCORE_THEME_NAME', 'WPRealizer');
define('TP_EXT_LOGO_ICON_URL', WPRCORE_ADDONS_URL . 'assets/img/logo.png');




define('TP_API_URL', 'https://wp.themepure.net/wprealizer/elementor-block/');
define('TP_EXT_LOGO_URL', WPRCORE_ADDONS_URL . 'include/elementor/templates/img/logo.png');

define('TP_ADDONS_FILE_', __FILE__);
define('TP_ADDONS_VERSION_', '1.0.0');



/**
 * 
 * Elementor blocks
 */

add_action('init', function () {
	if (defined('ELEMENTOR_VERSION')) {
		include_once(WPRCORE_ADDONS_DIR . '/include/elementor/templates/api.php');
		include_once(WPRCORE_ADDONS_DIR . '/include/elementor/templates/init.php');
		include_once(WPRCORE_ADDONS_DIR . '/include/elementor/templates/import.php');
		include_once(WPRCORE_ADDONS_DIR . '/include/elementor/templates/load.php');

		\WPR_ELEMENTOR\Templates\WPR_Templates::instance()->init();
		\WPR_ELEMENTOR\Templates\WPR_Import::instance()->load();
		\WPR_ELEMENTOR\Templates\WPR_Load::instance()->load();
	}
});

/**
 * 
 * Elementor widgets
 */


foreach (wprcore_include_files() as $key => $file_name) {
	foreach ($file_name as $file) {
		include_once(WPRCORE_ADDONS_DIR . "/include/{$key}/{$file}.php");
	}
}

function wprcore_include_files()
{
	$files_list = [
		'traits' => [
			'wpr-style-trait',
			'wpr-query-trait',
			'wpr-post-trait',
			'wpr-column-trait',
			'wpr-animation-trait',
			'wpr-icon-trait',
			'wpr-menu-trait',
			'wpr-offcanvas-trait',

		],
		'custom-post' => [
			'header',
			'footer',
			'portfolio',
			'services',
			'offcanvas',
			'breadcrumb',
		],
		'widgets' => [
			'wpr-blog-post-sidebar'
		],
		'common' => [
			'common-functions',
			'allow-svg',
			'class-ocdi-importer',
			'wprealizer-megamenu',
		],
		'post' => [
			'post-functions',
			'post-query'
		],
		'menu' => [
			'menu'
		],
	];

	return $files_list;
}


function wprcore_enqueue_scripts()
{
	wp_enqueue_style('wprcore-style', WPRCORE_ADDONS_URL . 'assets/css/wpr-core.css', array(), '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'wprcore_enqueue_scripts');

function wprealizer_admin_css_load($screen)
{
	if ('nav-menus.php' != $screen) {
		return;
	}
	wp_enqueue_style('wprealizer-admin-css', plugins_url('assets/css/wprealizer-admin.css', __FILE__), false, '1.0');
}
add_action('admin_enqueue_scripts', 'wprealizer_admin_css_load');


/**
 * Main Wpr Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class WPR_Core
{

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		// Init Plugin
		add_action('plugins_loaded', array($this, 'init'));
		add_action('init', array($this, 'load_textdomain'));
	}

	/**
	 * Load tutor text domain for translation
	 */
	public function load_textdomain()
	{
		load_plugin_textdomain('wprealizer', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}


	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', array($this, 'admin_notice_missing_main_plugin'));
			return;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_php_version'));
			return;
		}


		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once('plugin.php');
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'wprealizer'),
			'<strong>' . esc_html__('WPRealizer Core', 'wprealizer') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'wprealizer') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wprealizer'),
			'<strong>' . esc_html__('Wpr Core', 'wprealizer') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'wprealizer') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wprealizer'),
			'<strong>' . esc_html__('Wpr Core', 'wprealizer') . '</strong>',
			'<strong>' . esc_html__('PHP', 'wprealizer') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

// Instantiate WPR_Core.
new WPR_Core();
