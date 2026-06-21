<?php
// Block direct requests
if ( !defined('ABSPATH') ) die('-1');


if(!function_exists('unique_addons_register_widgets')) {
	/**
	 * Register all widgets
	 */
	function unique_addons_register_widgets() {
		$widget_list = array(
			'Unique_Addons_Widget_BlogList',
		);

		//apply filter
		if( has_filter('unique_addons_register_widgets_add_widgets') ) {
			$widget_list = apply_filters('unique_addons_register_widgets_add_widgets', $widget_list);
		}

		foreach( $widget_list as $each_widget ) {
			register_widget( $each_widget );
		}

	}
	/* Register the widget */
	unique_addons_register_widgets();
}
