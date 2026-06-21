<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once UNIQUE_ADDONS_ABS_PATH . 'lib/plugin-core-functions.php';

require_once UNIQUE_ADDONS_ABS_PATH . 'lib/functions.php';

require_once UNIQUE_ADDONS_ABS_PATH . 'lib/plugin-core-utility-variables-functions.php';



/* WordPress Post Like System

================================================== */

if (!function_exists('unique_addons_sl_get_simple_likes_button')) {

require_once UNIQUE_ADDONS_ABS_PATH . 'external-plugins/wp-post-like-system/post-like.php';

}

