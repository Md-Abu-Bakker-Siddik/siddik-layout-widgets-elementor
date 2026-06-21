<?php
namespace UniqueAddons\Lib;

/**
 * interface Unique_Addons_Interface_PostType
 * @package UniqueAddons\Lib;
 */
interface Unique_Addons_Interface_PostType {
	/**
	 * Returns PT Key
	 * @return string
	 */
	public function getPTKey();

	/**
	 * It registers custom post type
	 */
	public function register();
}