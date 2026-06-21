<?php
/**
 * Custom post type registry.
 *
 * @package SiddikLayoutWidgetsElementor
 */

namespace UniqueAddons\CPT;

use UniqueAddons\Lib;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers plugin CPTs.
 */
class Reg_Post_Type {

	/**
	 * Singleton instance.
	 *
	 * @var Reg_Post_Type|null
	 */
	private static $instance = null;

	/**
	 * Registered post type objects.
	 *
	 * @var Lib\Unique_Addons_Interface_PostType[]
	 */
	private $all_post_types = array();

	/**
	 * Get singleton.
	 *
	 * @return Reg_Post_Type
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	protected function __construct() {}

	/**
	 * Add a post type to the registry.
	 *
	 * @param Lib\Unique_Addons_Interface_PostType $post_type Post type object.
	 * @return void
	 */
	private function add_post_type( Lib\Unique_Addons_Interface_PostType $post_type ) {
		$key = $post_type->getPTKey();
		if ( ! isset( $this->all_post_types[ $key ] ) ) {
			$this->all_post_types[ $key ] = $post_type;
		}
	}

	/**
	 * Register admin menu for template/content CPTs.
	 *
	 * @return void
	 */
	public function register_admin_menu() {
		add_menu_page(
			esc_html__( 'Siddik Layout Widgets Templates', 'siddik-layout-widgets-elementor' ),
			esc_html__( 'UAE Templates', 'siddik-layout-widgets-elementor' ),
			'edit_posts',
			'uae-templates',
			array( $this, 'render_admin_landing_page' ),
			'dashicons-layout',
			58
		);
	}

	/**
	 * Render admin landing page with usage instructions.
	 *
	 * @return void
	 */
	public function render_admin_landing_page() {
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Siddik Layout Widgets Templates', 'siddik-layout-widgets-elementor' ); ?></h1>
			<p><?php esc_html_e( 'Manage portfolio and project content, plus reusable Elementor template parts from this section.', 'siddik-layout-widgets-elementor' ); ?></p>
			<ul style="list-style:disc;padding-left:1.5rem;">
				<li><?php esc_html_e( 'Portfolio and Project items are public content with archive pages and theme-independent fallback templates.', 'siddik-layout-widgets-elementor' ); ?></li>
				<li><?php esc_html_e( 'Header, Footer, Mega Menu, Page Title, and Side Panel templates are never injected into your theme automatically.', 'siddik-layout-widgets-elementor' ); ?></li>
				<li><?php esc_html_e( 'Display template parts using shortcodes (shown in each template list) or Elementor Theme Builder.', 'siddik-layout-widgets-elementor' ); ?></li>
			</ul>
		</div>
		<?php
	}

	/**
	 * Queue post types for registration.
	 *
	 * @return void
	 */
	private function queue_post_types() {
		if ( ! function_exists( 'slwe_is_pro_active' ) || ! slwe_is_pro_active() ) {
			return;
		}

		$this->add_post_type( Portfolio\CPT_Portfolio::instance() );
		$this->add_post_type( Footer\CPT_Footer::instance() );
		$this->add_post_type( MegaMenu\CPT_MegaMenu::instance() );

		$this->add_post_type( HeaderTop\CPT_HeaderTop::instance() );
		$this->add_post_type( PageTitle\CPT_PageTitle::instance() );
		$this->add_post_type( SidePushPanel\CPT_SidePushPanel::instance() );
		$this->add_post_type( Projects\CPT_Projects::instance() );

		if ( class_exists( 'WPCF\Crowdfunding' ) && class_exists( 'WPCF\CPT_WPCFTemplate' ) ) {
			$this->add_post_type( WPCF\CPT_WPCFTemplate::Instance() );
		}
	}

	/**
	 * Register all queued post types.
	 *
	 * @return void
	 */
	public function register() {
		$this->queue_post_types();

		foreach ( $this->all_post_types as $post_type ) {
			$post_type->register();
		}
	}
}

/**
 * Register the UAE Templates admin menu.
 *
 * @return void
 */
function unique_elementor_addons_register_cpt_admin_menu() {
	if ( function_exists( 'slwe_is_pro_active' ) && slwe_is_pro_active() ) {
		Reg_Post_Type::get_instance()->register_admin_menu();
	}
}
add_action( 'admin_menu', __NAMESPACE__ . '\\unique_elementor_addons_register_cpt_admin_menu', 9 );

/**
 * Bootstrap CPT display and template fallbacks.
 *
 * @return void
 */
function unique_elementor_addons_bootstrap_cpts() {
	if ( ! function_exists( 'slwe_is_pro_active' ) || ! slwe_is_pro_active() ) {
		return;
	}

	CPT_Display::init();
	CPT_Template_Fallback::init();
}
add_action( 'init', __NAMESPACE__ . '\\unique_elementor_addons_bootstrap_cpts', 20 );
