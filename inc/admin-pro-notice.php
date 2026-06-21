<?php
/**
 * Admin upsell: Get Pro link, notices, and plugin row actions.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_notices', 'slwe_free_admin_pro_notice' );
add_filter( 'plugin_action_links_' . plugin_basename( UNIQUE_ADDONS_MAIN_FILE ), 'slwe_free_plugin_action_links' );
add_filter( 'plugin_row_meta', 'slwe_free_plugin_row_meta', 10, 2 );

/**
 * Add Get Pro / Activate Pro link on the Plugins screen.
 *
 * @param array<string> $links Existing action links.
 * @return array<string>
 */
function slwe_free_plugin_action_links( $links ) {
	if ( slwe_is_pro_active() ) {
		return $links;
	}

	$links[] = sprintf(
		'<a href="%1$s" style="color:#4338ca;font-weight:600;">%2$s</a>',
		esc_url( slwe_get_go_pro_admin_url() ),
		esc_html__( 'Go PRO', 'siddik-layout-widgets-elementor' )
	);

	return $links;
}

/**
 * Add Upgrade to Pro link in plugin meta row.
 *
 * @param array<string> $links Existing meta links.
 * @param string        $file  Plugin basename.
 * @return array<string>
 */
function slwe_free_plugin_row_meta( $links, $file ) {
	if ( plugin_basename( UNIQUE_ADDONS_MAIN_FILE ) !== $file || slwe_is_pro_active() ) {
		return $links;
	}

	$links[] = sprintf(
		'<a href="%1$s"><strong>%2$s</strong></a>',
		esc_url( slwe_get_go_pro_admin_url() ),
		esc_html__( 'Go PRO', 'siddik-layout-widgets-elementor' )
	);

	return $links;
}

/**
 * Show a dismissible notice when Pro is not active.
 *
 * @return void
 */
function slwe_free_admin_pro_notice() {
	if ( ! current_user_can( 'manage_options' ) || slwe_is_pro_active() ) {
		return;
	}

	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if ( ! $screen || ! in_array( $screen->id, array( 'plugins', 'dashboard', 'edit-page', 'elementor_page_elementor' ), true ) ) {
		return;
	}

	if ( slwe_is_pro_installed() ) {
		$message = esc_html__( 'Siddik Layout Widgets Pro is installed but not active. Activate it to unlock WooCommerce widgets, portfolio/project post types, and advanced blocks.', 'siddik-layout-widgets-elementor' );
		$cta_url = slwe_get_pro_activate_url();
		$cta     = esc_html__( 'Activate Pro', 'siddik-layout-widgets-elementor' );
		$external = false;
	} else {
		$message = esc_html__( 'Unlock 50+ advanced widgets, WooCommerce shop blocks, portfolio/project post types, and reusable header/footer templates with Siddik Layout Widgets Pro.', 'siddik-layout-widgets-elementor' );
		$cta_url = slwe_get_go_pro_admin_url();
		$cta     = esc_html__( 'Go PRO', 'siddik-layout-widgets-elementor' );
		$external = false;
	}

	printf(
		'<div class="notice notice-info is-dismissible"><p>%1$s <a href="%2$s" class="button button-primary"%3$s>%4$s</a></p></div>',
		esc_html( $message ),
		esc_url( $cta_url ),
		$external ? ' target="_blank" rel="noopener noreferrer"' : '',
		esc_html( $cta )
	);
}
