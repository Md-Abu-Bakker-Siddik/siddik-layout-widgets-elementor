<?php
/**
 * Global CPT helper functions.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return a registered plugin CPT slug.
 *
 * @param string $key portfolio|project|footer|megamenu|header_top|page_title|side_panel|project_cat|portfolio_cat.
 * @return string
 */
function unique_elementor_addons_get_cpt_slug( $key ) {
	$map = array(
		'portfolio'     => \UniqueAddons\CPT\CPT_Constants::PORTFOLIO,
		'project'       => \UniqueAddons\CPT\CPT_Constants::PROJECT,
		'footer'        => \UniqueAddons\CPT\CPT_Constants::FOOTER,
		'megamenu'      => \UniqueAddons\CPT\CPT_Constants::MEGAMENU,
		'header_top'    => \UniqueAddons\CPT\CPT_Constants::HEADER_TOP,
		'page_title'    => \UniqueAddons\CPT\CPT_Constants::PAGE_TITLE,
		'side_panel'    => \UniqueAddons\CPT\CPT_Constants::SIDE_PANEL,
		'project_cat'   => \UniqueAddons\CPT\CPT_Constants::PROJECT_CAT,
		'portfolio_cat' => \UniqueAddons\CPT\CPT_Constants::PORTFOLIO_CAT,
	);

	return isset( $map[ $key ] ) ? $map[ $key ] : '';
}
