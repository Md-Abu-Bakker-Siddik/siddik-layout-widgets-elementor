<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="box-hover-effect play-video-button tm-sc-video-popup tm-sc-video-popup-button-over-image <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="effect-wrapper">
		<?php if( isset( $button_over_image_featured_image['id'] ) && !empty( $button_over_image_featured_image['id'] ) ): ?>
		<div class="thumb" style="background-image:url('<?php $image = wp_get_attachment_image_src( $button_over_image_featured_image['id'], $button_over_image_featured_image_size); echo esc_url( $image[0] );?>')">
		</div>
		<?php endif; ?>



		<?php if( isset( $button_over_image_play_btn['id'] ) && !empty( $button_over_image_play_btn['id'] ) ) { ?>
		<div class="text-holder video-button-holder">
		<?php
			$image_alt = get_post_meta($button_over_image_play_btn['id'], '_wp_attachment_image_alt', TRUE);
		?>
			<a data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>" title="<?php echo esc_attr( $title  ); ?>">
				<img class="" src="<?php $image = wp_get_attachment_image_src( $button_over_image_play_btn['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
			</a>
		</div>
		<?php } else if( isset( $button_over_image_pre_packaged_play_btn ) && !empty( $button_over_image_pre_packaged_play_btn ) ) { ?>
		<div class="text-holder video-button-holder pre-packaged-play-btn">
			<a data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>" title="<?php echo esc_attr( $title  ); ?>">
				<img class="" src="<?php echo esc_url( UNIQUE_ADDONS_ASSETS_URI . '/images/video-play-btn/' . $button_over_image_pre_packaged_play_btn );?>" alt="<?php esc_attr_e( 'Image', 'siddik-layout-widgets-elementor' ); ?>">
			</a>
		</div>
		<?php } else { ?>
		<div class="animated-css-play-button"><div class="bg-block"></div><span class="play-icon"><i class="fa fa-play"></i></span></div>
		<?php } ?>

		<div class="video-button-text"><?php echo esc_html( $button_over_image_title  ); ?></div>

		<a class="hover-link" data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>" title="<?php echo esc_attr( $button_over_image2_title  ); ?>"><?php echo esc_html( $button_over_image_title  ); ?></a>
	</div>
</div>
