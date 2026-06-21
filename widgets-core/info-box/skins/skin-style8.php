<?php
namespace UniqueAddons\Widgets\InfoBox\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Skin_Base as Elementor_Skin_Base;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_style8 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-info-box/tm_general/after_section_end', [ $this, 'register_layout_controls1' ] );
	}

	public function get_id() {
		return 'skin-style8';
	}


	public function get_title() {
		return __( 'Skin - Style 8', 'siddik-layout-widgets-elementor' );
	}


	public function register_layout_controls1( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$html = '';
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-info-box-style8', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/info-box/info-box-skin8' . $direction_suffix . '.css' );

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );


		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'info-box', $settings['_skin'], 'info-box/tpl', $settings, true );

		unique_addons_print_template_html( $html );

	}
}
