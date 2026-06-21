<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Loads all Custom Post Types located in post-types folder
================================================== */
require_once UNIQUE_ADDONS_ABS_PATH . 'lib/interface-post-type.php';
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/cpt-constants.php';
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/cpt-functions.php';
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/abstract-class-uae-cpt.php';
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/abstract-class-uae-template-part-cpt.php';
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/class-uae-cpt-display.php';
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/class-uae-cpt-templates.php';

foreach ( glob( UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/*/loader.php' ) as $each_cpt_loader ) {
	require_once $each_cpt_loader;
}

// Pro CPT loaders are loaded by the Pro add-on (pro/load-cpt-pro.php).

//load shortcodes for custom-post-types
require_once UNIQUE_ADDONS_ABS_PATH . 'inc/post-types/reg-post-type.php';

use UniqueAddons\CPT;
use UniqueAddons\Lib;

// activate custom post types
function unique_addons_reg_custom_post_types() {
    CPT\Reg_Post_Type::get_instance()->register();
}

//init cpt - priority 15 ensures it runs after plugin initialization (priority 5)
add_action('init', 'unique_addons_reg_custom_post_types', 15);