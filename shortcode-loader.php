<?php
namespace UniqueAddons;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;
	public $widgets = array();
	public $widgets_shop = array();
	public $widgets_core = array();
	public $woocommerce_status = false;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		$plugin_version = defined( 'UNIQUE_ADDONS_VERSION' ) ? UNIQUE_ADDONS_VERSION : '2.0.0';

		unique_addons_register_vendor_scripts();

		if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
			wp_register_script( 'imagesloaded', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/imagesloaded.pkgd.min.js', [ 'jquery' ], '5.0.0', true );
		}

		if ( ! wp_script_is( 'isotope', 'registered' ) ) {
			wp_register_script( 'isotope', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/isotope.pkgd.min.js', [ 'jquery' ], '3.0.6', true );
			wp_register_script( 'uae-isotope', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/isotope.pkgd.min.js', [ 'jquery', 'imagesloaded' ], '3.0.6', true );
		}

		if ( ! wp_script_is( 'slick', 'registered' ) ) {
			wp_register_script( 'slick', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/slick/slick.min.js', [ 'jquery' ], '1.8.1', true );
			wp_register_style( 'slick', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/slick/slick.css', [], '1.8.1' );
			wp_register_style( 'slick-theme', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/slick/slick-theme.css', [ 'slick' ], '1.8.1' );
		}

		if ( ! wp_script_is( 'unique-addons-elementor', 'registered' ) ) {
			wp_register_script(
				'unique-addons-elementor',
				UNIQUE_ADDONS_ASSETS_URI . '/js/custom-elementor.js',
				[ 'jquery', 'imagesloaded', 'isotope', 'swiper' ],
				$plugin_version,
				true
			);
		}

		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			wp_enqueue_script( 'swiper' );
			wp_enqueue_style( 'swiper' );
		}

		wp_register_script(
			'uae-elementor-init',
			plugins_url( '/assets/js/elementor-uae.js', __FILE__ ),
			[ 'jquery', 'unique-addons-elementor' ],
			$plugin_version,
			true
		);
	}

	public function widget_styles() {
		wp_enqueue_style( 'uae-elementor-css', plugins_url( '/assets/css/elementor-uae.css', __FILE__ ) );
	}

	public function widget_styles_frontend() {
		$direction_suffix = is_rtl() ? '.rtl' : '';
		$plugin_version     = defined( 'UNIQUE_ADDONS_VERSION' ) ? UNIQUE_ADDONS_VERSION : '2.0.0';

		wp_enqueue_style( 'uae-layouts', UNIQUE_ADDONS_ASSETS_URI . '/css/uae-layouts' . $direction_suffix . '.css', [], $plugin_version );
		wp_enqueue_style( 'tm-header-search', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/header-search' . $direction_suffix . '.css' );
		wp_enqueue_style( 'uae-widgets-core-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/uae-widgets-core-style' . $direction_suffix . '.css' );
	}


	public function woocommerce_status() {

		if ( class_exists( 'WooCommerce' ) ) {
			$this->woocommerce_status = true;
		}

		return $this->woocommerce_status;
	}


	// plugin core assets
	/**
	 * Free widget manifest cache.
	 *
	 * @return array<string, array<int, string>>
	 */
	private function get_free_manifest() {
		static $manifest = null;

		if ( null === $manifest ) {
			$manifest = require UNIQUE_ADDONS_ABS_PATH . 'inc/widgets/manifest-free.php';
		}

		return $manifest;
	}

	public function widgets_core_list() {
		$manifest           = $this->get_free_manifest();
		$this->widgets_core = $manifest['widgets_core'];

		return $this->widgets_core;
	}
	//widgets core
	private function include_widgets_core_files() {
		foreach( $this->widgets_core_list() as $widget ) {
			require_once( __DIR__ . '/widgets-core/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets-core/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}



	public function widgets_list() {
		$manifest     = $this->get_free_manifest();
		$this->widgets = $manifest['widgets'];

		return $this->widgets;
	}


	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		foreach( $this->widgets_list() as $widget ) {
			require_once( __DIR__ . '/widgets/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}
	}
	private function include_widgets_files_cpt() {
		require_once __DIR__ . '/cpt/blog/widget.php';

		foreach ( glob( __DIR__ . '/cpt/blog/skins/*.php' ) as $filepath ) {
			include $filepath;
		}
	}
	private function include_widgets_files_current_theme() {
	}


	//shop — WooCommerce widgets are Pro-only.
	public function widgets_list_shop() {
		return $this->widgets_shop;
	}

	private function include_widgets_files_shop() {
		// Pro add-on loads shop widgets.
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		$this->include_widgets_files();
		$this->include_widgets_files_cpt();
		$this->include_widgets_files_current_theme();
		$this->include_widgets_core_files();

		require_once UNIQUE_ADDONS_ABS_PATH . 'inc/widgets/register-free-widgets.php';
		slwe_register_free_elementor_widgets();
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles' ] );

		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'widget_styles_frontend' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'widget_styles_frontend' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();

//elementor elements
require_once( __DIR__ . '/elementor-elements/loader.php' );
