<?php
/**
 * Theme-independent helper fallbacks for blog/CPT templates.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'unique_addons_get_post_thumbnail' ) ) {
	/**
	 * Output post thumbnail markup.
	 *
	 * @param string $post_format       Post format slug.
	 * @param string $featured_image_size Image size slug.
	 * @return void
	 */
	function unique_addons_get_post_thumbnail( $post_format = 'standard', $featured_image_size = 'medium' ) {
		if ( ! has_post_thumbnail() ) {
			return;
		}

		$size = sanitize_key( $featured_image_size );
		if ( empty( $size ) ) {
			$size = 'medium';
		}

		echo get_the_post_thumbnail( get_the_ID(), $size ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'unique_addons_get_post_thumbnail_img' ) ) {
	/**
	 * Output post thumbnail as img tag only.
	 *
	 * @param string $post_format       Post format slug.
	 * @param string $featured_image_size Image size slug.
	 * @return void
	 */
	function unique_addons_get_post_thumbnail_img( $post_format = 'standard', $featured_image_size = 'medium' ) {
		unique_addons_get_post_thumbnail( $post_format, $featured_image_size );
	}
}

if ( ! function_exists( 'unique_addons_get_excerpt' ) ) {
	/**
	 * Output post excerpt.
	 *
	 * @param int $length Optional excerpt length.
	 * @return void
	 */
	function unique_addons_get_excerpt( $length = 0 ) {
		$length = absint( $length );

		if ( $length > 0 ) {
			echo esc_html( unique_addons_slice_excerpt_by_length( get_the_excerpt(), $length ) );
			return;
		}

		echo wp_kses_post( get_the_excerpt() );
	}
}

if ( ! function_exists( 'unique_addons_slice_excerpt_by_length' ) ) {
	/**
	 * Trim excerpt to a character length.
	 *
	 * @param string $text   Excerpt text.
	 * @param int    $length Character limit.
	 * @return string
	 */
	function unique_addons_slice_excerpt_by_length( $text, $length ) {
		$length = absint( $length );
		$text   = wp_strip_all_tags( (string) $text );

		if ( $length <= 0 || strlen( $text ) <= $length ) {
			return $text;
		}

		return substr( $text, 0, $length ) . '&hellip;';
	}
}

if ( ! function_exists( 'unique_addons_slice_text_by_length' ) ) {
	/**
	 * Trim plain text to a character length.
	 *
	 * @param string $text   Source text.
	 * @param int    $length Character limit.
	 * @return string
	 */
	function unique_addons_slice_text_by_length( $text, $length ) {
		return unique_addons_slice_excerpt_by_length( $text, $length );
	}
}

if ( ! function_exists( 'unique_addons_post_shortcode_meta' ) ) {
	/**
	 * Output basic post meta for shortcode templates.
	 *
	 * @param array $post_meta_options Enabled meta keys.
	 * @param array $extra           Unused legacy argument.
	 * @return void
	 */
	function unique_addons_post_shortcode_meta( $post_meta_options = array(), $extra = array() ) {
		if ( empty( $post_meta_options ) || ! is_array( $post_meta_options ) ) {
			return;
		}

		echo '<ul class="entry-meta list-inline">';

		if ( in_array( 'date', $post_meta_options, true ) ) {
			echo '<li class="entry-date"><i class="far fa-calendar-alt"></i> ' . esc_html( get_the_date() ) . '</li>';
		}

		if ( in_array( 'author', $post_meta_options, true ) ) {
			echo '<li class="entry-author"><i class="far fa-user"></i> ' . esc_html( get_the_author() ) . '</li>';
		}

		if ( in_array( 'category', $post_meta_options, true ) ) {
			echo '<li class="entry-category"><i class="far fa-folder"></i> ' . wp_kses_post( get_the_category_list( ', ' ) ) . '</li>';
		}

		if ( in_array( 'comments', $post_meta_options, true ) ) {
			echo '<li class="entry-comments"><i class="far fa-comment"></i> ' . esc_html( get_comments_number() ) . '</li>';
		}

		echo '</ul>';
	}
}

if ( ! function_exists( 'unique_addons_post_shortcode_single_meta' ) ) {
	/**
	 * Output a single meta item above featured image.
	 *
	 * @param array $post_meta_options Enabled meta keys.
	 * @return void
	 */
	function unique_addons_post_shortcode_single_meta( $post_meta_options = array() ) {
		unique_addons_post_shortcode_meta( is_array( $post_meta_options ) ? $post_meta_options : array( $post_meta_options ) );
	}
}

if ( ! function_exists( 'unique_addons_get_pagination' ) ) {
	/**
	 * Output numbered pagination for archive loops.
	 *
	 * @return void
	 */
	function unique_addons_get_pagination() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => esc_html__( '&laquo; Previous', 'siddik-layout-widgets-elementor' ),
				'next_text' => esc_html__( 'Next &raquo;', 'siddik-layout-widgets-elementor' ),
			)
		);
	}
}

if ( ! function_exists( 'unique_addons_get_rwmb_group' ) ) {
	/**
	 * Legacy meta-box group accessor — returns empty when Meta Box is unavailable.
	 *
	 * @return string
	 */
	function unique_addons_get_rwmb_group() {
		return '';
	}
}

if ( ! function_exists( 'unique_addons_display_breadcrumbs' ) ) {
	/**
	 * Output a simple breadcrumb trail.
	 *
	 * @param string $icon_html Optional separator icon markup.
	 * @return void
	 */
	function unique_addons_display_breadcrumbs( $icon_html = '' ) {
		if ( is_front_page() ) {
			return;
		}

		$separator = $icon_html ? wp_kses_post( $icon_html ) : '<span class="tm-breadcrumb-arrow-icon">/</span>';
		$crumbs    = array(
			'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'siddik-layout-widgets-elementor' ) . '</a>',
		);

		if ( is_home() ) {
			$crumbs[] = esc_html( get_the_title( get_option( 'page_for_posts' ) ) );
		} elseif ( is_singular() ) {
			$crumbs[] = esc_html( get_the_title() );
		} elseif ( is_archive() ) {
			$crumbs[] = esc_html( get_the_archive_title() );
		} elseif ( is_search() ) {
			$crumbs[] = esc_html__( 'Search Results', 'siddik-layout-widgets-elementor' );
		}

		echo '<ul class="breadcrumbs list-inline">';
		foreach ( $crumbs as $index => $crumb ) {
			if ( $index > 0 ) {
				echo '<li class="breadcrumb-separator">' . $separator . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			echo '<li>' . $crumb . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '</ul>';
	}
}

if ( ! function_exists( 'unique_addons_post_category' ) ) {
	/**
	 * Output post category list.
	 *
	 * @return void
	 */
	function unique_addons_post_category() {
		echo wp_kses_post( get_the_category_list( ', ' ) );
	}
}
