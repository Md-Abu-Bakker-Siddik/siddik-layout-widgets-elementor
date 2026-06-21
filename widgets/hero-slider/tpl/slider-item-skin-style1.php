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
$count = $hero_slider_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>



<div class="hero-slider-style1">
	<div class="business-image">
		<?php unique_addons_get_shortcode_template_part( 'part-featured-image', null, 'hero-slider/tpl', $hero_slider_item, false );?>
		<div class="business-layer-wrapper">
			<?php unique_addons_get_shortcode_template_part( 'part-featured-image-two', null, 'hero-slider/tpl', $hero_slider_item, false );?>
			<?php unique_addons_get_shortcode_template_part( 'part-featured-image-two', null, 'hero-slider/tpl', $hero_slider_item, false );?>
			<?php unique_addons_get_shortcode_template_part( 'part-featured-image-two', null, 'hero-slider/tpl', $hero_slider_item, false );?>
			<?php unique_addons_get_shortcode_template_part( 'part-featured-image-two', null, 'hero-slider/tpl', $hero_slider_item, false );?>
		</div>
	</div>
	<div class="content">
		<div class="icon">
			<?php unique_addons_get_shortcode_template_part( 'icon-type', $hero_slider_item['icon_type'], 'hero-slider/tpl', $hero_slider_item, false );?>
		</div>
		<?php unique_addons_get_shortcode_template_part( 'part-title', null, 'hero-slider/tpl', $hero_slider_item, false );?>
		<?php unique_addons_get_shortcode_template_part( 'part-content', null, 'hero-slider/tpl', $hero_slider_item, false );?>
	</div>
</div>