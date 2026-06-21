<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="box-hover-effect play-video-button tm-sc-video-popup tm-sc-video-popup-style-current-theme <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="effect-wrapper">
		<?php if( isset( $style1_featured_image['id'] ) && !empty( $style1_featured_image['id'] ) ): ?>
		<div class="thumb">
		<?php
			$image_alt = get_post_meta($style1_featured_image['id'], '_wp_attachment_image_alt', TRUE);
		?>
  			<img class="img-fullwidth" src="<?php $image = wp_get_attachment_image_src( $style1_featured_image['id'], $style1_featured_image_size); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
		</div>
		<?php endif; ?>



		<?php if( isset( $style1_play_btn['id'] ) && !empty( $style1_play_btn['id'] ) ) { ?>
		<div class="text-holder video-button-holder">
		<?php
			$image_alt = get_post_meta($style1_play_btn['id'], '_wp_attachment_image_alt', TRUE);
		?>
			<a data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>" title="<?php echo esc_attr( $title  ); ?>">
				<img class="" src="<?php $image = wp_get_attachment_image_src( $style1_play_btn['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
			</a>
		</div>
		<?php } else if( isset( $style1_pre_packaged_play_btn ) && !empty( $style1_pre_packaged_play_btn ) ) { ?>
		<div class="text-holder video-button-holder pre-packaged-play-btn">
			<a data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>" title="<?php echo esc_attr( $title  ); ?>">
				<img class="" src="<?php echo esc_url( UNIQUE_ADDONS_ASSETS_URI . '/images/video-play-btn/' . $style1_pre_packaged_play_btn );?>" alt="<?php esc_attr_e( 'Image', 'siddik-layout-widgets-elementor' ); ?>">
			</a>
		</div>
		<?php } else { ?>
		<div class="animated-css-play-button"><span class="play-icon"><i class="fa fa-play"></i></span></div>
		<?php } ?>

		<div class="video-button-text"><?php echo esc_html( $title  ); ?></div>

		<a class="hover-link" data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>" title="<?php echo esc_attr( $title  ); ?>"><?php echo esc_html( $title  ); ?></a>
	</div>
</div>
