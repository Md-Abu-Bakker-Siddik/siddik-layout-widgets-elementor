<?php
/**
 * Shortcode-based rendering for template part CPTs.
 *
 * @package SiddikLayoutWidgetsElementor
 */

namespace UniqueAddons\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT display via shortcodes.
 */
final class CPT_Display {

	/**
	 * Bootstrap hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_shortcode( 'slwe_template_part', array( __CLASS__, 'shortcode_template_part' ) );
		add_shortcode( 'slwe_footer', array( __CLASS__, 'shortcode_footer' ) );
		add_shortcode( 'slwe_megamenu', array( __CLASS__, 'shortcode_megamenu' ) );
		add_shortcode( 'slwe_header_top', array( __CLASS__, 'shortcode_header_top' ) );
		add_shortcode( 'slwe_page_title', array( __CLASS__, 'shortcode_page_title' ) );
		add_shortcode( 'slwe_side_panel', array( __CLASS__, 'shortcode_side_panel' ) );

		add_action( 'admin_init', array( __CLASS__, 'register_usage_meta_box' ) );
	}

	public static function shortcode_template_part( $atts ) {
		$atts    = shortcode_atts( array( 'id' => 0 ), $atts, 'slwe_template_part' );
		$post_id = absint( $atts['id'] );
		if ( ! $post_id ) {
			return '';
		}
		$post = get_post( $post_id );
		if ( ! $post || ! in_array( $post->post_type, CPT_Constants::template_part_post_types(), true ) ) {
			return '';
		}
		return self::render_post( $post_id );
	}

	public static function shortcode_footer( $atts ) {
		return self::shortcode_for_type( $atts, CPT_Constants::FOOTER, 'slwe_footer' );
	}

	public static function shortcode_megamenu( $atts ) {
		return self::shortcode_for_type( $atts, CPT_Constants::MEGAMENU, 'slwe_megamenu' );
	}

	public static function shortcode_header_top( $atts ) {
		return self::shortcode_for_type( $atts, CPT_Constants::HEADER_TOP, 'slwe_header_top' );
	}

	public static function shortcode_page_title( $atts ) {
		return self::shortcode_for_type( $atts, CPT_Constants::PAGE_TITLE, 'slwe_page_title' );
	}

	public static function shortcode_side_panel( $atts ) {
		return self::shortcode_for_type( $atts, CPT_Constants::SIDE_PANEL, 'slwe_side_panel' );
	}

	private static function shortcode_for_type( $atts, $post_type, $tag ) {
		$atts    = shortcode_atts( array( 'id' => 0 ), $atts, $tag );
		$post_id = absint( $atts['id'] );
		if ( ! $post_id ) {
			return '';
		}
		$post = get_post( $post_id );
		if ( ! $post || $post_type !== $post->post_type ) {
			return '';
		}
		return self::render_post( $post_id );
	}

	public static function render_post( $post_id ) {
		$post_id = absint( $post_id );
		if ( ! $post_id ) {
			return '';
		}

		$post = get_post( $post_id );
		if ( ! $post || 'publish' !== $post->post_status ) {
			return '';
		}

		if ( ! is_post_type_viewable( $post->post_type ) ) {
			return '';
		}

		if ( class_exists( '\Elementor\Plugin' ) ) {
			$elementor    = \Elementor\Plugin::$instance;
			$is_elementor = false;

			if ( isset( $elementor->db ) && method_exists( $elementor->db, 'is_built_with_elementor' ) ) {
				$is_elementor = $elementor->db->is_built_with_elementor( $post_id );
			} else {
				$is_elementor = (bool) get_post_meta( $post_id, '_elementor_edit_mode', true );
			}

			if ( $is_elementor && method_exists( $elementor->frontend, 'get_builder_content_for_display' ) ) {
				$content = $elementor->frontend->get_builder_content_for_display( $post_id );
				if ( $content ) {
					return '<div class="uae-template-part uae-template-part-' . esc_attr( $post->post_type ) . ' uae-template-part-' . esc_attr( (string) $post_id ) . '">' . $content . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}

		$content = apply_filters( 'the_content', $post->post_content );
		return '<div class="uae-template-part uae-template-part-' . esc_attr( $post->post_type ) . ' uae-template-part-' . esc_attr( (string) $post_id ) . '">' . $content . '</div>';
	}

	public static function get_shortcode_for_post( $post_id, $tag ) {
		return sprintf( '[%s id="%d"]', $tag, absint( $post_id ) );
	}

	public static function register_usage_meta_box() {
		foreach ( CPT_Constants::template_part_post_types() as $post_type ) {
			add_meta_box(
				'uae-template-part-usage',
				esc_html__( 'How to Display', 'siddik-layout-widgets-elementor' ),
				array( __CLASS__, 'render_usage_meta_box' ),
				$post_type,
				'side',
				'high'
			);
		}
	}

	public static function render_usage_meta_box( $post ) {
		$tag       = CPT_Constants::get_shortcode_tag( $post->post_type );
		$shortcode = self::get_shortcode_for_post( $post->ID, $tag );

		echo '<p>' . esc_html__( 'This template is not injected into your theme automatically. Place it using one of the methods below:', 'siddik-layout-widgets-elementor' ) . '</p>';
		echo '<p><strong>' . esc_html__( 'Shortcode', 'siddik-layout-widgets-elementor' ) . '</strong></p>';
		echo '<code style="display:block;word-break:break-all;">' . esc_html( $shortcode ) . '</code>';
		echo '<p><strong>' . esc_html__( 'Elementor', 'siddik-layout-widgets-elementor' ) . '</strong></p>';
		echo '<p>' . esc_html__( 'Use an Elementor Shortcode widget, or assign this template in Elementor Theme Builder.', 'siddik-layout-widgets-elementor' ) . '</p>';
	}
}
