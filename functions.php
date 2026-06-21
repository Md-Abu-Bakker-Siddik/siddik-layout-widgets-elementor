<?php
use Elementor\Controls_Manager;

if(!function_exists('unique_addons_get_cpt_shortcode_template_part')) {
	/**
	 * Load a cpt shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function unique_addons_get_cpt_shortcode_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'cpt/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('unique_addons_get_shortcode_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function unique_addons_get_shortcode_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'widgets/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('unique_addons_get_widgetcore_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function unique_addons_get_widgetcore_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'widgets-core/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('unique_addons_get_shortcode_shop_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function unique_addons_get_shortcode_shop_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'widgets-shop/' . $folder . '/' . $slug;

		return unique_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

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
		$roots   = array( UNIQUE_ADDONS_ABS_PATH );

		if ( defined( 'SLWE_PRO_ABS_PATH' ) && SLWE_PRO_ABS_PATH ) {
			$roots[] = SLWE_PRO_ABS_PATH;
		}

		foreach ( (array) $template_names as $template_name ) {
			if ( ! $template_name ) {
				continue;
			}

			foreach ( $roots as $root ) {
				if ( file_exists( $root . $template_name ) ) {
					$located = $root . $template_name;
					break 2;
				}
			}
		}

		return $located;
	}
}



if (!function_exists('unique_addons_shortcode_get_blog_post_format')) {
  /**
   * Return Shortcode Blog Post Format HTML
   */
  function unique_addons_shortcode_get_blog_post_format( $post_format = '', $params = array() ) {

    $format = $post_format ? : 'standard';
    $params['post_format'] = $format;

    //Produce HTML version by using the parameters (filename, variation, folder name, parameters)
    $html = unique_addons_get_cpt_shortcode_template_part( 'post-format', $format, 'blog/tpl/post-format', $params, true );
    return $html;
  }
}

if ( ! function_exists( 'unique_addons_is_elementor_pro_activated' ) ) {
    function unique_addons_is_elementor_pro_activated() {
        return function_exists( 'elementor_pro_load_plugin' ) ? true : false;
    }
}

if ( ! function_exists( 'unique_addons_elementor_grid_responsive_columns' ) ) {
    function unique_addons_elementor_grid_responsive_columns( $control_object ) {
			$control_object->add_responsive_control(
				'responsive_columns', [
					'label' => esc_html__( "Responsive Columns Layout", 'siddik-layout-widgets-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'100'  	=>  '1',
						'49.98' =>  '2',
						'33.2'  =>  '3',
						'24.98' =>  '4',
						'19.98' =>  '5',
						'14.2'  =>  '6',
					],
					'condition' => [
						'display_type!' => array('carousel')
					],
					'selectors' => [
						'{{WRAPPER}} .isotope-layout .isotope-item' => 'width: {{VALUE}}% !important;'
					]
				]
			);
    }
}


