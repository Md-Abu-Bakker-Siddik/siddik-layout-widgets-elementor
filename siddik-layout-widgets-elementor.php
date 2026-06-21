<?php
/**
 * Plugin Name:       Siddik Layout Widgets for Elementor
 * Plugin URI:        https://wordpress.org/plugins/siddik-layout-widgets-elementor/
 * Description:       A collection of custom Elementor widgets and extensions for building modern WordPress sites.
 * Version:           2.0.6
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Requires Plugins: elementor
 * Author:            Md Abu Bakker Siddik
 * Author URI:        https://profiles.wordpress.org/mdabubakkersiddik1/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       siddik-layout-widgets-elementor
 * Domain Path:       /languages
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Siddik Layout Widgets for Elementor bootstrap class.
 *
 * @since 1.0.0
 */
final class Unique_Addons_Elementor {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '2.0.6';

	/**
	 * Minimum Elementor version.
	 *
	 * @var string
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP version.
	 *
	 * @var string
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->define_constants();

		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_elementor' ) );
			return;
		}

		add_action( 'init', array( $this, 'i18n' ), 1 );
		add_action( 'init', array( $this, 'init' ), 5 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Define plugin constants.
	 *
	 * @return void
	 */
	private function define_constants() {
		if ( ! defined( 'UNIQUE_ADDONS_VERSION' ) ) {
			define( 'UNIQUE_ADDONS_VERSION', self::VERSION );
		}
		if ( ! defined( 'UNIQUE_ADDONS_MAIN_FILE' ) ) {
			define( 'UNIQUE_ADDONS_MAIN_FILE', __FILE__ );
		}
		if ( ! defined( 'UNIQUE_ADDONS_ABS_PATH' ) ) {
			define( 'UNIQUE_ADDONS_ABS_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'UNIQUE_ADDONS_URI' ) ) {
			define( 'UNIQUE_ADDONS_URI', plugin_dir_url( __FILE__ ) );
		}
		if ( ! defined( 'UNIQUE_ADDONS_ASSETS_URI' ) ) {
			define( 'UNIQUE_ADDONS_ASSETS_URI', UNIQUE_ADDONS_URI . 'assets' );
		}
		if ( ! defined( 'UNIQUE_ADDONS_TEXT_DOMAIN' ) ) {
			define( 'UNIQUE_ADDONS_TEXT_DOMAIN', 'siddik-layout-widgets-elementor' );
		}
		if ( ! defined( 'SLWE_ELEMENTOR_WIDGET_BADGE' ) ) {
			define( 'SLWE_ELEMENTOR_WIDGET_BADGE', '' );
		}
	}

	/**
	 * Load plugin text domain.
	 *
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain(
			'siddik-layout-widgets-elementor',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);
	}

	/**
	 * Initialize plugin dependencies.
	 *
	 * @return void
	 */
	public function init() {
		if ( defined( 'ELEMENTOR_VERSION' ) && ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'add_elementor_custom_icons' ) );

		require_once UNIQUE_ADDONS_ABS_PATH . 'inc/slwe-core.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'inc/admin-pro-notice.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'inc/class-slwe-admin-go-pro.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'inc/theme-shim.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'inc/template-escaping.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'functions.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'load-lib-ext-plugins.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'load-cpt-sc.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'load-other.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'scripts-loader.php';
		require_once UNIQUE_ADDONS_ABS_PATH . 'shortcode-loader.php';
	}

	/**
	 * Admin notice when Elementor is not active.
	 *
	 * @return void
	 */
	public function admin_notice_missing_elementor() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'siddik-layout-widgets-elementor' ),
			'<strong>' . esc_html__( 'Siddik Layout Widgets for Elementor', 'siddik-layout-widgets-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'siddik-layout-widgets-elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style(
			'unique-addons-custom-admin',
			UNIQUE_ADDONS_ASSETS_URI . '/css/custom-admin.css',
			array(),
			UNIQUE_ADDONS_VERSION
		);
	}

	/**
	 * Enqueue frontend scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		// Reserved for future frontend bootstrap assets.
	}

	/**
	 * Admin notice for minimum Elementor version.
	 *
	 * @return void
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'siddik-layout-widgets-elementor' ),
			'<strong>' . esc_html__( 'Siddik Layout Widgets for Elementor', 'siddik-layout-widgets-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'siddik-layout-widgets-elementor' ) . '</strong>',
			esc_html( self::MINIMUM_ELEMENTOR_VERSION )
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Admin notice for minimum PHP version.
	 *
	 * @return void
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'siddik-layout-widgets-elementor' ),
			'<strong>' . esc_html__( 'Siddik Layout Widgets for Elementor', 'siddik-layout-widgets-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'siddik-layout-widgets-elementor' ) . '</strong>',
			esc_html( self::MINIMUM_PHP_VERSION )
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Register custom Elementor icon sets.
	 *
	 * @param array $settings Icon manager settings.
	 * @return array
	 */
	public function add_elementor_custom_icons( $settings ) {
		$settings['flaticon-set-landscaping'] = array(
			'name'          => 'flaticon-set-landscaping',
			'label'         => esc_html__( 'Siddik Layout Widgets Icon Set', 'siddik-layout-widgets-elementor' ),
			'url'           => '',
			'enqueue'       => array(
				UNIQUE_ADDONS_ASSETS_URI . '/flaticon-set-landscaping/style.css',
			),
			'prefix'        => '',
			'displayPrefix' => '',
			'labelIcon'     => 'flaticon-set-landscape',
			'ver'           => UNIQUE_ADDONS_VERSION,
			'fetchJson'     => UNIQUE_ADDONS_ASSETS_URI . '/flaticon-set-landscaping/icon-list.js',
			'native'        => 1,
		);

		$settings['unique-addons-flaticon-common'] = array(
			'name'          => 'unique-addons-flaticon-common',
			'label'         => esc_html__( 'Siddik Layout Widgets Common Icons', 'siddik-layout-widgets-elementor' ),
			'url'           => '',
			'enqueue'       => array(
				UNIQUE_ADDONS_ASSETS_URI . '/flaticons-common/style.css',
			),
			'prefix'        => '',
			'displayPrefix' => '',
			'labelIcon'     => 'flaticon-common-alarm',
			'ver'           => UNIQUE_ADDONS_VERSION,
			'fetchJson'     => UNIQUE_ADDONS_ASSETS_URI . '/flaticons-common/icon-list.js',
			'native'        => 1,
		);

		return $settings;
	}
}

new Unique_Addons_Elementor();

if ( ! function_exists( 'unique_addons_matthewruddy_image_resize' ) ) {
	require_once UNIQUE_ADDONS_ABS_PATH . 'external-plugins/lib/matthewruddy-image-resizer.php';
}

if ( ! function_exists( 'unique_addons_theme_installed' ) ) {
	/**
	 * Checks whether a legacy companion theme framework is present.
	 *
	 * @return bool
	 */
	function unique_addons_theme_installed() {
		return defined( 'UAE_LEGACY_THEME_ACTIVE' );
	}
}

if ( ! function_exists( 'unique_addons_theme_active' ) ) {
	/**
	 * Checks whether a legacy companion theme is active.
	 *
	 * @return bool
	 */
	function unique_addons_theme_active() {
		return defined( 'UAE_LEGACY_THEME_ACTIVE' );
	}
}

if ( ! function_exists( 'unique_addons_get_fa_icons' ) ) {
	/**
	 * Return Font Awesome icon class list from bundled stylesheet.
	 *
	 * @return array
	 */
	function unique_addons_get_fa_icons() {
		$data = get_transient( 'unique_addons_fa_icons' );

		if ( empty( $data ) ) {
			global $wp_filesystem;

			if ( ! function_exists( 'WP_Filesystem' ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
			}

			WP_Filesystem();

			$fontawesome_file = UNIQUE_ADDONS_ABS_PATH . 'assets/fontawesome/css/all.min.css';
			$content          = '';

			if ( $wp_filesystem->exists( $fontawesome_file ) ) {
				$content = $wp_filesystem->get_contents( $fontawesome_file );
			}

			preg_match_all( '/\.(fa-(?:\w+(?:-)?)+):before\s*{\s*content/', $content, $matches, PREG_SET_ORDER );

			$icons = array();

			foreach ( $matches as $match ) {
				$icons[] = $match[1];
			}

			$data = $icons;
			set_transient( 'unique_addons_fa_icons', $data, WEEK_IN_SECONDS );
		}

		return array_combine( $data, $data );
	}
}

if ( ! function_exists( 'unique_addons_get_flat_icons' ) ) {
	/**
	 * Return custom flat icon class list from bundled stylesheet.
	 *
	 * @return array
	 */
	function unique_addons_get_flat_icons() {
		$data = get_transient( 'unique_addons_flat_icons' );

		if ( empty( $data ) ) {
			global $wp_filesystem;

			if ( ! function_exists( 'WP_Filesystem' ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
			}

			WP_Filesystem();

			$template_icon_file = UNIQUE_ADDONS_ABS_PATH . 'assets/flaticon-set-agri/style.css';
			$content              = '';

			if ( $wp_filesystem->exists( $template_icon_file ) ) {
				$content = $wp_filesystem->get_contents( $template_icon_file );
			}

			preg_match_all( '/\.(flaticon-(?:\w+(?:-)?)+):before\s*{\s*content/', $content, $matches, PREG_SET_ORDER );

			$icons = array();

			foreach ( $matches as $match ) {
				$icons[] = $match[1];
			}

			$data = $icons;
			set_transient( 'unique_addons_flat_icons', $data, WEEK_IN_SECONDS );
		}

		return array_combine( $data, $data );
	}
}

/**
 * Flush rewrite rules on plugin activation.
 *
 * @return void
 */
function unique_addons_activate() {
	if ( function_exists( 'unique_addons_reg_custom_post_types' ) ) {
		unique_addons_reg_custom_post_types();
	}
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'unique_addons_activate' );
