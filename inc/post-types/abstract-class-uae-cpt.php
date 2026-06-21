<?php
/**
 * Shared helpers for plugin custom post types.
 *
 * @package SiddikLayoutWidgetsElementor
 */

namespace UniqueAddons\CPT;

use UniqueAddons\Lib;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Abstract CPT base class.
 */
abstract class Abstract_UAE_CPT implements Lib\Unique_Addons_Interface_PostType {

	/**
	 * Post type key.
	 *
	 * @var string
	 */
	protected $pt_key = '';

	/**
	 * Rewrite slug.
	 *
	 * @var string
	 */
	protected $rewrite_slug = '';

	/**
	 * Singular label.
	 *
	 * @var string
	 */
	protected $singular_name = '';

	/**
	 * Plural label.
	 *
	 * @var string
	 */
	protected $plural_name = '';

	/**
	 * Dashicon for admin menu.
	 *
	 * @var string
	 */
	protected $menu_icon = 'dashicons-admin-post';

	/**
	 * {@inheritdoc}
	 */
	public function getPTKey() {
		return $this->pt_key;
	}

	/**
	 * Default registration arguments shared by all plugin CPTs.
	 *
	 * @return array
	 */
	protected function get_base_args() {
		return array(
			'map_meta_cap'    => true,
			'capability_type' => 'post',
			'show_in_rest'    => true,
		);
	}

	/**
	 * Register labels for a CPT.
	 *
	 * @return array
	 */
	protected function get_labels() {
		return array(
			'name'                  => $this->plural_name,
			'singular_name'         => $this->singular_name,
			'menu_name'             => $this->plural_name,
			'name_admin_bar'        => $this->singular_name,
			'archives'              => sprintf(
				/* translators: %s: post type plural label */
				esc_html__( '%s Archives', 'siddik-layout-widgets-elementor' ),
				$this->plural_name
			),
			'all_items'             => sprintf(
				/* translators: %s: post type plural label */
				esc_html__( 'All %s', 'siddik-layout-widgets-elementor' ),
				$this->plural_name
			),
			'add_new_item'          => sprintf(
				/* translators: %s: post type singular label */
				esc_html__( 'Add New %s', 'siddik-layout-widgets-elementor' ),
				$this->singular_name
			),
			'add_new'               => esc_html__( 'Add New', 'siddik-layout-widgets-elementor' ),
			'new_item'              => sprintf(
				/* translators: %s: post type singular label */
				esc_html__( 'New %s', 'siddik-layout-widgets-elementor' ),
				$this->singular_name
			),
			'edit_item'             => sprintf(
				/* translators: %s: post type singular label */
				esc_html__( 'Edit %s', 'siddik-layout-widgets-elementor' ),
				$this->singular_name
			),
			'update_item'           => sprintf(
				/* translators: %s: post type singular label */
				esc_html__( 'Update %s', 'siddik-layout-widgets-elementor' ),
				$this->singular_name
			),
			'view_item'             => sprintf(
				/* translators: %s: post type singular label */
				esc_html__( 'View %s', 'siddik-layout-widgets-elementor' ),
				$this->singular_name
			),
			'view_items'            => sprintf(
				/* translators: %s: post type plural label */
				esc_html__( 'View %s', 'siddik-layout-widgets-elementor' ),
				$this->plural_name
			),
			'search_items'          => sprintf(
				/* translators: %s: post type plural label */
				esc_html__( 'Search %s', 'siddik-layout-widgets-elementor' ),
				$this->plural_name
			),
			'not_found'             => esc_html__( 'Not found', 'siddik-layout-widgets-elementor' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'siddik-layout-widgets-elementor' ),
			'featured_image'        => esc_html__( 'Featured Image', 'siddik-layout-widgets-elementor' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'siddik-layout-widgets-elementor' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'siddik-layout-widgets-elementor' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'siddik-layout-widgets-elementor' ),
		);
	}

	/**
	 * Register a taxonomy with shared defaults.
	 *
	 * @param string $taxonomy Taxonomy slug.
	 * @param bool   $hierarchical Whether taxonomy is hierarchical.
	 * @param array  $labels Taxonomy labels.
	 * @param string $rewrite_slug Rewrite slug.
	 * @return void
	 */
	protected function register_taxonomy( $taxonomy, $hierarchical, array $labels, $rewrite_slug ) {
		register_taxonomy(
			$taxonomy,
			array( $this->pt_key ),
			array(
				'labels'            => $labels,
				'hierarchical'      => $hierarchical,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_in_rest'      => true,
				'rewrite'           => array(
					'slug'       => $rewrite_slug,
					'with_front' => false,
				),
			)
		);
	}

	/**
	 * Enable Elementor editing for this post type.
	 *
	 * @return void
	 */
	protected function enable_elementor_support() {
		add_action(
			'elementor/init',
			function () {
				add_post_type_support( $this->pt_key, 'elementor' );
			}
		);
	}
}
