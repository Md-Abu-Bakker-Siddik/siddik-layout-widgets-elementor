<?php
/**
 * Custom post type identifiers for Siddik Layout Widgets for Elementor.
 *
 * @package SiddikLayoutWidgetsElementor
 */

namespace UniqueAddons\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT slug constants (uae_ = internal plugin prefix, max 20 chars).
 */
final class CPT_Constants {

	const PREFIX = 'uae_';

	// Public content CPTs.
	const PORTFOLIO     = 'uae_portfolio';
	const PORTFOLIO_CAT = 'uae_portfolio_cat';
	const PORTFOLIO_TAG = 'uae_portfolio_tag';
	const PROJECT       = 'uae_project';
	const PROJECT_CAT   = 'uae_project_cat';

	// Elementor template parts (shortcode-driven, never auto-injected).
	const FOOTER      = 'uae_footer';
	const MEGAMENU    = 'uae_megamenu';
	const HEADER_TOP  = 'uae_header_top';
	const PAGE_TITLE  = 'uae_page_title';
	const SIDE_PANEL  = 'uae_side_panel';

	/**
	 * Template part CPTs.
	 *
	 * @return string[]
	 */
	public static function template_part_post_types() {
		return array(
			self::FOOTER,
			self::MEGAMENU,
			self::HEADER_TOP,
			self::PAGE_TITLE,
			self::SIDE_PANEL,
		);
	}

	/**
	 * Public content CPTs with archive pages.
	 *
	 * @return string[]
	 */
	public static function public_content_post_types() {
		return array(
			self::PORTFOLIO,
			self::PROJECT,
		);
	}

	/**
	 * Shortcode tag for a template part post type.
	 *
	 * @param string $post_type Post type slug.
	 * @return string
	 */
	public static function get_shortcode_tag( $post_type ) {
		$map = array(
			self::FOOTER     => 'uae_footer',
			self::MEGAMENU   => 'uae_megamenu',
			self::HEADER_TOP => 'uae_header_top',
			self::PAGE_TITLE => 'uae_page_title',
			self::SIDE_PANEL => 'uae_side_panel',
		);

		return isset( $map[ $post_type ] ) ? $map[ $post_type ] : 'uae_template_part';
	}
}
