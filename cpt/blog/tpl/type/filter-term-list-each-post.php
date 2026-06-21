<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	$term_slugs_list = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "slugs") );
	// Handle potential WP_Error
	if ( is_wp_error( $term_slugs_list ) ) {
		$term_slugs_list = array();
	}
	$term_slugs_list_string = implode( ' ', $term_slugs_list );


	$masonry_tiles_image_size_class = 'tm-masonry-default';
	if ( 'yes' === $use_masonry_tiles_featured_image_size ) {
		$meta_featured_image_size = ! empty( $featured_image_size ) ? $featured_image_size : 'default';
		$settings['featured_image_size'] = $meta_featured_image_size;

		switch ( $meta_featured_image_size ) {
			case 'large-height':
				$masonry_tiles_image_size_class = 'tm-masonry-large-height';
				break;
			case 'large-wide':
				$masonry_tiles_image_size_class = 'tm-masonry-large-wide';
				break;
			case 'large-width-height':
				$masonry_tiles_image_size_class = 'tm-masonry-large-width-height';
				break;
			default:
				$masonry_tiles_image_size_class = 'tm-masonry-default';
				$settings['featured_image_size'] = $featured_image_size;
				break;
		}

		if ( $settings['display_type'] != 'masonry-tiles' ) {
			$masonry_tiles_image_size_class = '';
		}
	}
?>