<?php

namespace WPRCore;

use WPRCore\PageSettings\Page_Settings;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class WPR_Core_Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var WPR_Core_Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return WPR_Core_Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

	public function wpr_core_elementor_category($manager)
	{
		$manager->add_category(
			'wprealizer',
			array(
				'title' => esc_html__('WPRealizer Addons', 'wprealizer'),
				'icon' => 'eicon-banner',
			)
		);
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_register_script('wprealizer', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'wprcore-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * wpr_enqueue_editor_scripts
	 */
	function wpr_enqueue_editor_scripts()
	{
		wp_enqueue_style('wpr-element-addons-editor', WPRCORE_ADDONS_URL . 'assets/css/editor.css', [], '1.0');
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('wprcore-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param  \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{

		foreach ($this->wprcore_widget_list() as $key => $widgets) {
			foreach ($widgets as $widget) {
				$widget_file = WPRCORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
				if (file_exists($widget_file)) {
					require_once $widget_file;
				}
			}
		}


		// for woocommerce plugin
		if (class_exists('woocommerce')) {
			foreach ($this->wprcore_widget_list_woo() as $key => $widgets) {
				foreach ($widgets as $widget) {
					$widget_file = WPRCORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
					if (file_exists($widget_file)) {
						require_once $widget_file;
					}
				}
			}
		}

		// for event plugin
		if (class_exists('Wpeventin')) {
			foreach ($this->wprcore_widget_list_event() as $key => $widgets) {
				foreach ($widgets as $widget) {
					$widget_file = WPRCORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
					if (file_exists($widget_file)) {
						require_once $widget_file;
					}
				}
			}
		}

		// for tutor lms plugin
		if (function_exists('tutor')) {
			foreach ($this->wprcore_widget_list_tutor_lms() as $key => $widgets) {
				foreach ($widgets as $widget) {
					$widget_file = WPRCORE_ELEMENTS_PATH . '/' . $key . '/' . $widget . '.php';
					if (file_exists($widget_file)) {
						require_once $widget_file;
					}
				}
			}
		}
	}

	// wprcore_widget_list
	public function wprcore_widget_list()
	{
		return [


			// all header widgest
			'header' => [
				'header-builder',
				// 'header-builder-2',
				// 'header-builder-3',
				// 'header-builder-4',
				// 'header-builder-5',
				// 'header-ecommerce',
				// 'header-inner'
			],

			'header-side' => [
				'search',
			],

			'breadcrumb' => [
				'default-breadcrumb',
			],

			// all footer widgets
			// 'footer' => [
			// 	'footer-language',
			// 	'footer-social',
			// 	'footer-links',
			// ],

			// all blog widgets
			'blog' => [
				'blog-post',
				// 'blog-hero',
				// 'blog-grid',
				// 'blog-post-list',
				// 'blog-category',
			],

			// all offcanvas widgets
			'offcanvas' => [
				'offcanvas-mobile-menu',
			],

			// menu widgets
			'menu' => [
				'home-demo',
			],

			// all buttons widgets
			'buttons' => [
				'button',
			],

			'banner' => [
				'banner',
			],

			// 'instagram' => [
			// 	'instagram',
			// ],

			'price' => [
				'price-box'
			],
			'faq' => [
				'faq',
			],

			'about' => [
				// 'about-year-slider',
				'about-tab',
				// 'about-team-single',
			],

			'common' => [
				'counter',
				// 'academic-programs',
				'icon-box',
				// 'kindergarten',
				'text-slider',
				'advanced-tab',
				// 'mission-sticky',
				'link-text',
				'link-list',
				'repeater-box',
			],

			// all services widgets
			'services' => [
				'services',
				'services-box',
			],

			// all heading widgets
			'heading' => [
				'heading',
			],

			// all video widgets
			'video' => [
				'video-play-mp4',
			],

			// all brand widgets
			'brand' => [
				'brand-slider',
			],

			// all team widgets
			'team' => [
				'team-box-widget',
			],

			// all testimonial widgets
			'testimonial' => [
				'testimonial-slider',
				'testimonial',
			],

			// all Project widgets
			'project' => [
				'project-slider',
				'project-box',
			],

			// all image widgets
			'image' => [
				'image',
				'image-shape',
				'image-slider',
			],

			// all hero widgets
			'hero' => [
				'hero-banner',
				'hero-slider',
				// 'hero-shop'
			],

			'contact' => [
				// 'contact-plan',
				// 'contact-box',
			],

			// lanzu 
			// 'university' => [
			// 	'campus-slider',
			// 	'campus-link',
			// 	'university-instructor',
			// 	'university-tab'
			// ],
		];
	}

	// wprcore_widget_list_woo
	public function wprcore_widget_list_woo()
	{
		return [
			'woocommerce' => [
				'product-card',
			],
		];
	}

	// wprcore_widget_list_event
	public function wprcore_widget_list_event()
	{
		return [
			'event' => [
				'events',
			],
		];
	}

	// wprcore_widget_list_tutor_lms
	public function wprcore_widget_list_tutor_lms()
	{
		return [
			'course' => [
				'course-tab',
				'course-card',
				'course-instructor',
				'course-search',
			],
		];
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	// private function add_page_settings_controls() {
	// 	require_once( __DIR__ . '/page-settings/manager.php' );
	// 	new Page_Settings();
	// }


	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

	public function register_controls(Controls_Manager $controls_Manager)
	{
		include_once(WPRCORE_ADDONS_DIR . '/controls/wprgradient.php');
		$wprgradient = 'WPRCore\Elementor\Controls\Group_Control_WPRGradient';
		$controls_Manager->add_group_control($wprgradient::get_type(), new $wprgradient());

		include_once(WPRCORE_ADDONS_DIR . '/controls/wprbggradient.php');
		$wprbggradient = 'WPRCore\Elementor\Controls\Group_Control_WPRBGGradient';
		$controls_Manager->add_group_control($wprbggradient::get_type(), new $wprbggradient());
	}


	public function wpr_add_custom_icons_tab($tabs = array())
	{

		// Append new icons
		$feather_icons = array(
			'feather-activity',
			'feather-airplay',
			'feather-alert-circle',
			'feather-alert-octagon',
			'feather-alert-triangle',
			'feather-align-center',
			'feather-align-justify',
			'feather-align-left',
			'feather-align-right',
		);

		$tabs['wpr-feather-icons'] = array(
			'name' => 'wpr-feather-icons',
			'label' => esc_html__('WPR - Feather Icons', 'wprealizer'),
			'labelIcon' => 'wpr-icon',
			'prefix' => '',
			'displayPrefix' => 'wpr',
			'url' => WPRCORE_ADDONS_URL . 'assets/css/feather.css',
			'icons' => $feather_icons,
			'ver' => '1.0.0',
		);


		// Append flaticon fonts icons
		$flat_icons = array(
			'flaticon-next',
			'flaticon-diagonal-arrow',
			'flaticon-blueprint',
			'flaticon-renovation',
			'flaticon-building',
			'flaticon-interior-design',
			'flaticon-quality',
			'flaticon-worker',
			'flaticon-check',
			'flaticon-unfold',
			'flaticon-project-management',
			'flaticon-management',
			'flaticon-satisfaction',
			'flaticon-process',
			'flaticon-help',
			'flaticon-blueprint-1',
			'flaticon-play-button',
			'flaticon-3d-model',
			'flaticon-livingroom',
			'flaticon-laser-cutting-machine',
			'flaticon-renovation-1',
			'flaticon-3d',
			'flaticon-brickwall',
			'flaticon-color-adjustment',
			'flaticon-roof',
			'flaticon-worker-1',
			'flaticon-broken-house',
			'flaticon-solar-system',
			'flaticon-review',
			'flaticon-bed',
			'flaticon-relax',
			'flaticon-kitchen',
			'flaticon-electric-panel',
			'flaticon-heater',
			'flaticon-lamp',
			'flaticon-vimeo',
			'flaticon-facebook',
			'flaticon-instagram',
			'flaticon-twitter',
			'flaticon-youtube',
			'flaticon-location',
			'flaticon-message',
			'flaticon-mail',
			'flaticon-search',
			'flaticon-shopping-cart',
			'flaticon-down-arrow',
			'flaticon-share',
			'flaticon-tick',
			'flaticon-user',
			'flaticon-phone-call',
			'flaticon-view',
			'flaticon-tag',
			'flaticon-clock',
			'flaticon-heart',
			'flaticon-badge',
			'flaticon-solution',
			'flaticon-menu',

		);

		$tabs['wpr-flat-icon-icons'] = array(
			'name' => 'wpr-flat-icon-icons',
			'label' => esc_html__('WPR - Flaticons', 'wprealizer'),
			'labelIcon' => 'wpr-icon',
			'prefix' => '',
			'displayPrefix' => 'wpr',
			'url' => WPRCORE_ADDONS_URL . 'assets/css/flaticon.css',
			'icons' => $flat_icons,
			'ver' => '1.0.0',
		);

		$fontawesome_icons = array(
			'angle-up',
			'check',
			'times',
			'calendar',
			'language',
			'shopping-cart',
			'bars',
			'search',
			'map-marker',
			'arrow-right',
			'arrow-left',
			'arrow-up',
			'arrow-down',
			'angle-right',
			'angle-left',
			'angle-up',
			'angle-down',
			'phone',
			'users',
			'user',
			'map-marked-alt',
			'trophy-alt',
			'envelope',
			'marker',
			'globe',
			'broom',
			'home',
			'bed',
			'chair',
			'bath',
			'tree',
			'laptop-code',
			'cube',
			'cog',
			'play',
			'trophy-alt',
			'heart',
			'truck',
			'user-circle',
			'map-marker-alt',
			'comments',
			'award',
			'bell',
			'book-alt',
			'book-open',
			'book-reader',
			'graduation-cap',
			'laptop-code',
			'music',
			'ruler-triangle',
			'user-graduate',
			'microscope',
			'glasses-alt',
			'theater-masks',
			'atom'
		);

		$tabs['wpr-fontawesome-icons'] = array(
			'name' => 'wpr-fontawesome-icons',
			'label' => esc_html__('WPR - Fontawesome Pro Light', 'wprealizer'),
			'labelIcon' => 'wpr-icon',
			'prefix' => 'fa-',
			'displayPrefix' => 'fal',
			'url' => WPRCORE_ADDONS_URL . 'assets/css/fontawesome-all.min.css',
			'icons' => $fontawesome_icons,
			'ver' => '1.0.0',
		);

		return $tabs;
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);

		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		add_action('elementor/elements/categories_registered', [$this, 'wpr_core_elementor_category']);

		// Register custom controls
		add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
		add_action('elementor/controls/register_style_controls', [$this, 'register_style_rols']);

		add_filter('elementor/icons_manager/additional_tabs', [$this, 'wpr_add_custom_icons_tab']);

		// $this->wpr_add_custom_icons_tab();

		add_action('elementor/editor/after_enqueue_scripts', [$this, 'wpr_enqueue_editor_scripts']);

		// $this->add_page_settings_controls();

	}
}

// Instantiate Plugin Class
WPR_Core_Plugin::instance();
