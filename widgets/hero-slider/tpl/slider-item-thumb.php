<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- Service Block Style1-->
<?php
$featured_image = $hero_slider_item['featured_image_two'];
$featured_image_size = $hero_slider_item['featured_image_two_size'];
$image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size);
			$image_alt = get_post_meta($featured_image['id'], '_wp_attachment_image_alt', TRUE);
?>
<?php if ( $settings['show_thumb'] == 'yes' ) { ?>
<div class="thumb-item fadeInUp" data-wow-delay="200">
  <?php if ( $settings['show_thumb_img'] == 'yes' ) { ?>
  <div class="thumb-inner">
	  <img src="<?php $image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size); echo esc_url( $image[0] );?>" width="<?php echo esc_attr( $image[1] );?>" height="<?php echo esc_attr( $image[2] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
  </div>
  <?php } ?>
  <?php if ( $settings['show_thumb_title'] == 'yes' ) { ?>
  <div class="title"><?php echo esc_html( $hero_slider_item['title'] ); ?></div>
  <?php } ?>
</div>
<?php } ?>