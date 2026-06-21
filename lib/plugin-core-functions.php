<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Null Funcion
function unique_addons_null_function() {}

if(!function_exists('unique_addons_get_cpt_template_part')) {
	/**
	 * Load a cpt template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function unique_addons_get_cpt_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start  = false ) {

		$template_path = 'inc/post-types/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('unique_addons_get_widget_template_part')) {
	/**
	 * Load a widget template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $widget_ob_start only for widget to get HTML string.
	 */
	function unique_addons_get_widget_template_part( $slug, $name = null, $folder = '', $params = array(), $widget_ob_start  = false ) {

		$template_path = 'inc/widgets/parts/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params, $widget_ob_start );

	}
}

if(!function_exists('unique_addons_get_shortcodes_template_part')) {
	/**
	 * Load a shortcodes template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $widget_ob_start only for widget to get HTML string.
	 */
	function unique_addons_get_shortcodes_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start  = false ) {

		$template_path = 'inc/shortcodes/parts/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('unique_addons_get_inc_folder_template_part')) {
	/**
	 * Load a inc folder template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function unique_addons_get_inc_folder_template_part( $slug, $name = null, $folder = '', $params = array() ) {

		$template_path = 'inc/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params );

	}
}

if(!function_exists('unique_addons_get_template_part')) {
	/**
	 * Load a template part into a template
	 *
	 * @param string $template_path path of the specialised template.
	 * @param string $name The name of the specialised template.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function unique_addons_get_template_part( $template_path, $name = null, $params = array(), $shortcode_ob_start = false ) {

		$templates = array();
		$name = (string) $name;
		if ( '' !== $name ) {
			$templates[] = "{$template_path}-{$name}.php";
		}

		$templates[] = "{$template_path}.php";

		$located = unique_addons_locate_template( $templates );

		if ( $located ) {
			return unique_addons_render_template_file( $located, $params, (bool) $shortcode_ob_start );
		}

		return '';
	}
}

if(!function_exists('unique_addons_locate_template')) {
	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * Searches in the UAE_LEGACY_STYLESHEET_DIR before UAE_LEGACY_TEMPLATE_DIR
	 * so that themes which inherit from a parent theme can just overload one file.
	 *
	 * @param string|array $template_names Template file(s) to search for, in order.
	 * @return string The template filename if one is located.
	 */
	function unique_addons_locate_template($template_names) {
		$located = '';
		foreach ( (array) $template_names as $template_name ) {
			if ( !$template_name ) {
				continue;
			}
			if ( file_exists(UNIQUE_ADDONS_ABS_PATH . '/' . $template_name)) {
				$located = UNIQUE_ADDONS_ABS_PATH . '/' . $template_name;
				break;
			}
		}
		return $located;
	}
}


if ( ! function_exists( 'unique_addons_category_list_array_for_vc' ) ) {
	/**
	 * Return category list array for VC
	 */
	function unique_addons_category_list_array_for_vc( $taxonomy ) {
		$list_categories = array(
			esc_html__( 'All', 'siddik-layout-widgets-elementor' ) => ''
		);
		$terms = get_terms( $taxonomy );

		if ( $terms && !is_wp_error( $terms ) ) :
			foreach ( $terms as $term ) {
				$list_categories[ $term->name ] = $term->slug;
			}
		endif;

		return $list_categories;
	}
}

if ( ! function_exists( 'unique_addons_vc_add_css_editor' ) ) {
	/**
	 * Return array of VC css editor
	 */
	function unique_addons_vc_add_css_editor( $name = 'css' ) {
		$data = array(
			'type'       => 'css_editor',
			'heading'    => esc_html__('Css', 'siddik-layout-widgets-elementor'),
			'param_name' => $name,
			'group'      => esc_html__('Design options', 'siddik-layout-widgets-elementor')
		);
		return apply_filters('unique_addons_vc_add_css_editor', $data);
	}
}


if ( ! function_exists( 'unique_addons_get_redux_option' ) ) {
	/**
	 * Returns a plugin option value or the provided fallback.
	 *
	 * Legacy Redux theme options are no longer read; callers receive fallbacks.
	 */
	function unique_addons_get_redux_option( $id, $fallback = false, $param = false ) {
		unset( $id );

		if ( false === $fallback ) {
			$fallback = '';
		}

		if ( $param && is_array( $fallback ) && isset( $fallback[ $param ] ) ) {
			return $fallback[ $param ];
		}

		return $fallback;
	}
}

if ( ! function_exists( 'unique_addons_return_false' ) ) {
	function unique_addons_return_false() {
		return false;
	}
}



if ( ! function_exists( 'unique_addons_get_url_params' ) ) {
	/**
	 * Retrieve a sanitized value from the current request query string.
	 *
	 * @param string $param Query parameter name.
	 * @return string
	 */
	function unique_addons_get_url_params( $param ) {
		$param = sanitize_key( $param );
		if ( '' === $param ) {
			return '';
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only query arg lookup.
		if ( isset( $_GET[ $param ] ) ) {
			return sanitize_text_field( wp_unslash( $_GET[ $param ] ) );
		}

		return '';
	}
}


if ( ! function_exists( 'unique_addons_is_empty' ) ) {
	/**
	 * Check whether a value is empty.
	 *
	 * @param mixed $val Value to check.
	 * @return bool
	 */
	function unique_addons_is_empty( $val ) {
		return empty( $val );
	}
}




if ( ! class_exists( 'Unique_Addons_T5_Richtext_Excerpt' ) ) {
	/**
	 * Replaces the default excerpt editor with TinyMCE.
	 */
	class Unique_Addons_T5_Richtext_Excerpt {
		/**
		 * Replaces the meta boxes.
		 *
		 * @return void
		 */
		public static function switch_boxes() {
			//if wocommerce then return
			global $pagenow;
			if (( $pagenow == 'post.php' ) || (get_post_type() == 'product')) {
				return;
			}
			if ( ! post_type_supports( $GLOBALS['post']->post_type, 'excerpt' ) ) {
				return;
			}

			remove_meta_box(
				'postexcerpt' // ID
			,   ''            // Screen, empty to support all post types
			,   'normal'      // Context
			);

			add_meta_box(
				'postexcerpt2'     // Reusing just 'postexcerpt' doesn't work.
			,   esc_html__( 'Excerpt', 'siddik-layout-widgets-elementor' )    // Title
			,   array ( __CLASS__, 'show' ) // Display function
			,   null              // Screen, we use all screens with meta boxes.
			,   'normal'          // Context
			,   'core'            // Priority
			);
		}

		/**
		 * Output for the meta box.
		 *
		 * @param  object $post
		 * @return void
		 */
		public static function show( $post ) {
		?>
			<label class="screen-reader-text" for="excerpt"><?php esc_html_e( 'Excerpt', 'siddik-layout-widgets-elementor' ); ?></label>
			<?php
			// We use the default name, 'excerpt', so we don’t have to care about
			// saving, other filters etc.
			wp_editor(
				self::unescape( $post->post_excerpt ),
				'excerpt',
				array (
				'textarea_rows' => 15
			,   'media_buttons' => FALSE
			,   'teeny'         => TRUE
			,   'tinymce'       => TRUE
				)
			);
		}

		/**
		 * The excerpt is escaped usually. This breaks the HTML editor.
		 *
		 * @param  string $str
		 * @return string
		 */
		public static function unescape( $str ) {
			return str_replace(
				array ( '&lt;', '&gt;', '&quot;', '&amp;', '&nbsp;', '&amp;nbsp;' )
			,   array ( '<',    '>',    '"',      '&',     ' ', ' ' )
			,   $str
			);
		}
	}
	add_action( 'add_meta_boxes', array ( 'Unique_Addons_T5_Richtext_Excerpt', 'switch_boxes' ) );
}

if(!function_exists('unique_addons_slice_text_by_length')) {
	/**
	 * Slice Text by length
	 */
	function unique_addons_slice_text_by_length( $text, $word_length = 0 ) {
		$word_length = absint( $word_length );
		$text        = wp_strip_all_tags( (string) $text );

		if ( $word_length <= 0 || strlen( $text ) <= $word_length ) {
			return $text;
		}

		return substr( $text, 0, $word_length ) . '&hellip;';
	}
}

if(!function_exists('unique_addons_posted_on_date')) {
	/**
	 * Posted on Date
	 */
	function unique_addons_posted_on_date() {
		return get_the_date();
	}
}



if(!function_exists('unique_addons_variable_val_is_empty')) {
	/**
	 * Check if variable value is empty
	 */
	function unique_addons_variable_val_is_empty( $variable ) {
		if ( ( is_array($variable) && empty($variable) ) || ( !is_array($variable) && $variable == '' ) ) {
			return true;
		} else {
			return false;
		}
	}
}


