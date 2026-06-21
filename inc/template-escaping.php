<?php
/**
 * Template output escaping helpers.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'unique_addons_print_pre_escaped_html_attrs' ) ) {
	/**
	 * Print HTML attribute strings that were escaped when they were built.
	 *
	 * @param string|array $attrs Attribute string or list of attribute strings.
	 * @return void
	 */
	function unique_addons_print_pre_escaped_html_attrs( $attrs ) {
		if ( empty( $attrs ) ) {
			return;
		}

		if ( is_array( $attrs ) ) {
			$attrs = implode( ' ', $attrs );
		}

		echo ' ' . $attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Attribute values are escaped when attributes are built.
	}
}

if ( ! function_exists( 'unique_addons_get_placeholder_image_url' ) ) {
	/**
	 * Local placeholder image URL bundled with the plugin.
	 *
	 * @return string
	 */
	function unique_addons_get_placeholder_image_url() {
		return UNIQUE_ADDONS_ASSETS_URI . '/images/placeholder.svg';
	}
}

if ( ! function_exists( 'unique_addons_maybe_enqueue_gsap_script' ) ) {
	/**
	 * Enqueue a GSAP-related script only when it is already registered by the theme.
	 *
	 * @param string $handle Script handle.
	 * @return void
	 */
	function unique_addons_maybe_enqueue_gsap_script( $handle ) {
		if ( wp_script_is( $handle, 'registered' ) ) {
			wp_enqueue_script( $handle );
		}
	}
}

if ( ! function_exists( 'unique_addons_get_kses_allowed_html' ) ) {
	/**
	 * Allowed HTML tags for widget template output.
	 *
	 * @return array
	 */
	function unique_addons_get_kses_allowed_html() {
		$allowed = wp_kses_allowed_html( 'post' );

		$allowed['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
			'allow'           => true,
			'loading'         => true,
			'title'           => true,
		);

		$allowed['svg'] = array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
		);

		return apply_filters( 'unique_addons_kses_allowed_html', $allowed );
	}
}

if ( ! function_exists( 'unique_addons_print_template_html' ) ) {
	/**
	 * Echo sanitized template HTML from partials.
	 *
	 * @param string $html Raw template HTML.
	 * @return void
	 */
	function unique_addons_print_template_html( $html ) {
		echo wp_kses( (string) $html, unique_addons_get_kses_allowed_html() );
	}
}

if ( ! function_exists( 'unique_addons_print_elementor_template_content' ) ) {
	/**
	 * Echo Elementor builder content safely.
	 *
	 * @param string $content Elementor frontend content.
	 * @return void
	 */
	function unique_addons_print_elementor_template_content( $content ) {
		echo wp_kses( (string) $content, unique_addons_get_kses_allowed_html() );
	}
}

if ( ! function_exists( 'unique_addons_print_link_target_attrs' ) ) {
	/**
	 * Print target and rel attributes for Elementor link controls.
	 *
	 * @param array $link Elementor URL control array.
	 * @return void
	 */
	function unique_addons_print_link_target_attrs( $link ) {
		if ( ! empty( $link['is_external'] ) ) {
			echo ' target="_blank"';
		}
		if ( ! empty( $link['nofollow'] ) ) {
			echo ' rel="nofollow"';
		}
	}
}

if ( ! function_exists( 'unique_addons_render_template_file' ) ) {
	/**
	 * Include a template file with params available in local scope.
	 *
	 * Always exposes the full params array as $settings, then extracts
	 * individual keys for legacy tpl/*.php partials.
	 *
	 * @param string $located  Absolute path to the template file.
	 * @param array  $params   Variables for the template partial.
	 * @param bool   $capture  Whether to return buffered output.
	 * @return string
	 */
	function unique_addons_render_template_file( $located, $params = array(), $capture = false ) {
		$settings = is_array( $params ) ? $params : array();

		$loader = function () use ( $located, $settings ) {
			if ( ! empty( $settings ) ) {
				// phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- Required for legacy template partials.
				extract( $settings, EXTR_SKIP );
			}

			include $located;
		};

		if ( $capture ) {
			ob_start();
			$loader();
			return (string) ob_get_clean();
		}

		$loader();

		return '';
	}
}

if ( ! function_exists( 'unique_addons_load_template_vars' ) ) {
	/**
	 * @deprecated 2.0.0 Use unique_addons_render_template_file() instead.
	 * @param array $params Variables for the template partial.
	 * @return void
	 */
	function unique_addons_load_template_vars( $params ) {
		// Intentionally empty. Extraction must happen in the same scope as the template include.
	}
}
