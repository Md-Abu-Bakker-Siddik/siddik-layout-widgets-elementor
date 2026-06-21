<?php
/**
 * Siddik Layout Widgets — shared helpers (Free + Pro).
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether the Pro add-on plugin is active.
 *
 * @return bool
 */
function slwe_is_pro_active() {
	return defined( 'SLWE_PRO_VERSION' ) && SLWE_PRO_VERSION;
}

/**
 * Absolute path to the Free plugin root.
 *
 * @return string
 */
function slwe_free_plugin_path() {
	return defined( 'UNIQUE_ADDONS_ABS_PATH' ) ? UNIQUE_ADDONS_ABS_PATH : '';
}

/**
 * URI to the Free plugin assets directory (shared by Pro widgets).
 *
 * @return string
 */
function slwe_free_assets_uri() {
	return defined( 'UNIQUE_ADDONS_ASSETS_URI' ) ? UNIQUE_ADDONS_ASSETS_URI : '';
}

/**
 * URL where users can purchase or download Pro.
 *
 * @return string
 */
function slwe_get_pro_store_url() {
	$url = 'https://siddiklayoutwidgets.com/';

	/**
	 * Filter the Pro purchase / download URL shown in admin upsell links.
	 *
	 * @param string $url Store URL.
	 */
	return apply_filters( 'slwe_pro_store_url', $url );
}

/**
 * Basename of the installed Pro plugin file, if present.
 *
 * @return string
 */
function slwe_get_pro_plugin_basename() {
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	foreach ( array_keys( get_plugins() ) as $basename ) {
		if ( false !== strpos( $basename, 'siddik-layout-widgets-elementor-pro.php' ) ) {
			return $basename;
		}
	}

	return '';
}

/**
 * Whether the Pro plugin is installed (active or not).
 *
 * @return bool
 */
function slwe_is_pro_installed() {
	return slwe_is_pro_active() || '' !== slwe_get_pro_plugin_basename();
}

/**
 * Admin URL to activate the Pro plugin.
 *
 * @return string
 */
function slwe_get_pro_activate_url() {
	$basename = slwe_get_pro_plugin_basename();

	if ( ! $basename ) {
		return slwe_get_pro_store_url();
	}

	return wp_nonce_url(
		admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $basename ) ),
		'activate-plugin_' . $basename
	);
}

/**
 * Admin page slug for the Go PRO screen.
 *
 * @return string
 */
function slwe_get_go_pro_page_slug() {
	return 'siddik-layout-widgets-go-pro';
}

/**
 * Main admin menu slug.
 *
 * @return string
 */
function slwe_get_admin_menu_slug() {
	return 'siddik-layout-widgets';
}

/**
 * URL to the Getting Started admin page.
 *
 * @return string
 */
function slwe_get_getting_started_admin_url() {
	return admin_url( 'admin.php?page=' . slwe_get_admin_menu_slug() );
}

/**
 * URL to the Go PRO admin page.
 *
 * @return string
 */
function slwe_get_go_pro_admin_url() {
	return admin_url( 'admin.php?page=' . slwe_get_go_pro_page_slug() );
}

/**
 * Whether Pro is offered as a free early-access download.
 *
 * @return bool
 */
function slwe_is_pro_early_access() {
	return (bool) apply_filters( 'slwe_pro_early_access_enabled', true );
}

/**
 * URL to download the Pro add-on ZIP.
 *
 * @return string
 */
function slwe_get_pro_download_url() {
	$url = 'https://drive.google.com/uc?export=download&id=15L8e8suu-Jfp5GSQNmlhhP97HznSlyMw';

	/**
	 * Filter the direct Pro plugin download URL.
	 *
	 * @param string $url Download URL.
	 */
	return apply_filters( 'slwe_pro_download_url', $url );
}

/**
 * Primary CTA URL for Pro upsell (activate, download, or store).
 *
 * @return string
 */
function slwe_get_pro_cta_url() {
	if ( slwe_is_pro_active() ) {
		return slwe_get_go_pro_admin_url();
	}

	if ( slwe_is_pro_installed() ) {
		return slwe_get_pro_activate_url();
	}

	if ( slwe_is_pro_early_access() ) {
		return slwe_get_pro_download_url();
	}

	return slwe_get_pro_store_url();
}

/**
 * Whether the Pro CTA should open in a new tab.
 *
 * @return bool
 */
function slwe_pro_cta_opens_new_tab() {
	return ! slwe_is_pro_installed() && ! slwe_is_pro_active();
}
