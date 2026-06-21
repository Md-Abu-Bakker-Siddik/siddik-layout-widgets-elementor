<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- Service Block Style1-->
<?php
$hero_slider_item['settings'] = $settings;
$hero_slider_item['title_tag'] = $title_tag;
$hero_slider_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $hero_slider_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';


$featured_image = $hero_slider_item['featured_image'];
$featured_image_size = $hero_slider_item['featured_image_size'];
$image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size);
?>
<div class="hero-slider-item hero-slider-style1" data-bg-image="<?php echo esc_attr($image[0]); ?>">
  <div class="e-con e-flex">
    <div class="e-con-inner">
      <div class="content-wrap">
        <div class="slider-content">
          <?php unique_addons_get_shortcode_template_part( 'part-subtitle', null, 'hero-slider/tpl', $hero_slider_item, false );?>
          <?php unique_addons_get_shortcode_template_part( 'part-title', null, 'hero-slider/tpl', $hero_slider_item, false );?>
          <?php unique_addons_get_shortcode_template_part( 'part-content', null, 'hero-slider/tpl', $hero_slider_item, false );?>
          <?php unique_addons_get_shortcode_template_part( 'button', null, 'hero-slider/tpl', $hero_slider_item, false );?>
        </div>
      </div>
    </div>
  </div>
</div>