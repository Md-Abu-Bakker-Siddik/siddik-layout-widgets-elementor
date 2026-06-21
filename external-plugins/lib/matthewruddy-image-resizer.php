<?php
/**
 * Resizes an image and returns an array containing the resized URL, width, height and file type.
 *
 * Uses native WordPress functionality via WP_Image_Editor.
 *
 * Copyright 2013 Matthew Ruddy (http://easinglider.com)
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * @author Matthew Ruddy (http://easinglider.com)
 * @return array An array containing the resized image URL, width, height and file type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $wp_version ) && version_compare( $wp_version, '3.5' ) >= 0 ) {
	/**
	 * Resize a media library image to the requested dimensions.
	 *
	 * @param string      $url    Attachment URL.
	 * @param int|null    $width  Target width.
	 * @param int|null    $height Target height.
	 * @param bool        $crop   Whether to crop the image.
	 * @param bool|int    $retina Retina multiplier.
	 * @return array|WP_Error
	 */
	function unique_addons_matthewruddy_image_resize( $url, $width = null, $height = null, $crop = true, $retina = false ) {
		if ( empty( $url ) ) {
			return array(
				'error'  => true,
				'url'    => '',
				'width'  => (int) $width,
				'height' => (int) $height,
			);
		}

		$width  = $width ? (int) $width : (int) get_option( 'thumbnail_size_w' );
		$height = $height ? (int) $height : (int) get_option( 'thumbnail_size_h' );
		$retina = $retina ? ( true === $retina ? 2 : (int) $retina ) : 1;

		$attachment_id = attachment_url_to_postid( $url );
		if ( ! $attachment_id ) {
			return array(
				'url'    => $url,
				'width'  => $width,
				'height' => $height,
			);
		}

		$file_path = get_attached_file( $attachment_id );
		if ( ! $file_path || ! file_exists( $file_path ) ) {
			return array(
				'url'    => $url,
				'width'  => $width,
				'height' => $height,
			);
		}

		$dest_width  = $width * $retina;
		$dest_height = $height * $retina;

		$info = pathinfo( $file_path );
		$dir  = $info['dirname'];
		$ext  = isset( $info['extension'] ) ? $info['extension'] : '';
		$name = wp_basename( $file_path, '.' . $ext );

		if ( 'bmp' === $ext ) {
			return new WP_Error(
				'bmp_mime_type',
				esc_html__( 'Image is BMP. Please use either JPG or PNG.', 'siddik-layout-widgets-elementor' ),
				$url
			);
		}

		$suffix         = "{$dest_width}x{$dest_height}";
		$dest_file_name = "{$dir}/{$name}-{$suffix}.{$ext}";

		if ( ! file_exists( $dest_file_name ) ) {
			$editor = wp_get_image_editor( $file_path );
			if ( is_wp_error( $editor ) ) {
				return array(
					'url'    => $url,
					'width'  => $width,
					'height' => $height,
				);
			}

			$size        = $editor->get_size();
			$orig_width  = $size['width'];
			$orig_height = $size['height'];
			$src_x       = 0;
			$src_y       = 0;
			$src_w       = $orig_width;
			$src_h       = $orig_height;

			if ( $crop ) {
				$cmp_x = $orig_width / $dest_width;
				$cmp_y = $orig_height / $dest_height;

				if ( $cmp_x > $cmp_y ) {
					$src_w = round( $orig_width / $cmp_x * $cmp_y );
					$src_x = round( ( $orig_width - ( $orig_width / $cmp_x * $cmp_y ) ) / 2 );
				} elseif ( $cmp_y > $cmp_x ) {
					$src_h = round( $orig_height / $cmp_y * $cmp_x );
					$src_y = round( ( $orig_height - ( $orig_height / $cmp_y * $cmp_x ) ) / 2 );
				}
			}

			$editor->crop( $src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height );
			$saved = $editor->save( $dest_file_name );

			if ( is_wp_error( $saved ) ) {
				return array(
					'url'    => $url,
					'width'  => $width,
					'height' => $height,
				);
			}

			$resized_url    = str_replace( basename( $url ), basename( $saved['path'] ), $url );
			$resized_width  = $saved['width'];
			$resized_height = $saved['height'];
			$resized_type   = $saved['mime-type'];

			$metadata = wp_get_attachment_metadata( $attachment_id );
			if ( isset( $metadata['image_meta'] ) ) {
				$metadata['image_meta']['resized_images'][] = $resized_width . 'x' . $resized_height;
				wp_update_attachment_metadata( $attachment_id, $metadata );
			}

			$image_array = array(
				'url'    => $resized_url,
				'width'  => $resized_width,
				'height' => $resized_height,
				'type'   => $resized_type,
			);
		} else {
			$image_array = array(
				'url'    => str_replace( basename( $url ), basename( $dest_file_name ), $url ),
				'width'  => $dest_width,
				'height' => $dest_height,
				'type'   => $ext,
			);
		}

		return $image_array;
	}
}

if ( ! function_exists( 'unique_addons_matthewruddy_delete_resized_images' ) ) {
	add_action( 'delete_attachment', 'unique_addons_matthewruddy_delete_resized_images' );
	/**
	 * Delete resized images when the original attachment is removed.
	 *
	 * @param int $post_id Attachment ID.
	 * @return void
	 */
	function unique_addons_matthewruddy_delete_resized_images( $post_id ) {
		$metadata = wp_get_attachment_metadata( $post_id );
		if ( ! $metadata ) {
			return;
		}

		if ( ! isset( $metadata['file'] ) || ! isset( $metadata['image_meta']['resized_images'] ) ) {
			return;
		}

		$pathinfo       = pathinfo( $metadata['file'] );
		$resized_images = $metadata['image_meta']['resized_images'];
		$wp_upload_dir  = wp_upload_dir();
		$upload_dir     = $wp_upload_dir['basedir'];

		if ( ! is_dir( $upload_dir ) ) {
			return;
		}

		foreach ( $resized_images as $dims ) {
			$file = $upload_dir . '/' . $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '-' . $dims . '.' . $pathinfo['extension'];
			wp_delete_file( $file );
		}
	}
}
