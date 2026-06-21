<?php
/**
 * Register Free-tier Elementor widgets.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register widgets included in the Free plugin.
 *
 * @return void
 */
function slwe_register_free_elementor_widgets() {
	$manager = \Elementor\Plugin::instance()->widgets_manager;

	$manager->register( new \UniqueAddons\Widgets\HeroSlider\TM_Elementor_HeroSlider() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Blog_List() );
	$manager->register( new \UniqueAddons\Widgets\ThemeButton\TM_Elementor_Theme_Button() );
	$manager->register( new \UniqueAddons\Widgets\FeaturesBlock\TM_Elementor_FeaturesBlock() );
	$manager->register( new \UniqueAddons\Widgets\ServiceBlock\TM_Elementor_ServiceBlock() );
	$manager->register( new \UniqueAddons\Widgets\TeamBlock\TM_Elementor_TeamBlock() );
	$manager->register( new \UniqueAddons\Widgets\TestimonialBlock\TM_Elementor_TestimonialBlock() );
	$manager->register( new \UniqueAddons\Widgets\CounterBlock\TM_Elementor_CounterBlock() );

	$manager->register( new \UniqueAddons\Widgets\Accordion\TM_Elementor_Accordion() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Button() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Clients_logo() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Contact_Form_7() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Contact_List() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Funfact_Counter() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Iconbox() );
	$manager->register( new \UniqueAddons\Widgets\InfoBox\TM_Elementor_InfoBox() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_List() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Progress_Bar() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Section_Title() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_Social_Links() );
	$manager->register( new \UniqueAddons\Widgets\Tabs\TM_Elementor_Tabs() );
	$manager->register( new \UniqueAddons\Widgets\TM_Elementor_TextEditor() );
	$manager->register( new \UniqueAddons\Widgets\VideoPopup\TM_Elementor_Video_Popup() );

	$manager->register( new \UniqueAddons\Widgets\Blog\TM_Elementor_Blog() );
}
