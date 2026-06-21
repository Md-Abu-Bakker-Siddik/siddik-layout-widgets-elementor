<?php

//load lib
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/widgets/lib/abstract-widgets.php';

/* Loads all widgets located in widgets folder
================================================== */
if( !function_exists('unique_addons_load_all_widgets') ) {
	function unique_addons_load_all_widgets() {
		foreach( glob(UNIQUE_ADDONS_ABS_PATH.'inc/widgets/parts/*/loader.php') as $each_sc_loader ) {
			require_once $each_sc_loader;
		}
		require_once UNIQUE_ADDONS_ABS_PATH . 'inc/widgets/parts/reg-widgets.php';
	}
	add_action('widgets_init', 'unique_addons_load_all_widgets');
}
remove_filter('widget_text_content', 'wpautop');