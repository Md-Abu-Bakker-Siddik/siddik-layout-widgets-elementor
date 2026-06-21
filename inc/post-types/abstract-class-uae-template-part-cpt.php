<?php
/**
 * Reusable template part CPT registration.
 *
 * @package SiddikLayoutWidgetsElementor
 */

namespace UniqueAddons\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base class for Elementor template part CPTs.
 */
abstract class Abstract_UAE_Template_Part_CPT extends Abstract_UAE_CPT {

	/**
	 * Shortcode tag without brackets.
	 *
	 * @var string
	 */
	protected $shortcode_tag = '';

	/**
	 * Register list table hooks.
	 *
	 * @return void
	 */
	protected function register_admin_columns() {
		add_filter( 'manage_edit-' . $this->pt_key . '_columns', array( $this, 'admin_columns' ) );
		add_filter( 'manage_' . $this->pt_key . '_posts_custom_column', array( $this, 'admin_column_content' ), 10, 2 );
	}

	/**
	 * {@inheritdoc}
	 */
	public function register() {
		register_post_type(
			$this->pt_key,
			array_merge(
				$this->get_base_args(),
				array(
					'labels'              => $this->get_labels(),
					'description'         => $this->get_description(),
					'supports'            => array( 'title', 'editor', 'revisions' ),
					'hierarchical'        => false,
					'public'              => true,
					'show_ui'             => true,
					'show_in_menu'        => 'uae-templates',
					'menu_icon'           => $this->menu_icon,
					'show_in_admin_bar'   => true,
					'show_in_nav_menus'   => false,
					'can_export'          => true,
					'has_archive'         => false,
					'exclude_from_search' => true,
					'publicly_queryable'  => true,
					'rewrite'             => array(
						'slug'       => $this->rewrite_slug,
						'with_front' => false,
					),
				)
			)
		);

		$this->enable_elementor_support();
	}

	/**
	 * CPT description for registration.
	 *
	 * @return string
	 */
	abstract protected function get_description();

	/**
	 * Admin list table columns.
	 *
	 * @param array $columns Existing columns.
	 * @return array
	 */
	public function admin_columns( $columns ) {
		return array(
			'cb'        => $columns['cb'],
			'title'     => esc_html__( 'Title', 'siddik-layout-widgets-elementor' ),
			'shortcode' => esc_html__( 'Shortcode', 'siddik-layout-widgets-elementor' ),
			'date'      => esc_html__( 'Date', 'siddik-layout-widgets-elementor' ),
		);
	}

	/**
	 * Admin list table column content.
	 *
	 * @param string $column Column key.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public function admin_column_content( $column, $post_id ) {
		if ( 'shortcode' !== $column ) {
			return;
		}

		echo '<code>' . esc_html( CPT_Display::get_shortcode_for_post( $post_id, $this->shortcode_tag ) ) . '</code>';
	}
}
