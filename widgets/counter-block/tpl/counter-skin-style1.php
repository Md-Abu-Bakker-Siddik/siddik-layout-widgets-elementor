<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- Counter block-->
<?php $settings['settings'] = $settings;?>
<?php
$animation = "";
$animation_delay = "";
if(isset($wow_appear_animation) && !empty($wow_appear_animation)) {
	$animation = $wow_appear_animation;
}
if(isset($wow_animation_delay) && !empty($wow_animation_delay)) {
	$animation_delay = $wow_animation_delay . 'ms';
}

$image[0] = '';
if( isset($skin_style1_featured_image['id']) && !empty($skin_style1_featured_image['id']) ){
	$image = wp_get_attachment_image_src( $skin_style1_featured_image['id'], 'full');
}
//if empty then use this default image
if( empty($image[0])) {
  $image[0] = UNIQUE_ADDONS_ASSETS_URI . '/images/current-theme/pattern-1.png';
}
?>

<div class="counter-item counter-item-style1 uae-counter <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
  <?php if ( $show_counter == 'yes' ): ?>
		<?php unique_addons_get_shortcode_template_part( 'counter', null, 'counter-block/tpl', $settings, false );?>
	<?php endif;?>
  <?php if ( $show_title == 'yes' ): ?>
			<?php unique_addons_get_shortcode_template_part( 'title', null, 'counter-block/tpl', $settings, false );?>
		<?php endif;?>
</div>