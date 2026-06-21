<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="tm-sc-video-popup tm-sc-video-popup-custom-css-button <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<a class="video-play-button" data-lightbox="iframe" href="<?php echo esc_url( $popup_video_url ); ?>"><i class="fa fa-play"></i></a>
</div>
