<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 $settings['settings'] = $settings; ?>
<?php
	//Swiper Slider Data
	$swiper_slide_data_info = unique_addons_swiper_data_params( $settings );
?>
<?php if ( $hero_slider_items_array ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-hero-slider tm-horizontal-hero-slider <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" <?php unique_addons_print_pre_escaped_html_attrs( $swiper_slide_data_info ); ?>>
		<div class="swiper-container-inner">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php foreach (  $hero_slider_items_array as $hero_slider_item ) { ?>
					<?php $settings['hero_slider_item'] = $hero_slider_item; ?>
					<?php
						$animation = "";
						$animation_delay = "";
						if(isset($hero_slider_item['wow_appear_animation']) && !empty($hero_slider_item['wow_appear_animation'])) {
							$animation = $hero_slider_item['wow_appear_animation'];
						}
						if(isset($hero_slider_item['wow_animation_delay']) && !empty($hero_slider_item['wow_animation_delay'])) {
							$animation_delay = $hero_slider_item['wow_animation_delay'] . 'ms';
						}
					?>
					<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $hero_slider_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
						<?php unique_addons_get_shortcode_template_part( 'slider-item', $_skin, 'hero-slider/tpl', $settings, false ); ?>
					</div>
				<?php } ?>
				<!-- end of the loop -->
			</div>
		</div>


		<div class="tm-parts-thumbnail">
			<div class="swiper swiper-item-wrap tm-hero-slider-thumb">
				<div class="swiper-wrapper">
					<?php foreach (  $hero_slider_items_array as $hero_slider_item ) { ?>
					<?php $settings['hero_slider_item'] = $hero_slider_item; ?>
					<div class="swiper-slide">
						<?php unique_addons_get_shortcode_template_part( 'slider-item-thumb', $_skin, 'hero-slider/tpl', $settings, false ); ?>
					</div>
					<?php } ?>
					<!-- end of the loop -->
				</div>
			</div>
		</div>

		<div class="swiper-pagination <?php if( $bullets !== 'yes' ) echo esc_attr( "d-none" ); ?>"></div>

		<div class="tm-swiper-arrow-wrap tm-swiper-button-wrap <?php if( $arrow !== 'yes' ) echo esc_attr( "d-none" ); ?>">
			<div class="tm-swiper-arrow tm-swiper-button-prev"><i class="lnr-icon-arrow-left"></i></div>
			<div class="tm-swiper-arrow tm-swiper-button-next"><i class="lnr-icon-arrow-right"></i></div>
		</div>
	</div>

<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>