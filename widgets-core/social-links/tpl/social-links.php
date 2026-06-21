<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<ul class="tm-sc-social-links <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">

	<?php if( !empty( $url_twitter ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_twitter ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-twitter"></i></a></li>
	<?php } ?>
	<?php if( !empty( $url_facebook ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_facebook ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-facebook"></i></a></li>
	<?php } ?>
	<?php if( !empty( $url_youtube ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_youtube ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-youtube"></i></a></li>
	<?php } ?>

	<?php if( !empty( $url_linkedin ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_linkedin ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
	<?php } ?>
	<?php if( !empty( $url_instagram ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_instagram ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-instagram"></i></a></li>
	<?php } ?>
	<?php if( !empty( $url_tumblr ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_tumblr ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-tumblr"></i></a></li>
	<?php } ?>

	<?php if( !empty( $url_vk ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_vk ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-vk"></i></a></li>
	<?php } ?>
	<?php if( !empty( $url_pinterest ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_pinterest ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-pinterest"></i></a></li>
	<?php } ?>
	<?php if( !empty( $url_reddit ) ) { ?>
	<li><a class="social-link" aria-label="<?php echo esc_attr__('Social Link', 'siddik-layout-widgets-elementor'); ?>" href="<?php echo esc_url( $url_reddit ); ?>" target="<?php echo ( ( $target == '' ) ? esc_attr( '_self' ) : esc_attr( $target ) ); ?>"><i class="fa fa-reddit"></i></a></li>
	<?php } ?>
</ul>