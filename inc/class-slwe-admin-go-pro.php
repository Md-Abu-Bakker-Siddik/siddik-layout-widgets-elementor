<?php
/**
 * Go PRO admin page for the free plugin.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the Go PRO admin screen and registers its menu.
 */
final class SLWE_Admin_Go_Pro {

	/**
	 * Singleton instance.
	 *
	 * @var SLWE_Admin_Go_Pro|null
	 */
	private static $instance = null;

	/**
	 * Get singleton instance.
	 *
	 * @return SLWE_Admin_Go_Pro
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'admin_menu', array( $this, 'register_menu' ), 9 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Register admin menu.
	 *
	 * @return void
	 */
	public function register_menu() {
		$menu_slug = slwe_get_admin_menu_slug();

		add_menu_page(
			esc_html__( 'Siddik Layout Widgets', 'siddik-layout-widgets-elementor' ),
			esc_html__( 'Siddik Layout Widgets', 'siddik-layout-widgets-elementor' ),
			'manage_options',
			$menu_slug,
			array( $this, 'render_getting_started_page' ),
			'dashicons-layout',
			57
		);

		add_submenu_page(
			$menu_slug,
			esc_html__( 'Getting Started', 'siddik-layout-widgets-elementor' ),
			esc_html__( 'Getting Started', 'siddik-layout-widgets-elementor' ),
			'manage_options',
			$menu_slug,
			array( $this, 'render_getting_started_page' )
		);

		if ( ! slwe_is_pro_active() ) {
			add_submenu_page(
				$menu_slug,
				esc_html__( 'Go PRO', 'siddik-layout-widgets-elementor' ),
				esc_html__( 'Go PRO', 'siddik-layout-widgets-elementor' ),
				'manage_options',
				slwe_get_go_pro_page_slug(),
				array( $this, 'render_page' )
			);
		}
	}

	/**
	 * Enqueue admin page styles.
	 *
	 * @param string $hook Current admin page hook.
	 * @return void
	 */
	public function enqueue_assets( $hook ) {
		$menu_slug = slwe_get_admin_menu_slug();
		$pro_slug  = slwe_get_go_pro_page_slug();
		$allowed   = array(
			'toplevel_page_' . $menu_slug,
			$menu_slug . '_page_' . $pro_slug,
		);

		if ( ! in_array( $hook, $allowed, true ) ) {
			return;
		}

		wp_enqueue_style(
			'slwe-go-pro',
			UNIQUE_ADDONS_ASSETS_URI . '/css/admin-go-pro.css',
			array(),
			UNIQUE_ADDONS_VERSION
		);
	}

	/**
	 * Render Getting Started admin page.
	 *
	 * @return void
	 */
	public function render_getting_started_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$pro_active = slwe_is_pro_active();
		?>
		<div class="wrap slwe-admin-wrap">
			<h1><?php esc_html_e( 'Getting Started', 'siddik-layout-widgets-elementor' ); ?></h1>
			<p class="slwe-admin-intro">
				<?php esc_html_e( 'Welcome to Siddik Layout Widgets for Elementor. Follow these steps to start building with custom widgets and layout enhancements.', 'siddik-layout-widgets-elementor' ); ?>
			</p>

			<div class="slwe-admin-cards">
				<div class="slwe-admin-card">
					<h2><?php esc_html_e( '1. Open Elementor', 'siddik-layout-widgets-elementor' ); ?></h2>
					<p><?php esc_html_e( 'Edit any page or template with Elementor from Pages → Edit with Elementor.', 'siddik-layout-widgets-elementor' ); ?></p>
				</div>
				<div class="slwe-admin-card">
					<h2><?php esc_html_e( '2. Find the widgets', 'siddik-layout-widgets-elementor' ); ?></h2>
					<p><?php esc_html_e( 'In the Elements panel, scroll to the Siddik Layout Widgets category and drag widgets onto your page.', 'siddik-layout-widgets-elementor' ); ?></p>
				</div>
				<div class="slwe-admin-card">
					<h2><?php esc_html_e( '3. Customize & publish', 'siddik-layout-widgets-elementor' ); ?></h2>
					<p><?php esc_html_e( 'Style each widget from the Content and Style tabs, then publish your page.', 'siddik-layout-widgets-elementor' ); ?></p>
				</div>
			</div>

			<?php if ( ! $pro_active ) : ?>
				<div class="slwe-admin-pro-teaser">
					<h2><?php esc_html_e( 'Unlock the full PRO library', 'siddik-layout-widgets-elementor' ); ?></h2>
					<p><?php esc_html_e( 'Get WooCommerce shop widgets, portfolio/project post types, header/footer templates, and 50+ advanced blocks — free during early access.', 'siddik-layout-widgets-elementor' ); ?></p>
					<a href="<?php echo esc_url( slwe_get_go_pro_admin_url() ); ?>" class="button button-primary button-hero">
						<?php esc_html_e( 'Go PRO →', 'siddik-layout-widgets-elementor' ); ?>
					</a>
				</div>
			<?php else : ?>
				<div class="slwe-admin-pro-teaser slwe-admin-pro-teaser-active">
					<h2><?php esc_html_e( 'PRO is active', 'siddik-layout-widgets-elementor' ); ?></h2>
					<p><?php esc_html_e( 'All premium widgets, WooCommerce blocks, and template parts are unlocked. Manage portfolio and project content under UAE Templates in the admin menu.', 'siddik-layout-widgets-elementor' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Feature comparison rows.
	 *
	 * @return array<int, array<string, mixed>>
	 */
	private function get_features() {
		return array(
			array(
				'feature' => __( '25+ free Elementor widgets', 'siddik-layout-widgets-elementor' ),
				'free'    => true,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Hero Slider, Blog List, Team & Testimonial blocks', 'siddik-layout-widgets-elementor' ),
				'free'    => true,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Accordion, Tabs, Icon Box, Button & core widgets', 'siddik-layout-widgets-elementor' ),
				'free'    => true,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Elementor section, column & container enhancements', 'siddik-layout-widgets-elementor' ),
				'free'    => true,
				'pro'     => true,
			),
			array(
				'feature' => __( '50+ advanced marketing & layout widgets', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Pricing tables, countdown & image gallery widgets', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Header, footer & mega menu template parts', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Portfolio & project custom post types', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
			array(
				'feature' => __( 'WooCommerce shop widgets (cart, products, tabs)', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Interactive tabs, moving text & animated effects', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Newsletter, navigation menu & advanced forms', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
			array(
				'feature' => __( 'Priority support', 'siddik-layout-widgets-elementor' ),
				'free'    => false,
				'pro'     => true,
			),
		);
	}

	/**
	 * Render Go PRO page.
	 *
	 * @return void
	 */
	public function render_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$features      = $this->get_features();
		$early_access  = slwe_is_pro_early_access();
		$pro_installed = slwe_is_pro_installed();
		$pro_url       = slwe_get_pro_cta_url();
		$opens_new_tab = slwe_pro_cta_opens_new_tab();
		$target_attrs  = $opens_new_tab ? ' target="_blank" rel="noopener noreferrer"' : '';

		if ( $early_access ) {
			$footer_title = __( 'Ready to unlock PRO?', 'siddik-layout-widgets-elementor' );
			$footer_text  = $pro_installed
				? __( 'Activate Siddik Layout Widgets PRO alongside this plugin to instantly unlock all premium features — free during early access.', 'siddik-layout-widgets-elementor' )
				: __( 'Download and install Siddik Layout Widgets PRO alongside this plugin to instantly unlock all premium features — free during early access.', 'siddik-layout-widgets-elementor' );
			$footer_cta   = $pro_installed
				? __( 'Activate PRO Free', 'siddik-layout-widgets-elementor' )
				: __( 'Download PRO Free', 'siddik-layout-widgets-elementor' );
		} else {
			$footer_title = $pro_installed
				? __( 'Ready to activate PRO?', 'siddik-layout-widgets-elementor' )
				: __( 'Ready to upgrade?', 'siddik-layout-widgets-elementor' );
			$footer_text  = $pro_installed
				? __( 'Activate Siddik Layout Widgets PRO alongside this plugin to instantly unlock all premium widgets and template parts.', 'siddik-layout-widgets-elementor' )
				: __( 'Install Siddik Layout Widgets PRO alongside this plugin to instantly unlock all premium features.', 'siddik-layout-widgets-elementor' );
			$footer_cta   = $pro_installed
				? __( 'Activate PRO', 'siddik-layout-widgets-elementor' )
				: __( 'Get PRO Now', 'siddik-layout-widgets-elementor' );
		}
		?>
		<div class="wrap slwe-go-pro-wrap">
			<?php if ( $early_access ) : ?>
				<div class="slwe-go-pro-offer-banner">
					<span class="slwe-go-pro-offer-icon" aria-hidden="true">🎉</span>
					<span>
						<strong><?php esc_html_e( 'Launch Offer — All PRO Features FREE', 'siddik-layout-widgets-elementor' ); ?></strong>
						<?php esc_html_e( ' For a limited time, download and use the full PRO add-on at no cost. WooCommerce widgets, portfolio CPTs, template parts, and 50+ advanced blocks included.', 'siddik-layout-widgets-elementor' ); ?>
					</span>
				</div>
			<?php endif; ?>

			<div class="slwe-go-pro-hero">
				<span class="slwe-go-pro-badge">
					<?php
					if ( $early_access ) {
						esc_html_e( 'Early Access Offer', 'siddik-layout-widgets-elementor' );
					} elseif ( $pro_installed ) {
						esc_html_e( 'Almost There', 'siddik-layout-widgets-elementor' );
					} else {
						esc_html_e( 'Upgrade', 'siddik-layout-widgets-elementor' );
					}
					?>
				</span>
				<h1>
					<?php
					if ( $early_access ) {
						esc_html_e( 'Get Siddik Layout Widgets PRO — Free Early Access', 'siddik-layout-widgets-elementor' );
					} elseif ( $pro_installed ) {
						esc_html_e( 'Activate Siddik Layout Widgets PRO', 'siddik-layout-widgets-elementor' );
					} else {
						esc_html_e( 'Unlock Siddik Layout Widgets PRO', 'siddik-layout-widgets-elementor' );
					}
					?>
				</h1>
				<p class="slwe-go-pro-subtitle">
					<?php
					if ( $early_access && $pro_installed ) {
						esc_html_e( 'All PRO features are free during our launch period. PRO is already installed on your site — activate it now to unlock WooCommerce widgets, portfolio/project post types, template parts, and 50+ advanced blocks.', 'siddik-layout-widgets-elementor' );
					} elseif ( $early_access ) {
						esc_html_e( 'Download the PRO add-on free while we grow. Install it alongside this plugin for WooCommerce blocks, portfolio templates, and advanced Elementor widgets — everything included at no cost.', 'siddik-layout-widgets-elementor' );
					} elseif ( $pro_installed ) {
						esc_html_e( 'PRO is already installed on your site. Activate it to unlock WooCommerce widgets, portfolio/project post types, template parts, and 50+ advanced blocks.', 'siddik-layout-widgets-elementor' );
					} else {
						esc_html_e( 'Supercharge your Elementor builds with shop widgets, reusable headers and footers, portfolio post types, and premium layout blocks.', 'siddik-layout-widgets-elementor' );
					}
					?>
				</p>
				<a href="<?php echo esc_url( $pro_url ); ?>" class="button button-primary button-hero slwe-go-pro-cta"<?php echo $target_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php
					if ( $early_access && $pro_installed ) {
						esc_html_e( 'Activate PRO Free →', 'siddik-layout-widgets-elementor' );
					} elseif ( $early_access ) {
						esc_html_e( 'Download PRO Free →', 'siddik-layout-widgets-elementor' );
					} elseif ( $pro_installed ) {
						esc_html_e( 'Activate PRO Now →', 'siddik-layout-widgets-elementor' );
					} else {
						esc_html_e( 'Get Siddik Layout Widgets PRO →', 'siddik-layout-widgets-elementor' );
					}
					?>
				</a>
				<?php if ( $early_access ) : ?>
					<p class="slwe-go-pro-fine-print">
						<?php esc_html_e( 'Early adopters keep PRO access when paid pricing launches.', 'siddik-layout-widgets-elementor' ); ?>
					</p>
				<?php endif; ?>
			</div>

			<div class="slwe-go-pro-grid">
				<div class="slwe-go-pro-card slwe-go-pro-card-free">
					<h2><?php esc_html_e( 'Free', 'siddik-layout-widgets-elementor' ); ?></h2>
					<p class="slwe-go-pro-price"><?php esc_html_e( '$0', 'siddik-layout-widgets-elementor' ); ?></p>
					<p class="slwe-go-pro-desc"><?php esc_html_e( 'Perfect for blogs, business pages, and landing sections with 25+ widgets.', 'siddik-layout-widgets-elementor' ); ?></p>
				</div>
				<div class="slwe-go-pro-card slwe-go-pro-card-pro<?php echo $early_access ? ' slwe-go-pro-card-pro-offer' : ''; ?>">
					<?php if ( $early_access ) : ?>
						<span class="slwe-go-pro-card-offer-badge"><?php esc_html_e( 'Free Now', 'siddik-layout-widgets-elementor' ); ?></span>
					<?php endif; ?>
					<h2><?php esc_html_e( 'PRO', 'siddik-layout-widgets-elementor' ); ?></h2>
					<p class="slwe-go-pro-price">
						<?php
						if ( $early_access ) {
							esc_html_e( 'Free', 'siddik-layout-widgets-elementor' );
						} elseif ( $pro_installed ) {
							esc_html_e( 'Installed', 'siddik-layout-widgets-elementor' );
						} else {
							esc_html_e( 'Premium', 'siddik-layout-widgets-elementor' );
						}
						?>
					</p>
					<p class="slwe-go-pro-desc">
						<?php
						if ( $early_access ) {
							esc_html_e( 'Full PRO features at no cost during early access. Limited-time offer.', 'siddik-layout-widgets-elementor' );
						} elseif ( $pro_installed ) {
							esc_html_e( 'Activate PRO to unlock the full widget library and template system.', 'siddik-layout-widgets-elementor' );
						} else {
							esc_html_e( 'For agencies, shops, and sites that need the complete toolkit.', 'siddik-layout-widgets-elementor' );
						}
						?>
					</p>
					<a href="<?php echo esc_url( $pro_url ); ?>" class="button button-primary slwe-go-pro-card-btn"<?php echo $target_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php
						if ( $early_access && $pro_installed ) {
							esc_html_e( 'Activate PRO Free', 'siddik-layout-widgets-elementor' );
						} elseif ( $early_access ) {
							esc_html_e( 'Download PRO Free', 'siddik-layout-widgets-elementor' );
						} elseif ( $pro_installed ) {
							esc_html_e( 'Activate PRO', 'siddik-layout-widgets-elementor' );
						} else {
							esc_html_e( 'View Pricing', 'siddik-layout-widgets-elementor' );
						}
						?>
					</a>
				</div>
			</div>

			<div class="slwe-go-pro-table-wrap">
				<h2><?php esc_html_e( 'Feature Comparison', 'siddik-layout-widgets-elementor' ); ?></h2>
				<table class="slwe-go-pro-table">
					<thead>
						<tr>
							<th scope="col"><?php esc_html_e( 'Feature', 'siddik-layout-widgets-elementor' ); ?></th>
							<th scope="col"><?php esc_html_e( 'Free', 'siddik-layout-widgets-elementor' ); ?></th>
							<th scope="col"><?php esc_html_e( 'PRO', 'siddik-layout-widgets-elementor' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $features as $row ) : ?>
							<tr>
								<td><?php echo esc_html( $row['feature'] ); ?></td>
								<td><?php echo $row['free'] ? '<span class="slwe-check" aria-label="' . esc_attr__( 'Included', 'siddik-layout-widgets-elementor' ) . '">✓</span>' : '<span class="slwe-dash" aria-hidden="true">—</span>'; ?></td>
								<td><?php echo $row['pro'] ? '<span class="slwe-check slwe-check-pro" aria-label="' . esc_attr__( 'Included', 'siddik-layout-widgets-elementor' ) . '">✓</span>' : '<span class="slwe-dash" aria-hidden="true">—</span>'; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="slwe-go-pro-footer">
				<h3><?php echo esc_html( $footer_title ); ?></h3>
				<p><?php echo esc_html( $footer_text ); ?></p>
				<a href="<?php echo esc_url( $pro_url ); ?>" class="button button-primary button-hero"<?php echo $target_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo esc_html( $footer_cta ); ?>
				</a>
			</div>
		</div>
		<?php
	}
}

SLWE_Admin_Go_Pro::instance();
