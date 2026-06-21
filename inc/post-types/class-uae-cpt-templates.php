<?php
/**
 * Theme-independent template fallbacks for public plugin CPTs.
 *
 * @package SiddikLayoutWidgetsElementor
 */

namespace UniqueAddons\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Template fallback handler.
 */
final class CPT_Template_Fallback {

	/**
	 * Bootstrap hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_filter( 'template_include', __NAMESPACE__ . '\\uae_cpt_template_fallback', 99 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_fallback_styles' ) );
	}

	/**
	 * Final template loader for plugin public CPT views.
	 *
	 * @param string $template Current template path.
	 * @return string
	 */
	public static function filter_template_include( $template ) {
		foreach ( CPT_Constants::public_content_post_types() as $post_type ) {
			if ( is_singular( $post_type ) ) {
				return self::resolve_single_template( $post_type, $template );
			}

			if ( is_post_type_archive( $post_type ) ) {
				return self::resolve_archive_template( $post_type, $template );
			}
		}

		return $template;
	}

	/**
	 * Resolve single template for a post type.
	 *
	 * @param string $post_type Post type slug.
	 * @param string $template  Fallback path.
	 * @return string
	 */
	private static function resolve_single_template( $post_type, $template ) {
		$theme_candidates = array(
			'single-' . $post_type . '.php',
		);

		if ( CPT_Constants::PORTFOLIO === $post_type ) {
			$theme_candidates[] = 'single-portfolio.php';
		}
		if ( CPT_Constants::PROJECT === $post_type ) {
			$theme_candidates[] = 'single-project.php';
			$theme_candidates[] = 'single-projects.php';
		}

		$theme_template = locate_template( $theme_candidates );
		if ( $theme_template ) {
			return $theme_template;
		}

		$plugin_template = self::get_template_path( 'single-' . $post_type . '.php' );
		if ( ! $plugin_template && CPT_Constants::PORTFOLIO === $post_type ) {
			$plugin_template = self::get_template_path( 'single-portfolio.php' );
		}
		if ( ! $plugin_template && CPT_Constants::PROJECT === $post_type ) {
			$plugin_template = self::get_template_path( 'single-project.php' );
		}

		return $plugin_template ? $plugin_template : $template;
	}

	/**
	 * Resolve archive template for a post type.
	 *
	 * @param string $post_type Post type slug.
	 * @param string $template  Fallback path.
	 * @return string
	 */
	private static function resolve_archive_template( $post_type, $template ) {
		$theme_candidates = array(
			'archive-' . $post_type . '.php',
		);

		if ( CPT_Constants::PORTFOLIO === $post_type ) {
			$theme_candidates[] = 'archive-portfolio.php';
		}
		if ( CPT_Constants::PROJECT === $post_type ) {
			$theme_candidates[] = 'archive-project.php';
			$theme_candidates[] = 'archive-projects.php';
		}

		$theme_template = locate_template( $theme_candidates );
		if ( $theme_template ) {
			return $theme_template;
		}

		$plugin_template = self::get_template_path( 'archive-' . $post_type . '.php' );
		if ( ! $plugin_template && CPT_Constants::PORTFOLIO === $post_type ) {
			$plugin_template = self::get_template_path( 'archive-portfolio.php' );
		}
		if ( ! $plugin_template && CPT_Constants::PROJECT === $post_type ) {
			$plugin_template = self::get_template_path( 'archive-project.php' );
		}

		return $plugin_template ? $plugin_template : $template;
	}

	/**
	 * Resolve a plugin template file path.
	 *
	 * @param string $filename Template filename.
	 * @return string|false
	 */
	public static function get_template_path( $filename ) {
		$path = UNIQUE_ADDONS_ABS_PATH . 'templates/' . $filename;
		return is_readable( $path ) ? $path : false;
	}

	/**
	 * Enqueue minimal fallback styles on plugin CPT views.
	 *
	 * @return void
	 */
	public static function enqueue_fallback_styles() {
		$is_plugin_cpt = false;
		foreach ( CPT_Constants::public_content_post_types() as $post_type ) {
			if ( is_singular( $post_type ) || is_post_type_archive( $post_type ) ) {
				$is_plugin_cpt = true;
				break;
			}
		}

		if ( ! $is_plugin_cpt ) {
			return;
		}

		wp_enqueue_style(
			'uae-cpt-fallback-templates',
			UNIQUE_ADDONS_ASSETS_URI . '/css/cpt-fallback-templates.css',
			array(),
			UNIQUE_ADDONS_VERSION
		);
	}
}

/**
 * Public CPT template fallback for template_include.
 *
 * @param string $template Current template path.
 * @return string
 */
function uae_cpt_template_fallback( $template ) {
	return CPT_Template_Fallback::filter_template_include( $template );
}

/** @deprecated 2.0.0 Use uae_cpt_template_fallback() */
function uae_portfolio_template_fallback( $template ) {
	return uae_cpt_template_fallback( $template );
}
