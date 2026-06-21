<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="tm-sc-video-popup tm-sc-video-popup-css-button <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="box-hover-effect play-video-button">
		<div class="effect-wrapper d-flex align-items-center">
			<div class="animated-css-play-button"><div class="bg-block"></div><span class="play-icon"><i class="fa fa-play"></i></span></div>
			<a class="hover-link" data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>" title="<?php echo esc_attr( $css_button_title  ); ?>"></a>
		</div>
	</div>
</div>
